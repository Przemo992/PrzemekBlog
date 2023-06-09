<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Przemysław Madej</title>
  <link rel="icon" href="favicon.ico">

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bungee+Outline&family=Delicious+Handrawn&family=Montserrat:wght@400;900&family=Open+Sans&family=Sacramento&family=Ubuntu&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../css/styles.css">
</head>

<body>

      <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="navbar-brand" href="/" >Przemysław Madej</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>

            <?php if (Auth::isLoggedIn()) : ?>

            <li class="nav-item"><a class="nav-link" href="/admin/">Admin</a></li>
            <li class="nav-item"><a class="nav-link" href="/logout.php">Log out</a></li>

            <?php else : ?>

            <li class="nav-item"><a class="nav-link" href="/login.php">Log in</a></li>

            <?php endif; ?>

            <li class="nav-item"><a class="nav-link" href="/contact.php">Kontakt</a></li>
          </ul>

        </div>
      </nav>

  <main id="middle">