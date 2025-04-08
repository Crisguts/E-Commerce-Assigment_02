<?php

namespace controllers;

use views\public\Login;
use core\auth\MembershipProvider;

require(dirname(__DIR__) . "/resources/views/public/login.php");
require(dirname(__DIR__) . "/core/auth/membershipprovider.php");

if (MembershipProvider::isLoggedIn()) {
    header('Location: /lab2/employees');
}


class LoginController
{
    public function read()
    {

        $data = null;
        (new Login())->render($data);
    }

    public function create($data)
    {
        $username = $data['username'];
        (new Login())->render($data);
    }
}
