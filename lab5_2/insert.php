<?php
require("db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $sql = "INSERT INTO employees (Name, Position, Salary) VALUES (?, ?, ?)";
    $answer = $pdo->prepare($sql);

    if ($answer->execute([$name, $position, $salary])) 
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
        <label for="name">Імя:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="cost">Посада:</label><br>
        <input type="text" id="position" name="position" required><br><br>

        <label for="kol">Зарплата:</label><br>
        <input type="number" id="salary" name="salary" required><br><br>

        <input type="submit" value="Додати запис">
    </form>
    <a href="index.php"><button>Назад</button></a>
</body>
</html>