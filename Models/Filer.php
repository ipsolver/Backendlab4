<?php
namespace Models;

class Filer
{
    private static string $dir = "text";

    public static function readingFile(string $filename): string 
    {
        $filepath = self::$dir.'/'.$filename;

        if (!file_exists($filepath)) 
        {
            return "Файл $filepath не знайдено!";
        }

        $content = file_get_contents($filepath);
        return $content == "" ? "(файл порожній)" : $content;
    }

    public static function writingFile(string $filename, string $text): void
    {

        $filePath = self::$dir.'/'.$filename;

        file_put_contents($filePath, $text, FILE_APPEND);
    }

    public static function clearFile(string $filename): void
    {
        $filepath = self::$dir.'/'.$filename;

        if (file_exists($filepath)) 
        {
            file_put_contents($filepath, "");
            echo "Файл $filename очищено!\n";
        } 
        else 
        {
            echo "Файл $filepath не знайдено!\n";
        }
    }

}
?>