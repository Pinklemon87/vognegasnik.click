<?php

namespace App\Controllers;

use App\Services\Article;
use App\Services\Auth;
use JetBrains\PhpStorm\NoReturn;
use PDOException;

class ArticleController extends Controller
{
    protected Auth $auth;
    protected Article $articleService;
    public function __construct()
    {
        parent::__construct();
        $this->auth = new Auth($this->conn);
        $this->articleService = new Article($this->conn);
    }

    public function getArticle($article_id): array
    {
          return $this->articleService->getArticle($article_id);
    }

    public function getArticles(): array
    {
        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        return [
            'articles' => $this->articleService->getAllArticles($limit, $offset),
            'hasMore' => $this->articleService->hasMoreArticles($limit, $offset)
        ];
    }

    public function getSearchArticle($article_name): array
    {
        return $this->articleService->getSearchArticle($article_name);
    }

    public function isActionArticle():void
    {
        if (!$this->auth->isAdmin()) {
            $_SESSION['error'] = "У Вас немає прав на виконання дій з статтями!";
            header("Location: /profile");
            exit;
        }
    }

    function generateArticle($articles): string
    {
        $html = '';
        foreach ($articles as $art) {
            $html .= '<a id="articles-container" href="/article/' . htmlspecialchars($art['article_id']) . '">';
            $html .= '<div class="d-flex media text-muted pt-3">';
            $html .= '<img src="/assets/images/articles/Info.png" class="mr-2 img-size rounded mx-2" alt="">';
            $html .= '<p class="flex-grow-1 media-body pb-3 mb-0 small lh-125 border-bottom border-gray">';
            $html .= '<strong class="d-block text-gray-dark fs-6 hover_underline">' . htmlspecialchars($art['article']) . '</strong>';
            $html .= htmlspecialchars($art['category']);
            $html .= '</p>';

            if ($this->auth->isAdmin()):
                $html .= '
                        <form method="post" class="justify-content-end" action="/includes/article/delete_article.php">
                            <input type="hidden" name="article_id" value="'. htmlspecialchars($art['article_id']).'">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                        ';
            endif;

            $html .= '</div>';
            $html .= '</a>';
        }

        return $html;
    }

    #[NoReturn] public function addArticle(): void
    {
        $this->isActionArticle();

        if (isset($_POST["articleTitle"], $_POST["articleText"], $_POST["articleCategory"])) {
            $title = trim($_POST["articleTitle"]);
            $text = trim($_POST["articleText"]);
            $category_id = filter_var($_POST["articleCategory"], FILTER_VALIDATE_INT);

            if ($category_id === false) {
                $_SESSION['error'] = "Некоректні дані.";
            } else {
                if ($this->articleService->insertArticle($title, $text, $category_id)) {
                    $_SESSION['success'] = "Стаття успішно додана!";
                } else {
                    $_SESSION['error'] = "Помилка при додаванні статті.";
                }
            }
        } else {
            $_SESSION['error'] = "Будь ласка, заповніть усі поля.";
        }
        header("Location: /profile");
        exit;
    }

    public function deleteArticle(): void
    {
        $this->isActionArticle();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['article_id'])) {
            $articleId = filter_input(INPUT_POST,'article_id', FILTER_SANITIZE_NUMBER_INT);
            try {
                if ($this->articleService->deleteArticle($articleId)) {
                    $_SESSION['success'] = "Статтю успішно видалено!";
                } else {
                    $_SESSION['error'] = "Помилка видалення статті!";
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = "Помилка SQL: " . $e->getMessage();
            }
        }
        header("Location: /article");
        exit;
    }

}