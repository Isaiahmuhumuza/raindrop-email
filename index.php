<?php

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';



// if (isset($_POST['submit-message'])) {
if (isset($_POST['email'])) {
  $mail = new PHPMailer(true);

  $contact_email = $_POST['email'];

  try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Port       = 465;                              // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->Host       = 'smtp.gmail.com';                              // Set the SMTP server to send through
    $mail->Password   = 'unrxnjjviqvpnrdy';                     // SMTP password
    $mail->Username   = 'isaiahmuhumuza@gmail.com';                     // SMTP username
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;                         // Enable verbose debug output
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged

    //Recipients
    $mail->addReplyTo($contact_email);
    $mail->setFrom($mail->Username);
    $mail->addAddress($contact_email);
    $mail->addBCC($mail->Username);

    

    // Content
    $mail->isHTML(true);
    $mail->Subject = "Message From";

    $body = file_get_contents("mail/raindrop-email.html");

    $mail->addEmbeddedImage('mail/images/background.png', 'background_image');

    $mail->msgHTML($body, dirname(__FILE__) . '/mail');

    $email_sent = $mail->send();
  } catch (Exception $e) {
    $email_sent = false;
  }
}
// }

?>


<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/assets/styling/styles.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa&family=Lato&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <link rel="stylesheet" href="/assets/font awesome/css/fontawesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="icon" href="assets/images/Logo/icon.png" type="image/x-icon">


  <title>Raindrop Designs - Coming soon</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div style="height: 325px" class="col-12">
        <img src="/assets/images/Logo/Raindrop Productions Logo.svg" alt="" width="250vw" />
      </div>
      <div class="main">
        <div class="col-12">
          <h1 style="font-size: 25px">
            We'll notify you as soon as the site <br />
            is live!
          </h1>
          <br />
          <div style="height: 325px; padding: 0px">
            <form method="post">
              <input type="email" id="email" name="email" size="20" placeholder="Enter email..." style="padding: 5px; border: none" required />
              <input name="submit-message" class="btn-1" type="submit" value="Submit" />
            </form>
            <div id="validation">
              <?php if (isset($email_sent) && $email_sent) : ?>
                <p id="success" style="color: green;">Your email has sent successfully!</p>
              <?php elseif (isset($email_sent) && !$email_sent): ?>
                <p id="error" style="color: red;">Error Sending message, Please try again.</p>
              <?php endif; ?>
              <p></p>
            </div>
          </div>
        </div>


        <div class="container" style="padding: 0vw 20vw">
          <div class="row justify-content-md-center">
            <div class="col-3">
              <i class="fa fa-instagram fa-2x" aria-hidden="true"></i>
            </div>
            <div class="col-3">
              <i class="fa fa-github fa-2x" aria-hidden="true"></i>
            </div>
            <div class="col-3">
              <i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i>
            </div>
            <div class="col-3">
              <i class="fa fa-linkedin fa-2x" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <style>
    body {
  margin: auto !important;
  text-align: center !important;
  padding: 90px 0px 60px 0px!important;
  font-family: 'Lato', sans-serif;
  background-image: url(/assets/images/Background/Gradient-shapes.png);
  background-repeat: no-repeat;
  background-size: cover;
}

    i {
      transition: 0.3s ease;
    }

    i:hover {
      cursor: pointer;
      transform: translate(0px, -10px);
    }

    .btn-1 {
      margin-left: 5px;
      padding: 4px;
      background-color: transparent;
      border: solid black 1px;
      color: black;
      transition: 0.3s ease;
    }

    .btn-1:hover {
      border: solid white 1px;
        color: white;
      background-color: #00000023;
    }

    img {
      animation: 0.3s ease-in 0s 1 slideInTop;
    }


    .main {
      animation: fadeInAnimation ease 3s;
      animation-iteration-count: 1;
      animation-duration: 3s;
    }

    @keyframes slideInTop {
      0% {
        transform: translateY(-200%);
      }

      100% {
        transform: translateY(0);
      }
    }

    @keyframes fadeInAnimation {
      0% {
        opacity: 0;
      }

      100% {
        opacity: 1;
      }
    }
  </style>
</body>

<script>
  setTimeout(function() {
    document.getElementById('validation').style.display = 'none';
  }, 8000);
</script>

</html>