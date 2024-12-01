<?php include('header.php'); ?>

<?php 

include ('../server/connection.php');

if (isset($_SESSION['admin_logged_in'])) {
  header('location: dashboard.php');
  exit;
}

if (isset($_POST['login'])) {

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $conn->prepare("SELECT admin_id,admin_name,admin_email,admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");

  $stmt->bind_param("ss", $email, $password);

  if ($stmt->execute()) {
      $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
      $stmt->store_result();

      if ($stmt->num_rows() == 1) {
        $stmt->fetch();

        $_SESSION['admin_id'] = $admin_id;
        $_SESSION['admin_name'] = $admin_name;
        $_SESSION['admin_email'] = $admin_email;
        $_SESSION['admin_logged_in'] = true;

        header('location: dashboard.php?login_success=logged in successfully');
      } else {
        header('location: login.php?error=Your password or email is incorrect');
      }
  } else {
    header('location: login.php?error=something went wrong');
  }

}
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
        </form>
      </div>
    </section>
