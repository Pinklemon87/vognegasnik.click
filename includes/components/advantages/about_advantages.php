<?php
require_once __DIR__ . '/../../state/about_array.php';
global $about;
?>
<div class="container px-4 py-5" id="about-us">
    <h2 class="pb-2 underline-red text-center">Інформаційний блок</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
        <?php foreach ($about as $ab): ?>
        <div class="col d-flex align-items-start">
            <div class="card h-100 p-3 shadow-lg rounded-5 border-3">
                <h3 class="fw-bold mb-3 fs-4 text-body-emphasis"><?=$ab['title']?></h3>
                <p><?=$ab['text']?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>