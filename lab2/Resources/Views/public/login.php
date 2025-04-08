<?php

namespace views\public;

use core\http\RequestBuilder;
use core\auth\MembershipProvider;


///Applications/XAMPP/xamppfiles/htdocs/lab2\core\http\requestbuilder.php
// require(dirname(dirname(dirname(__DIR__))) . "/core/http/" . "requestbuilder.php");
// require(dirname(dirname(dirname(__DIR__))) . "/core/auth/membershipprovider.php");

spl_autoload_register(function ($class) {
    $class = str_replace("\\", "/", $class);
    require $class . ".php";
});


class Login
{
    public function render($data)
    {
        $requestBuilder = new RequestBuilder();
        $request = $requestBuilder->getRequest();
        $membershipProvider = new MembershipProvider();



        if ($request->getMethod() == 'GET') {
            $usernameMessage = "<h1>Please enter your username and password</h1>";
        } else if ($request->getMethod() == 'POST') {
            print_r($_POST);
            if ($membershipProvider->login($data['username'], $data['password'])) {
                header('HTTP/1.1 302 Found');
                header('location: /lab2/employees');
            }
        } else {
            $usernameMessage = "<h1>The username or password is incorrect.</h1>";
        }

        $html = '
        <!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login Page</title>
             <style>
                form {
                    width: 300px;
                    margin: 100px auto;
                    padding: 20px;
                    background: #f4f4f4;
                    border-radius: 10px;
                    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }
                label {
                    font-size: 16px;
                    font-weight: bold;
                    display: block;
                    margin: 10px 0 5px;
                }
        
                input[type="text"],
                input[type="password"] {
                    width: 90%;
                    padding: 10px;
                    margin: 5px 0;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    font-size: 14px;
                }
        
                input[type="submit"] {
                    width: 100%;
                    background: #3498db;
                    color: white;
                    border: none;
                    padding: 10px;
                    font-size: 16px;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: 0.3s;
                }
        
                input[type="submit"]:hover {
                    background: #2980b9;
                }
            </style>
        </head>
        
        <body>
            <form action="" method="POST">
                <label for="fname">Username:</label><br>
                <input type="text" name="username"><br>
                <label for="password">Password:</label><br>
                <input type="password" name="password"><br><br>
                <input type="submit" value="Login">
            </form>' . $usernameMessage . '
        </body>
        
        </html>';

        echo $html;
    }
}
