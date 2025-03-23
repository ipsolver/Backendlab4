<?php
require "../DB/db.php";

if (!isset($_POST["id"], $_POST["name"], $_POST["lastname"])) 
{
    die("Всі поля обов'язкові");
}

$id = $_POST["id"];
$name = trim($_POST["name"]);
$lastname = trim($_POST["lastname"]);

$stmt = $pdo->prepare("UPDATE users SET Name = ?, Lastname = ? WHERE ID = ?");
$success = $stmt->execute([$name, $lastname, $id]);

if ($success) {
    header("Location: ../index.php");
    exit();
} else {
    echo "Помилка оновлення!";
}
