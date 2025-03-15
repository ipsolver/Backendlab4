<?php
session_start();
require "../db_connection.php";

if (!isset($_SESSION['user'])) 
{
    header("Location: index.php");
    exit();
}

$del=$pdo->prepare("DELETE FROM users WHERE Login = ?");
$del->execute([$_SESSION['user']]);

echo "Профіль успішно видалено!";
echo "<a href='../index.php'>На головну</a>";
session_destroy();

