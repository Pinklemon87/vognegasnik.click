<?php

namespace App\Services;

use PDO;
use PDOException;

class Order
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
     * Insert order to database
     *
     * @param $user_id
     * @param $product_id
     * @param $name
     * @param $phone
     * @param $city
     * @param $post_office
     * @param $post_id
     * @return bool
     */
    public function insertOrder($user_id, $product_id, $name, $phone, $city, $post_office, $post_id): bool
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO vognegasnik.orders (user_id, product_id, name, phone, city, 
                                post_office, post_id, status) 
                                     VALUES (:user_id, :product_id, :name, :phone, :city, :post_office, :post_id, :status)");
            $stmt->execute([
                ':user_id' => $user_id,
                ':product_id' => $product_id,
                ':name' => $name,
                ':phone' => $phone,
                ':city' => $city,
                ':post_office' => $post_office,
                ':post_id' => $post_id,
                ':status' => 0
            ]);
            return true;
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка додавання замовлення: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Get orders from user id
     *
     * @param $user_id
     * @return array
     */
    public function getOrders($user_id): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT p.name as product_name, p.price as product_price, 
            o.id as order_id, o.name as order_user,o.city as order_city, o.date as order_date,
            o.post_office as order_post, o.post_id as order_post_id, o.status as order_status
            FROM vognegasnik.orders o 
            JOIN vognegasnik.products p ON o.product_id = p.id WHERE user_id = :user_id");
            $stmt->execute([':user_id' => $user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка отримання замовлень: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Get full orders
     *
     * @return array
     */
    public function getFullOrders(): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT p.name as product_name, p.price as product_price, 
            o.id as order_id, o.name as order_user,o.city as order_city, o.date as order_date, o.phone as order_phone,
            o.post_office as order_post, o.post_id as order_post_id, o.status as order_status
            FROM vognegasnik.orders o 
            JOIN vognegasnik.products p ON o.product_id = p.id");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка отримання замовлень: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Update order status by admin
     *
     * @param $order_id
     * @param $status
     * @return bool
     */
    public function updateOrderStatus($order_id, $status): bool
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE vognegasnik.orders SET status = :status WHERE id = :order_id");
            $stmt->execute([
                ':status' => $status,
                ':order_id' => $order_id
            ]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            $_SESSION['error'] = "Помилка оновлення статусу замовлення: " . $e->getMessage();
            return false;
        }
    }
}
