<?php
    require_once "connectdb.php";
    if(isset($_POST["password"]) && isset($_POST["email"]))
    {

        $password = $_POST['password'];
        $email = $_POST['email'];
        $query_check_user = mysqli_query($conn,"SELECT * FROM `Customer` WHERE `email` = '$email'");
        if(mysqli_num_rows($query_check_user) > 0)
        {
            $hashpass = mysqli_fetch_array($query_check_user);
            if(password_verify($password,$hashpass['password']))
            {
                setcookie('id', $hashpass['id_customer'], time() + 60*60*24, "/");

                header("Location: http://site");
            }
            else{
                header("Location: http://site/Login.php");
            }
        }
        else
        {
            echo "Нет такого пользователя";
        }
    }
?>

