<?php

namespace App\Controller;

use eftec\bladeone\BladeOne;
use App\Libs\RegistrationValidator;

class RegistrationController
{
    public function top()
    {
        return $this->render('Top');
    }

    public function confirm()
    {
        $post_data = filter_input_array(INPUT_POST);
        $validator = new RegistrationValidator();
        $errors = $validator->registrationConfirm($post_data);

        if ($errors) {
            $variables = $errors;
            $variables["prev_post_email"] = $post_data["mail"];
            return $this->render('Top', $variables);
        }
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
