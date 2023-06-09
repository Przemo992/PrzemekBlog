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

  if($article->delete($connect)){
      
      Url::redirect("/admin/index.php");
      
    }
  }
?>
<?php require_once '../includes/header.php'; ?>

<h2> Delete article</h2>
<p> Are you sure? </p>
<form method="post">

    <button> Delete </button>

</form>
<a href="article.php?id=<?=$article->id;?>">Cancel</a>
<?php require_once '../includes/footer.php'; ?>