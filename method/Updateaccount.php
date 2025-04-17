<?php
    require_once "connectdb.php";
    if(isset($_POST['update'])){
        $email = $_COOKIE['email'];
        $login = $_POST['cus_login'];
        $password = $_POST['cus_pass'];
        $email_change = $_POST['cus_email'];
        if ($email_change != $email) 
        {
            $query_check_user = mysqli_query($conn,"SELECT * FROM `Customer` WHERE `email` = '$email_change'");
            if(mysqli_num_rows($query_check_user) > 0)
            {
                echo "<script>
                    alert(\"Почта занята\");
                    location.href='account.php';
                </script>";
                exit();
            }
            else{
                $query_user = mysqli_query($conn, "UPDATE `Customer` SET `email` = '$email_change' , `password` = '$password' , `name_customer` = '$login' WHERE `Customer`.`email` = '$email'");
                setcookie('email', $email_change, time() + 60*60*24) ;
                echo "<script>
                            alert(\"Успешно изменено\");
                            location.href='account.php';
                        </script>";
                        exit();
                }
        }
        else{
        $query_user = mysqli_query($conn, "UPDATE `Customer` SET `email` = '$email_change' , `password` = '$password' , `name_customer` = '$login' WHERE `Customer`.`email` = '$email'");
        setcookie('email', $email_change, time() + 60*60*24) ;
        echo "<script>
                    alert(\"Успешно изменено\");
                    location.href='account.php';
                </script>";
                exit();
        }
        
}
else{
      $email = $_COOKIE['email'];
    $query_delete_user = mysqli_query($conn,"DELETE FROM `Customer` WHERE `email` = '$email'");
    echo "<script>
                alert(\"Акаунт удален\");
                location.href='index.php';
            </script>";
}
?>