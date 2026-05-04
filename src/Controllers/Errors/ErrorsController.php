<?php

namespace App\Controllers\Errors;

use App\Controllers\App\AbstractController;

class ErrorsController extends AbstractController
{
    public function error_404()
    {
        http_response_code(404);
        $this->view("Errors/404.php");
    }

    public function error_403()
    {
        http_response_code(403);
        $this->view("Errors/403.php");
    }
};