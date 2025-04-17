<?php
    $email = $_COOKIE['email'];
    $query_delete_user = mysqli_query($conn,"DELETE FROM `Customer` WHERE `email` = '$email'");
    echo "<script>
                alert(\"Акаунт удален\");
                location.href='index.php';
            </script>";
?>