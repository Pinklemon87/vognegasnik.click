<?php

namespace App\Services;

use Exception;
use PDO;

class Auth
{
    private PDO $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        session_start();
    }

    public function register($name, $email, $password): string
    {
        if ($this->userExists($email)) {
            return "Користувач з таким email вже існує.";
        }

        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("INSERT INTO vognegasnik.users (name, email, password, status) 
            VALUES (:name, :email, :password, :status)");
            $stmt->execute([
                "name" => $name,
                "email" => $email,
                "password" => $hash,
                "status" => 0
            ]);
            return "success";
        } catch (Exception $e) {
            return "Помилка реєстрації: " . $e->getMessage();
        }
    }

    public function login($email, $password): string
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, name, password, status FROM vognegasnik.users WHERE email = :email");
            $stmt->execute(["email" => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user["password"])) {
                $_SESSION["name"] = $user["name"];
                $_SESSION["email"] = $email;
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["status"] = $user["status"];
                $_SESSION["logged"] = true;
                return "success";
            }
            return "Невірний email або пароль!";
        } catch (Exception $e) {
            return "Помилка входу: " . $e->getMessage();
        }
    }

    public function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();
    }

    public function isAuthenticated(): bool
    {
        return isset($_SESSION["logged"]) && $_SESSION["logged"] == true;
    }

    public function isAdmin(): bool
    {
        return isset($_SESSION['status']) && $_SESSION['status'] == 1;
    }

    private function userExists($email): bool
    {
        $stmt = $this->pdo->prepare("SELECT id FROM vognegasnik.users WHERE email = :email");
        $stmt->execute(["email" => $email]);
        return $stmt->fetch() !== false;
    }
}
