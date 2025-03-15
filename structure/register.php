<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        form {
        display: inline-block;
        text-align: left;
        }
        input {
        display: block;
        margin: 10px;
        padding: 5px;
        width: 250px;
        }
        button {
        padding: 5px 10px;
        }
    </style>
</head>
<body>
<h2>Реєстрація</h2>
    <form action="registration.php" method="post" enctype="multipart/form-data">
        <label>Ім'я:</label>
        <input type="text" name="name" required>

        <label>Прізвище:</label>
        <input type="text" name="lastname" required>

        <label>Логін:</label>
        <input type="text" name="login" required>

        <label>Пароль:</label>
        <input type="password" name="password" required>

        <label>Пароль ще раз:</label>
        <input type="password" name="password2" required>

        <label>Країна:</label>
        <input type="text" name="country" required>

        <label>Місто:</label>
        <input type="text" name="city">

        <label>Дата народження:</label>
        <input type="date" name="birthdate">

        <label>Аватар:</label>
        <input type="file" name="photo" id="photo" accept="image/*">

        <label>Про себе:</label>
        <textarea name="about" rows="4" cols="30"></textarea>

        <button type="submit">Зареєструватися</button>
    </form>

    <p>Вже маєте акаунт? <a href="../index.php">Увійти</a></p>
</body>
</html>