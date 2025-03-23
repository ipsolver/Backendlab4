<?php
session_start();
header("Content-Type: application/json");
require "../DB/db.php";

if (!isset($_GET['id']) || !isset($_SESSION['user'])) 
{
    echo json_encode(["error" => "Необхідна авторизація або відсутній ID"]);
    exit();
}

$noteID = $_GET['id'];

$stmt = $pdo->prepare("SELECT Title, Content FROM notes WHERE ID = ?");
$stmt->execute([$noteID]);
$note = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$note) 
{
    echo json_encode(["error" => "Нотатку не знайдено"]);
    exit();
}

echo json_encode($note);
?>
