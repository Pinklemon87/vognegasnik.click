<?php

namespace App\Controllers;

use App\Services\Auth;
use App\Services\Order;
use JetBrains\PhpStorm\NoReturn;

class OrderController extends Controller
{
    protected Auth $auth;
    protected Order $orderService;
    public function __construct()
    {
        parent::__construct();
        $this->auth = new Auth($this->conn);
        $this->orderService = new Order($this->conn);
    }

    public function getOrders(): array
    {
        if($this->auth->isAuthenticated()){
        $user_id = htmlspecialchars($_SESSION['user_id']);
        return $this->orderService->getOrders($user_id);
        }else{
            $_SESSION['error'] = "Помилка авторизації, перезайдіть в аккаунт";
            return [];
        }
    }

    public function getFullOrders(): array
    {
        if($this->auth->isAdmin()){
            return $this->orderService->getFullOrders();
        }else{
            $_SESSION['error'] = 'Ваш аккаунт не має статусу Admin!';
            return [];
        }
    }

    #[NoReturn] public function updateOrderStatus(): void
    {
        if (!$this->auth->isAdmin()) {
            $_SESSION['error'] = 'Ваш аккаунт не має статусу Admin!';
            header('Location: /profile');
            exit;
        }

        if (!isset($_POST['order_id'], $_POST['update_order_status'])) {
            $_SESSION['error'] = 'Невірні дані для оновлення статусу!';
            header('Location: /profile');
            exit;
        }

        $order_id = intval($_POST['order_id']);
        $status = intval($_POST['update_order_status']);

        if (!in_array($status, [1, 2, 3, 4], true)) {
            $_SESSION['error'] = 'Недопустимий статус замовлення!';
            header('Location: /profile');
            exit;
        }

        if ($this->orderService->updateOrderStatus($order_id, $status)) {
            $_SESSION['success'] = 'Статус успішно оновлено!';
        } else {
            $_SESSION['error'] = 'Не вдалося оновити статус замовлення!';
        }

        header('Location: /profile');
        exit;
    }

    #[NoReturn] public function addOrder(): void
    {
        if (empty($_POST["product_id"]) || empty($_POST["name"]) ||
            !is_numeric($_POST["phone"]) || empty($_POST["city"]) ||
            empty($_POST["post_office"]) || empty($_POST["post_id"])) {
            $_SESSION['error'] = "Будь ласка, заповніть усі поля коректно.";
            header("Location: <script>window.history.back();</script>");
            exit;
        }
        $user_id = htmlspecialchars($_SESSION["user_id"]);
        $product_id = intval($_POST["product_id"]);
        $name = htmlspecialchars(trim($_POST["name"]));
        $phone = intval(trim($_POST["phone"]));
        $city = htmlspecialchars($_POST["city"]);
        $post_office = htmlspecialchars($_POST["post_office"]);
        $post_id = intval($_POST["post_id"]);

        if ($this->orderService->insertOrder($user_id, $product_id, $name, $phone, $city, $post_office, $post_id)) {
            echo $_SESSION['success'] = "Замовлення успішно створено!";
        } else {
            echo $_SESSION['error'] = "Помилка при створенні замовлення!";
        }

        header("Location: /equipment");
        exit;
    }
}