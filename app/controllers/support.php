<?php

class support extends Controller
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

        $this->view('support/index');
    }
}
