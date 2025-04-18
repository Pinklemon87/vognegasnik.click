<?php

global $authController;
if ($_SERVER['REQUEST_URI'] == '/profile') {
    $h1_hero = 'Кабінет Користувача';
    $p_hero = "<span class='p-2 bg-secondary rounded'>" . $authController->statusAccount() . "</span> " . $_SESSION['name'];
    $addProduct = $authController->statusAccount() == 'Admin' ? '
    <button type="button" class="button m-2" onclick="toggleHandlerForm()">Обробити замовлення</button>
    <button type="button" class="button m-2" onclick="toggleAddProductForm()">Додати товар</button>
    <button type="button" class="button m-2" onclick="toggleAddArticleForm()">Написати статтю</button>' : '';
    $btn_hero = $addProduct;
} else {
    $h1_hero = 'Протипожежне обладнання';
    $p_hero = 'Послуги з виготовлення та сервісу';
    $btn_hero = '<a class="button" href="#products">Всі послуги</a>';
}
?>

<section class="hero">
    <h1><?=$h1_hero?></h1>
    <p><?=$p_hero?></p>
    <?=$btn_hero?>
</section>
