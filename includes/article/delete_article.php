<?php

require_once __DIR__ . "/../../vendor/autoload.php";
use App\Controllers\ArticleController;
if (isset($_POST)) {
    if (isset($_POST["article_id"]) !== null) {
        $articleController = new ArticleController();
        $articleController->deleteArticle();
    }
}
