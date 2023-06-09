<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

require 'includes/init.php';

require 'includes/header.php'; 

$email = '';
$subject = '';
$message = '';
$sent = false;

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  $errors = [];

  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
    $errors['email'] = 'Please enter a valid email address';
  }

  if ($subject == ''){
    $errors['subject'] = 'Please enter a subject';
  }

  if ($message == ''){
    $errors['message'] = 'Please enter a message';
  }

  if (empty($errors)){

    $mail = new PHPMailer(true);

    try {

      $mail->isSMTP();
      $mail->Host = SMTP_HOST;
      $mail->SMTPAuth = true;
      $mail->Username = SMTP_USER;
      $mail->Password = SMTP_PASS;
      $mail->SMTPSecure = 'ssl';
      $mail->Port = SMTP_PORT;

      $mail->setFrom(SMTP_USER);
      $mail->addAddress(SMTP_USER);
      $mail->addReplyTo($email);
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = $message;

      $mail->send();

      $sent = true;
    }catch (Exception $e){

      $errors['mail'] = $mail->ErrorInfo;

    }

  }

}


?>
<div class="row">
  <div class="col-lg-6 rounded mx-auto mb-3">
    <h2>Kontakt</h2>
    <p>Jeżeli potrzebujesz się ze mną skontaktować, wypełnij poniższy formularz.</p>

    <?php if ($sent) :?>
      <p>Message sent. </p>
    <?php else: ?>
      <?php if (! empty($errors['mail'])) : ?>
          <div><?= $errors['mail']?></div>
          <?php endif ; ?>
<div class="row justify-content-center register-form ">
  <div class="col-lg-12 ">
    <form method="post" id="formContact">

        <div class="input-group mb-3 contact-section">
          <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-at"></i></span>
            <input class="form-control" name="email" id="email" placeholder="email" type="email"  value="<?= htmlspecialchars($email) ?>">
        
        <?php if (! empty($errors['email'])) : ?>
          <div><?= $errors['email']?></div>
          <?php endif ; ?>
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-message"></i></span>
            <input class="form-control" name="subject" id="subject" placeholder="Temat" value="<?= htmlspecialchars($subject) ?>">
        </div>
        <?php if (! empty($errors['subject'])) : ?>
          <div><?= $errors['subject']?></div>
          <?php endif ; ?>

        <div class="input-group mb-3">
          <span class="input-group-text">Wiadomość</span>
            <textarea class="form-control"  name="message" id="message"><?= htmlspecialchars($message) ?></textarea>
        </div>
        <?php if (! empty($errors['message'])) : ?>
          <div><?= $errors['message']?></div>
          <?php endif ; ?>

        <button class="btn btn-outline-dark">Wyślij</button>

    </form>
  </div>
</div>
  </div>
</div>
<?php endif ;?>
<?php require 'includes/footer.php'; ?>
