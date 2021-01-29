<?php

namespace App\Controller;

use eftec\bladeone\BladeOne;

class RegistrationController
{
    public function top()
    {
        $variables = [
            "variable1" => "Hello",
            "variable2" => "World",
        ];

        return $this->render('Top', $variables);
    }

    private function render(string $template, array $variables = [])
    {
        $dir = dirname(__DIR__, 1);
        $views = $dir . '/Views/src/Registration';
        $cache = $dir . '/Views/cache/Registration';
        $blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
        return $blade->run($template, $variables);
    }
}
