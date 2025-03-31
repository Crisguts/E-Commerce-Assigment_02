<?php

namespace database;

use PDOException;

class DBConnectionManager
{

    private $host;
    private $dbName;
    private $username;
    private $password;

    private $dboConnection;

    function __construct()
    {
        $this->username = 'root';
        $this->password = '';
        $this->host = 'localhost';
        $this->dbName = 'hr';

        try {
            $this->dboConnection = new \PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password);
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->dboConnection;
    }
}
