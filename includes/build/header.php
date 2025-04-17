<?php
require_once __DIR__ . '/../state/link_array.php';
global $links, $authController;

?>
<header class='header'>
    <div class='container2 mx-5'>
        <div class='logo'><a href='/'>ПП «Вогнезахисник»</a></div>
        <nav class='nav'>
            <?php foreach ($links as $link): ?>
                <a href='<?=$link['link']?>'><i class="fas <?=$link['icon']?>"></i> <?=$link['name']?></a>
            <?php endforeach; ?>
        </nav>
        <div class="my-1 fw-bold">
            <?=$authController->loginBtn()?>
        </div>
    </div>
</header>