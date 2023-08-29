<?php

// creating connection to database using Singleton pattern
abstract class Model
{
    private static $pdo;

    private static function setDatabase()
    {
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'spy_agency';

        self::$pdo = new PDO('mysql:host=' . $host . ';port=3307;dbname=' . $dbname . ';charset=utf8', $username, $password);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getDatabase()
    {
        if (self::$pdo === null) {
          self::setDatabase();
        }
        return self::$pdo;
    }
}