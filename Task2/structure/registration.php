<?php
header("Content-Type: application/json");
require "../DB/db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["name"], $data["lastname"], $data["login"], $data["password"])) 
{
    echo json_encode(["success" => false, "message" => "Заповніть всі поля"]);
    exit;
}

$name = trim($data["name"]);
$lastname = trim($data["lastname"]);
$login = trim($data["login"]);
$password = $data["password"];


$stmt = $pdo->prepare("SELECT ID FROM users WHERE Login = ?");
$stmt->execute([$login]);

if ($stmt->fetch()) 
{
    echo json_encode(["success" => false, "message" => "Такий логін вже існує"]);
    exit;
}

$stmt = $pdo->prepare("INSERT INTO users (Name, Lastname, Login, Password) VALUES (?, ?, ?, ?)");
$success = $stmt->execute([$name, $lastname, $login, $password]);

if ($success) 
{
    echo json_encode(["success" => true, "message" => "Реєстрація успішна"]);
}
else 
{
    echo json_encode(["success" => false, "message" => "Виникла помилка"]);
}
?>
