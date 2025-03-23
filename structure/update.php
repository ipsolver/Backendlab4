<?php
header("Content-Type: application/json");
require "../DB/db.php";

if (!isset($_POST["id"], $_POST["name"], $_POST["lastname"])) 
{
    echo json_encode(["success" => false, "message" => "Всі поля обов'язкові"]);
    exit;
}

$id = $_POST["id"];
$name = trim($_POST["name"]);
$lastname = trim($_POST["lastname"]);

$stmt = $pdo->prepare("UPDATE users SET Name = ?, Lastname = ? WHERE ID = ?");
$success = $stmt->execute([$name, $lastname, $id]);

echo json_encode(["success" => $success, "message" => $success ? "Дані оновлено" : "Помилка оновлення"]);
header("Location: list.php");
?>
