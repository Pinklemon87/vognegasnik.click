<?php

namespace App\Services;

use PDO;
use PDOException;

class Product
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
     * Get all product categories
     *
     * @return array
     */
    public function getAllCategories(): array
    {
        try {
            $stmt = $this->pdo->query("SELECT title, image, items, button_name, link FROM vognegasnik.product_categories");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка отримання категорій: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Get products by category id
     *
     * @param $category_id
     * @return array
     */
    public function getAllProduct($category_id): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, name, image, description, price FROM vognegasnik.products 
                                           WHERE category_id = ?");
            $stmt->execute([$category_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка продукту: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Search products by product name
     *
     * @param $product_name
     * @return array
     */
    public function getSearchProduct($product_name): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, name, image, description, price FROM vognegasnik.products 
                                           WHERE name LIKE :name");
            $stmt->execute([':name' => "%$product_name%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка продукту: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Search product by id
     *
     * @param $product_id
     * @return array
     */
    public function getSearchProductFromID($product_id): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, name, image, description, price FROM vognegasnik.products WHERE id = :id");
            $stmt->execute([':id' => $product_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка продукту: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Insert product to database
     *
     * @param $name
     * @param $image
     * @param $description
     * @param $price
     * @param $category_id
     * @return bool
     */
    public function insertProduct($name, $image, $description, $price, $category_id): bool
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO vognegasnik.products (name, image, description, price, category_id) 
                                     VALUES (:name, :image, :description, :price, :category_id)");
            $stmt->execute([
                ':name' => $name,
                ':image' => $image,
                ':description' => $description,
                ':price' => $price,
                ':category_id' => $category_id
            ]);
            return true;
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка додавання продукту: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Delete product from the database
     *
     * @param $productId
     * @return bool
     */
    public function deleteProduct($productId): bool
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM vognegasnik.products WHERE id = ?");
            $stmt->execute([$productId]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                throw new PDOException("Товар не знайдено або вже видалено.");
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка видалення товару: " . $e->getMessage();
            return false;
        }
    }
}
