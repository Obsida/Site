<?php
require "connectdb.php";

if (isset($_POST['update'])) {
    $id = $_COOKIE['id'];
    $login = $_POST['cus_login'];
    $password = $_POST['cus_pass'];
    $email_change = $_POST['cus_email'];

    if ($email_change != $email) {
        $query_check_user = mysqli_query($conn, "SELECT * FROM `Customer` WHERE `id_customer` = '$id'");
        if (mysqli_num_rows($query_check_user) > 0) {
            echo "<script>
                    alert(\"Почта занята\");
                    location.href='../Account.php';
                </script>";
            exit();
        }
    }

    //"C:\Users\Program\AppData\Local\Yandex\YandexBrowser\User Data\Default\Network\Cookies"
    if (isset($password)) {
        $query_user = mysqli_query($conn, "UPDATE `Customer` SET `email` = '$email_change' , `name_customer` = '$login' WHERE `Customer`.`email` = '$email'");
        echo "<script>
                    alert(\"Успешно изменено\");
                    location.href='../Account.php';
                </script>";
        exit();
    } else {
        $query_user = mysqli_query($conn, "UPDATE `Customer` SET `email` = '$email_change' , `password` = '$password' , `name_customer` = '$login' WHERE `Customer`.`email` = '$email'");
        echo "<script>
                    alert(\"Успешно изменено\");
                    location.href='../Account.php';
                </script>";
        exit();
    }
} else {
    $id = $_COOKIE['id'];
    $query_delete_user = mysqli_query($conn, "DELETE FROM `Customer` WHERE `id_customer` = '$id'");
    echo "<script>
                alert(\"Акаунт удален\");
                location.href='index.php';
            </script>";
}
?>