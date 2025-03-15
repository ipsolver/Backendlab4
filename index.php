<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR5</title>
</head>
<body>
<?php if (isset($_SESSION['user'])): ?>

    <h2>Вітаємо в системі!</h2>
    <p>Ви увійшли як користувач: <?= $_SESSION['user'] ?></p>
    <p><a href="structure/edit.php">Редагувати</a></p>
    <p><a href="structure/logout.php">Вийти</a></p>


<?php else: ?>

    <h2>Вхід у систему</h2>
    <form method="POST" action="structure/login.php">
    <label for="login">Логін:</label><br>
    <input type="text" id="login" name="login" required><br><br>

    <label for="password">Пароль:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit">Увійти</button>
</form>
<p>Незареєстровані? <a href="structure/register.php">Зареєструватися</a></p>
<?php endif; ?>

</body>
</html>