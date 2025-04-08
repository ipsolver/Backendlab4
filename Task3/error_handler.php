<?php

ob_start();

register_shutdown_function('Erroring');

function Erroring()
{
    $error = error_get_last();
    if($error !== null && $error['type'] === E_ERROR)
    {
        ob_clean();
        http_response_code(500);
        echo "<h1>500 Internal Server Error</h1>";
        echo "<p>Вибачте, сталася фатальна помилка!</p>";
        echo "<p>Ми працюємо над вирішенням. Спробуйте пізніше!</p>";
    }
    else 
    {
        http_response_code(200);
        $content = ob_get_contents();
        ob_end_clean();
        echo $content; 
    }
}