<?php

class contact extends Controller
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
        // exit('Not Ready');
        // $this->model('Sample_Model');
        $this->view('contact-us/index');
    }
}
