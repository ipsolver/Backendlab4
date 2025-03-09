<?php
namespace Controllers;

use Models\UserModel;

/**
 * Клас UserController
 *
 * Обробляє функціонування користувачів
 */

class UserController 
{
    protected UserModel $user;

    public function __construct(UserModel $user) 
    {
        echo "<h2>Hello, world! Its controller!</h2";
        $this->user = $user;
    }

    public function getUserName(): string 
    {
        return "Користувач: " . $this->user->getName();
    }
}


?>