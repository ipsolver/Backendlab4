<?php
require("db.php");

$sql="SELECT * FROM employees";
$result = $pdo->prepare($sql);
$result->execute();



$avg_salary_sql = "SELECT AVG(Salary) AS avg_salary FROM employees";
$avg_salary = $pdo->prepare($avg_salary_sql);
$avg_salary->execute();
$avg_res = $avg_salary->fetch(PDO::FETCH_ASSOC)['avg_salary'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR5</title>
    <style>
        table{
            width: 500px;
            height: 400px;
        }
    </style>
</head>
<body>
<table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Salary</th>
            </tr>
        <tbody>
        <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
            {
                echo "<tr>";
                echo "<td>" .$row['ID']. "</td>";
                echo "<td>" .$row['Name']. "</td>";
                echo "<td>" .$row['Position']. "</td>";
                echo "<td>" .$row['Salary']. "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
</table>
<p>Середня заробітна плата: <?=round($avg_res,2) ?> грн</p>
<br>
<a href="insert.php"><button>Додати запис</button></a>
<br><br>
<form action="edit.php" method="GET">
<button type="submit">Редагувати запис</button>
<input type="number" id="record" name="record" required>
</form>
<br><br>
<form action="delete.php" method="POST">
<button type="submit">Вилучити запис</button>
<input type="number" id="record" name="record" required>
</form>
</body>
</html>