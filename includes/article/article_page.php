<?php
$article_id = $_GET['id'];

use App\Controllers\ArticleController;

$articleController = new ArticleController();
$article = $articleController->getArticle($article_id);

if(empty($article)):
    echo "<h3>Стаття відсутня!</h3>";
else:
    foreach ($article as $art):
        $formattedDate = date("d.m.Y H:i", strtotime($art['date']));
    ?>

<main class="container">
    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
        <div class="col-lg-6 px-0">
            <h1 class="display-4 fst-italic"><?=$art['title']?></h1>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-md-8">
            <article class="blog-post">
                <p class="blog-post-meta"><?=$formattedDate?> | Створив: Admin</p>
                <hr>
                <p><?= html_entity_decode(nl2br(htmlspecialchars($art['text'])))?></p>
            </article>
        </div>

        <div class="col-md-4">
            <div class="position-sticky" style="top: 2rem;">
                <div class="p-4 mb-3 bg-body-tertiary rounded">
                    <h4 class="fst-italic">Про Нас</h4>
                    <p class="mb-0">Компанія ПП “Вогнезахисник” пропонує великий вибір обладнання та комплекс послуг, пов'язаних з пожежною безпекою.</p>
                </div>

                <div>
                    <h4 class="fst-italic">ТОП Статті</h4>
                    <ul class="list-unstyled">
                        <li>
                            <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
                               href="/article/1">
                                <div class="col-lg-8">
                                    <h6 class="mb-0 text-black">Використання вогнегасників</h6>
                                    <small class="text-black-50">10.03.2025р. Створив: Admin</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
                               href="/article/2">
                                <div class="col-lg-8">
                                    <h6 class="mb-0 text-black">Час експлуатації вогнегасників</h6>
                                    <small class="text-black-50">10.03.2025р. Створив: Admin</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
                               href="/article/5">
                                <div class="col-lg-8">
                                    <h6 class="mb-0 text-black">Використання пожежного інвентаря</h6>
                                    <small class="text-black-50">10.03.2025р. Створив: Admin</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</main>
    <?php endforeach;
endif; ?>