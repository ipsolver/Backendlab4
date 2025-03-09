<?php
namespace Models;

class Programmer extends Human
{
    private array $languages;
    private int $exp;

    public function __construct(float $height, float $masa, int $age, array $languages, int $exp)
    {
        parent::__construct($height,$masa, $age);
        $this->SetLang($languages);
        $this->SetExp($exp);
    }
    public function getLang(): array 
    {
        return $this->languages;
    }
    public function getExp(): int
    {
        return $this->exp;
    }

    public function setLang(array $languages): void
    {
        $this->languages = $languages;
    }
    public function setExp(int $exp): void
    {
        $this->exp=$exp;
    }

    public function addLang(string $language): void 
    {
        if (!in_array($language, $this->languages)) 
        {
            $this->languages[] = $language;
        }
    } 

    public function BirthDay(): string 
    {
        return "<br>Назву малого Пайтон<br>";
    }

    public function cleanRoom(): string
    {
        return "<br>Програміст прибирає кімнату<br>";
    }

    public function cleanKitchen(): string
    {
        return "<br>Програміст прибирає кухню<br>";
    }
}