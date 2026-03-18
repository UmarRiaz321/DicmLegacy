<?php
namespace App\Controllers;
/**
 * SignUp.php
 * An API to handle database operations
 * Created : 11/09/2023
 *
 * @author Umar Riaz
*/
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use App\Models\PluginModel;
use App\Libraries\Email;
use App\Libraries\Evaluate;
use CodeIgniter\Files\File;



class SignUp extends BaseController
{
    use ResponseTrait;
    protected $u_id;
    protected $c_id;
	protected $s_email;
    protected $eva;
    protected array $adminRecipients = [
        ['name' => 'Jay Baughan', 'email' => 'jay.baughan@pluggin.org'],
        ['name' => 'Umar Riaz', 'email' => 'umar.riaz@pluggin.org'],
    ];

    function __construct()
	{

		$this->db = db_connect();
		$this->model = new PluginModel($this->db);
		$this->s_email = new Email();
        $this->eva = new Evaluate();
	}


    public function vcsejoin(){

        helper(['form', 'url']);
		if ('POST' === $_SERVER['REQUEST_METHOD']) 
        {
            $mainEmail = trim((string) $this->request->getVar('cmcd_email'));
            $emailCheck = $this->checkEmailStatusInAuth($mainEmail);
            if (!$emailCheck['checked']) {
                return $this->response->setStatusCode(503)->setJSON([
                    'message' => 'Unable to verify email with auth server. Please try again shortly.',
                    'exists'  => false,
                    'csrf'    => $this->csrfPayload(),
                ]);
            }
            if ($emailCheck['exists']) {
                return $this->response->setStatusCode(409)->setJSON([
                    'message' => 'User already exists, please login.',
                    'exists'  => true,
                    'csrf'    => $this->csrfPayload(),
                ]);
            }

            $this->u_id= $this->addUser('charity');
            if($this->u_id){
                $this->c_id = $this->addCharity($this->u_id);
                if($this->c_id){

                    $mc = $this->cseMainContact($this->c_id);
                    $pd = $this->projectDetails($this->c_id);
                    $s = $this->cseSocials($this->c_id);
                    $result = [
                    'message' => 'Your request has been submitted successfully!',
                    "user_id" => $this->u_id,
                    "cse_id" => $this->c_id,
                    "cmc_id" => $mc, 
                    "pd_id" => $pd, 
                    "so_id" => $s, 
                    ];
                    $this->notifyAdmins('charity', [
                        'organisation' => (string) $this->request->getVar('cse_OrgName'),
                        'contact_name' => trim(((string) $this->request->getVar('cmcd_fname')) . ' ' . ((string) $this->request->getVar('cmcd_lname'))),
                        'contact_email' => (string) $this->request->getVar('cmcd_email'),
                        'user_id' => $this->u_id,
                        'record_id' => $this->c_id,
                    ]);
                    $res = json_encode($result,JSON_UNESCAPED_SLASHES);
                    // header('Content-Type: application/json')
                    return $this->response->setHeader("Content-Type", "application/json")->setBody($res);
                }
            }

        }

    }

    public function addUser($type){
        helper(['form', 'url']);
        if ('POST' === $_SERVER['REQUEST_METHOD']) 
        {
            $user =[
                'user_type' => $type,
                'u_status'=> 'submitted'
            ];
            return $this->model->insertItem('Users', $user);
        }
    }
    //  cse_id	user_id	cse_OrgName	cse_SpoNeeded	cse_Type	cse_YearFounded	cse_RegisteredNo	cse_SERNo	cse_Regions	cse_Theme	cse_CurrentSupporters	cse_AIncome	cse_referer
    // $this->request->getVar('fname')
    public function addCharity($u_id){

        helper(['form', 'url']); 
        if ('POST' === $_SERVER['REQUEST_METHOD']) 
        {
            $regions = $this->request->getVar('cse_Regions[]');
            $currentSupprot =  $this->request->getVar('cse_CurrentSupporters[]');
            $cs = "";
            $r = "";
            foreach($regions as $reg){
             $r .= $reg.",";
            } 
            $r = rtrim($r,',');
            foreach($currentSupprot as $c){
                $cs .= "$c".";";
               } 
            rtrim($cs,';');

            $charity =[
                'user_id' => $u_id,
                'cse_OrgName' => $this->request->getVar('cse_OrgName'),
                // 'cse_Type' => $this->request->getVar('cse_Type'),
                'cse_YearFounded' => $this->request->getVar('cse_YearFounded'),
                'cse_RegisteredNo' => $this->request->getVar('cse_RegisteredNo'),
                'cse_SERNo' => $this->request->getVar('cse_SERNo'),
                'cse_Regions' => $r,
                // 'cse_Theme' => $this->request->getVar('cse_Theme'),
                'cse_CurrentSupporters' =>$cs,
                'cse_AIncome' => $this->request->getVar('cse_AIncome'),
                'cse_referer' => $this->request->getVar('cse_referer'),
                "approved" => 0

            ];
            return $this->model->insertItem('Charities', $charity);
           
        }
    }

    public function cseMainContact($cse_id){
        helper(['form', 'url']); 
        if ('POST' === $_SERVER['REQUEST_METHOD']) 
        {  
            $address = "";
            $name = $this->request->getVar('cmcd_fname') . " " . $this->request->getVar('cmcd_lname'); 
            $street = $this->request->getVar('cse_street');
            $city = $this->request->getVar('cse_city');
            $county = $this->request->getVar('cse_county');
            $postcode = $this->request->getVar('cse_pcode');
            // $address = $aArr[0] . " "+ $aArr[1] . " "+ $aArr[2] . " ". $aArr[3];
            $address = $street . " " .$city . " ". $county . " ". $postcode;
            
            
            $MainContact =[
                'cse_id'=> $cse_id,
                'cmcd_name'=> $name,
                'cmcd_email'=> $this->request->getVar('cmcd_email'),
                'cmcd_phone'=> $this->request->getVar('cmcd_phone'),
                'cmcd_jtitle'=> $this->request->getVar('cmcd_jtitle'),
                'cse_address'=>  $address
            ];
            return $this->model->insertItem('CSE_MainContactdetails', $MainContact);
           
        }
    }

    public function projectDetails($cse_id){
        helper(['form', 'url']); 
        if ($this->request->getMethod() !== 'post') {
            return null;
        }

        $projects = $this->request->getVar('projects');
        $createdIds = [];

        if (is_array($projects) && !empty($projects)) {
            foreach ($projects as $project) {
                if (!is_array($project)) {
                    continue;
                }
                $payload = $this->mapProjectPayload($cse_id, $project);
                if (empty($payload)) {
                    continue;
                }
                $createdIds[] = $this->model->insertItem('CSE_ProjectDetail', $payload);
            }
        } else {
            $legacy = $this->mapProjectPayload($cse_id, $this->request->getVar());
            if (!empty($legacy)) {
                $createdIds[] = $this->model->insertItem('CSE_ProjectDetail', $legacy);
            }
        }

        return $createdIds;
    }
    public function cseSocials($cse_id){

        helper(['form', 'url', 'filesystem']); 
        if ('POST' === $_SERVER['REQUEST_METHOD']) 
        {  
            $logo = $this->request->getFile('logo');

            if($logo->isValid() && ! $logo->hasMoved()){
                $imageName = $logo->getRandomName();
                $logo->move('public/images/cselogos/',$imageName); 
            }
         
            $CSE_Socials =[
                'cse_id'=> $cse_id,
                'cs_Facebook'=> $this->request->getVar('cs_Facebook'),
                'cs_Instagram'=> $this->request->getVar('cs_Instagram'),
                'cs_Website'=> $this->request->getVar('cs_Website'),
                'cs_logo'=> $imageName?$imageName:"No Image"
            ];
            return $this->model->insertItem('CSE_Socials', $CSE_Socials);
        }

    }

    // Sponsor SighnUp Functions
    public function sponsorjoin(){
        helper(['form', 'url']);
		if ('POST' === $_SERVER['REQUEST_METHOD']) 
        {
            $mainEmail = trim((string) $this->request->getVar('smcd_Email'));
            $emailCheck = $this->checkEmailStatusInAuth($mainEmail);
            if (!$emailCheck['checked']) {
                return $this->response->setStatusCode(503)->setJSON([
                    'message' => 'Unable to verify email with auth server. Please try again shortly.',
                    'exists'  => false,
                    'csrf'    => $this->csrfPayload(),
                ]);
            }
            if ($emailCheck['exists']) {
                return $this->response->setStatusCode(409)->setJSON([
                    'message' => 'User already exists, please login.',
                    'exists'  => true,
                    'csrf'    => $this->csrfPayload(),
                ]);
            }

            $user_id = $this->addUser('sponsor');
            if(!empty($user_id)){
                $sp = $this->addSponsor($user_id);
                if($sp){
                    $spMc =$this->spoMContact($sp);
                    if(isset($_POST["sa_fName"]) || isset($_POST["sa_lName"]) || isset($_POST["sa_Email"]) ){
                        $spAcc =$this->spoAccounts($sp);   
                    }
                    if(isset($_POST["sm_fName"]) || isset($_POST["sm_lName"]) || isset($_POST["sm_Email"]) ){
                        $spMar =$this->spoMarketing($sp);   
                    }
                    $sps = $this->spoSocials($sp);
                    $result = [
                        'message' => 'Your request has been submitted successfully!',
                        "user_id" => $user_id,
                        "spo_id" => $sp,
                        ];
                    $this->notifyAdmins('sponsor', [
                        'organisation' => (string) $this->request->getVar('spo_OrgName'),
                        'contact_name' => trim(((string) $this->request->getVar('smcd_fname')) . ' ' . ((string) $this->request->getVar('smcd_lname'))),
                        'contact_email' => (string) $this->request->getVar('smcd_Email'),
                        'user_id' => $user_id,
                        'record_id' => $sp,
                    ]);
                    $res = json_encode($result,JSON_UNESCAPED_SLASHES);
                    // header('Content-Type: application/json')
                    return $this->response->setHeader("Content-Type", "application/json")->setBody($res);

                }

            }

        }
    }
    public function addSponsor($user_id){
        helper(['form', 'url']);
		if ('POST' === $_SERVER['REQUEST_METHOD']) 
        {
            $address = "";
            $st = $this->request->getVar('spo_add');
            $ci = $this->request->getVar('spo_city');
            $co = $this->request->getVar('spo_county');
            $pc = $this->request->getVar('spo_pcode');
            $address = $st . " ".$ci. " ".$co. " ".$pc;
            $regions = $this->request->getVar('spo_Regions[]');
            $r = "";
            foreach($regions as $reg){
             $r .= $reg.",";
            } 
            $r = rtrim($r,',');

            $clinets = $this->request->getVar('spo_clients[]');
            $c = "";    
            foreach($clinets as $cl){
                $c .= $cl.",";
            }
            $c = rtrim($c,',');
            
            $spoOrganisation = [
               
                "spo_OrgName" => $this->request->getVar('spo_OrgName'),
                "spo_TradingName" => $this->request->getVar('spo_TradingName'),
                "spo_Address" => $address,
                "spo_Registration" => $this->request->getVar('spo_Registration'),
                "spo_VatNumber" => $this->request->getVar('spo_VatNumber'),
                "spo_BusSize" => $this->request->getVar('spo_Bsize'),
                "spo_AccSetup" => $this->request->getVar('spo_AccountSetup'),
                "spo_Regions" => $r,
                "spo_Clients" => $c,
                "spo_Referer" => $this->request->getVar('spo_Referer'),
                "approved" => 0,
                "user_id" => $user_id
            ];

            return $this->model->insertItem('Sponsors', $spoOrganisation);

        }

    }
    public function spoMContact($sp_id){
        helper(['form', 'url']);
		if ('POST' === $_SERVER['REQUEST_METHOD']) 
        {
            $name = $this->request->getVar('smcd_fname') . " " . $this->request->getVar('smcd_lname'); 
            $spoMContact=[
                "spo_id" => $sp_id,
                "smcd_Name" => $name,
                "smcd_Email" => $this->request->getVar('smcd_Email'),
                "smcd_Phone" => $this->request->getVar('smcd_Phone'),
                "smcd_JobTitle" => $this->request->getVar('smcd_JobTitle'),
            ];
            return $this->model->insertItem('SPO_MainContactdetails', $spoMContact);

        }

    }
    public function spoAccounts($sp_id){
        $spoAcc=[
            "spo_id"=> $sp_id,
            "sa_fName"=> $this->request->getVar('sa_fName'),
            "sa_lName"=> $this->request->getVar('sa_lName'),
            "sa_Email"=> $this->request->getVar('sa_Email')
        ];
        return $this->model->insertItem('SPO_Accounts', $spoAcc);

    }

    public function spoMarketing($sp_id){
        $spoAcc=[
            "spo_id"=> $sp_id,
            "sm_fName"=> $this->request->getVar('sm_fName'),
            "sm_lName"=> $this->request->getVar('sm_lName'),
            "sm_Email"=> $this->request->getVar('sm_Email')
        ];
        return $this->model->insertItem('SPO_Marketing', $spoAcc);

    }
    // spoSocials
    public function spoSocials($sp_id){
        $spoSocials=[
            "spo_id"=> $sp_id,
            "sps_Facebook"=> $this->request->getVar('sps_Facebook'),
            "sps_Instagram"=> $this->request->getVar('sps_Instagram'),
            "sps_Website"=> $this->request->getVar('sps_Website'),
            "sps_Linkedin"=> $this->request->getVar('sps_Linkedin'),
            
        ];
        return $this->model->insertItem('SPO_Socials', $spoSocials);

    }

    // Enabler SignUp Functions enablerjoin

    public function enablerjoin(){
        helper(['form', 'url']);
		if ('POST' === $_SERVER['REQUEST_METHOD']) 
        {
            $mainEmail = trim((string) $this->request->getVar('emcd_Email'));
            $emailCheck = $this->checkEmailStatusInAuth($mainEmail);
            if (!$emailCheck['checked']) {
                return $this->response->setStatusCode(503)->setJSON([
                    'message' => 'Unable to verify email with auth server. Please try again shortly.',
                    'exists'  => false,
                    'csrf'    => $this->csrfPayload(),
                ]);
            }
            if ($emailCheck['exists']) {
                return $this->response->setStatusCode(409)->setJSON([
                    'message' => 'User already exists, please login.',
                    'exists'  => true,
                    'csrf'    => $this->csrfPayload(),
                ]);
            }

            $user_id = $this->addUser('enabler');
            if($user_id){
                $ena = $this->addEnabler($user_id);
                if($ena){
                    $emcd = $this->enaMContact($ena);
                    if(isset($_POST["epr_fName"]) || isset($_POST["epr_lName"]) || isset($_POST["epr_Email"]) ){
                        $enahprm =$this->ena_hprm($ena);   
                    }
                    if(isset($_POST["emr_fName"]) || isset($_POST["emr_lName"]) || isset($_POST["emr_Email"]) ){
                        $enahmar =$this->ena_hmar($ena);   
                    }
                    if(isset($_POST["epro_fName"]) || isset($_POST["epro_lName"]) || isset($_POST["epro_Email"]) ){
                        $enahpro =$this->ena_hpro($ena);   
                    }

                    if(isset($_POST["es_Facebook"]) || isset($_POST["es_Website"]) || isset($_POST["es_Instagram"]) ){
                        $ensocial = $this->enaSocials($ena);
                    }

                    $result = [
                        'message' => 'Your request has been submitted successfully!',
                        ];
                    $this->notifyAdmins('enabler', [
                        'organisation' => (string) $this->request->getVar('ena_OrgName'),
                        'contact_name' => trim(((string) $this->request->getVar('emcd_fname')) . ' ' . ((string) $this->request->getVar('emcd_lname'))),
                        'contact_email' => (string) $this->request->getVar('emcd_Email'),
                        'user_id' => $user_id,
                        'record_id' => $ena,
                    ]);
                    $res = json_encode($result,JSON_UNESCAPED_SLASHES);
                    // header('Content-Type: application/json')
                    return $this->response->setHeader("Content-Type", "application/json")->setBody($res);
                    
                    



                }

            }

        }
    }

    public function addEnabler($user_id){
        helper(['form', 'url']);
		if ('POST' === $_SERVER['REQUEST_METHOD']) 
        {
            $regions = $this->request->getVar('ena_regions[]');
            $r = "";
            foreach($regions as $reg){
             $r .= $reg.",";
            } 
            $r = rtrim($r,',');
            $enaOrganisation = [
                "ena_OrgName" => $this->request->getVar('ena_OrgName'),
                "ena_ServiceType" => $this->request->getVar('ena_ServiceType'),
                "ena_regions" => $r,
                // "ena_theme" => $this->request->getVar('ena_theme'),
                "approved" => 0,
                "user_id" => $user_id
            ];

            return $this->model->insertItem('Enablers', $enaOrganisation);

        }

    }

    public function enaMContact($ena_id){
        helper(['form', 'url']);
		if ('POST' === $_SERVER['REQUEST_METHOD']) 
        {
            $name = $this->request->getVar('emcd_fname') . " " . $this->request->getVar('emcd_lname'); 
            $enaMContact=[
                "ena_id" => $ena_id,
                "emcd_Name" => $name,
                "emcd_Email" => $this->request->getVar('emcd_Email'),
                "emcd_Phone" => $this->request->getVar('emcd_Phone'),
                "emcd_JobTitle" => $this->request->getVar('emcd_JobTitle'),
                "ena_Confirmation" => $this->request->getVar('ena_Confirmation')
            ];
            return $this->model->insertItem('ENA_MainContactdetails', $enaMContact);

        }

    }

    public function enaSocials($ena_id){
        $enaSocials=[
            "ena_id"=> $ena_id,
            "es_Facebook"=> $this->request->getVar('es_Facebook'),
            "es_Instagram"=> $this->request->getVar('es_Instagram'),
            "es_Website"=> $this->request->getVar('es_Website')
            
        ];
        return $this->model->insertItem('ENA_Socials', $enaSocials);

    }

    public function ena_hprm($ena_id){
        $spoAcc=[
            "ena_id"=> $ena_id,
            "epr_fName"=> $this->request->getVar('epr_fName'),
            "epr_lName"=> $this->request->getVar('epr_lName'),
            "epr_Email"=> $this->request->getVar('epr_Email')
        ];
        return $this->model->insertItem('ENA_HPRM', $spoAcc);

    }
    public function ena_hmar($ena_id){
        $spoAcc=[
            "ena_id"=> $ena_id,
            "emr_fName"=> $this->request->getVar('emr_fName'),
            "emr_lName"=> $this->request->getVar('emr_lName'),
            "emr_Email"=> $this->request->getVar('emr_Email')
        ];
        return $this->model->insertItem('ENA_HMAR', $spoAcc);

    }
    public function ena_hpro($ena_id){
        $spoAcc=[
            "ena_id"=> $ena_id,
            "epro_fName"=> $this->request->getVar('emr_fName'),
            "epro_lName"=> $this->request->getVar('epro_lName'),
            "epro_Email"=> $this->request->getVar('epro_Email')
        ];
        return $this->model->insertItem('ENA_HPRO', $spoAcc);

    }

    protected function notifyAdmins(string $type, array $context = []): void
    {
        if (empty($this->adminRecipients)) {
            return;
        }

        $payload = array_merge([
            'type' => ucfirst($type),
            'organisation' => 'Unknown organisation',
            'contact_name' => 'Unknown contact',
            'contact_email' => 'N/A',
            'user_id' => null,
            'record_id' => null,
            'submitted_at' => date('j M Y, H:i T'),
            'admin_link' => base_url('admin'),
        ], $context);

        foreach ($this->adminRecipients as $recipient) {
            $payload['admin_name'] = $recipient['name'];
            try {
                $this->s_email->sendAdminJoinAlert($recipient['email'], $payload);
            } catch (\Throwable $e) {
                log_message('error', '[SignUp] Failed to notify admin {email}: {error}', [
                    'email' => $recipient['email'],
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }


    protected function mapProjectPayload(int $cseId, array $project): ?array
    {
        $name = trim($project['pro_Name'] ?? '');
        if ($name === '') {
            return null;
        }

        $purpose = trim($project['pro_Purpose'] ?? '');
        $objectives = trim($project['pro_KeyObjectives'] ?? '');
        $startYear = trim($project['pro_StartYear'] ?? '');
        $collectData = $project['pro_CollectData'] ?? null;
        $impactSummary = trim($project['pro_Impact'] ?? '');
        $requiredSponsorship = $project['pro_RequiredSponsorship'] ?? $project['pro_financialask'] ?? 0;

        $businessBenefits = $project['pro_businessBenifits'] ?? $project['pro_businessBenifit'] ?? [];
        if (is_array($businessBenefits)) {
            $businessBenefits = implode('; ', array_filter(array_map('trim', $businessBenefits)));
        }

        $additionalResources = $project['pro_AdditionResourcesNeeded'] ?? null;
        if ($additionalResources === 'N/A') {
            $additionalResources = null;
        }
        if (!$additionalResources) {
            $additionalResources = $this->buildAdditionalResources($project);
        }

        return [
            'cse_id'=> $cseId,
            'pro_Name'=> $name,
            'pro_Purpose'=> $purpose,
            'pro_KeyObjectives'=> $objectives,
            'pro_StartYear'=> $startYear,
            'pro_CollectData'=> $collectData,
            'pro_Impact'=> $impactSummary,
            'pro_RequiredSponsorship'=> $requiredSponsorship,
            'pro_AdditionResourcesNeeded'=> $additionalResources,
            'pro_pccfunding'=> $project['pro_pccfunding'] ?? null,
            'pro_pccfundingDetails'=> $project['pro_fundingDetails'] ?? null,
            'pro_fAsk'=> $project['pro_financialask'] ?? null,
            'pro_fAskDetails'=> $project['pro_financialDetails'] ?? null,
            'pro_eAsk'=> $project['pro_equipmentAsk'] ?? null,
            'pro_eAskDetails'=> $project['pro_equipmentDetails'] ?? null,
            'pro_pAsk'=> $project['pro_staffAsk'] ?? null,
            'pro_pAskDetails'=> $project['pro_staffDetails'] ?? null,
            'pro_businessBenefits'=> $businessBenefits,
        ];
    }

    protected function buildAdditionalResources(array $project): string
    {
        $parts = [];
        if (!empty($project['pro_financialDetails'])) {
            $parts[] = "Financial Support: " . trim($project['pro_financialDetails']);
        }
        if (!empty($project['pro_equipmentDetails'])) {
            $parts[] = "Equipment Support: " . trim($project['pro_equipmentDetails']);
        }
        if (!empty($project['pro_staffDetails'])) {
            $parts[] = "Professional Support: " . trim($project['pro_staffDetails']);
        }

        return implode("\n\n", array_filter($parts));
    }

    public function checkEmailExists()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(405)->setJSON([
                'message' => 'Invalid request method.',
                'exists'  => false,
                'csrf'    => $this->csrfPayload(),
            ]);
        }

        $email = strtolower(trim((string) $this->request->getVar('email')));
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setStatusCode(422)->setJSON([
                'message' => 'Please provide a valid email address.',
                'exists'  => false,
                'csrf'    => $this->csrfPayload(),
            ]);
        }

        $emailCheck = $this->checkEmailStatusInAuth($email);
        if (!$emailCheck['checked']) {
            return $this->response->setStatusCode(503)->setJSON([
                'message' => 'Unable to verify email with auth server. Please try again shortly.',
                'exists'  => false,
                'csrf'    => $this->csrfPayload(),
            ]);
        }

        return $this->response->setJSON([
            'message' => $emailCheck['exists'] ? 'User already exists, please login.' : 'Email is available.',
            'exists'  => $emailCheck['exists'],
            'csrf'    => $this->csrfPayload(),
        ]);
    }

    protected function checkEmailStatusInAuth(string $email): array
    {
        $email = strtolower(trim($email));
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['checked' => false, 'exists' => false];
        }

        try {
            $result = $this->eva->checkifUserExist($email);
            if (!empty($result['success']) && !empty($result['response'])) {
                return ['checked' => true, 'exists' => true];
            }

            $message = strtolower((string) ($result['message'] ?? ''));
            if (str_contains($message, 'user not found')) {
                return ['checked' => true, 'exists' => false];
            }

            return ['checked' => false, 'exists' => false];
        } catch (\Throwable $e) {
            log_message('error', '[SignUp] email existence check failed: ' . $e->getMessage());
            return ['checked' => false, 'exists' => false];
        }
    }

    protected function csrfPayload(): array
    {
        return [
            'name'  => csrf_token(),
            'value' => csrf_hash(),
        ];
    }
}
