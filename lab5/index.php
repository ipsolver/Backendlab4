<?php
require("../db_connection.php");

$sql="SELECT * FROM tov";
$result = $pdo->prepare($sql);
$result->execute();
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
                <th>Cost</th>
                <th>Kol</th>
                <th>Date</th>
            </tr>
        <tbody>
        <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
            {
                echo "<tr>";
                echo "<td>" .$row['ID']. "</td>";
                echo "<td>" .$row['Name']. "</td>";
                echo "<td>" .$row['Cost']. "</td>";
                echo "<td>" .$row['Kol']. "</td>";
                echo "<td>" .$row['Date']. "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
</table><br>
<a href="insert.php"><button>Додати запис</button></a>
<br><br>
<form action="delete.php" method="POST">
<button type="submit">Вилучити запис</button>
<input type="number" id="record" name="record" required>
</form>
</body>
</html>