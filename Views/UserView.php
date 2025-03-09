<?php
namespace Views;

/**
 * Клас UserView
 *
 * Відображає інформацію про користувачів
 */

class UserView 
{
    public function Index(string $login) 
    {
        echo "<h1>Hello $login</h1>";
    }
}
