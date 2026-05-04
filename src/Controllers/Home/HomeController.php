<?php

namespace App\Controllers\Home;

use App\Controllers\App\AbstractController;

class HomeController extends AbstractController
{
    public function index()
    {
        $this->view("Home/index.php", ["name" => "Albert"]);
    }

    public function login()
    {
        if($_SERVER["REQUEST_METHOD"] === "GET")
        {
            $_SESSION["token"] = $this->generateToken();
        
            $this->generateToken();
            $this->view("Home/login.php", ["token" => $_SESSION["token"]]);
        }

        else
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            if($_POST["token"] !== $_SESSION["token"])
            {
                header("Location: /error/403");
                exit();
            }

            //
        }
    }

    private function generateToken()
    {
        $nbChars = 30;
        $charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $token = "";

        for($i = 0 ; $i < $nbChars ; $i++)
        {
            $index = random_int(0, strlen($charset));
            $token .= $charset[$index];
        }

        return $token;
    }
};