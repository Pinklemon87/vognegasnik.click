<?php global $links, $contacts, $product_redirect; ?>
<footer class='footer'>
    <div class='footer-container'>
        <div class='footer-column'>
            <div class='logo'>ПП «Вогнезахисник»</a></div>
            <p> &copy; <script>document.write(new Date().getFullYear())</script>
                ПП «Вогнезахисник» Протипожежне обладнання
            </p>
        </div>
        <div class='footer-column'>
            <h3>Клієнтам</h3>
            <ul>
                <?php foreach ( $links as $link): ?>
                    <li><a href='<?=$link['link']?>'><i class='fas <?=$link['icon']?>'></i> <?=$link['name']?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class='footer-column'>
            <h3>Виготовлення</h3>
            <ul>
                <?php foreach ($product_redirect as $pr): ?>
                    <li><a href='/equipment.php?eq=<?=$pr['link']?>'><i class='fas <?=$pr['icon']?>'></i> <?=$pr['title']?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class='footer-column'>
            <h3>Контакти</h3>
            <?php foreach ( $contacts as $contact): ?>
                <p><i class='fas <?=$contact['icon']?>'></i> <a href='<?=$contact['link']?>'><?=$contact['text']?></a></p>
            <?php endforeach; ?>
        </div>
    </div>
</footer>

<?php require_once 'mobile_menu.php';  ?>
<script src='/assets/js/main.js'></script>
</body>
</html>
