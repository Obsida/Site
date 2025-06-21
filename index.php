<?php
require_once "method/connectdb.php";

$name = "Не авторизован";
$redirectUrl = "Login.php";

if (isset($_COOKIE['id'])) {
    $id = $_COOKIE['id'];
    $query_user = mysqli_query($conn, "SELECT * FROM `Customer` WHERE `id_customer` = '$id'");
    $list = mysqli_fetch_array($query_user);

    if ($list) {
        $name = $list['name_customer'];
        $redirectUrl = "Account.php";
    }
}
$query_check_user = mysqli_query($conn, "SELECT * FROM `Game`");
$list = mysqli_fetch_all($query_check_user);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playnchill</title>
</head>
<link rel="stylesheet" href="css/style.css">

<body>
    <header>
        <div class="header-lvl-one">
            <div class="money-header">
                RU/$
            </div>
            <ul class="link-header">
                <li><a href="">Накопительный счет</a></li>
                <li><a href="">Отзывы</a></li>
                <li><a href="">Гарантии</a></li>
                <li><a href="">Как купить</a></li>
                <li><a href="">Накопительная</a></li>
                <li><a href="">Заработай</a></li>
            </ul>
            <div>
                <a class="user-header" href="<?= $redirectUrl ?>">
                    <p class="name-user"><?= $name ?></p>
                    <img src="./image/avatar.svg" alt="">
                </a>
            </div>
        </div>
        <div class="header-lvl-two">
            <div class="logo-header">
                <img src="./image/logo.svg" alt="">
                <h1>Playnchill</h1>
            </div>
            <div class="search-header">
                <input class="search" type="text" placeholder="Поиск">
            </div>
            <div class="button-header">
                <a href=""></a>
                <a href=""></a>
            </div>
            <div class="like-card-header">
                <img src="./image/like.svg" alt="" width="25" height="25">
                <img src="./image/card.svg" alt="" width="25" height="25">
            </div>
        </div>

    </header>
    <div class="block-one">
        <div class="block-one-name">
            <img src="./image/NFC-name.png">
            <H1>Тотальная война нового поколения началась!</H1>
            <H1>Сыграйте в Battlefield™ 2042 уже сегодня.</H1>
            <H1>Адаптируйтесь и процветайте!</H1>
            <div class="cost">
                <h2>16 400₽</h2>
                <h3 id="green">-15%</h3>
                <h3><span>16 400₽</span></h3>
            </div>
            <div class="button-card">
                <button id="card-btn">В корзину</button>
                <button id="save-btn">В избранное</button>
            </div>
        </div>
    </div>
    <div class="top">
        <h1>Топ 5</h1>
        <img src="./image/Vector (3).png" alt="">
    </div>

    <div class="card-all">
        <?php $count = 0; ?>
        <?php foreach ($list as $item): ?>
            <?php if ($count >= 5)
                break; ?>

            <div class="card">
                <?php
                $imageData = $item[8];
                $base64Image = base64_encode($imageData);
                ?>
                <img src="data:image/jpeg;base64,<?= $base64Image ?>" alt="<?= $item[4] ?>">

                <div class="card-sale-cost">
                    <h2><?= $item[6] ?>₽</h2>
                    <p>-15%</p>
                    <span><?= $item[6] ?>₽</span>
                </div>
                <h1><?= $item[4] ?></h1>
                <ul class="cart-other-info">
                    <li>Ключ</li>
                    <li>Аккаунт Steam</li>
                </ul>
            </div>

            <?php $count++; ?>
        <?php endforeach; ?>
    </div>
    <div class="category">
        <div class="nav-container">
            <div class="nav-item active">Новинки</div>
            <div class="nav-item">Аккаунты</div>
            <div class="nav-item">Ключи</div>
            <div class="nav-item">Активация</div>
            <div class="nav-item">Прокачка</div>
        </div>
        <div class="categorydiv">
            <?php foreach ($list as $item): ?>
                <div class="card">
                    <?php
                    $imageData = $item[8];
                    $base64Image = base64_encode($imageData);
                    ?>
                    <img src="data:image/jpeg;base64,<?= $base64Image ?>" alt="<?=$item[4] ?>">
                    <div class="card-sale-cost">
                        <h2><?= $item[6] ?>₽</h2>
                        <p>-15%</p>
                        <span><?= $item[6] ?>₽</span>
                    </div>
                    <h1><?= $item[4] ?></h1>
                    <ul class="cart-other-info">
                        <li>Ключ</li>
                        <li>Аккаунт Steam</li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="catalog_btn_div">
            <button class="catalog_btn">Перейти в каталог</button>
        </div>
    </div>
    <div class="Promotions_and_discounts">
        <div class="top">
            <h1 class="promo">Акции и скидки</h1>
            <h1 class="disc">%</h1>
        </div>
        <div class="categorydiv">
            <?php foreach ($list as $item): ?>
                <div class="card">
                    <?php
                    $imageData = $item[8];
                    $base64Image = base64_encode($imageData);
                    ?>
                    <img src="data:image/jpeg;base64,<?= $base64Image ?>" alt="<?= $item[4] ?>">
                    <div class="card-sale-cost">
                        <h2><?= $item[6] ?>₽</h2>
                        <p>-15%</p>
                        <span><?= $item[6] ?>₽</span>
                    </div>
                    <h1><?= $item[4] ?></h1>
                    <ul class="cart-other-info">
                        <li>Ключ</li>
                        <li>Аккаунт Steam</li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>



    <footer>
        <div class="requisites-icon">
            <img src="./image/Visa_Inc._logo 1.svg" alt="">
            <img src="./image/1920px-Mir-logo.SVG 1.svg" alt="">
            <img src="./image/WebMoney_logo_blue 2 1.svg" alt="">
            <img src="./image/2560px-PayPal_logo 2.svg" alt="">
        </div>
        <div class="about">
            <div class="about-us">
                <h1>О компании</h1>
                <p>О нас</p>
                <p>Вакансии</p>
                <p>Реквизиты</p>
            </div>
            <div class="offer">
                <h1>Договор оферты</h1>
                <p>Каталог</p>
                <p>Акции</p>
                <p>Личный кабинет</p>
            </div>
            <img src="./image/WebMoney.svg" alt="">
            <img src="./image/google.svg" alt="">
        </div>

    </footer>
</body>

</html>