<?php
require_once '../../vendor/autoload.php';

use App\Controllers\AuthController;

$authController = new AuthController();
$authController->logout();
exit;