<?php

require 'includes/init.php';

mysqli_report(MYSQLI_REPORT_STRICT);

$connect = require 'includes/db.php';

if (isset($_GET['id'])) {

  $article = Article::getWithCategories($connect, $_GET['id'], true);

}else{
  $article = null;
}

?>
<?php require_once 'includes/header.php'; ?>
    <?php if ($article) : ?>    
      <div class="row index-page">
        <div class="col-lg-9  about-blog">
        <article>
          <h2>
            <?= htmlspecialchars($article[0]['title']); ?>
          </h2>
      
          <time class="date-time" datetime="<?= $article[0]['published_at'] ?>">
            <?php 
                          $datetime = new DateTime($article[0]['published_at']);
                          echo $datetime->format("j F, Y");
                    ?>
          </time>
      
          <?php if ($article[0]['category_name']) : ?>
          <p>Categories:
            <?php foreach ($article as $a) : ?>
      
            <?= htmlspecialchars($a['category_name']); ?>
      
            <?php endforeach; ?>
          </p>
          <?php endif ; ?>
      
          <?php if ($article[0]['image_file']) : ?>
          <div class="col-lg-12 ">
          <img class="article-image" src="/uploads/<?= $article[0]['image_file']; ?>">
        </div>
          <?php endif; ?>
        
          <p class="content">
            <?= htmlspecialchars($article[0]['content']); ?>
          </p>
        </article>
      </div>
      <div class="col-lg-3 article-section">
        <h2> O mnie:</h2>
        <p>W skrócie, jestem inżynierem budownictwa i obecnie przechodzę na drogę programisty.</p>
        <p>Przejście do zupełnie nowej profesji może być wyzwaniem, ale połączenie mojej wiedzy z zakresu budownictwa z umiejętnościami programistycznymi może otworzyć przed mną ekscytujące możliwości kariery. Poza tym, naprawdę lubię programowanie. </p>
      </div>
      </div>
    <?php else: ?>
      <p>Article not found!</p>
    <?php endif; ?>
    <?php require_once 'includes/footer.php'; ?>