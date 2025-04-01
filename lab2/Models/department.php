<?php

namespace models;
use database\DBConnectionManager;
require_once("../core/db/dbconnectionmanager.php");
require("employee.php");

class Department{
    private $depID;
    private $name;
    private $employees;

    private $dbConnection;


public function get_depID(){
    return $this->depID;
}
public function set_depID($depID){
    $this->depID = $depID;
}
public function get_name(){
    return $this->name;
}
public function set_name($name){
    $this->name = $name;
}

public function __construct()
{
    $this->dbConnection = (new DBConnectionManager())->getConnection();  
}









}