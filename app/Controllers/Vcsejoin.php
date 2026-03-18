<?php

namespace App\Controllers;
use App\Models\PluginModel;
use App\Libraries\Email;

class Vcsejoin extends BaseController
{
    protected $u_id;
    protected $c_id;
    protected $u_email;
	protected $s_email;
    protected $request;

    function __construct()
	{

		$this->db = db_connect();
		$this->model = new PluginModel($this->db);
		$this->s_email = new Email();
       
	}
    public function index(): string
    {
        return view('vcsejoin/signup'); 
    }
    public function guidlines(): string
    {
        return view('vcsejoin/guidlines'); 
    }

}
