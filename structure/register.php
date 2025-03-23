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
    <form id="register" enctype="multipart/form-data">
        <label>Ім'я:</label>
        <input type="text" name="name" id="name" required>

        <label>Прізвище:</label>
        <input type="text" name="lastname" id="lastname" required>

        <label>Логін:</label>
        <input type="text" name="login" id="login" required>

        <label>Пароль:</label>
        <input type="password" name="password" id="password" required>

        <label>Пароль ще раз:</label>
        <input type="password" name="password2" id="password2" required>

        <button type="submit">Зареєструватися</button>
    </form>

    <p>Вже маєте акаунт? <a href="../index.php">Увійти</a></p>


    <script>
    document.querySelector("#register").addEventListener("submit", async function(event) 
    {
        event.preventDefault();
        let name = document.querySelector("#name").value.trim();
        let lastname = document.querySelector("#lastname").value.trim();
        let login = document.querySelector("#login").value.trim();
        let password = document.querySelector("#password").value;
        let password2 = document.getElementById("password2").value;

        if (!name || !lastname || !login) 
        {
                alert("Не заповнені поля!");
                return;
        }
        if (password !== password2) 
        {
                alert("Введено різні паролі!");
                return;
        }



        let response = await fetch("registration.php", 
        {
            method: "POST",
            headers: 
            {
                "Content-Type": "application/json"
            },
                body: JSON.stringify({ name, lastname, login, password })
        });

        let result = await response.json();

            if (result.success) 
            {
                alert("Реєстрація успішна!");
                window.location.href = "../index.php";
            } 
            else 
            {
                alert(result.message || "Виникла помилка!");
            }


    });
    </script>
</body>
</html>