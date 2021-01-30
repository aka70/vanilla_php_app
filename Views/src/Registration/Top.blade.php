<h1>会員登録ページ</h1>

会員登録ページです<br /><br />

<form id=registrationForm name="registrationForm" action="/registration/confirm" method="POST">
    <fieldset>
        @if ($email)
        <div class="card-text text-left alert alert-danger">
            <ul class="mb-0">
                @foreach($email as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <legend>会員登録フォーム</legend>
        <label for="mail">メールアドレス</label><input type="email" id="mail" name="mail" placeholder="メールアドレスを入力"
            value="{{$prev_post_email}}">
        <br />
        @if ($password)
        <div class="card-text text-left alert alert-danger">
            <ul class="mb-0">
                @foreach($password as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <label for="password">パスワード</label><input type="password" id="password" name="password" value=""
            placeholder="パスワードを入力">
        <br>
        <label for="password_conf">パスワード(再確認)</label><input type="password" id="password_conf" name="password_conf"
            value="" placeholder="パスワードを入力">
        <br>
        <input type="submit" value="会員登録">
    </fieldset>
</form>
<a href="/login">ログイン</a> <br />
<a href="/">TOPページへ戻る</a>