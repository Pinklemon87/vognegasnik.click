<?php

use App\Controllers\ArticleController;

$articleController = new ArticleController();
$result = $articleController->getArticles();
$articles = $result['articles'];
$hasMore = $result['hasMore'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
?>

<main role="main" class="container">
    <?php require_once __DIR__ . "/../search/search_form.php"; ?>

    <div class="my-3 p-3 bg-white rounded shadow-lg">
        <?php if (isset($_POST['search_name']) && $_POST['search_name'] !== '') :
            ?>
            <h6>Результат пошуку: <?= htmlspecialchars($_POST['search_name']) ?></h6>
            <?= $articleController->generateArticle($articleController->getSearchArticle(htmlspecialchars($_POST['search_name']))) ?>
            <?php
        else :
            ?>
            <h6 class="border-bottom border-gray pb-2 mb-0">Всі статті</h6>
            <?= $articleController->generateArticle($articles) ?>
            <?php if ($hasMore) :
                ?>
                <small class="d-block mt-3">
                    <button class="clear-button" id="load-more" data-page="<?php echo $page + 1; ?>">Завантажити ще</button>
                </small>
                <?php
            endif; ?>
            <script src="/assets/js/load-more.js" defer></script>
            <?php
        endif; ?>
    </div>
</main>
