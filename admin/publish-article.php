<?php
require '../includes/init.php';

Auth::requireLogin();

$connect = require '../includes/db.php';

$article = Article::getByID($connect, $_POST['id']);

$published_at = $article->publish($connect);

?> <time><?= $published_at ?></time>