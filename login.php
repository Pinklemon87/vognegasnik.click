<?php
require_once 'includes/build/use_controllers.php';
global $authController, $condition;
$authController->isAuth();
?>

<!DOCTYPE html>
<html lang='uk'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title><?=$heading_h1 ?? ''?> - ПП "Вогнезахисник"</title>
    <link rel='icon' href='/assets/images/favicon.png'>
    <link rel='stylesheet' href='/assets/css/login.css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'
          integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
</head>
<body style="background:#111">

    <div class="sign-in">
        <div class="content">
            <?php $condition->loginRoute(); ?>
        </div>
    </div>

</body>
</html>