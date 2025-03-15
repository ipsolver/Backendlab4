<?php
require("../db_connection.php");
session_start();
$this_user=$_SESSION['user'];

$data=$pdo->prepare("SELECT * FROM users WHERE Login=?");
$data->execute([$this_user]);
$user=$data->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <style>
        form {
        display: inline-block;
        text-align: left;
        }
        input {
        display: block;
        margin: 10px;
        padding: 5px;
        width: 250px;
        }
        button {
        padding: 5px 10px;
        }
    </style>
</head>
<body>
<h2>Редагувати</h2>
    <form action="editing.php" method="post" enctype="multipart/form-data">
        <label>Ім'я:</label>
        <input type="text" name="name" value="<?= $user['Name']?>" required>

        <label>Прізвище:</label>
        <input type="text" name="lastname" value="<?= $user['LastName']?>" required>

        <label>Логін:</label>
        <input type="text" name="login" value="<?= $user['Login']?>" required>

        <label>Пароль:</label>
        <input type="text" name="password" value="<?= $user['Password']?>" required>

        <label>Країна:</label>
        <input type="text" name="country" value="<?= $user['Country']?>" required>

        <label>Місто:</label>
        <input type="text" name="city" value="<?= $user['City']?>">

        <label>Дата народження:</label>
        <input type="date" name="birthdate" value="<?= $user['BirthDate']?>">

        <label>Аватар:</label>
        <input type="file" name="photo" id="photo" value="<?= $user['Avatar']?>" accept="image/*">
        <input type="text" name="url" id="url" value="<?= $user['Avatar']?>" readonly>

        <label>Про себе:</label>
        <textarea name="about" rows="4" cols="30" value="<?= $user['About']?>"></textarea>
        <br><br>
        <button type="submit">Зберегти</button>
    </form>

    <p>Видалити профіль? <a href="delete.php">Видалити</a></p>
</body>
</html>