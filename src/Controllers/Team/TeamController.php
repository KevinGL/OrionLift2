<?php

namespace App\Controllers\Team;

use App\Controllers\App\AbstractController;
use App\Services\DatabaseManager;

class TeamController extends AbstractController
{
    public function index()
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
    
        $teams = DatabaseManager::findAll("teams");

        //var_dump($teams);

        $content = "<table>";
        $content .= "    <thead>";
        $content .= "        <tr>";
        $content .= "            <th>Identifiant</th>";
        $content .= "            <th>Nom</th>";
        $content .= "        </tr>";
        $content .= "    </thead>";

        $content .= "    <tbody>";
        
        foreach($teams as $team)
        {
            $content .= "        <tr>";
            $content .= "            <td>" . $team["id"] ."</td>";
            $content .= "            <td>" . htmlspecialchars($team["name"]) ."</td>";
            $content .= "        </tr>";
        }

        $content .= "    </tbody>";
        $content .= "</table>";
    
        $this->view("Teams/index.php", ["teams" => $content]);
    }

    public function add()
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
    
        if($_SERVER["REQUEST_METHOD"] === "GET")
        {
            $_SESSION["token"] = $this->generateToken();
        
            $this->view("Teams/add.php", ["token" => $_SESSION["token"]]);
        }

        else
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            if(!$_POST["token"] || $_POST["token"] !== $_SESSION["token"])
            {
                $this->addFlash("Une erreur s'est produite");
                header("location: /teams");
                exit();
            }

            unset($_SESSION["token"]);

            DatabaseManager::add("teams", ["name" => $_POST["name"]]);

            $this->addFlash(htmlspecialchars($_POST['name']) . " créée avec succès");
            header("location: /teams");
            exit();
        }
    }
}