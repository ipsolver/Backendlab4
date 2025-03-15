<?php
require("../db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $record_id = $_POST['record'];

    $check_sql = "SELECT COUNT(*) FROM tov WHERE ID = ?";
    $check = $pdo->prepare($check_sql);
    $check->execute([$record_id]);

    if ($check->fetchColumn() > 0) 
    {
        $sql = "DELETE FROM tov WHERE ID = ?";
        $del = $pdo->prepare($sql);

        if ($del->execute([$record_id])) 
        {
            echo "Запис успішно видалено!";
        } 
        else 
        {
            echo "Не вдалося видалити запис!";
        }
    } 
    else 
    {
        echo "Такого запису не існує!";
    }

    echo "<br><br><a href='index.php'><button>Назад</button></a>";
}
?>
