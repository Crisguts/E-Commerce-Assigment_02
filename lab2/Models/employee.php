<?php

namespace models;

use database\DBConnectionManager;

// OR THIS require_once("../core/db/dbconnectionmanager.php");
require_once(dirname(__DIR__) . "/core/db/dbconnectionmanager.php");

class Employee
{

    private $dep_id;
    private $emp_id;
    private $fname;
    private $lname;
    private $title;

    private $dbConnection;

    public function getFirstName()
    {
        return $this->fname;
    }
    public function setFirstName($fname)
    {

        $this->fname = $this->validateInput($fname);
    }

    public function getLastName()
    {
        return $this->lname;
    }
    public function setLastName($lname)
    {
        $this->lname = $this->validateInput($lname);
    }

    public function getEmpID()
    {
        return $this->emp_id;
    }
    public function setEmpID($empID)
    {
        $this->emp_id = $this->validateInput($empID);
    }

    public function getDepID()
    {
        return $this->dep_id;
    }

    //public function setDepID(Department $depID) //teacher has it like this in his code
    public function setDepID($depID)
    {
        $this->dep_id = $this->validateInput($depID);
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $title = $this->validateInput($title);
        if ($this->titleValidation($title)) {
            $this->title = $title;
        } else {
            echo "Invalid Title.";
        }
    }

    public function __construct()
    {
        $this->dbConnection = (new DBConnectionManager())->getConnection();
    }

    //Implement the CRUD options 

    //CREATE
    //create using this employee's 
    public function create()
    {
        $query = "SELECT COUNT(*) FROM EMPLOYEES WHERE EMPLOYEEID = :employeeID";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam("employeeID", $this->getEmpID());
        $stmt->execute();
        if ($stmt->fetchColumn() == 0) {
            $query = "INSERT INTO employees (employeeID, firstName, lastName, title, departmentID) VALUES (:employeeID, :fname, :lname, :title, :depID)";
            $stmt = $this->dbConnection->prepare($query);
            $stmt->bindParam("employeeID", $this->getEmpID(), \PDO::PARAM_INT);
            $stmt->bindParam("fname", $this->getFirstName(), \PDO::PARAM_STR);
            $stmt->bindParam("lname", $this->getLastName(), \PDO::PARAM_STR);
            $stmt->bindParam("title", $this->getTitle(), \PDO::PARAM_STR);
            $stmt->bindValue(":depID", $this->getDepID(), $this->getDepID() !== null ? \PDO::PARAM_INT : \PDO::PARAM_NULL);
            $stmt->execute();
            echo "EMPLOYEE CREATED";
        } else {
            echo "ERROR, THIS EMPLOYEE ALREADY EXISTS";
        }
    }

    //READ
    //read all employees
    public function read()
    {
        $query = "SELECT * FROM EMPLOYEES";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    //read one
    public function readOne()
    {
        //NEVER DIRECTLY APPEND THE VARIABLE TO THE QUERY BECAUSE THE USER/HACKER COULD DELETE YOUR TABLES (SQL INJECTION ATTACK)
        //$query = "SELECT * FROM EMPLOYEES WHERE EMPLOYEEID = {$this->emp_id}";
        $query = "SELECT * FROM EMPLOYEES WHERE EMPLOYEEID = :employeeID";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(":employeeID", $this->getEmpID());
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Employee::class);
    }

    //UPDATE
    //this function can accept depID as null,but rest must be given AND of the good data type
    public function update($empID, ?int $depID, $fname, $lname, $title)
    {
        if ($this->titleValidation($title)) {
            $query = "UPDATE EMPLOYEES SET firstName = :fname,lastName = :lname,title = :title,departmentID = :depID  WHERE EMPLOYEEID = :empID";
            $stmt = $this->dbConnection->prepare($query);
            $stmt->bindParam(":fname", $this->validateInput($fname), \PDO::PARAM_STR);
            $stmt->bindParam(":lname", $this->validateInput($lname), \PDO::PARAM_STR);
            $stmt->bindParam(":title", $this->validateInput($title), \PDO::PARAM_STR);
            $stmt->bindParam(":empID", $this->validateInput($empID), \PDO::PARAM_INT);
            $stmt->bindValue(":depID", $this->validateInput($depID), $this->validateInput($depID) !== null ? \PDO::PARAM_INT : \PDO::PARAM_NULL);
            $stmt->execute();
        } else {
            echo "Title is not valid.";
        }
    }

    //DELETE
    public function deleteThis()
    {
        $query = "DELETE FROM EMPLOYEES WHERE EMPLOYEEID = :employeeID";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam("employeeID", $this->emp_id);
        $stmt->execute();
    }



    //ASSIGNMENT 2 -  
    //Ensure all employee records have the title only containing alphabetical characters.
    public function titleValidation($title)
    {
        //return ctype_alpha($title); //assuming title has no space
        return preg_match('^[a-zA-Z\s]+$', $title); //better because it accepts spaces in title
    }

    // Function to validate user input
    function validateInput($data)
    {
        // Trim whitespace from the beginning and end of the input
        $data = trim($data);
        // Remove backslashes from the input
        $data = stripslashes($data);
        // Convert special characters to HTML entities
        $data = htmlspecialchars($data);
        return $data;
    }
}

//TESTING 
//TDD: Test Driven Development
//Test your code as you work. Before progressing.



// $employee1 = new Employee();
// $employee1->setEmpID(10);
// $employee1->setFirstName("Florence");
// $employee1->setLastName("Stuff");
// $employee1->setTitle("Back-End Developer");
// $employee1->setDepID(2);

// $employee1->create();
// $employee1 = $employee->read();

//$employee1->deleteThis();
//$employee1->update(5,null,"Florrience","Stiff","Jobless"); //dep id can be null


// $employee = new Employee();
// $employees = $employee->read();
// echo "<pre>";
// print_r($employees);
// echo "</pre>";
