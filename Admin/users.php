<?php
require "./../method/connectdb.php";
if (isset($_GET['toggle'])) {
    $id_customer = mysqli_real_escape_string($conn, $_GET['toggle']);
    $sql = "SELECT Activity FROM Customer WHERE id_customer = '$id_customer'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $new_activity = $row['Activity'] ? 0 : 1;

    $sql = "UPDATE Customer SET Activity = $new_activity WHERE id_customer = '$id_customer'";
    $conn->query($sql);
}

if (isset($_POST['edit_user'])) {
    $id_customer = mysqli_real_escape_string($conn, $_POST['id_customer']);
    $name_customer = mysqli_real_escape_string($conn, $_POST['name_customer']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);
    $activity = isset($_POST['activity']) ? 1 : 0;

    $sql = "UPDATE Customer 
            SET name_customer = '$name_customer', 
                email = '$email', 
                role_id = '$role_id',
                Activity = $activity
            WHERE id_customer = '$id_customer'";

    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Управление пользователями</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<h1>Список пользователей</h1>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Роль</th>
        <th>Активность</th>
    </tr>

    <?php
    $result = $conn->query("SELECT c.id_customer, c.name_customer, c.email, r.role_name, c.Activity
                            FROM Customer c
                            LEFT JOIN Role r ON c.role_id = r.role_id");

    while ($row = $result->fetch_assoc()):
    ?>
    <tr>
        <td><?= htmlspecialchars($row['id_customer']) ?></td>
        <td><?= htmlspecialchars($row['name_customer']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['role_name'] ?? 'Не определена') ?></td>
        <td>
            <a href="?toggle=<?= $row['id_customer'] ?>">
                <?= $row['Activity'] ? '✅ Активен' : '❌ Неактивен' ?>
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="index.php" class="btn btn-secondary">Назад в админ панель</a>

</body>
</html>