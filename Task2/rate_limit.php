<?php

$logger="requests.log";
$timer = 60;
$ip=$_SERVER['REMOTE_ADDR'];

$now = time();
$requests = [];

$max_lasttime=$now-$timer;


    if (file_exists($logger)) 
    {
        $lines = file($logger, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line)
        {
            $parts = explode(' ', $line);
            if(count($parts)==2)
            {
            $log_ip = $parts[0];
            $log_time = $parts[1];
            }
            $log_time = (int)$log_time;

            if($now - $log_time < $timer)
            {
                $requests[] = [$log_ip, $log_time];
            }
        }
    }


    $request_count = 0;
    foreach ($requests as $req) 
    {
        if ($req[0] === $ip)
        {
            $request_count++;
        }
    }
    
    if ($request_count >= 5)
    {
        http_response_code(429);
        echo "<h2>429 Too Many Requests</h2>";
        echo "Занадто багато запитів!";
        exit;
    }
    $requests[] = [$ip, $now];

    $log_lines = [];
    foreach ($requests as $req) 
    {
        $log_lines[] = $req[0] . ' ' . $req[1];
    }
    file_put_contents($logger, implode("\n", $log_lines)."\n");

ob_start();
echo "200 OK\n";
echo "<h1>Вітаю на головній сторінці!</h1>";
$content = ob_get_clean();

http_response_code(200);

echo $content;