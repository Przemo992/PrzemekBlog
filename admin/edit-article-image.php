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

  try{

    if (empty($_FILES)){
      throw new Exception('Invalid upload');
    }

    switch ($_FILES['file']['error']){

      case UPLOAD_ERR_OK:
        break;
      case UPLOAD_ERR_NO_FILE:
          throw new Exception('No file uploaded');
          break;
      case UPLOAD_ERR_INI_SIZE:
          throw new Exception('File is too large (from the server settings)');
          break;
      default:
          throw new Exception('An error occured');

    }

    $mime_types = ['image/gif', 'image/png', 'image/jpeg'];

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

    if ( ! in_array($mime_type, $mime_types)){

      throw new Exception('Invalid file type');

    }

    $pathinfo = pathinfo($_FILES['file']['name']);

    $base = $pathinfo['filename'];

    $base = preg_replace('/[^a-zA-Z0-9_-]/' , '_', $base);

    $base = mb_substr($base, 0, 200);

    $filename = $base . "." . $pathinfo['extension'];

    $destination = "../uploads/$filename";

    $i = 1;

    while (file_exists($destination)){

      $filename = $base . "-$i." . $pathinfo['extension'];
      $destination = "../uploads/$filename";

      $i++;

    }

    if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)){

      $previous_image = $article->image_file;

      if ($article->setImageFile($connect, $filename)){

        if ($previous_image){

          unlink("../uploads/$previous_image");

        }

        Url::redirect("/admin/edit-article-image.php?id={$article->id}");

      }
    }else{

      throw new Exception('Unable to move uploaded file');

    }

  } catch(Exception $e) {
    $error = $e->getMessage();
  }
}
  



?>
<?php require_once '../includes/header.php'; ?>
<div class="row">
  <div class="col-lg-9 mx-auto">
<h2>Edit article image</h2>

  <?php if ($article->image_file) : ?>
      <img class="edit-image mb-3" src="/uploads/<?= $article->image_file; ?>">
      <p><a class="delete btn btn-outline-danger" role="button" href="delete-article-image.php?id=<?= $article->id; ?>">Delete</a></p>
  <?php endif; ?>

  <?php if (isset($error)) : ?>

    <p><?= $error ?> </p>

    <?php endif; ?>

<form method="post" enctype="multipart/form-data">

<div class="input-group mb-3 pe-5">
  <input class="form-control" type="file" name="file" id="file">
</div>

<button class="btn btn-outline-primary">Upload</button>

</form>
  </div>
  </div>

<?php require_once '../includes/footer.php'; ?>