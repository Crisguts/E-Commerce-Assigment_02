<?php

namespace controllers;

use models\Employee;
use views\EmployeeList;

require(dirname(__DIR__) . "/models/employee.php");
require(dirname(__DIR__) . "/resources/Views/Employees/EmployeesList.php");


class EmployeeController
{
   
    private Employee $employee;

    public function read()
    {
        $this->employee = new Employee();
        $data = $this->employee->read();
    

        (new EmployeeList())->buildHtml($data);

        //another option is to remove the echo from the view 
        //and just return html, then the controller returns 
        //the view as the requested resource. And it will be 
        //written to the response.
    }

    public function create($data) {
                    //     if (isset($_POST)) {
        //         echo $_POST['fname'] . "-" . $_POST['lname'] . "-" . $_POST['title'] . "-" . $_POST['empId'] . "-" . $_POST['depId'];
        //         $employee = new Employee();
        //         $employee->setEmpID($_POST['empId']);
        //         $employee->setFirstName((string) $_POST['fname']);
        //         $employee->setLastName((string)$_POST['lname']);
        //         $employee->setTitle((string)$_POST['title']);
        //         $employee->setDepID((int) $_POST['depId']);
        //         $employee->create();
        //         header("Location: " . $_SERVER['PHP_SELF']);
        //         exit();
        //     }
        // } else {
        //     // echo "Request method is " . $_SERVER['REQUEST_METHOD'];
        // }

    }
}


//testing
//(new EmployeeController())->read();
