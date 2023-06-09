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

if($_SERVER["REQUEST_METHOD"] == "POST"){

      $previous_image = $article->image_file;

      if ($article->setImageFile($connect, null)){

        if ($previous_image){

          unlink("../uploads/$previous_image");

        }

        Url::redirect("/admin/edit-article-image.php?id={$article->id}");

      }
    }
    
?>
<?php require_once '../includes/header.php'; ?>

<h2>Delete article image</h2>

  <?php if ($article->image_file) : ?>
      <img src="/uploads/<?= $article->image_file; ?>">
  <?php endif; ?>

<form method="post">

    <p>Are you sure?</a>

    <button>Delete</button>
    <a href="edit-article-image.php?id=<?= $article->id; ?>">Cancel</a>

</form>

<?php require_once '../includes/footer.php'; ?>