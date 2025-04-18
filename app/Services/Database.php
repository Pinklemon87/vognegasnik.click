<?php

namespace App\Services;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private PDO $pdo;

    /**
     * Connect to database
     */
    private function __construct()
    {
        $conn_data = require_once __DIR__ . '/../../config/database.php';

        try {
            $this->pdo = new PDO(
                "mysql:host={$conn_data['hostname']};dbname={$conn_data['database']}",
                $conn_data['username'],
                $conn_data['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_PERSISTENT => true,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]
            );
        } catch (PDOException $e) {
            die('Помилка підключення до бази даних: ' . $e->getMessage());
        }
    }

    /**
     * Create instance connect to database
     *
     * @return Database
     */
    public static function getInstance(): Database
    {
        return self::$instance ?? self::$instance = new self();
    }

    /**
     * Check connect to database
     *
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->pdo;
    }

    private function __clone()
    {
    }
}
