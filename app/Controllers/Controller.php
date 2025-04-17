<?php

namespace App\Controllers;

use App\Services\Database;
use PDO;

class Controller
{
    protected PDO $conn;
    public function __construct() {
        session_start();
        $this->conn = Database::getInstance()->getConnection();
    }

}