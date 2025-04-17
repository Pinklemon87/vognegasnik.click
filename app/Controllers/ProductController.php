<?php

namespace App\Controllers;

use App\Services\Auth;
use App\Services\Product;
use JetBrains\PhpStorm\NoReturn;
use PDOException;

class ProductController extends Controller
{
    protected Auth $auth;
    protected Product $productService;

    public function __construct()
    {
        parent::__construct();
        $this->auth = new Auth($this->conn);
        $this->productService = new Product($this->conn);
    }

    public function getAllProductCategories(): array
    {
        return $this->productService->getAllCategories();
    }

    public function getProducts($category_id): array
    {
        return $this->productService->getAllProduct($category_id);
    }

    public function getSearchProducts($product_name): array
    {
        return $this->productService->getSearchProduct($product_name);
    }

    public function getSearchProductFromID($product_id): array
    {
        return $this->productService->getSearchProductFromID($product_id);
    }

    public function isActionProduct(): void
    {
        if (!$this->auth->isAdmin()) {
            $_SESSION['error'] = "У Вас немає прав на виконання дій з товарами!";
            header("Location: /equipment");
            exit;
        }
    }

    #[NoReturn] public function addProduct(): void
    {
        $this->isActionProduct();
        if (empty($_POST["productName"]) || empty($_POST["productDescription"]) ||
            empty($_POST["productPrice"]) || empty($_POST["productCategory"]) ||
            !is_numeric($_POST["productPrice"]) || !is_numeric($_POST["productCategory"])) {
            $_SESSION['error'] = "Будь ласка, заповніть усі поля коректно.";
            header("Location: /profile");
            exit;
        }

        $fileName = $this->uploadImage($_FILES['productImage'] ?? null);
        $name = htmlspecialchars(trim($_POST["productName"]));
        $description = htmlspecialchars(trim($_POST["productDescription"]));
        $price = floatval($_POST["productPrice"]);
        $category_id = intval($_POST["productCategory"]);

        if ($this->productService->insertProduct($name, $fileName, $description, $price, $category_id)) {
            $_SESSION['success'] = "Продукт успішно додано!";
        } else {
            $_SESSION['error'] = "Помилка при додаванні продукту.";
        }

        header("Location: /profile");
        exit;
    }

    private function uploadImage(?array $file): string
    {
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/assets/images/products/";
        $defaultFile = "default.png";

        if (!$file || empty($file['name']) || $file['error'] !== 0) {
            return $defaultFile;
        }

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = time() . '_' . basename($file['name']);
        $imgPath = $uploadDir . $fileName;

        return move_uploaded_file($file['tmp_name'], $imgPath) ? $fileName : $defaultFile;
    }

    public function generateProductCategories(): string
    {
        $html = '';
        foreach ($this->getAllProductCategories() as $product) {
            $itemsList = explode(',', $product['items']);
            $itemsList = array_map('trim', $itemsList);

            $html .= '<div class="product-item shadow-lg">';
            $html .= '<img src="/assets/images/category-product/' . htmlspecialchars($product['image']) . '
            " alt="" class="product-image">';
            $html .= '<h3>' . htmlspecialchars($product['title']) . '</h3>';
            $html .= '<ul class="product-list">';
            foreach ($itemsList as $item):
                $html .= '<li><i class="fas fa-fire"></i> ' . htmlspecialchars($item) . '</li>';
            endforeach;
            $html .= '</ul>';
            $html .= '<a class="button" href="' . htmlspecialchars($product['link']) . '">
            ' . htmlspecialchars($product['button_name']) . ' <i class="fas fa-arrow-right"></i></a>';
            $html .= '</div>';
        }
        return $html;
    }

    public function generateProduct($category_id): string
    {
        $html = '';
        foreach ($category_id as $product) {

            $html .= '<div class="product-item shadow-lg">';
            $html .= '<img src="/assets/images/products/' . htmlspecialchars($product['image']) . '"alt="" class="product-image2">';
            $html .= '<h3>' . htmlspecialchars($product['name']) . '</h3>';
            $html .= '<ul class="product-list">';
            $html .= '<li>' . htmlspecialchars($product['description']) . '</li>';
            $html .= '</ul>';
            $html .= '<p><i class="fas fa-fire"></i> ' . htmlspecialchars($product['price']) . ' грн.</p>';
            if (!str_starts_with($_SERVER['REQUEST_URI'], '/order/') && $_SERVER['REQUEST_URI'] !== '/profile'):
                if ($this->auth->isAuthenticated()):
                    $html .= '<a class="button m-2" href="/order/' . htmlspecialchars($product['id']) . '">
                    <i class="fas fa-cart-arrow-down"></i> Замовити</i></a>';
                    if ($this->auth->isAdmin()):
                        $html .= '<form action="/includes/products/delete_product.php" method="POST">';
                        $html .= '<input type="hidden" name="product_id" value="' . htmlspecialchars($product['id']) . '">';
                        $html .= '<button class="button" type="submit"><i class="fas fa-trash"></i> Видалити</i></button>';
                        $html .= '</form>';
                    endif;
                endif;
            endif;
            $html .= '</div>';
        }
        return $html;
    }

    public function deleteProduct(): void
    {
        $this->isActionProduct();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $productId = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);
            try {
                if ($this->productService->deleteProduct($productId)) {
                    $_SESSION['success'] = "Товар успішно видалено!";
                } else {
                    $_SESSION['error'] = "Помилка видалення товару!";
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = "Помилка SQL: " . $e->getMessage();
            }
        }
        header("Location: /equipment");
        exit;
    }

}