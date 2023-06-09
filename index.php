<?php

require 'includes/init.php';

mysqli_report(MYSQLI_REPORT_STRICT);

$connect = require 'includes/db.php';

$paginator = new Paginator($_GET['page'] ?? 1, 4, Article::getTotal($connect, true));

$articles = Article::getPage($connect, $paginator->limit, $paginator->offset, true);

?>
<?php require 'includes/header.php'; ?>

    <?php if (empty($articles)) : ?>
      <p>No articles found!</p>
    <?php else : ?>
      <div class="row index-page">
        <div class="col-lg-6 about-blog">
          <h2>Blog poświęcony wskazywaniu zależności między Programowaniem a Budownictwem.</h2>
          <p>Oczywiste jest, że budownictwo i programowanie to dwie różne dziedziny, ale w rzeczywistości istnieje wiele zależności między nimi, które można wykorzystać w celu doskonalenia procesów w obu dziedzinach.</p>
          <p><img class="main-image" src="uploads\PlanRadar-cyfrowa-pomoc-na-budowie-1024x683.jpg" alt="Construction site manager with tablet"></p>
        </div>
        <div class="col-lg-6 article-section">
          <h2>Artykuły:</h2>
          <div class="list-group">
            <ul id="index">
              <?php foreach ($articles as $article) : ?>
              <li>
                <article>
      
                  <a href="article.php?id=<?=$article['id'];?>" class="list-group-item list-group-item-action"
                    aria-current="true">
      
      
                    <div class="d-flex w-100 justify-content-between">
      
                      <h3 class="mb-1">
                        <?= htmlspecialchars($article['title']); ?>
                      </h3>
      
                      <small class="text-muted"><time datetime="<?= $article['published_at'] ?>">
                          <?php 
                                    $datetime = new DateTime($article['published_at']);
                                    echo $datetime->format("j F, Y");
                              ?>
                        </time></small>
      
                    </div>
      
                    <?php if ($article['category_names']) : ?>
                    <p>Kategorie:
                      <?php foreach ($article['category_names'] as $name) : ?>
                      <?= htmlspecialchars($name ?? ''); ?>
                      <?php endforeach; ?>
                    </p>
                    <?php endif; ?>
                    <p>                  
                      <?= htmlspecialchars(substr($article['content'], 0, 50)) . "(...)"; ?>
                    </p>
                  </a>
                </article>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <?php require 'includes/pagination.php'; ?>
        </div>

      </div>
      


    <?php endif; ?>

    <?php require_once 'includes/footer.php'; ?>