<?php

namespace core\http;

require("request.php");
//A factory class for requests

class RequestBuilder
{

    public function getRequest()
    {
        $method = $this->getRequestMethod();
        $url = $_SERVER['REQUEST_URI'];
        $headers = getallheaders();
        $body = file_get_contents("php://input");
        $params = $this->getURLParams();;
        $postFields = $_POST;

        return new Request($method, $url, $headers, $body, $params, $postFields);
    }

    private function getRequestMethod()
    {
        $requestMethod = "";
        if (isset($this->getURLParams()[1]))
            $requestMethod = $this->getURLParams()[1];


        switch ($requestMethod) {
            case 'list':
                $requestMethod = 'GET';
                break;
            case 'create':
                $requestMethod = 'POST';
                break;
            case 'update':
                $requestMethod = 'PUT';
                break;
            case 'delete':
                $requestMethod = 'DELETE';
                break;
            default:
                $requestMethod = $_SERVER["REQUEST_METHOD"];
        }
        return $requestMethod;
    }

    //we assume our url is of the format
    //[BASE URL] [RESOURCE] [ACTION OPTIONAL] [ID]
    //eg: lab2/employees/list/1

    //This method returns an array
    //$params = getURLParams()
    //$param[0] -> resource
    //$param[1] -> action or method
    //$param[2] -> id

    private function getURLParams()
    {

        //Since we may get a url of the form lab2/employees/1/ that finishes with a 
        //slash, we need to use trim to remove the last slash.
        //Then we need to use explose to transform the value of $_GET['url'] into an array. 

        return explode("/", trim($_GET["url"], "/"));
    }
}
