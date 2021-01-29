<?php

namespace App\Controller;

class TopController
{
    public function index($blade)
    {
        $variables = [
            "variable1" => "Hello",
            "variable2" => "World",
        ];

        echo $blade->run("Top", $variables);
    }
}
