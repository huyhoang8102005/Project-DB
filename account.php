<?php 

session_start();

include('server/connection.php');

if (!isset($_SESSION['logged_in'])) {
  header("location: login.php");
  exit;
}

if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_email']);
    header('location: login.php');
    exit;
  }
}


if (isset($_POST['changePasswordBtn'])) {
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm-password'];
  $user_email = $_SESSION['user_email'];

  if ($password !== $confirmPassword) {
    header("location: account.php?error=password do not match");
  } elseif (strlen($password) < 6) {
    header('location: account.php?error=password must be at least 6 characters');
  }
  else {
    $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email =?");
    $stmt->bind_param("ss", md5($password), $user_email);

    if ($stmt->execute()) {
      header("location: account.php?message=password has been updated");
    } else {
      header("location: account.php?message=could not update your password");
    }
  }
}

// get orders

if (isset($_SESSION['logged_in'])) {
  $user_id = $_SESSION['user_id'];
  $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");

  $stmt->bind_param("i", $user_id);

  $stmt->execute();

  $orders = $stmt->get_result();

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
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/index.css" />
    <link rel="stylesheet" href="assets/css/navbar.css" />
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/account.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="assets/css/orders.css">
  </head>
  <body>
    <?php 
      include('layout/navbar.php');
    ?>


    <!-- Account  -->
     <section class="account my-5 pt-5">
      <div class="row container">
        <div class="col-6 text-center">
          <div class="account-left">
          <p class="mb-3" style="color: green;"><?php if(isset($_GET['register_success'])) {echo $_GET['register_success'];}?></p>
          <p class="mb-3" style="color: green;"><?php if(isset($_GET['login_success'])) {echo $_GET['login_success'];}?></p>
            <h2 class="account_info">Account Info</h2>
            <div class="line mx-auto" style="width: 60px;"></div>
            <div class="account_info-content">
              <p style="color: black;">Name: 
                <span>
                  <?php if(isset($_SESSION['user_name'])) {echo $_SESSION['user_name'];}?>
                </span>
            </p>
              <p style="color: black;">Email: 
                <span>
                  <?php if(isset($_SESSION['user_email'])) {echo $_SESSION['user_email'];}?>
                </span>
              </p>
              <div>
                <a href="#orders" class="account_orders">Your orders</a>
              </div>
              <div>
                <a href="account.php?logout=1 " class="button account_logout">Logout</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6 text-center">
          <p class="mb-3" style="color: red;"><?php if(isset($_GET['error'])) {echo $_GET['error'];}?></p>
          <p class="mb-3" style="color: green;"><?php if(isset($_GET['message'])) {echo $_GET['message'];}?></p>
          <h2 class="change-password">Change Password</h2>
          <div class="line mx-auto" style="width: 60px;"></div>
          <form id="account-form" method="POST" action="account.php">
            <div class="form-group text-center">
              <input type="password" class="form-control" id="account-password" name="password" placeholder="Password">
            </div>
            <div class="form-group text-center">
              <input type="password" class="form-control" id="account-confirm-password" name="confirm-password" placeholder="Confirm password">
            </div>
            <div class="form-group text-center">
              <input type="submit" class="button" name="changePasswordBtn" id="register-btn" value="Change">
            </div>
        </div>
      </div>
     </section>

    <!-- Your orders  -->
    <section id="orders" class="orders container my-5 py-5">
      <div class="mt-5 text-center">
        <h2 class="orders_title">Your Orders</h2>
        <div style="width: 500px;" class="line mx-auto"></div>
      </div>
      <div class="order_top">
        <p>Order ID</p>
        <p>Order Cost</p>
        <p>Order Status</p>
        <p>Order Date</p>
        <p>Order Details</p>
      </div>
      <?php foreach($orders as $row){?>
        <div class="order_content mt-4">
          <div><?php echo $row['order_id'];?></div>
          <div>$<?php echo $row['order_cost'];?></div>
          <div><?php echo $row['order_status'];?></div>
          <div><?php echo $row['order_date'];?></div>
          <div>
            <form class="form" method="POST" action="order_details.php">
              <input type="hidden" value="<?php echo $row['order_status'];?>" name="order_status"/>
              <input type="hidden" value="<?php echo $row['order_id'];?>" name="order_id"/>
              <input type="submit" value="detail" class="button_detail" name="order_detail_btn"/>
            </form>
          </div>
        </div>
      <?php }?>
    </section>  


<?php 
  include('layout/footer.php');
?>