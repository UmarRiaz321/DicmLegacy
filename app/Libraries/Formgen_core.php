<?php

namespace App\Libraries;

use App\Models\PluginModel;
use CodeIgniter\HTTP\RequestInterface;

class Formgen_core
{
    protected $schema, // table schema
    $spo_schema, // table schema
    $base = null, //prefix uri or parrent controller.
    $table, //string
    $spo_table, //string
    $id,  //primary key value
    $id_field,  //primary key field
    $current_values, //will get current form values before updating
    $db, //db connection instance
    $model, //db connection instance
    $request,
    $fields = [], //array of field options: (type, required, label),
    $multipart = false,
    $validator = false;

    
    

    function __construct($params, RequestInterface $request)
    {
        $this->request = $request;
        $this->table = $table = $params['table'];
        $this->db = db_connect();
        $this->model = new PluginModel($this->db);
        $this->schema = $this->schema($table);
        $this->spo_schema = $this->schema('sponsorshipis');

        if (isset($params['fields']) && $params['fields']) {
            $this->fields = $params['fields'];
            foreach ($this->fields as $key => $field) {

                //Adding custom fields to schema for relational table
                if (isset($field['relation']) && isset($field['relation']['save_table'])) {
                    $newSchema = [
                        'Field' => $key,
                        'Type' => 'text',
                        'Key' => '',
                        'Default' => '',
                        'Extra' => 'other_table'
                    ];
                    $this->schema[] = (object) $newSchema;
                }

                //Adding custom fields to schema for relational table for files
                if (isset($field['files_relation']) && isset($field['files_relation']['files_table'])) {
                    $newSchema = [
                        'Field' => $key,
                        'Type' => 'text',
                        'Key' => '',
                        'Default' => '',
                        'Extra' => 'file_table'
                    ];
                    $this->schema[] = (object) $newSchema;
                }
            }
        }
    }
    function view($page_number, $per_page, $columns = null, $where = null, $order = null)
    {
        //$root_url = $this->base . '/' . $this->table;
        $total_rows = $this->model->countTotalRows($this->table, $where, $this->request, $this->schema, $this->fields);
        $offset = $per_page * ($page_number - 1);

        //Start of actual results query
        $items = $this->model->getItems($this->table, $where, $this->request, $this->schema, $this->fields, $order, $offset, $per_page);

        //Pagination
        $pager = service('pager');
        $pagination = $pager->makeLinks($page_number, $per_page, $total_rows, 'pagination');

        return $this->items_table($columns, $items, $pagination);
    }

    function cseview($where, $order = null) {
        $total_rows = $this->model->countTotalRows($this->table, $where, $this->request, $this->schema);
        
        //Start of actual results query
        $items = $this->model->getItemMul($this->table, $where);

        $data = array();
       foreach($items as $row)  
        {  
            $sub_array = array();  
            $sub_array[] = $row->cse_OrgName;  
            // $sub_array[] = $row->cse_Type;  
            // $sub_array[] = $row->cse_Theme;
            $encode_id = base64_encode($row->cse_id);
            // $sub_array[] = '<a href="#" id="viewCse('.$row->cse_id.')" class="btn btn-outline-success btn-sm"><i class="bi bi-eye"></i></a>';  
            $sub_array[] = '<button type="button" class="btn btn-outline-success btn-sm tbtn-sm" data-bs-toggle="modal" data-bs-target="#vCseModal" data-bs-whatever="'.$encode_id.'"><i class="bi bi-eye"></i></button> <button type="button" class="tbtn-sm btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cseDModal" data-bs-whatever="'.$row->cse_id.'"><i class="bi bi-trash"></i></button>';
            $data[] = $sub_array;  
        }  

        $output = array(  
            "draw"                    =>    true,
            "recordsTotal"          =>      $total_rows,
            "data"                    =>     $data  
       );  

       return json_encode($output);

    }
    function spoview($where, $order = null) {
        $total_rows = $this->model->countTotalRows($this->table, $where, $this->request, $this->schema);
        
        //Start of actual results query
        $items = $this->model->getItemMul($this->table, $where);

        $data = array();
       foreach($items as $row)  
        {  
            $sub_array = array();  
            $sub_array[] = $row->spo_OrgName;  
            $sub_array[] = $row->spo_Registration;  
            $actions = [];
            $actions[] = '<button type="button" class="btn btn-outline-success btn-sm tbtn-sm" data-bs-toggle="modal" data-bs-target="#vSpoModal" data-bs-whatever="'.$row->spo_id.'"><i class="bi bi-eye"></i></button>';
            $actions[] = '<button type="button" class="btn btn-outline-primary btn-sm tbtn-sm" data-bs-toggle="modal" data-bs-target="#spoEmailModal" data-spo-id="'.$row->spo_id.'" data-spo-name="'.htmlspecialchars($row->spo_OrgName, ENT_QUOTES, 'UTF-8').'"><i class="bi bi-envelope"></i></button>';
            $actions[] = '<button type="button" class="tbtn-sm btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#spoDModal" data-bs-whatever="'.$row->spo_id.'"><i class="bi bi-trash"></i></button>';
            $sub_array[] = implode(' ', $actions);
            $data[] = $sub_array;  
        }  
        $output = array(  
            "draw"                    =>    true,
            "recordsTotal"          =>      $total_rows,
            "data"                    =>     $data  
       );  

       return json_encode($output);

    }

    public function enaview($where,$order){
        $total_rows = $this->model->countTotalRows($this->table, $where, $this->request, $this->schema);
        $items = $this->model->getItemMul($this->table, $where);
        $data = array();
        foreach ($items as $row) {
            # code...
            $sub_array = array();  
            $sub_array[] = $row->ena_OrgName;  
            $sub_array[] = $row->ena_ServiceType;  
            // $sub_array[] = $row->ena_theme;
            $ena_id = $row->ena_id;
            // $sub_array[] = '<a href="#" id="viewCse('.$row->cse_id.')" class="btn btn-outline-success btn-sm"><i class="bi bi-eye"></i></a>';  
            $sub_array[] = '<button type="button" class="btn btn-outline-success btn-sm tbtn-sm " data-bs-toggle="modal" data-bs-target="#vEnaModal" data-bs-whatever="'.$row->ena_id.'"><i class="bi bi-eye"></i></button> <button type="button" class="tbtn-sm btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#enaDDModal" data-bs-whatever="'.$row->ena_id.'"><i class="bi bi-trash"></i></button>';
            $data[] = $sub_array;  
        }
        $output = array(  
            "draw"   =>    true,
            "recordsTotal"  => $total_rows,
            "data"  =>   $data  
       );  

       return json_encode($output);


    }
    


    function schema()
    {
        return $this->model->schema($this->table);
    }

    public function get_primary_key_field_name()
    {
        return $this->model->get_primary_key_field_name($this->table);
    }


    public function getUnApproved($where, $order = null){
        $total_rows = $this->model->countTotalRows($this->table, $where, $this->request, $this->schema);
        $users = $this->model->getItemMul($this->table, $where);

        if(!empty($users)){
            foreach ($users as $row){
                $sub_array = array();
                $type =$row->user_type;
                $where =['user_id'=> $row->user_id];
                $org_Name = "";
                $theme ="";
               
                switch ($type) {
                    case 'charity':
                        $c =$this->model->getAnyItems('Charities', $where);
                        if(!empty($c)){
                            $org_Name = $c[0]->{'cse_OrgName'};
                            // $theme = $c[0]->{'cse_Theme'};
                             
                        }
                        break;
                    case 'sponsor':
                        $c =$this->model->getAnyItems('Sponsors', $where);
                        if(!empty($c)){
                            $org_Name = $c[0]->{'spo_OrgName'};
                            // $theme = $c[0]->{'spo_Theme'};
                             
                        }
                        break;
                    case 'enabler':
                        $c =$this->model->getAnyItems('Enablers', $where);
                        if(!empty($c)){
                            $org_Name = $c[0]->{'ena_OrgName'};
                            // $theme = $c[0]->{'ena_theme'};
                             
                        }
                        break;
                    default:
                        break;
                }
    
                $sub_array[] = $org_Name;
                $sub_array[] = $row->user_type;
                // $sub_array[] = $theme;
                $sub_array[] = '<button type="button" class="btn btn-outline-success btn-sm tbtn-sm" data-bs-toggle="modal" data-bs-target="#vUappModal" data-bs-whatever="'.$row->user_id.'">View</button> <button type="button" class="btn btn-outline-success btn-sm tbtn-sm" data-bs-toggle="modal" data-bs-target="#vAppModal" data-bs-whatever="'.$row->user_id.'">Approve</button> <button type="button" class="tbtn-sm btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#appRModal" data-bs-whatever="'.$row->user_id.'">Review</button>';
                $data[] = $sub_array;  
     
            }
            $output = array(  
                "draw"                    =>    true,
                "recordsTotal"          =>      $total_rows,
                "data"                    =>     $data  
           );
           return json_encode($output);

        }else{
            $users = [];
            return json_encode($users);
        }
        // $count =0;

    }

    public function getSponsorships($where, $order = null)
    {
        try {
            $total_rows = $this->model->countTotalRows('sponsorshipis', $where, $this->request, $this->spo_schema);
            $items = $this->model->getItemMul('sponsorshipis', $where);
            if ($items) {
                $data = array();
                foreach ($items as $row) {
                    $sub_array = array();
                    $sub_array[] = 'Reference';
                    $sub_array[] = 'Charity';
                    $sub_array[] = "Sponsor";
                    $sub_array[] = "Sponsorship Offer";
                    $sub_array[] = '<button type="button" class="btn btn-outline-success btn-sm tbtn-sm" data-bs-toggle="modal" data-bs-target="#vSpoModal" data-bs-whatever=""><i class="bi bi-eye"></i></button> <button type="button" class="tbtn-sm btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#spoDModal" data-bs-whatever=""><i class="bi bi-trash"></i></button>';
                    $data[] = $sub_array;
                }
                $output = array(
                    "draw" => true,
                    "recordsTotal" => $total_rows,
                    "data" => $data
                );
                return json_encode($output);
            } else {
                $items = [];
            }
        } catch (\Exception $e) {
            return json_encode(array(
                "error" => $e->getMessage()
            ));
        }
    }

    public function getAllUsers($where,$order =null){
        $total_rows = $this->model->countTotalRows($this->table, $where, $this->request, $this->schema);
        $users = $this->model->getItemMul($this->table, $where);

        if(!empty($users)){
            foreach ($users as $row){
                $sub_array = array();
                $type =$row->user_type;
                $where =['user_id'=> $row->user_id];
                $org_Name = "";
                $theme ="";
                $email ="";
               
                switch ($type) {
                    case 'charity':
                        $c =$this->model->getAnyItems('Charities', $where);

                        if(!empty($c)){
                            $org_Name = $c[0]->{'cse_OrgName'};
                            // $theme = $c[0]->{'cse_Theme'};
                            $Mcd = $this->model->getAnyItems('CSE_MainContactdetails', ['cse_id'=>$c[0]->{'cse_id'}]);
                            $email = $Mcd[0]->{'cmcd_email'};
                             
                        }
                        break;
                    case 'sponsor':
                        $c =$this->model->getAnyItems('Sponsors', $where);
                        if(!empty($c)){
                            $org_Name = $c[0]->{'spo_OrgName'};
                            $Mcd = $this->model->getAnyItems('SPO_MainContactdetails', ['spo_id'=>$c[0]->{'spo_id'}]);
                            $email = $Mcd[0]->{'smcd_Email'};
                            // $theme = $c[0]->{'spo_Theme'};
                             
                        }
                        break;
                    case 'enabler':
                        $c =$this->model->getAnyItems('Enablers', $where);
                        if(!empty($c)){
                            $org_Name = $c[0]->{'ena_OrgName'};
                            $Mcd = $this->model->getAnyItems('ENA_MainContactdetails', ['ena_id'=>$c[0]->{'ena_id'}]);
                            $email = $Mcd[0]->{'emcd_Email'};
                            // $theme = $c[0]->{'ena_theme'};
                             
                        }
                        break;
                    default:
                        break;
                }

                // $u = $this->model->getAnyItems('Unique_Identifiers',['user_id'=> $row->user_id]);
                $uniq = $this->model->getUniqqueId($row->user_id);
                $sub_array[] = $org_Name;
                $sub_array[] = $uniq;
;
                // $sub_array[] = $theme;
                $sub_array[] = '<button type="button" class="btn btn-outline-success transferUser btn-sm tbtn-sm"
                                data-bs-usid="'.$row->user_id.'"
                                data-bs-uniq="'.$uniq.'"
                                >Tranfer</button>';
                $data[] = $sub_array;  
     
            }
            $output = array(  
                "draw"                    =>    true,
                "recordsTotal"          =>      $total_rows,
                "data"                    =>     $data
              );
              return json_encode($output);
        }else{
            $users = [];
            return json_encode($users); 
        }
    }


    
}


?>

