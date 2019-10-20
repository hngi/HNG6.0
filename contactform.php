<?php
require 'classControllers/init.php';

$contact_mail = new AdminClass;
$validation = new Validation();

if (isset($_POST['contact-btn'])) {

  //use this as an example to get form input data
  $name = $database->escape_string($_POST["name"]);
  $email = $database->escape_string($_POST["email"]);
  $subject = $database->escape_string($_POST["subject"]);
  $message = $database->escape_string($_POST["message"]);
  //validation of data
  $msg = $validation->check_empty($_POST, array('name', 'email', 'subject', 'message'));
  $check_email = $validation->is_email_valid($_POST['email']);
          // checking empty fields
          if ($msg != null) {
          } elseif (!$check_email) {
            $msg2 = 'Please provide proper email.';
          } else {

   //here is method that will submit mail to database table and you can find it in adminClass
    $send = $contact_mail->contactFormMailer($name, $email, $subject, $message);
    if ($send) {
      $name = $name;
      $subject = $subject;
      $body = $message;
      //here is the function to send mail to admin email
      contactMail($email, $name, $subject, $body);
      $mess = 'Message Sent, Thank you!';
    }
          }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Contact</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'>
  <link rel="stylesheet" href="css/contactform.css">
  <link rel="stylesheet" type="text/css" href="css/header-footer.css">
  <link rel="icon" type="img/png" href="images/hng-favicon.png">
</head>

<body class="container-fluid">
  <?php include('fragments/site_header.php'); ?>


  <div class="form1">
    <form class="form is-login" method="post">
      <h2 class="heading">Not a Frequently Asked Question?<br>Contact us below</h2>
      
        <?php
            if(!empty($error)){
                echo "<h4 class='text-danger text-center'>".$error."</h4>";
            }
             if(!empty($mess)){
                echo "<h4 class='text-success text-center' style='color: green;'>".$mess."</h4>";
            }
            if (!empty($msg)) {
              echo "<h4 class='text-danger text-center' style='color: red;'>".$msg."</h4>";
            }
            if (!empty($msg2)) {
              echo "<h4 class='text-danger text-center' style='color: red;'>".$msg2."</h4>";
            }
        ?>
      
      <div class="form__field">
        <i class="material-icons"> perm_identity </i>
        <input type="text" name="name" placeholder="Name">

      </div>
      <div class="form__field">
        <i class="material-icons">email</i>
        <input type="email" name="email" placeholder="Email">

      </div>
      <div class="form__field">
        <i class="material-icons">subject</i>
        <input type="text" name="subject" placeholder="Subject">
      </div>
      <div class="form__field">
        <i class="material-icons">create</i>
        <textarea minlength="20" name="message" placeholder="Write a message"></textarea>
      </div>
      <input type="submit" class="submit" name="contact-btn" value="SEND MESSAGE">
    </form>
  </div>

  <footer>
    <img src="https://res.cloudinary.com/jaycodist/image/upload/v1570722444/hng-brand-logo_gnplmq.svg">
    <nav>
      <section>
        <h2 class="skyblue-text">Quick Links</h2>
        <div id="link-list">
          <a href="join-intern.php" class="skyblue-text">Join HNG</a>
          <a href="index.php" class="skyblue-text">About HNG</a>
          <a href="donationpage.html" class="skyblue-text">Become a Sponsor</a>
          <a href="MentorSetUpPage2.php" class="skyblue-text">Sign up as Mentor</a>
        </div>
      </section>
      <section id="contact-section">
        <h2 class="skyblue-text">Contact Us</h2>
        <div>
          <a href="tel:+2348123456789">
            <strong>
              Phone: <br />
            </strong>
            +234 812 345 6789
          </a>
          <br />
          <a href="mailto:interns@hng.tech">
            <strong>
              Email: <br />
            </strong>
            interns@hng.tech
          </a>
        </div>
      </section>
      <section>
        <h2 class="skyblue-text">Office Address</h2>
        <p id="address">
          3 Birrel Avenue <br /> Sabo, Yaba, <br /> Lagos state
        </p>
      </section>
      <section>
        <h2 class="skyblue-text">Follow Us</h2>
        <div id="socials">
          <a href="https://twitter.com" title="Follow on Twitter!"><img src="https://res.cloudinary.com/jaycodist/image/upload/v1570722900/twitter-logo_m1mgzi.svg"></a>
          <a href="https://facebook.com"><img title="Follow on Facebook!" src="https://res.cloudinary.com/jaycodist/image/upload/v1570722900/facebook-logo_bw1hal.svg"></a>
          <a href="https://dribble.com"><img title="Follow on Dribble!" src="https://res.cloudinary.com/jaycodist/image/upload/v1570722900/dribble-logo_w4vwuz.svg"></a>
        </div>
      </section>
    </nav>
    <p class="center-text darkblue-text">&copy 2019, HNG Internship. All rights reserved.</p>
  </footer>
</body>

</html>