<?php
$cache_file = 'cache.html';
$page = 'page.php';

if (file_exists($cache_file) && file_exists($page)) 
{
    echo file_get_contents($cache_file);
    exit;
}

if (!file_exists($page)) 
{
    if (file_exists($cache_file)) 
    {
        unlink($cache_file);
    }
    echo"<h2>404 Not Found</h2>";
    echo "Сторінка не знайдена!";
    exit;
}

ob_start();

include($page);

$page_content = ob_get_contents();

ob_end_clean();

file_put_contents($cache_file, $page_content);

?>
