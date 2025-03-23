<?php
header("Content-Type: application/json");
require "../DB/db.php";

$req = $pdo->query("SELECT ID, Name, Lastname, Login FROM users");
$users = $req->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($users);
?>
