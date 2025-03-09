<?php
namespace Models;
use Models\IClean;
// interface IClean 
// {
//     public function cleanRoom(): string;
//     public function cleanKitchen(): string;

// }


abstract class Human implements IClean
{
protected float $height;
protected float $masa;
protected int $age; 


public function __construct(float $height, float $masa, int $age) 
    {
        $this->setAge($age);
        $this->setMasa($masa);
        $this->setHeight($height);
    }

    public function getAge(): int 
    {
        return $this->age;
    }
    public function getMasa(): float 
    {
        return $this->masa;
    }
    public function getHeight(): float 
    {
        return $this->height;
    }

    public function setAge($age): void 
    {
        $this->age = $age;
    }
    public function setMasa($masa): void
    {
        $this->masa = $masa;
    }
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    public function Birth(): void 
    {
        echo $this->BirthDay();
    }
    protected abstract function BirthDay(): string;

}
