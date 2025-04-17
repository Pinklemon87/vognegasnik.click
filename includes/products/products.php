<?php

use App\Controllers\ProductController;

$category_id = $category_id ?? '';
$output = '';
$require = '';
$getProd = new ProductController();

if (isset($_GET['id']) && $_GET['id'] != "" && $_GET['eq'] == 'order') {
    $output = $getProd->generateProduct($getProd->getSearchProductFromID(htmlspecialchars($_GET['id'])));
    if ($output != '') {
        $require = "/../order/order_form.php";
    } else {
       header('Location: /equipment');
    }
} else {
    if ($category_id == '') {
        if (isset($_POST['search_name']) && $_POST['search_name'] !== '') {
            $output .= $getProd->generateProduct($getProd->getSearchProducts(htmlspecialchars($_POST['search_name'])));
            if ($output == '') {
                $output = "<h3>Такого товару не існує!</h3>";
            }
        } else {
            $output .= $getProd->generateProductCategories();
            if ($output == '') {
                $output = "<h3>Категорії не завантажено!</h3>";
            }
        }
    }
}

$output .= $getProd->generateProduct($getProd->getProducts($category_id));
?>

<main role="main" class="container">
    <?php
    if ($_SERVER['REQUEST_URI'] == '/equipment') {
        require_once __DIR__ . "/../search/search_form.php";
    }
    ?>
    <section id="products" class="products">
        <h2><?= $h2 ?? 'Ми виготовляємо' ?></h2>
        <div class="product-list">
            <?= $output ?>
            <?php if (!empty($require)) require_once __DIR__ . $require; ?>
        </div>
    </section>
</main>