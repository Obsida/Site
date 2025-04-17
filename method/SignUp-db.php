<?php
    require_once "connectdb.php";
    if(isset($_POST['name_customer']) && isset($_POST["password"]) && isset($_POST["email"]))
    {

        $login = $_POST['name_customer'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $query_check_user = mysqli_query($conn,"SELECT * FROM `Customer` WHERE `email` = '$email'");
        if(mysqli_num_rows($query_check_user) > 0)
        {
            echo "<script>
                alert(\"Почта занята\");
                location.href('index.php');
            </script>";
        }
        else
        {
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $query_new_user = mysqli_query($conn,"INSERT INTO `Customer`(`name_customer`, `password`, `email`, `role_id`) VALUE ('$login','$hash','$email',1)");
            if($query_new_user)
            {
                setcookie('email', $email, time() + 60*60*24) ;
                echo "<script>
                location.href='account.php';
            </script>";
            }
        }
    }
?>

