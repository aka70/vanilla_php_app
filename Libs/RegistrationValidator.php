<?php

namespace App\Libs;

use Valitron\Validator;

class RegistrationValidator
{
    public function __construct()
    {
        Validator::lang('ja');
    }

    public function registrationConfirm($post_data)
    {
        $validation = new Validator($post_data);

        $validation->labels([
            'mail' => 'メールアドレス',
            'password' => 'パスワード',
            'password_conf' => 'パスワード(確認用)'
        ]);

        $validation->rule('required', ['mail', 'password', 'password_conf'])
            ->message('{field}は必須項目です。');

        $validation->rule('equals', 'password', 'password_conf')
            ->message('パスワードとパスワード(確認用)が一致しません。');

        $validation->rule('email', 'mail')
            ->message('正しいメールアドレス形式で入力してください。');

        $validation->rule('lengthMin', 'password', 6)
            ->message('パスワードは6文字以上にしてください。');

        if ($validation->validate()) {
            $errors = [];
        } else {
            $errors = $validation->errors();
        }

        return $errors;
    }
}
