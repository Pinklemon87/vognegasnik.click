<?php
require_once '../../vendor/autoload.php';

use App\Controllers\ProductController;

$addProduct = new ProductController();

$addProduct->addProduct();
