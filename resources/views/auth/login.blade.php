<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>

<form method="POST" action="{{ route('login-post') }}">
    @csrf

    <div>
        <label for="email">E-posta Adresi:</label>
        <input id="email" type="email" name="email" required>
    </div>

    <div>
        <label for="password">Şifre:</label>
        <input id="password" type="password" name="password" required>
    </div>


    <button type="submit">Kayıt Ol</button>
</form>

</body>
</html>
