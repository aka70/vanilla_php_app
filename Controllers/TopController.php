<?php

namespace App\Controller;

class TopController
{
    public function index()
    {
        echo json_encode(["status" => 'OK']);
    }
}
