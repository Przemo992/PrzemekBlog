<?php

require '../includes/init.php';

Auth::requireLogin();

mysqli_report(MYSQLI_REPORT_STRICT);

$connect = require '../includes/db.php';


$paginator = new Paginator($_GET['page'] ?? 1, 6, Article::getTotal($connect));

$articles = Article::getPage($connect, $paginator->limit, $paginator->offset);


?>
<?php require_once '../includes/header.php'; ?>


<div class="row">
  <div class="col-lg-6 mx-auto">
    <h2>Administration</h2>

    <p><a class="btn btn-outline-secondary" role="button" href="new-article.php">New article</a></p>

    <?php if (empty($articles)) : ?>
    <p>No articles found!</p>
    <?php else : ?>
    <table class="table table-hover">
      <thead>
        <th scope="col">Title</th>
        <th scope="col">Published</th>
      </thead>
      <tbody>
        <?php foreach ($articles as $article) : ?>
        <tr>
          <th scope="row">
            <a href="article.php?id=<?=$article['id'];?>">
              <?= htmlspecialchars($article['title']); ?>
            </a>

          </th>
          <th scope="row">
            <?php if ($article['published_at']) : ?>
            <time>
              <?= $article['published_at'] ?>
            </time>
            <?php else : ?>
            Unpublished
            <button class="publish btn btn-outline-dark" data-id="<?= $article['id'] ?>">Opublikuj</button>
            <?php endif ; ?>
          </th>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <?php require '../includes/pagination.php'; ?>

    <?php endif; ?>
  </div>
</div>

    <?php require_once '../includes/footer.php'; ?>