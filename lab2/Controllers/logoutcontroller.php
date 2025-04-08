<?php

namespace controllers;

use core\auth\MembershipProvider;

require(dirname(__DIR__) . "/core/auth/membershipprovider.php");

class LogoutController
{
    public function read()
    {
        MembershipProvider::logout();
    }

    public function create($data) {}
}
