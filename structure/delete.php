<?php
session_start();
require "../DB/db.php";

if (!isset($_SESSION['user'])) 
{
    echo json_encode(["success" => false, "message" => "Користувач не авторизований"]);
    exit();
}

$del = $pdo->prepare("DELETE FROM users WHERE Login = ?");
$success = $del->execute([$_SESSION['user']]);

if ($success) 
{
    session_destroy();
    echo json_encode(["success" => true, "message" => "Профіль успішно видалено!"]);
} 
else 
{
    echo json_encode(["success" => false, "message" => "Помилка при видаленні профілю"]);
}
?>
