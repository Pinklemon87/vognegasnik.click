<?php

require_once '../../vendor/autoload.php';
use App\Controllers\ArticleController;
$articleController = new ArticleController();
$articleController->addArticle();
