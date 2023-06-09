<?php
require '../includes/init.php';

Auth::requireLogin();

$article = new Article();


$category_ids = [];

$connect = require '../includes/db.php';

$categories = Category::getAll($connect);

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $article->title = $_POST['title'];
  $article->content = $_POST['content'];
  $article->published_at = $_POST['published_at'];

  $category_ids = $_POST['category'] ?? [];

    if ($article->create($connect)){

      $article->setCategories($connect, $category_ids);
  
      Url::redirect("/admin/article.php?id={$article->id}");
      
    }
  }


?>

<?php require_once '../includes/header.php'; ?>
<div class="row">
  <div class="col-lg-6 mx-auto">
    <h2>New article</h2>

    <?php require 'includes/article-form.php'; ?>
  </div>
</div>
<?php require_once '../includes/footer.php'; ?>
