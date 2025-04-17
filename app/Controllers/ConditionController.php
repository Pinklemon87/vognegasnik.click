<?php

namespace App\Controllers;

class ConditionController
{
    public function titleRoute(): string
    {
        $route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        return match (true) {
            $route === '/login' || isset($_GET['page']) => $this->loginTitle(),
            $route === '/article' || isset($_GET['state']) => $this->articleTitle(),
            $route === '/equipment' || isset($_GET['eq']) => $this->equipmentTitle(),
            $route === '/about' => 'Про сервіс',
            $route === '/profile' => 'Кабінет користувача',
            default => 'Протипожежне обладнання',
        };
    }
    public function equipmentTitle(): string
    {
        return match ($_GET['eq'] ?? '') {
            'fire_extinguishers' => 'Вогнегасники',
            'fire_cabinet' => 'Пожежні щити',
            'inventory' => 'Інвентар',
            'order' => 'Замовлення',
            default => 'Категорії товарів',
        };
    }

    public function articleTitle(): string
    {
        return match ($_GET['state'] ?? '') {
            'blog' => 'Стаття № ' . ($_GET['id'] ?? ''),
            default => 'Статті',
        };
    }

    public function loginTitle(): string
    {
        return match ($_GET['page'] ?? '') {
            'authorization' => 'Вхід',
            'registration' => 'Реєстрація',
            default => 'Error',
        };
    }

    public function articleRoute(): string
    {
        return match ($_GET['state'] ?? '') {
            'blog' => 'article_page',
            default => 'article_category',
        };
    }

    public function equipmentRoute(): array
    {
        $categories = [
            'fire_extinguishers' => ['Вогнегасники', 1],
            'fire_cabinet' => ['Протипожежні щити', 2],
            'inventory' => ['Пожежний інвентар', 3],
            'order' => ['Замовлення', ''],
        ];

        return $categories[$_GET['eq'] ?? ''] ?? ['Ми виготовляємо', ''];
    }

    public function loginRoute(): void
    {
        $pagePath = match ($_GET['page'] ?? '') {
            'registration' => 'registration',
            default => 'login',
        };

        if ($pagePath) {
            require_once __DIR__ . "/../../includes/components/authentication/{$pagePath}_form.php";
        } else {
            header('Location: /login');
            exit;
        }
    }

}