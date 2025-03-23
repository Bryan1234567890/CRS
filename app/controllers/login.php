<?php

class login extends Controller{

    function index($args = []){
        // $this->model('Sample_Model');

        $this->view('security/login');
    }
}