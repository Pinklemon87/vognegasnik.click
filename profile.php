<?php
require_once 'includes/build/use_controllers.php';
global $authController;
$authController->noAuth();
require_once __DIR__ . '/includes/build/html.php';
require_once __DIR__ . '/includes/build/header.php';
require_once __DIR__ . '/includes/components/heroes/hero.php';
if ($authController->isAdminStatus()):
    require_once __DIR__ . '/includes/products/add_product.php';
    require_once __DIR__ . '/includes/article/add_article.php';
    require_once __DIR__ . '/includes/order/update_order.php';
endif;
require_once __DIR__ . '/includes/order/profile_orders.php';
require_once __DIR__ . '/includes/build/footer.php';