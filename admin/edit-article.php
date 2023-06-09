<?php

require '../includes/init.php';

Auth::requireLogin();

mysqli_report(MYSQLI_REPORT_STRICT);

$connect = require '../includes/db.php';

if (isset($_GET['id'])) {

  $article = Article::getByID($connect, $_GET['id']);

  if( ! $article){
  
    die('article not found');

  }
}else{

  die('id not supplied, article not found');

}

$category_ids = array_column($article->getCategories($connect), 'id');
$categories = Category::getAll($connect);

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $article->title = $_POST['title'];
  $article->content = $_POST['content'];
  $article->published_at = $_POST['published_at'];

  $category_ids = $_POST['category'] ?? [];

    if ($article->update($connect)){

      $article->setCategories($connect, $category_ids);
  
      Url::redirect("/admin/article.php?id={$article->id}");
      
    }
  }
  



?>
<?php require_once '../includes/header.php'; ?>
<div class="row">
  <div class="col-lg-6 mx-auto">
<h2>Edit article</h2>

<?php require 'includes/article-form.php'; ?>
</div>
</div>
<?php require_once '../includes/footer.php'; ?>