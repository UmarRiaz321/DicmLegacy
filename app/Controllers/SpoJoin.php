<?php

namespace App\Controllers;
use App\Models\PluginModel;
use App\Libraries\Email;

class SpoJoin extends BaseController
{
    function __construct()
	{

		$this->db = db_connect();
		$this->model = new PluginModel($this->db);
		$this->s_email = new Email();
	}
    public function index(): string
    {
        return view('spojoin/spojoin'); 
    }
    public function TermsAndConditions(): string
    {
        return view('spojoin/termsAndConditions'); 
    }

}