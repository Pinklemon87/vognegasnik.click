<?php
  if($_SERVER['REQUEST_URI'] == '/about'){
  $btn = '<a href="#about-us" class="button">Вся інформація <i class="fas fa-arrow-down"></i></a>';
  }else{
      $btn = '<a href="/about" class="button">Про Нас</a>';
  }
?>
<section id="about" class="about">
    <div class="content text-shadow">
        <h1>Протипожежне обладнання та засоби пожежогасіння</h1>
        <p>Компанія ПП “Вогнезахисник” пропонує великий вибір обладнання та комплекс послуг, пов'язаних з пожежною безпекою.</p>
        <?= $btn ?>
    </div>
</section>