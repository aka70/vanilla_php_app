<h1>会員登録ページ</h1>

会員登録ページです<br /><br />

<form id=registrationForm name="registrationForm" action="/registration/comfirm" method="POST">
    <fieldset>
        <legend>会員登録フォーム</legend>
        <label for="mail">メールアドレス</label><input type="email" id="mail" name="mail" placeholder="メールアドレスを入力"
            value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
        <br />
        <label for="password">パスワード</label><input type="password" id="password" name="password" value=""
            placeholder="パスワードを入力">
        <br>
        <label for="password_conf">パスワード(再確認)</label><input type="password_conf" id="password_conf" name="password_conf"
            value="" placeholder="パスワードを入力">
        <br>
        <input type="submit" id="registration" name="registration" value="会員登録">
    </fieldset>
</form>
<a href="/login">ログイン</a> <br />
<a href="/">TOPページへ戻る</a>