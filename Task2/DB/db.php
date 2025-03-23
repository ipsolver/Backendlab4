<?php

try 
{
$pdo = new PDO('mysql:host=localhost;dbname=notes_db;charset=utf8','root','Plat0ner19051907!');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) 
{
 echo $e->getMessage();
}
