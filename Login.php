<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
</head>
<link rel="stylesheet" href="css/login-style.css">
<body>
    <div class="login-container">
    <form class="login-form">
        <p class="heading">Login</p>
        <p class="paragraph">Login to your account</p>
        <div class="input-group">
        <input
            required=""
            placeholder="email"
            id="email"
            type="text"
        />
        <div class="input-group">
        <input
            required=""
            placeholder="Password"
            name="password"
            id="password"
            type="password"
        />
        </div>
        <button type="submit">Login</button>
        <div class="bottom-text">
        <p>Don't have an account? <a href="#">Sign Up</a></p>
        </div>
    </form>
    </div>
</body>
</html>