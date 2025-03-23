<?php

class website extends Controller{


    function addWebsite($args = []){
        $this->view('security/website-fieldset');
    }
    
    
    function addDiscriptor($args = []){
        $this->view('security/descriptor-input');
    }
    
}