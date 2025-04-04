<?php

namespace models;

use database\DBConnectionManager;

require_once(dirname(__DIR__) . "/core/db/dbconnectionmanager.php");

class User
{

    private $id;
    private $username;
    private $password;
    private $enabled2FA;
    private $secret;

    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = (new DBConnectionManager())->getConnection();
    }

    //getters setters
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    //should this be public!? if not used, could even be removed
    private function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEnabled2FA()
    {
        return $this->enabled2FA;
    }

    public function setEnabled2FA($enabled2FA)
    {
        $this->enabled2FA = $enabled2FA;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
    }


    //read single user by id
    public function readOne()
    {
        $query = "SELECT * FROM users WHERE id = :userID";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':userID', $this->id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, User::class);
    }

    //read single user by username
    public function readByUsername()
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, User::class);
    }
}


//test
// $user = new User();
// $user->setUsername('user1');

// var_dump($user->readByUsername());
