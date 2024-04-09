<?php

namespace CodersCanine\DatabaseConnector;

use PDO;

class DatabaseConnector
{
    public function connect()
    {
        $db = new PDO('mysql:host=db; dbname=music', 'root', 'password');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}