<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>

<form method="POST" action="{{ route('register-post') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">


    <div>
        <label for="name">İsim:</label>
        <input id="name" type="text" name="name" required autofocus>
    </div>

    <div>
        <label for="email">E-posta Adresi:</label>
        <input id="email" type="email" name="email" required>
    </div>

    <div>
        <label for="password">Şifre:</label>
        <input id="password" type="password" name="password" required>
    </div>

    <div>
        <label for="password_confirmation">Şifreyi Onayla:</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <button type="submit">Kayıt Ol</button>
</form>

</body>
</html>
