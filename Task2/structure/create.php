<?php
header("Content-Type: application/json");
session_start();
require "../DB/db.php";

if (!isset($_SESSION['user'])) 
{
    echo json_encode(["success" => false, "message" => "Користувач не авторизований"]);
    exit();
}

$req = $pdo->prepare("SELECT ID FROM users WHERE Login = ?");
$req->execute([$_SESSION['user']]);
$userID = $req->fetchColumn();

if (!$userID) 
{
    echo json_encode(["success" => false, "message" => "Користувача не знайдено"]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);
$title = trim($data["title"] ?? "");
$content = trim($data["content"] ?? "");

if (empty($title) || empty($content)) 
{
    echo json_encode(["success" => false, "message" => "Всі поля обов’язкові"]);
    exit();
}

$add = $pdo->prepare("INSERT INTO notes (Title, Content, UserID, Date) VALUES (?, ?, ?, NOW())");
$success = $add->execute([$title, $content, $userID]);

echo json_encode(["success" => $success, "message" => $success ? "Нотатку створено" : "Помилка створення"]);
?>
