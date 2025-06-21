<?php
require("./../method/connectdb.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_game'])) {
    $id_company = mysqli_real_escape_string($conn, $_POST['id_company']);
    $id_category = mysqli_real_escape_string($conn, $_POST['id_category']);
    $id_platform = mysqli_real_escape_string($conn, $_POST['id_platform']);
    $game_name = mysqli_real_escape_string($conn, $_POST['game_name']);
    $game_description = mysqli_real_escape_string($conn, $_POST['game_description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
        $image = mysqli_real_escape_string($conn, $image);
    } else {
        $image = null;
    }

    $game_name = mysqli_real_escape_string($conn, $game_name);
    $game_description = mysqli_real_escape_string($conn, $game_description);

    $sql = "INSERT INTO Game (
                id_company, 
                id_category, 
                id_platform, 
                game_name, 
                game_description, 
                price,
                image
            ) VALUES (
                '$id_company', 
                '$id_category', 
                '$id_platform', 
                '$game_name', 
                '$game_description', 
                '$price',
                '$image'
            )";

    $conn->query($sql);
}

// Редактирование игры
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_game'])) {
    $id_game = mysqli_real_escape_string($conn, $_POST['id_game']);
    $id_company = mysqli_real_escape_string($conn, $_POST['id_company']);
    $id_category = mysqli_real_escape_string($conn, $_POST['id_category']);
    $id_platform = mysqli_real_escape_string($conn, $_POST['id_platform']);
    $game_name = mysqli_real_escape_string($conn, $_POST['game_name']);
    $game_description = mysqli_real_escape_string($conn, $_POST['game_description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
        $image = mysqli_real_escape_string($conn, $image);
        $sql = "UPDATE Game SET 
                    id_company='$id_company', 
                    id_category='$id_category', 
                    id_platform='$id_platform', 
                    game_name='$game_name', 
                    game_description='$game_description', 
                    price='$price', 
                    image='$image'
                WHERE id_game='$id_game'";
    } else {
        $sql = "UPDATE Game SET 
                    id_company='$id_company', 
                    id_category='$id_category', 
                    id_platform='$id_platform', 
                    game_name='$game_name', 
                    game_description='$game_description', 
                    price='$price'
                WHERE id_game='$id_game'";
    }

    $conn->query($sql);
}

if (isset($_GET['delete'])) {
    $id_game = $_GET['delete'];
    $sql = "DELETE FROM Game WHERE id_game='$id_game'";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Управление играми</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <h1>Список игр</h1>
    <div class="verticaldiv">
        <a href="index.php">Вернутся на админ</a>
        <a href="#" onclick="document.getElementById('addGameForm').style.display='block'; return false;">Добавить
            игру</a>
    </div>

    <div id="addGameForm" style="display:none; margin-top:20px;">
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="add_game" value="1">
            ID компании: <input type="number" name="id_company" required><br>
            ID категории: <input type="number" name="id_category" required><br>
            ID платформы: <input type="number" name="id_platform" required><br>
            Название игры: <input type="text" name="game_name" required><br>
            Описание: <textarea name="game_description" required></textarea><br>
            Цена: <input type="number" step="0.01" name="price" required><br>
            Изображение: <input type="file" name="image"><br>
            <button type="submit">Добавить</button>
        </form>
    </div>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Рейтинг</th>
            <th>Действия</th>
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM Game");
        while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?= htmlspecialchars($row['id_game']) ?></td>
                <td><?= htmlspecialchars($row['game_name']) ?></td>
                <td><?= htmlspecialchars($row['game_description']) ?></td>
                <td><?= htmlspecialchars($row['price']) ?></td>
                <td><?= htmlspecialchars($row['rating']) ?></td>
                <td>
                    <a href="?edit=<?= $row['id_game'] ?>">Редактировать</a> |
                    <a href="?delete=<?= $row['id_game'] ?>" onclick="return confirm('Уверены?')">Удалить</a>
                </td>
            </tr>

            <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['id_game']): ?>
                <tr>
                    <td colspan="6">
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_game" value="<?= $row['id_game'] ?>">
                            ID компании: <input type="number" name="id_company" value="<?= $row['id_company'] ?>"><br>
                            ID категории: <input type="number" name="id_category" value="<?= $row['id_category'] ?>"><br>
                            ID платформы: <input type="number" name="id_platform" value="<?= $row['id_platform'] ?>"><br>
                            Название игры: <input type="text" name="game_name" value="<?= $row['game_name'] ?>"><br>
                            Описание: <textarea name="game_description"><?= $row['game_description'] ?></textarea><br>
                            Цена: <input type="number" step="0.01" name="price" value="<?= $row['price'] ?>"><br>
                            Изображение: <input type="file" name="image"><br>
                            <button type="submit" name="edit_game">Сохранить</button>
                        </form>
                    </td>
                </tr>
            <?php endif ?>

        <?php endwhile; ?>
    </table>

</body>

</html>