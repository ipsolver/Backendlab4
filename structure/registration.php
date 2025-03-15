<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require("../db_connection.php");

if (!isset($_SESSION['user'])) 
{
    header("Location: index.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name = trim($_POST['name']);
    $lastname = trim($_POST['lastname']);
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);
    $country = trim($_POST['country']);
    $city = trim($_POST['city']) ? : NULL;
    $birthdate = $_POST['birthdate']? : NULL;
    $about = trim($_POST['about']) ? : NULL;

    if($password!=$password2)
    {
        die("Різні паролі!");
    }

    if(empty($name) || empty($lastname) || empty($login) || empty($password) || empty($password2) || empty($country))
    {
        die("Ви не заповнили всі обовязкові поля!");
    }
        $samelog = $pdo->prepare("SELECT COUNT(*) FROM users WHERE Login = ?");
        $samelog->execute([$login]);

        if ($samelog->fetchColumn() > 0)
        {
            die("Користувач із таким логіном вже існує! <a href='register.php'>Назад</a>");
        }

    if (isset($_FILES["photo"]) && is_uploaded_file($_FILES["photo"]["tmp_name"])) 
    {
        $my_dir = "../pictures/";
        if ($_FILES["photo"]["error"] != 0)
        {
            die("Помилка при завантаженні фото! Код помилки: ".$_FILES["photo"]["error"]);
        }

        $path = $my_dir.$login.rand(1,1000).basename($_FILES['photo']['name']);
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

        if (!in_array($_FILES['photo']['type'], $allowed_types)) 
        {
            die("Непідтримуваний тип файлу!");
        }
        if (!is_uploaded_file($_FILES["photo"]["tmp_name"])) 
        {
            die("Файл не був завантажений");
        }
        move_uploaded_file($_FILES["photo"]["tmp_name"], $path);
    } 
    else 
    {
        die("Фото не було завантажене");
    }
    /////////////////////////////////////
    $loading=$pdo->prepare("INSERT INTO users (Login, Password, Name, LastName, Country, City, Avatar, About, BirthDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $loading->execute([$login, $password, $name, $lastname, $country, $city, $path, $about, $birthdate]);

    echo "Реєстрація успішна!";
    echo "<a href='../index.php'>Вхід</a>";

}

