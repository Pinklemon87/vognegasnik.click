<h2>Авторизація</h2>
<form  method="POST" action="/includes/authentication/login.php" class="form">
    <?php require_once __DIR__ . "/../../build/alert.php"?>
    <div class="inputBox">
        <label class="w-100">
            <input type="email" name="email" placeholder="Введіть Email" autocomplete="off" required>
        </label>
    </div>
    <div class="inputBox">
        <label class="w-100">
            <input type="password" name="password" placeholder="Введіть пароль" required>
        </label>
    </div>
    <div class="inputBox">
        <label class="w-100">
            <input type="submit" class="btn" value="Увійти">
        </label>
    </div>
    <div class="links"><a href="/registration">Немає акаунту? <i class="fas fa-arrow-right"></i> зареєструйтесь!</a>
    </div>
</form>