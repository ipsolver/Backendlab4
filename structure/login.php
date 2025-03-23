<?php
session_start();
require "../DB/db.php";

if (isset($_SESSION['user'])) 
{
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $login=trim($_POST['login']);
    $password = trim($_POST['password']);

    $auth = $pdo->prepare("SELECT * FROM users WHERE (Login = :login and Password= :password)");
    $auth->execute(['login' => $login, 'password' => $password]);
    $user = $auth->fetch(PDO::FETCH_ASSOC);

    if ($user) 
    {
        $_SESSION['user'] = $user['Login'];
        header("Location: ../index.php");
        exit();
    } 
    else 
    {
         header("Location: ../index.php");
    }
}