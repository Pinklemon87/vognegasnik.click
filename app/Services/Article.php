<?php

namespace App\Services;

use PDO;
use PDOException;

class Article
{
    private PDO $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get All Articles with pagination
     *
     * @param $limit
     * @param $offset
     * @return array
     */
    public function getAllArticles($limit, $offset): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT ac.id as category_id, ac.name as category, 
                a.title as article, a.id as article_id
                FROM vognegasnik.article_categories ac 
                JOIN vognegasnik.articles a ON a.category_id = ac.id 
                ORDER BY a.id DESC 
                LIMIT :limit OFFSET :offset");

            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка отримання категорій: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Pagination in articles
     *
     * @param $limit
     * @param $offset
     * @return bool
     */
    public function hasMoreArticles($limit, $offset): bool
    {
        try {
            $countStmt = $this->pdo->query("SELECT COUNT(*) FROM vognegasnik.articles");
            $totalArticles = $countStmt->fetchColumn();
            return ($offset + $limit) < $totalArticles;
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }

    /**
     * Search for an article by title
     *
     * @param $article_name
     * @return array
     */
    public function getSearchArticle($article_name): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT ac.id as category_id, ac.name as category, 
            a.title as article, a.id as article_id  FROM vognegasnik.articles a 
                          JOIN vognegasnik.article_categories ac on ac.id = a.category_id
                          WHERE title LIKE :article_name");
            $stmt->execute([':article_name' => "%$article_name%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка отримання статті: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Get article by id
     *
     * @param $article_id
     * @return array
     */
    public function getArticle($article_id): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT  title, text, date FROM vognegasnik.articles WHERE id = :article_id");
            $stmt->execute([':article_id' => $article_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка отримання статті: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Insert article to database
     *
     * @param $title
     * @param $text
     * @param $category_id
     * @return bool
     */
    public function insertArticle($title, $text, $category_id): bool
    {
        try {
            $stmt = $this->pdo->prepare(query: "INSERT INTO vognegasnik.articles (title, text, category_id) 
                                     VALUES (:title, :text, :category_id)");
            $stmt->execute([
                ':title' => $title,
                ':text' => $text,
                ':category_id' => $category_id
            ]);
            return true;
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка додавання статті: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Delete article from the database
     *
     * @param $articleId
     * @return bool
     */
    public function deleteArticle($articleId): bool
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM vognegasnik.articles WHERE id = ?");
            $stmt->execute([$articleId]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                throw new PDOException("Статтю не знайдено або вже видалено.");
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка видаленні статті: " . $e->getMessage();
            return false;
        }
    }
}
