<?php
session_start();
require "../DB/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE Login = ?");
$stmt->execute([$_SESSION['user']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) 
{
    die("Користувач не знайдений!");
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
    <input type="hidden" name="id" value="<?= $user['ID'] ?>">
    
    <label>Ім'я:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($user['Name']) ?>" required><br>
    
    <label>Прізвище:</label>
    <input type="text" name="lastname" value="<?= htmlspecialchars($user['Lastname']) ?>" required><br>

    <button type="submit">Зберегти зміни</button>
</form>
</body>
</html>
