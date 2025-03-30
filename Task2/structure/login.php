<?php
session_start();
require "../DB/db.php";

header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["login"], $data["password"])) 
{
    echo json_encode(["success" => false, "message" => "Заповніть всі поля"]);
    exit;
}
$login = trim($data["login"]);
$password = $data["password"];


    $auth = $pdo->prepare("SELECT * FROM users WHERE Login = :login AND Password = :password");
    $auth->execute(['login' => $login, 'password' => $password]);
    $user = $auth->fetch(PDO::FETCH_ASSOC);

    if ($user) 
    {
        $_SESSION['user'] = $user['Login'];
        echo json_encode(["success" => true, "message" => "Успішний вхід!"]);
    } 
    else 
    {
        echo json_encode(["success" => false, "message" => "Невірний логін або пароль"]);
    }
?>
