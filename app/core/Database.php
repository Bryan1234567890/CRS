<?php

class Database extends PDO {

    function __construct(){
        parent::__construct('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASS);
    }
}