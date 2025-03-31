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

    //public function create() {}
}


//testing
//(new EmployeeController())->read();
