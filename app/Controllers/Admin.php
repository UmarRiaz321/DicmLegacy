<?php
namespace App\Controllers;
/**
 * Admin.php
 * An Admin Panel Controlls 
 * Created : 26/09/2023
 *
 * @author Umar Riaz
*/
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use App\Models\PluginModel;
use App\Libraries\Email;
use CodeIgniter\Session\Session;
use CodeIgniter\Config\Services;
use App\Libraries\Formgen;
use App\Libraries\Evaluate;
use App\Models\SponsorshipModel;





class Admin extends BaseController
{
    use ResponseTrait;
    protected $u_id;
    protected $c_id;
	protected $s_email;

    protected $sponsorshipModel;

    function __construct()
	{
        parent::setProtected(true);
		$this->db = db_connect();
		$this->model = new PluginModel($this->db);
        $this->sponsorshipModel = new SponsorshipModel($this->db);
		$this->s_email = new Email();
        $this->eva = new Evaluate();
        $this->session = Services::session();
        $userdata['logged'] = FALSE ;
        if ($userdata['logged'] == TRUE)
        {
            return redirect()->route('login');
        }
        else
        {
            return redirect()->route('vcse-join'); //if session is not there, redirect to login page
        }   
       
    }
    function index(){

    // public function countTotalRows($table, $where, $request, $schema, $fields)
        $s_schema = $this->schema('Sponsors');
        $e_schema = $this->schema('Enablers');
        $c_schema = $this->schema('Charities');
        $p_schema = $this->schema('Users');
        $spo_schema = $this->schema('sponsorships');
        $faq_schema = $this->schema('FAQs');
        // $sponsors = $this->model->countTotalRows('Sponsors',$where=[], $this->request, $s_schema);
        // $enablers= $this->model->countTotalRows('Enablers',$where=[], $this->request, $e_schema);
        // $charities = $this->model->countTotalRows('Charities',$where=[], $this->request, $c_schema);
        $sponsors = $this->model->countTotalRows('Users',$where=['u_status' => 'approved','user_type'=> 'sponsor'], $this->request, $p_schema);
        $enablers = $this->model->countTotalRows('Users',$where=['u_status' => 'approved','user_type'=> 'enabler'], $this->request, $p_schema);
        $charities = $this->model->countTotalRows('Users',$where=['u_status' => 'approved','user_type'=> 'charity'], $this->request, $p_schema);
        $pendinhg = $this->model->countTotalRows('Users',$where=['u_status' => 'submitted'], $this->request, $p_schema);

        // PROP → Proposal (Default)
        // OFBP → Offer for Bidding Purpose
        // OAAS → Offer Accepted Awaiting Sign-Off
        // SIGN-U → Signed Unpaid
        // CONF → Sponsorship Confirmed

        $spo_prop = $this->model->countTotalRows('sponsorships',$where=['status' => 'PROP'], $this->request, $spo_schema);
        $spo_ofbp = $this->model->countTotalRows('sponsorships',$where=['status' => 'OFBP'], $this->request, $spo_schema);
        $spo_oaas = $this->model->countTotalRows('sponsorships',$where=['status' => 'OAAS'], $this->request, $spo_schema);
        $spo_signu = $this->model->countTotalRows('sponsorships',$where=['status' => 'SIGN-U'], $this->request, $spo_schema);
        $spo_conf = $this->model->countTotalRows('sponsorships',$where=['status' => 'CONF'], $this->request, $spo_schema);


        // FAQ's 

        $cse_faq = $this->model->countTotalRows('FAQs',$where=['faq_type'=>'Charities'], $this->request, $faq_schema);
        $bus_faq = $this->model->countTotalRows('FAQs',$where=['faq_type'=>'Businesses'], $this->request, $faq_schema);
        $buy_faq = $this->model->countTotalRows('FAQs',$where=['faq_type'=>'Buyers'], $this->request, $faq_schema);

        // $pendinhg = 0 ;

        // $users = $this->model->getItemMul('Users',$where=['u_status' => 'submitted']);

        // foreach ($users as $p) {
        //     $s = $this->model->countTotalRows('Sponsors',$where=['user_id'=>$p->user_id], $this->request, $s_schema);
        //     $e= $this->model->countTotalRows('Enablers',$where=['user_id'=>$p->user_id,], $this->request, $e_schema);
        //     $c = $this->model->countTotalRows('Charities',$where=['user_id'=>$p->user_id], $this->request, $c_schema);
        //     if($s>0){ $pendinhg += 1; }
        //     if($e>0){$pendinhg += 1;}
        //     if($c>0){$pendinhg += 1;}
        // }


        $c_table = $this->get_charities();
        $data = [
            'sponsors'   => $sponsors,
            'enablers'  => $enablers,
            'charities'  => $charities,
            'pendinhg'  => $pendinhg,
            'spo_prop'  => $spo_prop,
            'spo_ofbp'  => $spo_ofbp,
            'spo_oaas'  => $spo_oaas,
            'spo_signu'  => $spo_signu,
            'spo_conf'  => $spo_conf,
            'c_table' => $c_table,
            'cse_faq' => $cse_faq,
            'bus_faq' => $bus_faq,
            'buy_faq' => $buy_faq
            
        ];
        return view('admin/admin',$data);
    }

    function schema($ta)
    {
        return $this->model->schema($ta);
    }

    public function get_charities(){
        $params = [
            'table' => 'Charities',
        ];
        $forms = new Formgen($params, service('request'));

        $columns = ['cse_OrgName'];
        $where = ['approved' => 1];
        $order = [
            ['cse_id', 'ASC']
        ];
        return $forms->cseview($where, $order);

    }
    public function get_CseDetail(){
        $id= base64_decode($_GET['id']);
        $where=['cse_id'=>$id];
        return $this->model->getCDetail($where);

    }
    public function get_sponsors(){
        $params = [
            'table' => 'Sponsors',
        ];
        $forms = new Formgen($params, service('request'));
        if (isset($_GET['page'])) {
            $page = (int) $_GET['page'];
            $page = max(1, $page);
        } 
        $columns = ['spo_OrgName','spo_Regions','spo_Theme'];
        $where = ['approved' => 1];
        $order = [
            ['spo_id', 'ASC']
        ];
        return $forms->spoview($where, $order);

    }

    public function get_SpoDetail(){
        $id= $_GET['id'];
        $where=['spo_id'=>$id];
        return $this->model->getSDetail($where);

    }

    public function getSponsorMarketingContacts()
    {
        $spoId = (int) ($this->request->getGet('spo_id') ?? 0);
        if ($spoId <= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid sponsor id',
            ])->setStatusCode(400);
        }

        $contacts = $this->model->getItemMul('SPO_Accounts', ['spo_id' => $spoId]) ?? [];
        $data = array_map(static function ($contact) {
            return [
                'name' => trim(((string) ($contact->sa_fName ?? '')) . ' ' . ((string) ($contact->sa_lName ?? ''))),
                'email' => (string) ($contact->sa_Email ?? ''),
            ];
        }, $contacts);

        return $this->response->setJSON([
            'success' => true,
            'contacts' => $data,
        ]);
    }

    public function sendSponsorMarketingEmail()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(405);
        }

        $spoId = (int) ($this->request->getPost('spo_id') ?? 0);
        $message = trim((string) $this->request->getPost('message'));
        $subject = trim((string) $this->request->getPost('subject'));

        if ($spoId <= 0 || $message === '') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Sponsor and message are required.',
            ])->setStatusCode(422);
        }

        $sponsor = $this->model->getItem('Sponsors', ['spo_id' => $spoId]);
        if (!$sponsor) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Sponsor not found.',
            ])->setStatusCode(404);
        }

        $contacts = $this->model->getItemMul('SPO_Accounts', ['spo_id' => $spoId]) ?? [];
        if (empty($contacts)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No marketing contacts available for this sponsor.',
            ])->setStatusCode(404);
        }

        $sent = [];
        $errors = [];
        foreach ($contacts as $contact) {
            $email = isset($contact->sa_Email) ? trim((string) $contact->sa_Email) : '';
            if ($email === '') {
                continue;
            }

            $fullName = trim(((string) ($contact->sa_fName ?? '')) . ' ' . ((string) ($contact->sa_lName ?? '')));
            $success = $this->s_email->sendSponsorMarketingCustom(
                $email,
                $fullName,
                (string) $sponsor->spo_OrgName,
                $subject !== '' ? $subject : 'Message from Pluggin Ecosystem',
                $message
            );

            if ($success) {
                $sent[] = $email;
            } else {
                if (method_exists($this->s_email, 'getLastError')) {
                    $errors[] = $this->s_email->getLastError();
                }
            }
        }

        if (empty($sent)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to send email to marketing contacts.',
                'errors' => array_filter($errors),
            ])->setStatusCode(500);
        }

        return $this->response->setJSON([
            'success' => true,
            'sent' => $sent,
        ]);
    }

   public function get_enablers(){
    $params = [
        'table' => 'Enablers',
    ];
    $forms = new Formgen($params, service('request'));
        $where = ['approved' => 1];
        $order = [
            ['ena_id', 'ASC']
        ];

        // enaview
        return $forms->enaview($where, $order);


   }
    public function get_EnaDetail(){
        $id= $_GET['id'];
        $where=['ena_id'=>$id];
        return $this->model->getEDetail($where);

    }
    // Dell Enablers
    public function dellEna(){
        $id= $_GET['id'];
        $Enablers = $this->model->getAnyItems('Enablers',['ena_id'=> $id]);
        $user_id = $Enablers[0]->{'user_id'};
        $en_id = $Enablers[0]->{'ena_id'};
        $userMc = $this->model->getAnyItems('ENA_MainContactdetails',['ena_id'=> $en_id]);
        $email = $userMc[0]->{'emcd_Email'};
       $deleted = $this->model->deleteItems('Users', ['user_id ='=> $user_id], null, null);

       if($deleted){
            $res = $this->eva->deleteFromPluggin($email);
            if($res['success']){
                return true;
            }else{
                return false;
            }
       }else{
           return false;
       }
    }

    // Dell Charities

    public function dellCse(){
        $id= $_GET['id'];
       $CSE = $this->model->getAnyItems('Charities',['cse_id'=> $id]);
       $user_id = $CSE[0]->{'user_id'};
       $cse_id = $CSE[0]->{'cse_id'};
       $userMc = $this->model->getAnyItems('CSE_MainContactdetails',['cse_id'=> $cse_id]);
       $email = $userMc[0]->{'cmcd_email'};
       $deleted = $this->model->deleteItems('Users', ['user_id ='=> $user_id], null, null);  
       if($deleted){
            $res = $this->eva->deleteFromPluggin($email);
            if($res['success']){
                return true;
            }else{
                return false;
            }
       }else{
           return false;
       }
    }

    // Dell Sponsors

    public function dellSpo(){
       $id= $_GET['id'];
       $SPO = $this->model->getAnyItems('Sponsors',['spo_id'=> $id]);
       $user_id = $SPO[0]->{'user_id'};
       $spo_id = $SPO[0]->{'spo_id'};
       $userMc = $this->model->getAnyItems('SPO_MainContactdetails',['spo_id'=> $spo_id]);
       $email = $userMc[0]->{'smcd_Email'};
       $deleted = $this->model->deleteItems('Users', ['user_id ='=> $user_id], null, null);
        if($deleted){
            $res = $this->eva->deleteFromPluggin($email);
            if($res['success']){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }



    // Get UnApproved Users
    public function getUnApproved(){
        $params = [
            'table' => 'Users',
        ];
        $where=['u_status' => 'submitted'];
        $forms = new Formgen($params, service('request'));
        $order = [
            ['user_id', 'ASC']
        ];
        return $forms->getUnApproved($where, $order);

    }

    public function getAllUsers(){
        $params = [
            'table' => 'Users',
        ];
        $where=['transferred' => 0];
        $forms = new Formgen($params, service('request'));
        $order = [
            ['user_id', 'ASC']
        ];
        return $forms->getAllUsers($where, $order);

    }

    public function get_AppDetail(){
        $id= $_GET['id'];
        return $this->model->getAppDetail($id);
    }

    // approve User
    public function approveUser(){
        $id= $_GET['id'];
        $approved = $this->eva->approve_user($id);
        $session = session();
        if($approved){
            $this->model->updateItem('Users', ['user_id' => $id], ['u_status' => 'approved']);
            $session->setFlashdata('success', 'User is Approved');
            return true;

        }else{
            $session->setFlashdata('error', 'Not Approved try again later');
            return false;
        }
    }


    // transfer User Temp
    public function transferUser(){
        $userid = $_POST['usid'];
        $uniq = $_POST['uniq'];
        $transfered = $this->eva->transfer_user($userid,$uniq);

        if($transfered){
            $this->model->updateItem('Users', ['user_id' => $userid], ['transferred' => 1]);
            return $this->respond(['status' => 'success', 'userID' => $userid], 200);
        }else{
            return $this->failServerError('Failed to transfer user');  
    }  
}  

    // Review User

    public function reviewUser(){
        $id= $_GET['id'];
        $message= $_GET['message'];
        return $this->eva->review_user($id,$message);
    }

    // export cse to csv 
    public function exportCSEToCSV(){
        $charities = $this->model->getItemMul('Charities', ['approved' => 1]);
        $rows = [];

        foreach ($charities as $c) {
            $detail = $this->model->getCDetail(['cse_id' => $c->cse_id]);
            $decoded = json_decode($detail, true);
            if (empty($decoded[0])) {
                continue;
            }
            $record = $decoded[0];
            $mc     = $record['mc'] ?? [];
            [$firstName, $lastName] = $this->splitContactName((string) ($mc['Name'] ?? ''));
            $rows[] = [
                'Company Name'              => $record['Organisation Name'] ?? '',
                'Main Contact First Name'   => $firstName,
                'Main Contact Last Name'    => $lastName,
                'Main Contact Email'        => $mc['Email'] ?? '',
                'Main Contact Role'         => $mc['Job Title'] ?? '',
            ];
        }

        return json_encode($rows, JSON_UNESCAPED_SLASHES);
    }

    // export sponsors to csv
    public function exportSPOToCSV(){
        $sponsors = $this->model->getItemMul('Sponsors', ['approved' => 1]);
        $rows = [];

        foreach ($sponsors as $s) {
            $detail = $this->model->getSDetail(['spo_id' => $s->spo_id]);
            $decoded = json_decode($detail, true);
            if (empty($decoded[0])) {
                continue;
            }
            $record = $decoded[0];
            $mc     = $record['mc'] ?? [];
            [$firstName, $lastName] = $this->splitContactName((string) ($mc['Name'] ?? ''));
            $rows[] = [
                'Company Name'              => $record['Organisation Name'] ?? '',
                'Main Contact First Name'   => $firstName,
                'Main Contact Last Name'    => $lastName,
                'Main Contact Email'        => $mc['Email'] ?? '',
                'Main Contact Role'         => $mc['Job Title'] ?? '',
            ];
        }

        return json_encode($rows, JSON_UNESCAPED_SLASHES);
    }

    // export enablers to csv
    public function exportENAToCSV(){
        $enablers = $this->model->getItemMul('Enablers', ['approved' => 1]);
        $rows = [];

        foreach ($enablers as $e) {
            $detail = $this->model->getEDetail(['ena_id' => $e->ena_id]);
            $decoded = json_decode($detail, true);
            if (empty($decoded[0])) {
                continue;
            }
            $record = $decoded[0];
            $mc     = $record['mc'] ?? [];
            [$firstName, $lastName] = $this->splitContactName((string) ($mc['Name'] ?? ''));
            $rows[] = [
                'Company Name'              => $record['Organisation Name'] ?? '',
                'Main Contact First Name'   => $firstName,
                'Main Contact Last Name'    => $lastName,
                'Main Contact Email'        => $mc['Email'] ?? '',
                'Main Contact Role'         => $mc['Job Title'] ?? '',
            ];
        }

        return json_encode($rows, JSON_UNESCAPED_SLASHES);
    }


    // get all sponsorships
    
    public function getSponsorships(){
        $params =[ 'table' => 'sponsorships'];
        $forms = new Formgen($params, service('request'));
        $where = ['status' => 'PROP'];  // Default  status
        $order = [
            ['id', 'ASC']
        ];
        return $forms->getSponsorships($where, $order);

    }


    // check if user exist on fuse

    public function checkUser(){
        $email = $_GET['email'];
        $userID = $this->eva->checkifUserExist($email);

        if ($userID) {
            return $this->respond(['status' => 'success', 'userID' => $userID], 200);
        } else {
            return $this->failNotFound('User not found');
        }


    }

    protected function splitContactName(string $fullName): array
    {
        $fullName = trim(preg_replace('/\s+/', ' ', $fullName) ?? '');
        if ($fullName === '') {
            return ['', ''];
        }

        $parts = explode(' ', $fullName, 2);
        $firstName = $parts[0] ?? '';
        $lastName = $parts[1] ?? '';

        return [$firstName, $lastName];
    }

    public function UpdateUser() {
        // Get parameters from request
        $id = isset($_POST['user']) ? $_POST['user'] : null;
        $type = isset($_POST['type']) ? $_POST['type'] : null;
    
        // Validate inputs
        if (empty($id) || empty($type)) {
            return $this->failValidationErrors('Missing required parameters: user ID and type.');
        }
    
        // Call update function
        $update = $this->eva->updateUsername($id, $type);
    
        // Check for success
        if ($update["success"]) {
            return $this->respond(['status' => 'success', 'userID' => $id], 200);
        } else {
            return $this->failServerError('Failed to update user: ' . $update["error"]);
        }
    }

    public function createPlatformUser()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(405)->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method.',
            ]);
        }

        if (!$this->session->get('isAdmin')) {
            return $this->response->setStatusCode(403)->setJSON([
                'status' => 'error',
                'message' => 'Access denied.',
            ]);
        }

        $validation = Services::validation();
        $validation->setRules([
            'full_name' => 'required|string|min_length[3]|max_length[200]',
            'email' => 'required|valid_email|max_length[200]',
            'user_type' => 'required|in_list[admin,sponsor,charity,enabler]',
            'preferred_username' => [
                'rules' => 'permit_empty|regex_match[/^[A-Za-z0-9\\-_]+$/]|max_length[32]|min_length[3]',
                'errors' => [
                    'regex_match' => 'Preferred identifier may only contain letters, numbers, hyphen or underscore.',
                ],
            ],
            'notes' => 'permit_empty|max_length[500]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setStatusCode(422)->setJSON([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $validation->getErrors(),
            ]);
        }

        $fullName   = trim((string) $this->request->getPost('full_name'));
        $email      = strtolower(trim((string) $this->request->getPost('email')));
        $userType   = strtolower((string) $this->request->getPost('user_type'));
        $preferred  = trim((string) $this->request->getPost('preferred_username'));
        $notes      = trim((string) $this->request->getPost('notes'));
        $preferred  = $preferred === '' ? null : strtoupper($preferred);

        try {
            $result = $this->eva->provisionPlatformUser($fullName, $email, $userType, $preferred);
        } catch (\Throwable $e) {
            log_message('error', '[AdminUser] provisionPlatformUser error: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Unable to create user at this time.',
            ]);
        }

        if (($result['success'] ?? false) !== true) {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => $result['message'] ?? 'Provisioning failed.',
            ]);
        }

        $emailDispatched = false;
        try {
            $this->s_email->passEmail($email, $email, (string) $result['password']);
            $emailDispatched = true;
        } catch (\Throwable $e) {
            log_message('error', '[AdminUser] Failed to send credentials email: ' . $e->getMessage());
        }

        log_message('info', sprintf(
            '[AdminUser] %s created %s account for %s (%s). Notes: %s',
            (string) ($this->session->get('user_email') ?? 'system'),
            $userType,
            $fullName,
            $email,
            $notes !== '' ? $notes : 'n/a'
        ));

        $message = $emailDispatched
            ? 'User has been created and notified via email.'
            : 'User was created but credentials email could not be sent. Please contact them manually.';

        $statusCode = $emailDispatched ? 200 : 207;

        return $this->response->setStatusCode($statusCode)->setJSON([
            'status' => $emailDispatched ? 'success' : 'warning',
            'message' => $message,
            'username' => $result['username'],
            'existing' => (bool) ($result['existing'] ?? false),
        ]);
    }
    

}
?>
