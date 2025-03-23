<?php
session_start();
header("Content-Type: application/json");
require "../DB/db.php";

if (!isset($_SESSION['user'])) 
{
    echo json_encode(["error" => "Необхідна авторизація"]);
    exit();
}

$getUser = $pdo->prepare("SELECT ID FROM users WHERE Login = ?");
$getUser->execute([$_SESSION['user']]);
$userID = $getUser->fetchColumn();

if (!$userID) 
{
    echo json_encode(["error" => "Користувач не знайдений"]);
    exit();
}

$stmt = $pdo->prepare("SELECT ID, Title, Content, Date FROM notes WHERE UserID = ?");
$stmt->execute([$userID]);
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($notes);
?>
