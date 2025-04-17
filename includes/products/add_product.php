<div class="container d-flex justify-content-center ">
    <form action="/includes/products/add_product_handler.php" method="POST" class="border p-4 shadow w-100 my-3" style="max-width: 600px; display:none"
          enctype="multipart/form-data" id="addProduct">
        <h1 class="text-center">Додати товар</h1>
        <div class="form-group mb-2">
            <label for="productName">Назва продукту</label>
            <input type="text" class="form-control" name="productName" id="productName" maxlength="49" placeholder="" required>
        </div>
        <div class="form-group mb-2">
            <label for="productPrice">Ціна продукту</label>
            <input type="number" class="form-control" name="productPrice" id="productPrice" placeholder="" required>
        </div>
        <div class="form-group mb-2">
            <label for="productImage">Фото продукту</label>
            <input class="form-control" name="productImage" id="productImage" type="file"
                   accept="image/png, image/jpeg, image/jpg, image/webp">
        </div>
        <div class="form-group mb-2">
            <label for="productDescription">Опис продукту</label>
            <textarea class="form-control" id="productDescription" name="productDescription" maxlength="199" rows="6" required></textarea>
        </div>
        <div class="form-group mb-3">
            <label>
                <select name="productCategory" required>
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