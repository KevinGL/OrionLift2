<?php

namespace App\Controllers\App;

class AbstractController
{
    protected function view($template, $datas = [])
    {
        $path = "../src/Templates/" . $template;
    
        $content = file_get_contents($path);

        $keys = array_keys($datas);
        
        foreach($keys as $key)
        {
            $content = str_replace("@" . $key, $datas[$key], $content);
        }

        echo $content;
    }
};