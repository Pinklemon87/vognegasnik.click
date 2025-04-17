<?php
require_once 'includes/build/use_controllers.php';

global $condition;

[$h2, $category_id] = $condition->equipmentRoute();

require_once __DIR__ . '/includes/build/html.php';
require_once __DIR__ . '/includes/build/header.php';
require_once __DIR__ . '/includes/products/products.php';
require_once __DIR__ . '/includes/components/heroes/order_hero.php';
require_once __DIR__ . '/includes/build/footer.php';