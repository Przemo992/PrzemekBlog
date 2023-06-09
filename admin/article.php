<?php

require '../includes/init.php';

Auth::requireLogin();

mysqli_report(MYSQLI_REPORT_STRICT);

$connect = require '../includes/db.php';

if (isset($_GET['id'])) {

  $article = Article::getWithCategories($connect, $_GET['id']);

}else{
  $article = null;
}

?>
<?php require_once '../includes/header.php'; ?>
    <?php if ($article) : ?> 
      <div class="row">
        <div class="col-lg-9 mx-auto about-blog mb-3">   
      <article>
              <h2><?= htmlspecialchars($article[0]['title']); ?></h2>

              <?php if ($article[0]['published_at']) : ?>
                <time><?= $article[0]['published_at'] ?></time>
                <?php else : ?>
                  Unpublished
                  <?php endif ; ?>

              <?php if ($article[0]['category_name']) : ?>
                <p>Categories:
                <?php foreach ($article as $a) : ?>

                  <?= htmlspecialchars($a['category_name']); ?>

                  <?php endforeach; ?>
                </p>
                <?php endif ; ?>

              <?php if ($article[0]['image_file']) : ?>
                   <p> <img class="mb-3 article-image" src="/uploads/<?= $article[0]['image_file']; ?>"></p>
                <?php endif; ?>

              <p class="content"><?= htmlspecialchars($article[0]['content']); ?></p>
            </article>
            <a class="btn btn-outline-secondary" role="button" href='edit-article.php?id=<?= $article[0]['id'];?>'> Edit </a>
            <a class="delete btn btn-outline-secondary" role="button" href='delete-article.php?id=<?= $article[0]['id'];?>'> Delete </a>
            <a class="btn btn-outline-secondary" role="button"href="edit-article-image.php?id=<?= $article[0]['id']; ?>">Edit image</a>
    <?php else: ?>
      <p>Article not found!</p>
    <?php endif; ?>
    </div>
    </div>
    <?php require_once '../includes/footer.php'; ?>