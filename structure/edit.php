<?php
session_start();
require "../DB/db.php";

if (!isset($_SESSION['user'])) 
{
    header("Location: ../index.php");
    exit();
}

if (!isset($_GET['id'])) 
{
    die("Немає ID");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT Name, Lastname, Login FROM users WHERE ID = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Користувач не знайдений!");
}

if ($_SESSION['user'] !== $user['Login']) 
{
    die("Ви не можете редагувати цей профіль!");
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагування користувача</title>
</head>
<body>
<h2>Редагування користувача</h2>
<form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?=$id?>">
    
    <label>Ім'я:</label>
    <input type="text" name="name" value="<?=$user['Name']?>" required><br>
    
    <label>Прізвище:</label>
    <input type="text" name="lastname" value="<?=$user['Lastname']?>" required><br>
    
    <button type="submit">Зберегти зміни</button>
</form>
</body>
</html>
