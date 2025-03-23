<?php
header("Content-Type: application/json");
require "../DB/db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id']) || !isset($data['title']) || !isset($data['content'])) 
{
    echo json_encode(["success" => false, "message" => "Некоректні дані"]);
    exit();
}

$id = $data['id'];
$title = $data['title'];
$content = $data['content'];

$upd = $pdo->prepare("UPDATE notes SET Title = ?, Content = ? WHERE ID = ?");
$success = $upd->execute([$title, $content, $id]);

if ($success) {
    echo json_encode(["success" => true, "message" => "Нотатку оновлено!"]);
} else {
    echo json_encode(["success" => false, "message" => "Помилка оновлення"]);
}
?>
