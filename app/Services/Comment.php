<?php

namespace App\Services;

use PDO;
use PDOException;

class Comment
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addComment(int $userid, string $text): bool
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO vognegasnik.comments (userid, text) VALUES (:userid, :text)");
            return $stmt->execute([
                ':userid' => $userid,
                ':text' => $text
            ]);
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка SQL: " . $e->getMessage();
            return false;
        }
    }

    public function getComments(): array
    {
        $stmt = $this->pdo->query("SELECT c.id, c.text, c.date, u.name FROM vognegasnik.comments c
                          JOIN vognegasnik.users u ON (c.userid = u.id)
                          ORDER BY date DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteComment($commentId): bool
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM vognegasnik.comments WHERE id = ?");
            $stmt->execute([$commentId]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                throw new PDOException("Коментар не знайдено або вже видалено.");
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка видалення коментаря: " . $e->getMessage();
            return false;
        }
    }
}