<?php
require_once 'vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\ConditionController;

$authController = new AuthController();
$condition = new ConditionController();

$heading_h1 = $condition->titleRoute();
