<?php

namespace App\Services;

use Exception;
use PDO;
use PDOException;

class DatabaseManager
{
    private static $db = null;

    public function __construct()
    {
        try
        {
            $host = $_ENV['DB_HOST'];
            $dbName = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASSWORD'];
        
            self::$db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $password);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Bravo, la connexion est établie !";
        }
        catch (PDOException $e)
        {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }

    public static function findAll($table)
    {
        $query = self::$db->prepare("SELECT * FROM $table");
        $query->execute();
        $datas = $query->fetchAll();

        return $datas;
    }

    public static function find($table, $id)
    {
        $query = self::$db->prepare("SELECT * FROM $table WHERE id = :id");
        $query->execute(["id" => $id]);
        $datas = $query->fetch();

        return $datas;
    }

    public static function findByName($table, $name)
    {
        $query = self::$db->prepare("SELECT * FROM $table WHERE username = :name");
        $query->execute(["name" => $name]);
        $datas = $query->fetch();

        return $datas;
    }

    public static function add(string $table, array $item)
    {
        //$request = "INSERT INTO $table (name) VALUES (";
        $request = "INSERT INTO $table (";
        $keys = array_keys($item);

        for($i = 0 ; $i < count($keys) ; $i++)
        {
            $request .= $keys[$i];

            if($i < count($keys) - 1)
            {
                $request .= ", ";
            }
        }

        $request .= ") VALUES (";

        $values = array_values($item);

        $params = [];

        for($i = 0 ; $i < count($item) ; $i++)
        {
            $value = sprintf(":value%d", $i + 1);
            $request .= $value;

            $key = sprintf("value%d", $i + 1);

            if($i < count($item) - 1)
            {
                $request .= ", ";
            }

            else
            {
                $request .= ")";
            }

            $params[$key] = $values[$i];
        }

        try
        {
            $query = self::$db->prepare($request);
            $query->execute($params);
        }

        catch(Exception $e)
        {
            echo $e->getMessage();
            exit();
        }
    }
};