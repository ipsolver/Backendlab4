<?php
require("../db_connection.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $kol = $_POST['kol'];
    $date = $_POST['date'];

    $sql = "INSERT INTO tov (Name, Cost, Kol, Date) VALUES (?, ?, ?, ?)";
    $answer = $pdo->prepare($sql);

    if ($answer->execute([$name, $cost, $kol, $date])) 
    {
        echo "Запис успішно додано!";
    } 
    else 
    {
        echo "Не вдалося додати запис";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR5</title>
</head>
<body>
    <h2>Додати новий запис</h2>
    <form action="insert.php" method="POST">
        <label for="name">Назва:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="cost">Ціна:</label><br>
        <input type="number" id="cost" name="cost" required><br><br>

        <label for="kol">Кількість:</label><br>
        <input type="number" id="kol" name="kol" required><br><br>

        <label for="date">Дата:</label><br>
        <input type="date" id="date" name="date" required><br><br>

        <input type="submit" value="Додати запис">
    </form>
    <a href="index.php"><button>Назад</button></a>
</body>
</html>