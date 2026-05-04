<?php

namespace App\Services;

use PDO;
use PDOException;

class DatabaseManager
{
    private $db = null;

    public function __construct()
    {
        try
        {
            $host = $_ENV['DB_HOST'];
            $dbName = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASSWORD'];
        
            $this->db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Bravo, la connexion est établie !";
        }
        catch (PDOException $e)
        {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }
};