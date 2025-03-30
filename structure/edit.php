<?php
session_start();
require "../DB/db.php";

if (!isset($_SESSION['user'])) 
{
    header("Location: ../index.php");
    exit();
}

if (!isset($_GET['id'])) 
{
    die("Немає ID");
}

$id = $_GET['id'];
$req = $pdo->prepare("SELECT Name, Lastname, Login, Password FROM users WHERE ID = ?");
$req->execute([$id]);
$user = $req->fetch(PDO::FETCH_ASSOC);

if (!$user) 
{
    die("Користувач не знайдений!");
}

if ($_SESSION['user'] !== $user['Login']) 
{
    die("Ви не можете редагувати цей профіль!");
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагування користувача</title>
</head>
<body>
<h2>Редагування користувача</h2>
<form id="editing">
    <input type="hidden" id="idin" name="id" value="<?=$id?>">
    
    <label>Ім'я:</label>
    <input type="text" id="name" name="name" value="<?=$user['Name']?>" required><br>
    
    <label>Прізвище:</label>
    <input type="text" id="lastname" name="lastname" value="<?=$user['Lastname']?>" required><br>
    
    <label>Логін:</label>
    <input type="text" id="login" name="login" value="<?=$user['Login']?>" required><br>

    <label>Пароль:</label>
    <input type="text" id="password" name="password" value="<?=$user['Password']?>" required><br>

    <button type="submit">Зберегти зміни</button>
</form>

<script>
document.querySelector('#editing').addEventListener("submit", async (event) => 
{
    event.preventDefault();

    let name = document.querySelector('#name').value.trim();
    let lastname = document.querySelector("#lastname").value.trim();
    let id = document.querySelector("#idin").value;
    let login = document.querySelector("#login").value.trim();
    let password = document.querySelector("#password").value;

        if (!name || !lastname || !login || !password) 
        {
            alert("Не заповнені поля!");
            return;
        }
    

    let response = await fetch("update.php", 
    {
        method: "POST",
        headers: 
        {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ name, lastname, login, password, id })
        });

        let result = await response.json();

        if (result.success) 
        {
            window.location.href = "list.php";
        }
        else 
        {
          alert(result.message || "Виникла помилка!");
        }



})
</script>
</body>
</html>
