<?php

    declare(strict_types = 1);

    namespace App\model\database;

    use PDO;

    class DbManager
    {
        protected function dbConnect(): PDO
        {
            return new PDO('mysql:host=longrich_db;dbname=longrich;charset=utf8;', 'root', '@Dm1n1Str@t3urDC', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
    }