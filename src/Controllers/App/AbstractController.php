<?php

namespace App\Controllers\App;

class AbstractController
{
    protected function view($template, $datas = [])
    {
        $path = "../src/Templates/" . $template;
    
        echo file_get_contents($path);
    }
};