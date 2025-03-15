<?php
require("db.php");
$name = "";
$position = "";
$salary = "";
if (isset($_GET['record'])) 
{
    $record_id = $_GET['record'];

    $check_sql = "SELECT * FROM employees WHERE ID = ?";
    $check = $pdo->prepare($check_sql);
    $check->execute([$record_id]);

    if ($row = $check->fetch(PDO::FETCH_ASSOC)) 
    {
        $name = $row['Name'];
        $position = $row['Position'];
        $salary = $row['Salary'];
    } 
    else 
    {
        echo "Такого запису не існує!";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $name = $_POST['name'];
        $position = $_POST['position'];
        $salary = $_POST['salary'];

        $sql = "UPDATE employees SET Name = ?, Position = ?, Salary = ? WHERE ID = ?";
        $answer = $pdo->prepare($sql);

        if ($answer->execute([$name, $position, $salary, $record_id])) 
        {
            echo "Запис успішно оновлено!";
        } 
        else 
        {
            echo "Не вдалося оновити запис!";
        }
    }
} 
else
{
    exit;
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
<h2>Редагувати запис</h2>

<form action="edit.php?record=<?= $record_id?>" method="POST">
<label for="name">Ім'я:</label><br>
        <input type="text" id="name" name="name" value="<?=$name?>" required><br><br>
        <label for="position">Посада:</label><br>
        <input type="text" id="position" name="position" value="<?=$position?>" required><br><br>
        <label for="salary">Заробітна плата:</label><br>
        <input type="number" id="salary" name="salary" value="<?=$salary?>" required><br><br>
        <button type="submit">Оновити запис</button>
</form>
<br><br>
    <a href="index.php"><button>Назад</button></a>

</body>
</html>
