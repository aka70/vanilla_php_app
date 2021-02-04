<h1>会員登録ページ</h1>

会員登録ページです<br /><br />

<form id=registrationForm name="registrationForm" action="/registration/complete" method="POST">
    <fieldset>
        <legend>確認フォーム</legend>
        メールアドレス : {{$mail}}
        <br />
        パスワード : @php echo str_repeat("*", mb_strlen($password, "UTF8")); @endphp
        <br><br>
        これでいいですか？
        <br>
        <button type="button" onclick="location.href='/registration/top'">戻る</button><input type="submit" value="会員登録">
    </fieldset>
</form>

<a href="/">topページへ戻る</a>