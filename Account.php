<?php
require_once "method/connectdb.php";

if (isset($_COOKIE['id'])) {
    $id = $_COOKIE['id'];
    $query_user = mysqli_query($conn, "SELECT * FROM `Customer` WHERE `id_customer` = '$id'");
    $list = mysqli_fetch_array($query_user);
}
?>  
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный профиль</title>
</head>
<link rel="stylesheet" href="css/Account-style.css">

<body>
    <header class="header-lvl-one">
        <div class="logo-header">
            <a href="index.php">
                <img src="./image/logo.svg" alt="">
                <h1>Playnchill</h1>
            </a>
        </div>
    </header>
    <div class="container">
        <h1>Личный профиль</h1>
        <p>Обновите свои данные или удалите аккаунт</p>
        <form method="post" action="method/Updateaccount.php">
            <div class="info_user">
                <label for="name_cus">Имя:</label>
                <input type="text" id="name_cus" name="cus_login"
                    value="<?= htmlspecialchars($list['name_customer']) ?>" required>
            </div>
            <div class="info_user">
                <label for="email_cus">Почта:</label>
                <input type="email" id="email_cus" name="cus_email" value="<?= htmlspecialchars($list['email']) ?>" required pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$">
            </div>
            <div class="info_user">
                <label for="pass_cus">Пароль:</label>
                <input type="password" id="pass_cus" name="cus_pass" placeholder="Новый Пароль">
            </div>
            <div class="buttons">
                <button type="submit" name="update">Изменить</button>
                <button type="submit" name="delete">Удалить</button>
            </div>
        </form>
    </div>
</body>

</html>