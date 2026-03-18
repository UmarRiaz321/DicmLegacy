<?php
/**
 * @author Umar Riaz
 * Created at 10/09/2023
 * Model to perform add, delete, update, approve users
 */

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;



class PluginModel{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }



    public function schema($table)
    {
        $query = "SHOW COLUMNS FROM $table";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    public function insertItem($table, $data)
    {
        $this->db->table($table)->insert($data);
        return $this->db->insertID();
    }

    public function getAnyItems($table, $where)
    {
        $builder = $this->db->table($table);
        if ($where)
            $builder->where($where);
        return $builder->get()->getResult();
    }
    public function updateItem($table, $where, $data)
    {
        $builder = $this->db->table($table);
        if ($where)
            $builder->where($where);

        return $builder->update($data);
    }
    function get_primary_key_field_name($table)
    {
        $query = "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'";
        return $this->db->query($query)->getRow()->Column_name;
    }
    //Get one item
    public function getItem($table, $where)
    {
        return $this->db->table($table)
            ->where($where)
            ->get()
            ->getRow();
    }

    // Get Image 
    public function getImage($table, $where)
    {
        return $this->db->table($table)
            ->select('cs_logo')
            ->where($where)
            ->get()
            ->getRow();
    }

    // Get Multiple Items
    public function getItemMul($table, $where)
    {

        $builder = $this->db->table($table);

        if ($where)
            $builder->where($where);

        $items = $builder->get()
            ->getResult();
    
        return $items;
    
    }
    public function countTotalRows($table, $where, $request, $schema)
    {
        $count_query = "SELECT COUNT(*) as total FROM " . $table;
        //get primary_key field name
        $pk = $this->get_primary_key_field_name($table);

        if ($where) {
            $count_query .= " WHERE (";
            $i = 0;
            foreach ($where as $key => $value) {
                if ($i > 0)
                    $count_query .= " AND ";

                //Check if operator is different from = (equal sign)
                $operator_arr = explode(" ", $key);
                if (isset($operator_arr[1]))
                    $operator = $operator_arr[1];
                else
                    $operator = "=";

                $count_query .= " `$operator_arr[0]`$operator" . $this->db->escape($value) . " ";
                $i++;
            }
            $count_query .= ")";
        }

        if ($table_search = $request->getPost('table_search')) {
                $allEmpty = true;
                $tempQuery = '';

            if ($where)
                $tempQuery .= " AND ";
            else
                $tempQuery .= " WHERE ";
                $tempQuery .= " ( ";
                $i = 0;
            // echo '<pre>';
            //  print_r($schema);
            // echo '<pre>';
            foreach ($schema as $column) {
                if (trim($request->getPost($column->Field)) == '')
                    continue;
                if ($column->Extra == 'other_table')
                    continue;

                $allEmpty = false;
                if ($i > 0)
                    $tempQuery .= " OR ";


                $tempQuery .= " " . $table_search
                    . "." . $column->Field
                    . " LIKE '%"
                    . trim($this->db->escapeLikeString($request->getPost($column->Field)))
                    . "%' ESCAPE '!'";

                $i++;
            }
            $tempQuery .= ")";
            if (!$allEmpty)
                $count_query .= $tempQuery;
        }

        return $this->db->query($count_query)->getRow()->total;
    }

    public function getUniqqueId($user_id){
        $where = ['user_id'=>$user_id];
        $u = $this->getAnyItems('Unique_Identifiers',$where);
        if (!empty($u) && isset($u[0]->{'unique_id'})) {
            return $u[0]->{'unique_id'};
        }
        return null;
    }
    public function getItems($table, $where, $request, $schema, $fields, $order, $offset, $per_page)
    {
        $result_query = "SELECT * FROM " . $table;
        //get primary_key field name
        $pk = $this->get_primary_key_field_name($table);


        //Check for relation fields
        foreach ($fields as $key => $rel_field) {
            if (isset($rel_field['relation']) && !isset($rel_field['relation']['save_table'])) {
                $rfield = $rel_field['relation'];
                $result_query .= " LEFT JOIN  " . $rfield['table'] . " ON " . $table . '.' . $key . "=" . $rfield['table'] . "." . $rfield['primary_key'] . "  ";
                //$this->db->join($rfield['table'], $table.'.'.$key.'='.$rfield['table'].'.'.$rfield['primary_key'], 'left');
            }
        }

        if ($where) {
            $result_query .= " WHERE (";
            $i = 0;
            foreach ($where as $key => $value) {
                if ($i > 0)
                    $result_query .= " AND ";

                //Check if operator is different from = (equal sign)
                $operator_arr = explode(" ", $key);
                if (isset($operator_arr[1]))
                    $operator = $operator_arr[1];
                else
                    $operator = "=";

                $escapedValue = $this->db->escape($value);
                $columnRaw = preg_replace('/[^A-Za-z0-9_\.]/', '', $operator_arr[0]);
                if (strpos($columnRaw, '.') !== false) {
                    $columnParts = array_map(static function ($segment) {
                        return '`' . $segment . '`';
                    }, array_filter(explode('.', $columnRaw), 'strlen'));
                    $columnSql = implode('.', $columnParts);
                } else {
                    $columnSql = '`' . $columnRaw . '`';
                }

                $result_query .= "  " . $columnSql . "$operator" . $escapedValue . " ";

                //$this->db->where($key, $value);
                $i++;
            }
            $result_query .= ")";
        }

        if ($request->getPost('table_search')) {

            $allEmpty = true;
            $tempQuery = '';
            $i = 0;
            if ($where)
                $tempQuery .= " AND ";
            else
                $tempQuery .= " WHERE ";

            //$tempQuery .= " ( ";

            foreach ($schema as $column) {

                if ($request->getPost($column->Field) == '')
                    continue;

                $allEmpty = false;
                $col_search = [];
                $col_search[] = $column->Field;
                if (isset($fields[$column->Field]['relation']) && isset($fields[$column->Field]['relation']['save_table'])) {
                    //Search relational table to get the ids of related ids
                    $relField = $fields[$column->Field]['relation'];

                    $parent_table = $relField['table'];
                    $relation_table = $relField['save_table'];
                    $joinString = $relation_table . '.' . $relField['child_field'] . '=' . $parent_table . '.' . $relField['primary_key'];
                    $likeColumns = $relField['display'];
                    $likeTerm = $request->getPost($column->Field);
                    //$relselect is optional. when used it will add DISTINCT to prevent dublicates
                    $relSelect = $relation_table . '.' . $relField['parent_field'];
                    $relatedItems = $this->searchRelatedItems($parent_table, $relation_table, $joinString, $likeColumns, $likeTerm, $relSelect);
                    $relatedItemsIdArr = [];
                    if (!$relatedItems)
                        $relatedItemsIdArr = '-1';
                    else {
                        //Create an array of ids for whereIn statement
                        foreach ($relatedItems as $relatedItem) {
                            $relatedItemsIdArr[] = $relatedItem->{$relField['parent_field']};
                        }
                    }

                    if ($i > 0)
                        $tempQuery .= " AND ";

                    if (is_array($relatedItemsIdArr)) {
                        $safeIds = array_map('intval', (array) $relatedItemsIdArr);
                        $relTempQuery = '' . $table . '.' . $pk . ' IN (' . implode(',', $safeIds) . ')';
                    } else {
                        $relTempQuery = $table . '.' . $pk . ' = ' . (int) $relatedItemsIdArr;
                    }

                    //  echo $tempQuery.'<br>';
                    $tempQuery .= $relTempQuery;
                    //  echo $tempQuery;

                    $i++;
                    //$allEmpty = false;
                    continue;
                } else if (isset($fields[$column->Field]['relation'])) {

                    $col_search = $fields[$column->Field]['relation']['display'];
                    //check if display is an array of columns
                    if (!is_array($col_search))
                        $col_search[] = $col_search;

                    $table_search = $fields[$column->Field]['relation']['table'];
                } else {
                    $table_search = $table;

                    //$col_search[] = $column->Field;
                }
                if ($i > 0)
                    $tempQuery .= " AND ";


                //For loop is required when search must be performed in multiple relational columns from another table
                $searchLikeTempQuery = '';
                $searchLikeTempQueryArr = [];
                foreach ($col_search as $colToSearch) {
                    $searchLikeTempQueryArr[] = $this->generateLikeClause($table_search, $colToSearch, $request->getPost($column->Field));
                }

                if (count($col_search) > 1) {
                    $searchLikeTempQuery = implode(' OR ', $searchLikeTempQueryArr);
                    $searchLikeTempQuery = "($searchLikeTempQuery)";
                } else
                    $searchLikeTempQuery = $searchLikeTempQueryArr[0];


                $tempQuery .= $searchLikeTempQuery;

                //$this->db->like($table_search.'.'.$col_search, $request->getPost($column->Field), 'both');
                $i++;
            }

            $tempQuery .= isset($searchLikeTempQuery) ?  "  " : "";
            if (!$allEmpty)
                $result_query .= $tempQuery;
        }

        if ($order) {
            $result_query .= " ORDER BY ";
            $i = 0;
            foreach ($order as $ord) {
                if ($i > 0)
                    $result_query .= ", ";
                $result_query .= $ord[0] . " " . $ord[1];
                //$this->db->order_by($ord[0], $ord[1]);
                $i++;
            }
        } else {

            $result_query .= " ORDER BY " . $pk . " DESC";
            //$this->db->order_by($pk, 'DESC');
        }

        $result_query = rtrim($result_query, ',');
        $result_query .= " LIMIT " . (int) $offset . ", " . (int) $per_page . " ";
        // $this->db->limit($per_page, $offset);

        $page_items = $this->db->query($result_query)->getResult();


        return $page_items;
    }

    public function getCDetail($where, ?int $projectId = null){
        $cseD = $this->getItemMul('Charities',$where);
        if (empty($cseD)) {
            return json_encode([]);
        }

        $baseWhere = ['cse_id' => $cseD[0]->{'cse_id'}];
        $cse_MCD = $this->getItemMul('CSE_MainContactdetails',$baseWhere);
        $cse_PD = $this->getItemMul('CSE_ProjectDetail',$baseWhere);
        $cse_SD = $this->getItemMul('CSE_Socials',$baseWhere);
        $user = $this->getItem('Unique_Identifiers',['user_id'=>$cseD[0]->{'user_id'}]);
   
        // cse_id	user_id	cse_OrgName	cse_SpoNeeded	cse_Type	cse_YearFounded	cse_RegisteredNo	cse_SERNo	cse_Regions	cse_Theme	cse_CurrentSupporters	cse_AIncome	cse_referer
        // $obj['id'] = $cseD[0]->{'cse_id'};

        if ($user !== null && isset($user->{'unique_id'})) {
            $obj['unique_id'] = $user->{'unique_id'};
        }
        $obj['Organisation Name'] = $cseD[0]->{'cse_OrgName'};
        // $obj['Organisation Founded Year'] = $cseD[0]->{'cse_SpoNeeded'};
        // $obj['CSE Type'] = $cseD[0]->{'cse_Type'};
        $obj['Organisation Founded Year'] = $cseD[0]->{'cse_YearFounded'};
        $obj['Charity Registration Number'] = $cseD[0]->{'cse_RegisteredNo'};
        $obj['Social Enterprise Registration Number'] = $cseD[0]->{'cse_SERNo'};
        $obj['Annual Income'] = $cseD[0]->{'cse_AIncome'};
        // $obj['CSE Theme'] = $cseD[0]->{'cse_Theme'};
        $obj['Regions'] = $cseD[0]->{'cse_Regions'};
        $obj['Reference Number'] = $cseD[0]->{'cse_referer'};
        $obj['Current Sponsors'] = $cseD[0]->{'cse_CurrentSupporters'};
        // cmcd_id	cse_id	cmcd_name	cmcd_email	cmcd_phone	cmcd_jtitle	cse_address
        if(!empty($cse_MCD[0]->{'cmcd_name'})){$obj['mc']['Name'] = $cse_MCD[0]->{'cmcd_name'};}
        if(!empty($cse_MCD[0]->{'cmcd_email'})){$obj['mc']['Email'] = $cse_MCD[0]->{'cmcd_email'};}
        if(!empty($cse_MCD[0]->{'cmcd_phone'})){$obj['mc']['Phone'] = $cse_MCD[0]->{'cmcd_phone'};}
        if(!empty($cse_MCD[0]->{'cmcd_jtitle'})){ $obj['mc']['Job Title'] =$cse_MCD[0]->{'cmcd_jtitle'} ;}
        if(!empty($cse_MCD[0]->{'cse_address'})){ $obj['mc']['Organisation Address'] = $cse_MCD[0]->{'cse_address'};}   

        $projects = [];
        foreach ($cse_PD as $project) {
            $projects[] = $this->formatProjectDetail($project);
        }

        $obj['projects'] = $projects;
        $obj['pro'] = $this->selectActiveProject($projects, $projectId);


        // CSE Social cs_Facebook	cs_Instagram	cs_Website	cs_logo
        if(!empty($cse_SD[0]->{'cs_Facebook'})){$obj['socials']['Facebook'] = $cse_SD[0]->{'cs_Facebook'};}
        if(!empty($cse_SD[0]->{'cs_Instagram'})){$obj['socials']['Instagram'] = $cse_SD[0]->{'cs_Instagram'};}
        if(!empty($cse_SD[0]->{'cs_Website'})){$obj['socials']['Website'] = $cse_SD[0]->{'cs_Website'};}
        if(!empty($cse_SD[0]->{'cs_logo'})){$obj['socials']['Logo'] = $cse_SD[0]->{'cs_logo'};}

       $d = [$obj];
        $result = json_encode($d,JSON_UNESCAPED_SLASHES);
        return $result;

    }
    public function getSDetail($where){
        $spoD = $this->getItemMul('Sponsors',$where);
        if (empty($spoD)) {
            return json_encode([]);
        }
        $baseWhere = ['spo_id' => $spoD[0]->{'spo_id'}];
        $spo_MCD = $this->getItemMul('SPO_MainContactdetails',$baseWhere);
        $spo_SD = $this->getItemMul('SPO_Socials',$baseWhere);
        $spo_Acc = $this->getItemMul('SPO_Accounts',$baseWhere);
       
        // spo_id	user_id	spo_OrgName	spo_Address	spo_Registration	spo_VatNumber	spo_Theme	ena_Regions	spo_Referer	spo_FoundPluggin
        $obj['Organisation Name'] = $spoD[0]->{'spo_OrgName'};
        $obj['Registration Number'] = $spoD[0]->{'spo_Registration'};
        $obj['Vat Number'] = $spoD[0]->{'spo_VatNumber'};
        // $obj['Theme'] = $spoD[0]->{'spo_Theme'};
        $obj['Regions'] = $spoD[0]->{'spo_Regions'};
        $obj['Referer'] = $spoD[0]->{'spo_Referer'};
        // $obj['Found Plugin Via'] = $spoD[0]->{'spo_FoundPluggin'};
        $obj['Address'] = $spoD[0]->{'spo_Address'};

        // SPP Main Contact smcd_Name	smcd_Email	smcd_Phone	smcd_JobTitle	spo_OtherAccount
        if(!empty($spo_MCD[0]->{'smcd_Name'})){$obj['mc']['Name'] = $spo_MCD[0]->{'smcd_Name'};}
        if(!empty($spo_MCD[0]->{'smcd_Email'})){$obj['mc']['Email'] = $spo_MCD[0]->{'smcd_Email'};}
        if(!empty($spo_MCD[0]->{'smcd_Phone'})){$obj['mc']['Phone'] = $spo_MCD[0]->{'smcd_Phone'};}
        if(!empty($spo_MCD[0]->{'smcd_JobTitle'})){$obj['mc']['Job Title'] = $spo_MCD[0]->{'smcd_JobTitle'};}
        if(!empty($spo_MCD[0]->{'spo_OtherAccount'})){$obj['Other Accounts'] = $spo_MCD[0]->{'spo_OtherAccount'}?"Yes":"No";}

        // Other Account Details sa_fName	sa_lName	sa_Email	
       // if(!empty($spo_Acc[0]->{'sa_fName'} && $spo_Acc[0]->{'sa_lName'})){$obj['oc']['Name'] = $spo_Acc[0]->{'sa_fName'}." ".$spo_Acc[0]->{'sa_lName'};}
       // if(!empty($spo_Acc[0]->{'sa_Email'})){$obj['oc']['Email'] = $spo_Acc[0]->{'sa_Email'};}

        // Sponsors Social Details sps_Facebook	sps_Instagram	sps_Website	sps_Linkedin
        if(!empty($spo_SD[0]->{'sps_Facebook'})){$obj['socials']['Facebook'] = $spo_SD[0]->{'sps_Facebook'};}
        if(!empty($spo_SD[0]->{'sps_Instagram'})){$obj['socials']['Instagram'] = $spo_SD[0]->{'sps_Instagram'};}
        if(!empty($spo_SD[0]->{'sps_Website'})){$obj['socials']['Website'] = $spo_SD[0]->{'sps_Website'};}
        if(!empty($spo_SD[0]->{'sps_Linkedin'})){$obj['socials']['LinkenIn'] = $spo_SD[0]->{'sps_Linkedin'};}



        $d = [$obj];
        $result = json_encode($d,JSON_UNESCAPED_SLASHES);
        return $result;

    }
    protected function formatProjectDetail($project): array
    {
        $collected = isset($project->pro_CollectData) ? ((int)$project->pro_CollectData === 1 ? 'Yes' : 'No') : null;
        $pccFunding = isset($project->pro_pccfunding) ? ((int)$project->pro_pccfunding === 1 ? 'Yes' : 'No') : null;

        return [
            'Project ID' => (int) $project->pro_id,
            'Name' => $project->pro_Name ?? '',
            'Purpose' => $project->pro_Purpose ?? '',
            'Key Objectives' => $project->pro_KeyObjectives ?? '',
            'Start Year' => $project->pro_StartYear ?? '',
            'Collected Impact Data' => $collected,
            'Project Impact' => $project->pro_Impact ?? '',
            'Required Sponsorship' => $project->pro_RequiredSponsorship ?? '',
            'Addition Resources Needed' => $project->pro_AdditionResourcesNeeded ?? '',
            'Financial Ask' => $project->pro_fAsk ?? '',
            'Financial Ask Details' => $project->pro_fAskDetails ?? '',
            'Equipment Ask' => $project->pro_eAsk ?? '',
            'Equipment Ask Details' => $project->pro_eAskDetails ?? '',
            'Professional Ask' => $project->pro_pAsk ?? '',
            'Professional Ask Details' => $project->pro_pAskDetails ?? '',
            'Received PCC Funding' => $pccFunding,
            'PCC Funding Details' => $project->pro_pccfundingDetails ?? '',
            'Business Benefits' => $project->pro_businessBenefits ?? '',
        ];
    }

    protected function selectActiveProject(array $projects, ?int $projectId): array
    {
        if (empty($projects)) {
            return [];
        }

        if ($projectId !== null) {
            foreach ($projects as $project) {
                if (isset($project['Project ID']) && (int)$project['Project ID'] === $projectId) {
                    return $project;
                }
            }
        }

        return $projects[0];
    }
    public function getEDetail($where){
        $enaD = $this->getItemMul('Enablers',$where);
        if (empty($enaD)) {
            return json_encode([]);
        }
        $baseWhere = ['ena_id' => $enaD[0]->{'ena_id'}];
        $ena_MCD = $this->getItemMul('ENA_MainContactdetails',$baseWhere);
        $ena_SD = $this->getItemMul('ENA_Socials',$baseWhere);
        $ena_HMAR = $this->getItemMul('ENA_HMAR',$baseWhere);
        $ena_HPRM = $this->getItemMul('ENA_HPRM',$baseWhere);
        $ena_HPRO = $this->getItemMul('ENA_HPRO',$baseWhere);
     
        $obj['Organisation Name'] = $enaD[0]->{'ena_OrgName'};
        $obj['Service Type'] = $enaD[0]->{'ena_ServiceType'};
        $obj['Regions'] = $enaD[0]->{'ena_Regions'};
        // $obj['Theme'] = $enaD[0]->{'ena_theme'} ;

        if(!empty($ena_HMAR[0]->{'emr_fName'}) || !empty($ena_HMAR[0]->{'emr_fName'}))
        {
            $obj["hmar"]["Name"] = $ena_HMAR[0]->{'emr_fName'} ." ".$ena_HMAR[0]->{'emr_lName'};
        }
        if(!empty($ena_HMAR[0]->{'emr_Email'})){$obj['hmar']['Email'] = $ena_HMAR[0]->{'emr_Email'};}


        if(!empty($ena_HPRM[0]->{'epr_fName'}) || !empty($ena_HPRM[0]->{'epr_lName'}))
        {
            $obj["hprm"]["Name"] = $ena_HPRM[0]->{'epr_fName'} ." ".$ena_HPRM[0]->{'epr_lName'};
        }
        if(!empty($ena_HPRM[0]->{'epr_Email'})){$obj['hprm']['Email'] = $ena_HPRM[0]->{'epr_Email'};}

        // $enaMContact=[
        //     "ena_id" => $ena_id,
        //     "emcd_Name" => $name,
        //     "emcd_Email" => $this->request->getVar('emcd_Email'),
        //     "emcd_Phone" => $this->request->getVar('emcd_Phone'),
        //     "emcd_JobTitle" => $this->request->getVar('emcd_JobTitle'),
        //     "ena_Confirmation" => $this->request->getVar('ena_Confirmation')
        // ];
        
        if(!empty($ena_MCD[0])){
            $obj['mc']['Name'] = $ena_MCD[0]->{'emcd_Name'};
            $obj['mc']['Email'] = $ena_MCD[0]->{'emcd_Email'};
            $obj['mc']['Phone'] = $ena_MCD[0]->{'emcd_Phone'};
            $obj['mc']['Job Title'] = $ena_MCD[0]->{'emcd_JobTitle'};
            $obj['mc']['Confirmation'] = $ena_MCD[0]->{'ena_Confirmation'}?'Yes':'No';

        }


        //   Enabler HPRO
        if(!empty($ena_HPRO[0]->{'epro_fName'}) || !empty($ena_HPRO[0]->{'epro_lName'}))
        {
            $obj["hpro"]["Name"] = $ena_HPRO[0]->{'epro_fName'} ." ".$ena_HPRO[0]->{'epro_lName'};
        }
        if(!empty($ena_HPRO[0]->{'epro_Email'})){$obj['hpro']['Email'] = $ena_HPRO[0]->{'epro_Email'};}

        // Socicals
        if(!empty($ena_SD[0]->{'es_Facebook'})){$obj['socials']['Facebook'] = $ena_SD[0]->{'es_Facebook'};}
        if(!empty($ena_SD[0]->{'es_Instagram'})){$obj['socials']['Website'] = $ena_SD[0]->{'es_Instagram'};}
        if(!empty($ena_SD[0]->{'es_Website'})){$obj['socials']['Instagram'] = $ena_SD[0]->{'es_Website'};}




        $d = [$obj];

        $result = json_encode($d,JSON_UNESCAPED_SLASHES);
        return $result;

    }

    public function deleteItems($table, $where, $whereInField, $whereInValue)
    {
        $builder = $this->db->table($table);
        if ($where)
            $builder->where($where);

        if ($whereInField && $whereInValue)
            $builder->whereIn($whereInField, $whereInValue);

        return $builder->delete();
    }

    public function ifExist($table,$user_id){
        $query = "SELECT TOP 1 1 FROM $table WHERE user_id = $user_id";
        return $this->db->query($query);

    }

    // function to get details of unapproved users

    public function getAppDetail($id){
        $where = ['user_id'=>$id];
        $user = $this->getItemMul('Users',$where);

        $type =$user[0]->{'user_type'};
        
        switch ($type) {
            case 'charity':
                $c=$this->getItem('Charities',$where);
                $c_id = $c->cse_id;
                $w=['cse_id'=>$c_id];
                return $this->getCDetail($w);
                break;
            case 'sponsor':
                $c=$this->getItem('Sponsors',$where);
                $s_id = $c->spo_id;
                $w=['spo_id'=>$s_id];
                return $this->getSDetail($w);
                break;
            case 'enabler':
                $c=$this->getItem('Enablers',$where);
                $e_id = $c->ena_id;
                $w=['ena_id'=>$e_id];
                return $this->getEDetail($w);
                break;
            default:
                break;
        }


    }

    // Catalouge Page

    public function getCatalogue($table, $where, $request, $schema, $order, $offset, $per_page){

        $builder = $this->db->table($table);
        if ($where)
            $builder->where($where);
        // if($order)
        //     $builder->orderBy('cse_id', 'DESC'); 
        //     $builder->limit(1);
       
        return $builder->get()->getResult();
    }


}
?>
