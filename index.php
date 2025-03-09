<?php
require 'autoload.php';
use Models\UserModel;
use Controllers\UserController;
use Views\UserView;
use Models\Circle;
use Models\Filer;
use Models\Human;
use Models\Student;
use Models\Programmer;

$userModel = new UserModel("Vadim");
$userController = new UserController($userModel);
$userView = new UserView();
$userView->Index($userController->getUserName());

$filename = 'file1.txt';

echo "Початковий вміст файлу:\n";
echo Filer::readingFile($filename) . "<br>";

Filer::writingFile($filename, "Як справи?");
echo "Вміст файлу після запису:<br>";
echo Filer::readingFile($filename) . "<br>";

echo "Очищуємо файл<br>";
Filer::clearFile($filename);
echo "Вміст файлу після очищення:<br>";
echo Filer::readingFile($filename) . "<br>";


$circle = new Circle(12, 15, 5);
$circle2=new Circle(20, 5,  10);
echo $circle."<br>";
echo $circle2."<br>";
if ($circle->intersects($circle2)) 
{
    echo "Кола перетинаються<br>";
}
 else 
{
    echo "Кола не перетинаються<br>";
}

$student = new Student("politeh", 2, "IPZk241", 180, 70, 21);
echo "Створення обєкту Студент. ВНЗ: ".$student->getVNZ().", курс: ".$student->getCourse()." , група: ".$student->getGroup().";";
echo "<br>Вік студента: ".$student->getAge();
echo "<br>Маса студента: ".$student->getMasa();
echo "<br>Зріст студента: ".$student->getHeight();

echo $student->BirthDay();
echo $student->cleanRoom();

$languages=["Cpp", "Python"];
$programer=new Programmer(195, 85, 25, $languages, 3);
echo "<br>Створення обєкту Програміст<br>";

echo "<br>Вік програміста: ".$programer->getAge();
echo "<br>Маса програміста: ".$programer->getMasa();
echo "<br>Зріст програміста: ".$programer->getHeight();

echo $programer->BirthDay();
echo $programer->cleanRoom();
echo $programer->cleanKitchen();
?>