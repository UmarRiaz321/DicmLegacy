<?php

namespace App\Controllers;

use App\Controllers\Admin;
use App\Libraries\Email;
use App\Models\PluginModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class CseCatalogue extends BaseController{
    
    private const INITIAL_PER_PAGE = 6;
    private const LIST_PER_PAGE = 6;

    function __construct()
	{

		$this->db = db_connect();
		$this->model = new PluginModel($this->db);
		$this->s_email = new Email();
        $this->admin = new Admin();
        // $this->load->library('pagination');
        $this->pager = service('pager');

	}
     // cse_id	user_id	cse_OrgName	cse_SpoNeeded	cse_Type	cse_YearFounded	cse_RegisteredNo	cse_SERNo	cse_Regions	cse_Theme	cse_CurrentSupporters	cse_AIncome	cse_referer
    // public function index()
    // {

    //     $page = 1;
    //     $per_page =10;
    //     if (isset($_GET['page'])) {
    //         $page = (int) $_GET['page'];
    //         $page = max(1, $page);
    //     } 
    //     $where = [];
    //     $order = [['cse_id', 'ASC']];
    //     $c_schema = $this->schema('Charities'); 
    //     $total_rows = $this->model->countTotalRows('Charities',$where=[], $this->request, $c_schema);

    //     // $table, $where, $request, $schema, $order, $offset, $per_page
    //     $charities = $this->model->getCatalogue('Charities',$where,$this->request,$c_schema,$order,$page,$per_page);
    //     $data = [];
    //     foreach($charities as $ch){
    //         $obj['id'] = $ch->cse_id;
    //         $obj['name'] = $ch->cse_OrgName;
    //         $obj['type'] = $ch->cse_Type;
    //         $obj['img'] = $ch->cse_Type;
    //         array_push($data,$obj);
    //     }

        
    //     //Pagination
    //     $pager = service('pager');
    //     $d['cse'] = json_encode($data);
    //     $d['pagination'] = $pager->makeLinks($page, $per_page, $total_rows, 'pagination');
    //     // return $d;
    //     return view('catalogue/catalogue' , $d); 
    // }

    // public function index():string{
    //     $page = 1;
    //     $per_page =5;
    //     if (isset($_GET['page'])) {
    //         $page = (int) $_GET['page'];
    //         $page = max(1, $page);
    //     } 
    //     $where =[];
    //     $order = ['cse_id', 'DECE'];
    //     $c_schema = $this->schema('Charities');
    //     $total_rows = $this->model->countTotalRows('Charities',$where, $this->request, $c_schema);
    //     $charities = $this->model->getCatalogue('Charities',$where,$this->request,$c_schema,$order,$page,$per_page);

    //     if($charities){
    //     $data = [];
    //     foreach($charities as $ch){
    //         $Img = $this->model->getImage('CSE_Socials',['cse_id'=> $ch->cse_id]);
    //         $obj['id'] = $ch->cse_id;
    //         $obj['name'] = $ch->cse_OrgName;
    //         $obj['type'] = $ch->cse_Type;
    //         $obj['img'] = $Img ? $Img->cs_logo : null;
    //         array_push($data,$obj);
    //     }
    //     //Pagination
    //     $pager = service('pager');
    //     $d['cse'] = json_encode($data);
    //     $d['pagination'] = $pager->makeLinks($page, $per_page, $total_rows, 'pagination');
    //     return view('catalogue/catalogue' , $d); 

    //     }else{
    //         $data = [];
    //         $d['cse'] = json_encode($data);
    //         $pager = service('pager');
    //         $d['pagination'] = $pager->makeLinks($page, $per_page, $total_rows, 'pagination');
    //         $d["no_data"] = "No Data Found";
    //         return view('catalogue/catalogue' , $d); 
    //     }

    // }



    public function index()
    {
        $projects = $this->fetchProjects(1, self::INITIAL_PER_PAGE);

        $d['projects'] = json_encode($projects['items']);
        $d['total'] = $projects['total'];
        $d['per_page'] = self::INITIAL_PER_PAGE;

        return view('catalogue/catalogue', $d);
    }
    

    public function getAll()
    {
        $body = $this->getRequestPayload();
        $pageInput = $body['page'] ?? $this->request->getVar('page');
        $page = max(1, (int) ($pageInput ?? 1));
        $result = $this->fetchProjects($page, self::LIST_PER_PAGE);

        return $this->response->setJSON([
            'products' => $result['items'],
            'total' => $result['total'],
            'per_page' => self::LIST_PER_PAGE,
            'current_page' => $page,
            'total_pages' => (int) ceil($result['total'] / self::LIST_PER_PAGE),
        ]);
    }
    

    public function getFiltered()
    {
        $filters = $this->getRequestPayload();
        $page = max(1, (int) ($filters['page'] ?? 1));
        $regions = $filters['region'] ?? ($filters['regions'] ?? []);
        if (!is_array($regions)) {
            $regions = [$regions];
        }

        $result = $this->fetchProjects($page, self::LIST_PER_PAGE, [
            'regions' => $regions,
        ]);

        return $this->response->setJSON([
            'products' => $result['items'],
            'total' => $result['total'],
            'per_page' => self::LIST_PER_PAGE,
            'current_page' => $page,
            'total_pages' => (int) ceil($result['total'] / self::LIST_PER_PAGE),
        ]);
    }
    
    
    
    
    

    
    
    

    function schema($ta)
    {
        return $this->model->schema($ta);
    }

    public function detailView(){
        $projectParam = $this->request->getGet('project');
        $legacyParam = $this->request->getGet('id');

        $projectId = $this->decodeIdentifier($projectParam);
        $charityId = null;

        if ($projectId === null && $legacyParam !== null) {
            $charityId = $this->decodeIdentifier($legacyParam);
            if ($charityId !== null) {
                $projectId = $this->findFirstProjectId($charityId);
            }
        }

        if ($projectId === null) {
            throw PageNotFoundException::forPageNotFound('Project not found');
        }

        $projectRow = $this->getProjectById($projectId);
        if (!$projectRow) {
            throw PageNotFoundException::forPageNotFound('Project not found');
        }

        $where = ['cse_id' => $projectRow->cse_id];
        $detailJson = $this->model->getCDetail($where, $projectId);

        $data = [
            'data' => $detailJson,
            'id' => $projectRow->cse_id,
            'project_id' => base64_encode((string) $projectId),
        ];

        return view('catalogue/detail', $data);
    }

    private function fetchProjects(int $page, int $perPage, array $filters = []): array
    {
        $builder = $this->baseProjectBuilder();

        if (!empty($filters['regions'])) {
            $regions = is_array($filters['regions']) ? $filters['regions'] : [$filters['regions']];
            $regions = array_filter(array_map('trim', $regions));

            if (!empty($regions)) {
                $builder->groupStart();
                foreach ($regions as $region) {
                    $escaped = $this->db->escapeString($region);
                    $condition = "FIND_IN_SET('{$escaped}', Charities.cse_regions) > 0";
                    $builder->orWhere($condition, null, false);
                }
                $builder->groupEnd();
            }
        }

        $countBuilder = clone $builder;
        $total = $countBuilder->countAllResults();

        $items = $builder
            ->orderBy('CSE_ProjectDetail.pro_id', 'DESC')
            ->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResult();

        $projects = array_map(function ($row) {
            $logo = $row->cs_logo ?? null;
            if (empty($logo) || strtolower($logo) === 'no image') {
                $logo = 'default.jpg';
            }
            return [
                'id' => base64_encode($row->pro_id),
                'project_id' => (int) $row->pro_id,
                'project_name' => $row->pro_Name,
                'charity_id' => (int) $row->cse_id,
                'charity_name' => $row->cse_OrgName,
                'regions' => $row->cse_regions,
                'img' => $logo,
                'required_sponsorship' => $row->pro_RequiredSponsorship,
                'key_objectives' => $row->pro_KeyObjectives,
            ];
        }, $items);

        return [
            'items' => $projects,
            'total' => $total,
        ];
    }

    private function baseProjectBuilder()
    {
        return $this->db->table('CSE_ProjectDetail')
            ->select('CSE_ProjectDetail.*, Charities.cse_OrgName, Charities.cse_regions, Charities.cse_id, CSE_Socials.cs_logo')
            ->join('Charities', 'CSE_ProjectDetail.cse_id = Charities.cse_id', 'inner')
            ->join('CSE_Socials', 'Charities.cse_id = CSE_Socials.cse_id', 'left')
            ->where('Charities.approved', 1);
    }

    private function decodeIdentifier(?string $value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        $decoded = base64_decode($value, true);

        if ($decoded === false) {
            $fallback = trim($value);
            return ctype_digit($fallback) ? (int) $fallback : null;
        }

        $decoded = trim($decoded);
        return ctype_digit($decoded) ? (int) $decoded : null;
    }

    private function findFirstProjectId(int $charityId): ?int
    {
        $row = $this->db->table('CSE_ProjectDetail')
            ->select('pro_id')
            ->where('cse_id', $charityId)
            ->orderBy('pro_id', 'ASC')
            ->get()
            ->getRow();

        return $row ? (int) $row->pro_id : null;
    }

    private function getProjectById(int $projectId)
    {
        return $this->db->table('CSE_ProjectDetail')
            ->select('CSE_ProjectDetail.pro_id, CSE_ProjectDetail.cse_id')
            ->join('Charities', 'CSE_ProjectDetail.cse_id = Charities.cse_id', 'inner')
            ->where('Charities.approved', 1)
            ->where('CSE_ProjectDetail.pro_id', $projectId)
            ->get()
            ->getRow();
    }

    private function getRequestPayload(): array
    {
        $body = $this->request->getJSON(true);
        if (is_array($body) && !empty($body)) {
            return $body;
        }

        $raw = $this->request->getRawInput();
        if (is_array($raw) && !empty($raw)) {
            return $raw;
        }

        return [];
    }
}
