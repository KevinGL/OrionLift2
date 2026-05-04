<?php

namespace App\Controllers\Home;

use App\Controllers\App\AbstractController;

class HomeController extends AbstractController
{
    public function index()
    {
        $this->view("Home/index.php", ["name" => "Albert"]);
    }
};