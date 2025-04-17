<?php
require_once 'includes/build/use_controllers.php';
global $condition;

require_once __DIR__ . '/includes/build/html.php';
require_once __DIR__ . '/includes/build/header.php';
require_once 'includes/article/'. $condition->articleRoute() .'.php';
require_once __DIR__ . '/includes/build/footer.php';
