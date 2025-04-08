<?php
require "DB.php";

$ip = $_SERVER['REMOTE_ADDR'];
$timer = date('Y-m-d H:i:s');
$page = basename($_SERVER['REQUEST_URI']);
$url=$_SERVER['REQUEST_URI'];

ob_start();

if (file_exists($page)) 
{
    include $page;
    http_response_code(200);
} 
else 
{
    http_response_code(404);
    echo "404 Error!";
}


$status = http_response_code();
$req = $pdo->prepare("INSERT INTO logs (IP, Timer, URL, Status) VALUES (?, ?, ?, ?)");
$req->execute([$ip, $timer, $url, $status]);
ob_end_flush();