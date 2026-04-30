<?php

namespace App\Controllers\App;

class AbstractController
{
    protected function view($template, $datas = [])
    {
        var_dump($template);
    }
};