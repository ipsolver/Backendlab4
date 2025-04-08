<?php
require "DB.php";

$since = date("Y-m-d H:i:s", strtotime("-1 day"));

$total = $pdo->query("SELECT COUNT(*) FROM logs WHERE Timer >= '$since'")->fetchColumn();
$errors404 = $pdo->query("SELECT COUNT(*) FROM logs WHERE Timer >= '$since' AND Status = 404")->fetchColumn();


if($total>0)
{
    $percent = round(($errors404 / $total) * 100, 2);
}
else
{
    $percent = 0;
}

echo "<h2>Статистика за останню добу:</h2>";
echo "<p>Всього запитів: $total</p>";
echo "<p>404 помилок: $errors404 ($percent%)</p>";

if ($percent > 10) 
{
    echo "<p style='color:red'>Увага! Високий відсоток 404: $percent%</p>";
}
