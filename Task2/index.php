<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR6</title>
</head>
<body>
<?php if (isset($_SESSION['user'])): ?>

    <h2>Вітаємо в системі!</h2>
    <p>Ви увійшли як користувач: <?= $_SESSION['user'] ?></p>
    <p><a href="structure/list.php">Мої нотатки</a></p>
    <p><a href="structure/edit.php">Редагувати профіль</a></p>
    <p><a href="structure/logout.php">Вийти</a></p>


<?php else: ?>

    <h2>Вхід у систему</h2>
    <form id="logining">
    <label for="login">Логін:</label><br>
    <input type="text" id="login" name="login" required><br><br>

    <label for="password">Пароль:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit">Увійти</button>
</form>
<p>Незареєстровані? <a href="structure/register.php">Зареєструватися</a></p>
<?php endif; ?>


<script>
document.querySelector('#logining').addEventListener("submit", async function (event) 
{
    event.preventDefault();

    let login = document.getElementById("login").value.trim();
    let password = document.getElementById("password").value;
    let message = document.getElementById("message");

    let response = await fetch("structure/login.php", 
    {
        method: "POST",
        headers: 
            {
                "Content-Type": "application/json"
            },
                body: JSON.stringify({login, password })
    });

    let result = await response.json();
    if(result.success)
    {
        window.location.href = "index.php";
    }
    message.textContent = result.message;


})
</script>

</body>
</html>