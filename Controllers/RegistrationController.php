<?php

namespace App\Controller;

use eftec\bladeone\BladeOne;
use App\Libs\RegistrationValidator;
use App\Models\User;

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

        $_SESSION['mail'] = $post_data["mail"];
        $_SESSION['password'] = $post_data["password"];

        return $this->render('confirm', $post_data);
    }

    public function complete()
    {
        $hashed_password = password_hash($_SESSION["mail"],PASSWORD_DEFAULT);
        $user = new User();

        $user->create([
            'user_name' => $_SESSION["mail"],
            'password' => "$hashed_password",
        ]);

        return $this->render('complete');
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
