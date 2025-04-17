<div class="container d-flex justify-content-center">
    <form method="POST" action="/includes/article/add_article_handler.php" class="border p-4 shadow w-100 my-3" style="max-width: 600px; display:none"
          id="addArticle">
        <h1 class="text-center">Написати статтю</h1>
        <div class="form-group mb-2">
            <label for="articleTitle">Назва статті</label>
            <input type="text" class="form-control" name="articleTitle" id="articleTitle" maxlength="255" placeholder="" required>
        </div>
        <div class="form-group mb-2">
            <label for="articleText">Текст статті</label>
            <textarea class="form-control" id="articleText" name="articleText" rows="15" required></textarea>
        </div>
        <div class="form-group mb-3">
            <label>
                <select name="articleCategory" required>
                    <option selected disabled>Виберіть категорію</option>
                    <option value="1">Вогнегасники</option>
                    <option value="2">Пожежні щити</option>
                    <option value="3">Пожежний інвентар</option>
                </select>
            </label>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-danger w-100">Опублікувати</button>
        </div>
    </form>
</div>