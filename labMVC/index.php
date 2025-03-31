<?php

use models\Employee;


class App
{

    public function start()
    {
        //FROM THE FORM
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            require(__DIR__ . '/Models/employee.php');

            if (isset($_POST)) {
                echo $_POST['fname'] . "-" . $_POST['lname'] . "-" . $_POST['title'] . "-" . $_POST['empId'] . "-" . $_POST['depId'];
                $employee = new Employee();
                $employee->setEmpID($_POST['empId']);
                $employee->setFirstName((string) $_POST['fname']);
                $employee->setLastName((string)$_POST['lname']);
                $employee->setTitle((string)$_POST['title']);
                $employee->setDepID((int) $_POST['depId']);
                $employee->create();
                header("Location: " . $SERVER['PHP_SELF']);
                exit();
            }
        } else {
            // echo "Request method is " . $_SERVER['REQUEST_METHOD'];
        }


        //echo dirname(__DIR__);///Applications/XAMPP/xamppfiles/htdocs

        spl_autoload_register(function ($class) {
            $class = str_replace("\\", "/", $class);
            require $class . ".php";
        });


        $requestBuilderClass = "\\core\\http\\RequestBuilder";

        if (class_exists($requestBuilderClass)) {

            $requestBuilder = new $requestBuilderClass();

            $request = $requestBuilder->getRequest();

            echo "method = " . $request->getMethod();


            //if the url is "http://localhost:8080/lab2/index.php?employee=1"
            //then we want employee ID = 1
            //we can do $_GET["employee"] to get that 1

            //but if we want "http://localhost:8080/lab2/index.php?employee"
            //then we want all employees 
            //to know which controller to use (ex: what if its department)

            $urlParams = $request->getParams();

            $resource = $urlParams[0];
            //echo $resource;


            //we need to construct the controller name from the resource name
            //To match our controller name EmployeeController
            //starting with "employees" as included in the query string
            //1- we need to capitalize the E
            //2- we need to remove the s
            //3- we need to append the keyword controller

            $controllerClass = "\\Controllers\\" . substr(ucfirst($resource), 0, strlen($resource) - 1) . "Controller";

            //add the controllers' namespace to the class name as a fully qualified class name
            //so that the require works when the autoload function is called.

            //The class exists check is calling the function given to the autoload register
            if (class_exists($controllerClass, true)) {
                //if the controller's class exist, call it's function to satisfy the request
                $controller = new $controllerClass();
                $controller->read();

                //echo "The request method is: " . $_SERVER["REQUEST_METHOD"];
            } else {
                echo "The requested resource doesn't exist.";
            }
        }
    }
}

$app = new App();
$app->start();
