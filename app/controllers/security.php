<?php

class security extends Controller
{
    public $request;
    public $activemenu;
    function __construct()
    {
        $this->request = $_REQUEST;
        $this->activemenu = $this->request['url'];
    }
    function index($args = [])
    {
        // $this->model('Sample_Model');
        $this->view('security/index');
    }
}
