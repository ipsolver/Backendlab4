<?php
header("Content-Type: application/json");
require "../DB/db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["id"], $data["name"], $data["lastname"], $data["login"], $data["password"])) 
{
    echo json_encode(["success" => false, "message" => "Всі поля обов'язкові"]);
    exit;
}

$id = $data["id"];
$name = trim($data["name"]);
$lastname = trim($data["lastname"]);
$login = trim($data["login"]);
$password = $data["password"];

$req = $pdo->prepare("UPDATE users SET Name = ?, Lastname = ?, Login = ?, Password = ? WHERE ID = ?");
$success = $req->execute([$name, $lastname, $login, $password, $id]);

echo json_encode(["success" => $success, "message" => $success ? "Дані оновлено" : "Помилка оновлення"]);
?>
