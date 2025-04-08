<?php
require_once 'Response.php';

$response = new Response();
$response->setStatus(200);
$response->addHeader("Content-Type: text/html");

$answer = "<h1>Вітаємо!</h1><p>Це динамічна відповідь</p>";

$response->send($answer);
