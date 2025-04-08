<?php

namespace core\auth;

use models\User;

require_once dirname(dirname(__DIR__)) . "/models/user.php";

class MembershipProvider
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function initUserByUsername($username)
    {
        $this->user->setUsername($username);
        $users = $this->user->readByUsername();
        if (isset($users))
            $this->user = $users[0];
    }

    public function login($username, $password)
    {
        $this->initUserByUsername($username);

        //validate pw
        if (password_verify($password, $this->user->getPassword())) {

            session_start();
            $_SESSION['username'] = $this->user->getUsername();
            $_SESSION['loggedIn'] = true;

            return true;
        } else
            return false;
    }

    //is logged in - boolean
    static function isLoggedIn()
    {
        session_start();
        if (isset($_SESSION)) {
            if (isset($_SESSION['username']) && $_SESSION['loggedIn'] == true) {
                return true;
            }
        }
        return false;
    }

    static function logout()
    {
        session_start();
        setcookie(session_name(), $_SESSION['username'], time() + 1800, "/lab2/", "localhost", false);
        session_unset(); //clear session array, this is the same as $_SESSION = []
        session_destroy(); //clears all session data
        header('Location: /lab2/logins');
    }
}
