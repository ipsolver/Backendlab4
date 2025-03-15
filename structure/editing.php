<?php
session_start();
require("../db_connection.php");

if (!isset($_SESSION['user'])) 
{
    header("Location: index.php");
    exit();
}

if($_SERVER['REQUEST_METHOD']=="POST")
{
    $name = trim($_POST['name']);
    $lastname = trim($_POST['lastname']);
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $country = trim($_POST['country']);
    $city = trim($_POST['city']) ? : NULL;
    $birthdate = $_POST['birthdate']? : NULL;
    $about = trim($_POST['about']) ? : NULL;
    $path=$_POST['url']? : NULL;

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

    $loading = $pdo->prepare("UPDATE users SET Login = ?, Password = ?, Name = ?, LastName = ?, Country = ?, City = ?, Avatar = ?, About = ?, BirthDate = ? WHERE Login = ?");
    $loading->execute([$login, $password, $name, $lastname, $country, $city, $path, $about, $birthdate, $_SESSION["user"]]);

    header("Location: ../index.php");
}

