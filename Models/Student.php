<?php
namespace Models;

class Student extends Human
{
    private string $VNZ;
    private int $course;
    private string $group;
    
    
    public function __construct(string $VNZ, int $course, string $group, float $height, float $masa, int $age) 
    {
        parent::__construct($height,$masa, $age);
        $this->SetVNZ($VNZ);
        $this->SetCourse($course);
        $this->SetGroup($group);
    }

    public function getVNZ(): string 
    {
        return $this->VNZ;
    }
    public function getCourse(): int 
    {
        return $this->course;
    }
    public function getGroup(): string 
    {
        return $this->group;
    }

    public function setVNZ($VNZ): void
    {
        $this->VNZ=$VNZ;
    }
    public function setCourse($course): void
    {
        $this->course=$course;
    }
    public function setGroup($group): void
    {
        $this->group=$group;
    }

    public function NewCourse(): void
    {
        $this->course+=1;
    }


    public function BirthDay(): string 
    {
        return "<br>Сподіваюсь стипендії вистачить на нас двох...<br>";
    }

    public function cleanRoom(): string
    {
        return "<br>Студент прибирає кімнату<br>";
    }

    public function cleanKitchen(): string
    {
        return "<br>Студент прибирає кухню<br>";
    }

} 