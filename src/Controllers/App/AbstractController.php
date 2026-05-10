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

    protected function generateToken()
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

    protected function addFlash($message)
    {
        $_SESSION["flash"] = $message;
    }
};