<h2>Реєстрація</h2>
<form method="POST" class="form" action="/includes/authentication/registration.php">
    <?php require_once __DIR__ . "/../../build/alert.php"?>
    <div class="inputBox">
        <label class="w-100">
            <input type="email" name="email" placeholder="Введіть Email" autocomplete="off" required>
        </label>
    </div>
    <div class="inputBox">
        <label class="w-100">
            <input type="text" name="name" placeholder="Введіть Прізвище Ім`я По-батькові" autocomplete="off" required>
        </label>
    </div>
    <div class="inputBox">
        <label class="w-100">
            <input type="password" name="password" placeholder="Придумайте пароль" required>
        </label>
    </div>
    <div class="inputBox">
        <input type="submit" value="Зареєструватись">
    </div>
    <div class="links"><a href="/login">Уже маєте акаунт? <i class="fas fa-arrow-right"></i> увійдіть!</a>
    </div>
</form>