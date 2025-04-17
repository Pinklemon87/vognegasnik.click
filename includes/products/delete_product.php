<?php
require_once __DIR__ . "/../../vendor/autoload.php";
use App\Controllers\ProductController;

if (isset($_POST)) {
    if (isset($_POST["article_id"]) !== null) {
        $productController = new ProductController();
        $productController->deleteProduct();
    }
}