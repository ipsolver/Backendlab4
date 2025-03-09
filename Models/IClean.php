<?php
namespace Models;


interface IClean 
{
    public function cleanRoom(): string;
    public function cleanKitchen(): string;

}