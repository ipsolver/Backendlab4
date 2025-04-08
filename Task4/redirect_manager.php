<?php
ob_start();

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

$redirects = json_decode(file_get_contents("redirects.json"), true);

if (isset($redirects[$currentPage])) 
{
    $target = $redirects[$currentPage];

    if ($target === "/404") 
    {
        header("Location: /404.php", true, 404);
    } 
    else 
    {
        header("Location: $target", true, 301);
        exit;
    }
}

ob_end_flush();
