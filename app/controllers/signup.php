<?php

class signup extends Controller{

    function index($args = []){
        // $this->model('Sample_Model');

        $this->view('security/signup');
    }
}