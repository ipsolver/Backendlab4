<?php
session_start();
header("Content-Type: application/json");
require "../DB/db.php";

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['id']) || !isset($_SESSION['user']))
{
    echo json_encode(["error" => "Необхідна авторизація або відсутній ID"]);
    exit();
}

$noteID = $data['id'];

$req = $pdo->prepare("SELECT ID FROM notes WHERE ID = ?");
$req->execute([$noteID]);
$note = $req->fetch(PDO::FETCH_ASSOC);

if (!$note) 
{
    echo json_encode(["error" => "Нотатку не знайдено"]);
    exit();
}

$deleteStmt = $pdo->prepare("DELETE FROM notes WHERE ID = ?");
$success = $deleteStmt->execute([$noteID]);

if ($success) 
{
    echo json_encode(["success" => true, "message" => "Нотатку видалено"]);
} 
else 
{
    echo json_encode(["success" => false, "message" => "Помилка видалення"]);
}
?>
