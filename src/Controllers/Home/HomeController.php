<?php

namespace App\Controllers\Home;

use App\Controllers\App\AbstractController;
use App\Services\DatabaseManager;

class HomeController extends AbstractController
{
    public function index()
    {
        $this->view("Home/index.php", ["name" => "Albert"]);
    }

    public function login()
    {
        if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'])
        {
            header("location: /dashboard");
        }
    
        if($_SERVER["REQUEST_METHOD"] === "GET")
        {
            $_SESSION["token"] = $this->generateToken();
            $this->view("Home/login.php", ["token" => $_SESSION["token"], "flash" => ""]);
        }

        else
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            if($_POST["token"] !== $_SESSION["token"])
            {
                header("Location: /error/403");
                exit();
            }

            $user = DatabaseManager::findByName("users", $_POST["login"]);

            if(!$user)
            {
                $_SESSION["token"] = $this->generateToken();
                $this->view("Home/login.php", ["token" => $_SESSION["token"], "flash" => "Utilisateur introuvable"]);
                exit();
            }

            if(!password_verify($_POST["password"], $user["password"]))
            {
                $_SESSION["token"] = $this->generateToken();
                $this->view("Home/login.php", ["token" => $_SESSION["token"], "flash" => "Mot de passe erroné"]);
                exit();
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_logged'] = true;

            header("location: /dashboard");
        }
    }

    public function dashboard()
    {
        if(!isset($_SESSION['is_logged']) || !$_SESSION['is_logged'])
        {
            header("location: /login");
        }
    
        $this->view("Home/dashboard.php");
    }

    public function logout()
    {
        if(!isset($_SESSION['is_logged']) || !$_SESSION['is_logged'])
        {
            header("location: /login");
        }    
    
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['is_logged']);

        header("location: /login");
    }

    private function generateToken()
    {
        $nbChars = 30;
        $charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $token = "";

        for($i = 0 ; $i < $nbChars ; $i++)
        {
            $index = random_int(0, strlen($charset) - 1);
            $token .= $charset[$index];
        }

        return $token;
    }
};