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


$req = $pdo->prepare("SELECT ID FROM users WHERE Login = ?");
$req->execute([$login]);

if ($req->fetch()) 
{
    echo json_encode(["success" => false, "message" => "Такий логін вже існує"]);
    exit;
}

$req = $pdo->prepare("INSERT INTO users (Name, Lastname, Login, Password) VALUES (?, ?, ?, ?)");
$success = $req->execute([$name, $lastname, $login, $password]);

if ($success) 
{
    echo json_encode(["success" => true, "message" => "Реєстрація успішна"]);
}
else 
{
    echo json_encode(["success" => false, "message" => "Виникла помилка"]);
}
?>
