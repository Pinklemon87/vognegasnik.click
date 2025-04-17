<div class="col-md-6">
    <form action="/includes/order/order_handler.php" method="post">
        <input type="hidden" name="product_id" value="<?=htmlspecialchars($_GET['id']) ?? ''?>" />
        <div class="mb-3">
            <label for="name" class="form-label">Введіть Прізвище Ім'я По-батькові</label>
            <input type="text" class="form-control" name="name" id="name" autocomplete="on" value="<?=htmlspecialchars($_SESSION['name'])?>" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Введіть номер телефона</label>
            <input type="tel" class="form-control" name="phone" id="phone" maxlength="12" autocomplete="on" placeholder="380XXXXXXXXX" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Введіть ваше місто</label>
            <input type="text" class="form-control" name="city" id="city" maxlength="54" placeholder="Ваше місто" required>
        </div>
        <div class="mb-3">
            <label for="post-office" class="form-label">Виберіть пошту</label>
            <select class="form-control" name="post_office" id="post-office" required>
                <option selected disabled>Виберіть потрібний варіант</option>
                <option value="nova_post">Нова пошта</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="post-office" class="form-label">Введіть номер відділення</label>
            <input type="text" class="form-control" name="post_id" maxlength="49" id="post-office" placeholder="Номер відділення" required>
        </div>
        <button type="submit" class="btn btn-danger w-100">Оформити замовлення</button>
    </form>
</div>