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
            exit();
        }
    
        if($_SERVER["REQUEST_METHOD"] === "GET")
        {
            $_SESSION["token"] = $this->generateToken();
            $this->view("Home/login.php", ["token" => $_SESSION["token"]]);
        }

        else
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            if($_POST["token"] !== $_SESSION["token"])
            {
                unset($_SESSION["token"]);
            
                $this->addFlash("Une erreur s'est produite");
                header("location: /login");
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

            unset($_SESSION["token"]);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_logged'] = true;
            $_SESSION['user_role'] = $user["role"];

            if($user["role"] === "tech")
            {
                header("location: /dashboard");
                exit();
            }
            else
            if($user["role"] === "admin")
            {
                header("location: /dashboard_admin");
                exit();
            }
        }
    }

    public function dashboard()
    {
        if(!isset($_SESSION['is_logged']) || !$_SESSION['is_logged'])
        {
            header("location: /login");
            exit();
        }

        if($_SESSION['user_role'] === 'admin')
        {
            header("location: /dashboard_admin");
            exit();
        }
    
        $this->view("Home/dashboard.php");
    }

    public function dashboardAdmin()
    {
        if(!isset($_SESSION['is_logged']) || !$_SESSION['is_logged'])
        {
            header("location: /login");
            exit();
        }

        if($_SESSION['user_role'] === 'tech')
        {
            header("location: /dashboard");
            exit();
        }
    
        $this->view("Home/dashboard_admin.php");
    }

    public function logout()
    {
        if(!isset($_SESSION['is_logged']) || !$_SESSION['is_logged'])
        {
            header("location: /login");
            exit();
        }    
    
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['is_logged']);
        unset($_SESSION['role']);

        header("location: /login");
        exit();
    }
};