<?php 

session_start();

include ('server/connection.php');

if (isset($_SESSION['logged_in'])) {
  header('location: account.php');
  exit;
}

if (isset($_POST['login'])) {

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $conn->prepare("SELECT user_id,user_name,user_email,user_password FROM users WHERE user_email = ? AND user_password = ?");

  $stmt->bind_param("ss", $email, $password);

  if ($stmt->execute()) {
      $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
      $stmt->store_result();

      if ($stmt->num_rows() == 1) {
        $stmt->fetch();

        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['logged_in'] = true;

        header('location: account.php?login_success=logged in successfully');
      } else {
        header('location: login.php?error=Your password or email is incorrect');
      }
  } else {
    header('location: login.php?error=something went wrong');
  }

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
    <link rel="stylesheet" href="./assets/css/login.css">
  </head>
  <body>
    <?php 
      include('layout/navbar.php');
    ?>


    <!-- Login  -->
    <section class="my-4 py-5">
      <div class="login container text-center mt-3 pt-5 mb-5">
        <h2 class="login_title">Login</h2>
        <div class="line mx-auto" style="width: 100px; margin-top: 15px"></div>
      </div>
      <div class="container mx-auto">
        <form id="login-form" method="POST" action="login.php">
          <p style="color: red;" class="text-center">
            <?php if(isset($_GET['error'])) {echo $_GET['error'];}?>
          </p>
          <div class="form-group text-center">
            <input type="email" class="form-control" id="login-email" name="email" placeholder="Email">
          </div>
          <div class="form-group text-center">
            <input type="password" class="form-control" id="login-password" name="password" placeholder="Password">
          </div>
          <div class="form-group text-center">
            <input type="submit" class="button" name="login" id="login-btn" value="Login" style="border-radius: 10px;">
          </div>
          <div class="form-group text-center">
            <a href="register.php" id="login-url" class="btn">Don't have an account ? Register</a>
          </div>
        </form>
      </div>
    </section>


    <?php 
      include('layout/footer.php');
    ?>
