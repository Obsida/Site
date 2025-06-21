<?php
require "./../method/connectdb.php";

if (isset($_GET['toggle'])) {
    $id_customer = $_GET['toggle'];

    $stmt = $conn->prepare("SELECT Activity FROM Customer WHERE id_customer = ?");
    $stmt->bind_param("i", $id_customer);
    $stmt->execute();
    $stmt->bind_result($currentStatus);
    $stmt->fetch();
    $stmt->close(); 

    $newStatus = ($currentStatus == 1) ? 0 : 1;

    $stmt = $conn->prepare("UPDATE Customer SET Activity = ? WHERE id_customer = ?");
    $stmt->bind_param("ii", $newStatus, $id_customer);
    $stmt->execute();
    $stmt->close(); 
}

// Обработка удаления
if (isset($_GET['delete'])) {
    $id_customer = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM Customer WHERE id_customer = ?");
    $stmt->bind_param("i", $id_customer);
    $stmt->execute();
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
        <th>Действия</th>
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
        <td>
            <a href="?delete=<?= $row['id_customer'] ?>" onclick="return confirm('Вы уверены?')">Удалить</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="index.php" class="btn btn-secondary">Назад в админ панель</a>

</body>
</html>