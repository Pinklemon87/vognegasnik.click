<?php

namespace App\Controllers;

use App\Services\Auth;
use App\Services\Comment;
use PDOException;

class CommentController extends Controller
{
    protected Auth $auth;
    protected Comment $commentService;

    public function __construct()
    {
        parent::__construct();
        $this->auth = new Auth($this->conn);
        $this->commentService = new Comment($this->conn);
    }

    /**
     * Is add comment controller
     *
     * @return void
     */
    public function isAddComment(): void
    {
        if (!$this->auth->isAuthenticated()) {
            $_SESSION['error'] = "Потрібно увійти в аккаунт для виконання дій з коментарями!";
            header("Location: /about#feedbackForm");
            exit;
        }
    }

    /**
     * Get comments. Return comment array
     *
     * @return array
     */
    public function getComments(): array
    {
        return $this->commentService->getComments();
    }

    /**
     * Add Comment controller
     *
     * @return void
     */
    public function addComment(): void
    {
        $this->isAddComment();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userid = htmlspecialchars($_SESSION['user_id']) ?? null;
            $comment = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_SPECIAL_CHARS);
            $comment = trim($comment);

            if (empty($userid) || empty($comment)) {
                $_SESSION['error'] = "Будь ласка, введіть коментар!";
            } else {
                try {
                    if ($this->commentService->addComment($userid, $comment)) {
                        $_SESSION['success'] = "Коментар успішно додано!";
                    } else {
                        $_SESSION['error'] = "Помилка під час додавання коментаря.";
                    }
                } catch (PDOException $e) {
                    $_SESSION['error'] = "Помилка SQL: " . $e->getMessage();
                }
            }

            header("Location: /about#feedbackForm");
            exit;
        }
    }

    /**
     * Delete comment controller
     *
     * @return void
     */
    public function deleteComment(): void
    {
        $this->isAddComment();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_comment'])) {
            $commentId = filter_input(INPUT_POST, 'comment_id', FILTER_SANITIZE_NUMBER_INT);
            try {
                if ($this->commentService->deleteComment($commentId)) {
                    $_SESSION['success'] = "Коментар успішно видалено!";
                } else {
                    $_SESSION['error'] = "Помилка видалення коментаря!";
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = "Помилка SQL: " . $e->getMessage();
            }
        }
        header("Location: /about#feedbackForm");
        exit;
    }
}
