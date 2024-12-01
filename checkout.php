<?php 

session_start();

if (!empty($_SESSION['cart']) && isset($_POST['checkout'])) {



} else {
  header('location: home.php');
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
    <link rel="stylesheet" href="./assets/css/checkout.css">
  </head>
  <body>
    <?php 
      include('layout/navbar.php');
    ?>


    <!-- Checkout  -->
     <section class="checkout my-5 py-5">
      <div class="container text-center mt-3 pt-3">
        <h2 class="checkout_title">Checkout</h2>
        <div class="line mx-auto" style="width: 60px;"></div>
      </div>
      <div class="mx-auto container">
        <form id="checkout-form" method="POST" action="server/place_order.php">
          <div class="form-group checkout_small-element">
            <label for="">Name</label>
            <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Full Name">
          </div>
          <div class="form-group checkout_small-element">
            <label for="">Email</label>
            <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email">
          </div>
          <div class="form-group checkout_small-element">
            <label for="">Phone</label>
            <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Your phone">
          </div>
          <div class="form-group checkout_small-element">
            <label for="">City</label>
            <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City">
          </div>
          <div class="form-group checkout_large-element">
            <label for="">Address</label>
            <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Your Address">
          </div>
          <div class="form-group mt-3 checkout_button">
            <p style="color: #754F23; font-weight: 500" class="mb-3">Total amount: $<?php echo $_SESSION['total'];?></p>
            <input type="submit" class="button" id="checkout-btn" name="place_order" value="Place order">
          </div>
        </form>
      </div>
     </section>


     <?php 
      include('layout/footer.php');
    ?>
