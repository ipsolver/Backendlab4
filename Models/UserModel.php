<?php
namespace Models;


/**
 * Клас UserModel
 *
 * Ініціалізовує користувача, повертає його ім'я
 */

class UserModel 
{
    protected string $name;
    protected bool $isAdmin;

    public function __construct($name = "User")
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}



?>