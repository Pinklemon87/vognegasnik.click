<?php
require_once '../../vendor/autoload.php';

use App\Controllers\CommentController;

$commentController = new CommentController();
$commentController->deleteComment();
exit();