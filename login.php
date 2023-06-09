<?php

require 'includes/init.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $connect = require 'includes/db.php';

  if(User::authenticate($connect, $_POST['username'], $_POST['password'])){

    Auth::login();

    Url::redirect('/');

  }else{
    
    $error = "login incorrect";

  }

}

?>

<?php require_once 'includes/header.php'; ?>
<div class="row">
  <div class="col-lg-6 mx-auto  height">
    <h2>Login</h2>



    <form method="post">

      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user-tag"></i></span>
        <input class="form-control" name="username" id="username" placeholder="Login" aria-label="Username" >

        <?php if (! empty($error)): ?>

        <div>
          <?= $error ?>
        </div>
    
        <?php endif; ?>
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></i></span>
        <input type="password" name="password" id="password" class="form-control" placeholder="Hasło" aria-label="Username" >
      </div>

      <button class="btn btn-outline-dark">Log in</button>

    </form>
  </div>
</div>


<?php require_once 'includes/footer.php'; ?>
