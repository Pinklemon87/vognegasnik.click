<?php
use App\Controllers\CommentController;
$commentController = new CommentController();
global $authController;
?>
<section class="feedback-form">
    <form id="feedbackForm" class="container" method="POST" action="/includes/comments/comments_handler.php">
        <label for="message">Ваш відгук:</label>
        <textarea id="message" name="text" class="shadow-lg" rows="9" placeholder="Напишіть ваш відгук" required></textarea>
        <button type="submit" class="shadow-lg">Опублікувати</button>
    </form>
</section>
<section class="feedback-list" id="feedback">
    <div class="container d-flex flex-column">
        <?php foreach ($commentController->getComments() as $comment):?>
            <article class="feedback shadow-lg">
                <h5>
                    <?= htmlspecialchars($comment['text']) ?>
                </h5>
                <p class="fs-6">
                    <?= htmlspecialchars($comment['name']) ?>
                </p>
                <span class="date fs-6">
                    <?= htmlspecialchars(date("d.m.Y H:i", strtotime($comment['date']))) ?>
                </span>
                <?php if ($authController->isAdminStatus()): ?>
                    <form method="post" action="/includes/comments/delete_comment.php" class="m-0 p-0">
                        <input type="hidden" name="comment_id" value="<?= htmlspecialchars($comment['id']) ?>">
                        <button type="submit" class="btn btn-danger btn-secondary" name="delete_comment">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>

    </div>
</section>
