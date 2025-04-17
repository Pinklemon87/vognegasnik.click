<?php global $links, $authController; ?>
<div class='mobile'>
    <div>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <nav>
        <ul>
            <?=$authController->loginBtnMobile()?>
            <hr>
            <a href='/'><i class='fas fa-list' aria-label='true'></i> Головна</a>
            <?php foreach ($links as $link): ?>
                <a href='<?=$link['link']?>'><i class='fas <?=$link['icon']?>' aria-label='true'></i> <?=$link['name']?></a>
            <?php endforeach; ?>
        </ul>
    </nav>
</div>

