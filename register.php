<?php 

session_start();

include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
  header('location: account.php');
  exit;
};

if (isset($_POST['register'])) {
  $name = $_POST['name']; 
  $email = $_POST['email']; 
  $password = $_POST['password'];
  $confirmpassword = $_POST['confirm-password'];

  // if password is incorrect
  if ($password !== $confirmpassword) {
    header('location: register.php?error=passwords do not match');

  // if password is less than 6 characters
  } elseif (strlen($password) < 6) {
    header('location: register.php?error=password must be at least 6 characters');
  // if no error
  } else {
    // check exist user
    $stmt1 = $conn->prepare("SELECT count(*) FROM users where user_email = ?");
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();
    if ($num_rows != 0) {
      header('location: register.php?error=user with email has already exist');
    } else {
      // create a new user
      $stmt = $conn->prepare("INSERT INTO users (user_name,user_email,user_password) 
      VALUE (?,?,?)");
      $stmt->bind_param("sss", $name,$email,md5($password));


      if ($stmt->execute()) {
          $user_id = $stmt->insert_id;
          $_SESSION['user_id'] = $user_id;
          $_SESSION['user_email'] = $email;
          $_SESSION['name'] = $name;
          $_SESSION['logged_in'] = true;
          header('location: account.php?register_success=You registered successfully');
      } else {
         header('location: register.php?error=could not create an account at the moment');
      }
    }
  }
  // if user has already registered so direct to account.php
} 


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SHOP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/reset.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/index.css" />
    <link rel="stylesheet" href="assets/css/navbar.css" />
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/register.css">
  </head>
  <body>
    <?php 
      include('layout/navbar.php');
    ?>


    <!-- Register  -->
    <section class="my-4 py-5">
      <div class="register container text-center mt-2 pt-4 mb-5">
        <h2 class="register_title">Register</h2>
        <div class="line mx-auto" style="width: 100px; margin-top: 15px"></div>
      </div>
      <div class="container mx-auto">
        <form id="register-form" method="POST" action="register.php">
          <p style="color: red;" class="text-center">
            <?php if(isset($_GET['error'])) {echo $_GET['error'];}?>
          </p>
          <div class="form-group text-center">
            <input type="text" class="form-control" id="register-name" name="name" placeholder="Full Name">
          </div>
          <div class="form-group text-center">
            <input type="email" class="form-control" id="register-email" name="email" placeholder="Email">
          </div>
          <div class="form-group text-center">
            <input type="password" class="form-control" id="register-password" name="password" placeholder="Password">
          </div>
          <div class="form-group text-center">
            <input type="password" class="form-control" id="register-confirm-password" name="confirm-password" placeholder="Confirm Password">
          </div>
          <div class="form-group text-center">
            <input type="submit" class="button" name="register" id="register-btn" value="Register" style="border-radius: 10px;">
          </div>
          <div class="form-group text-center">
            <a href="login.php" id="register-url" class="btn">You've already account ? Login</a>
          </div>
        </form>
      </div>
    </section>


    <?php 
      include('layout/footer.php');
    ?>
