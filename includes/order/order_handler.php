<?php

require_once '../../vendor/autoload.php';
use App\Controllers\OrderController;
$orderController = new OrderController();
$orderController->addOrder();
