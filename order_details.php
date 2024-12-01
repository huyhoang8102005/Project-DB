<?php 

include('server/connection.php');


if (isset($_POST['order_detail_btn']) && isset($_POST['order_id'])) {
  $order_id = $_POST['order_id']; 
  $order_status = $_POST['order_status'];

  $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");

  $stmt->bind_param("i", $order_id);

  $stmt->execute();

  $order_details = $stmt->get_result();

  $total_order_price = caculateTotalOrderPrice($order_details);

} else {
  header('location: account.php');
  exit;
};

function caculateTotalOrderPrice($order_details) {
  $total = 0;

    foreach($order_details as $row) {
    $product_price = $row['product_price'];
    $product_quantity = $row['product_quantity'];

    $total = $total + ($product_price * $product_quantity);
  };

  return $total;
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
    <link rel="stylesheet" href="assets/css/order_detail.css">
  </head>
  <body>
    <?php 
      include('layout/navbar.php');
    ?>


    <!-- Order detail -->
    <section class="order_detail container my-5 py-5">
      <div class="mt-5 text-center">
        <h2 class="order_detail-title">Order detail</h2>
        <div style="width: 500px;" class="line mx-auto"></div>
      </div>
      <div>
          <div class="order_detail-top text-center">
            <p>Product</p>
            <p>Price</p>
            <p>Quantity</p>
          </div>
          <?php foreach($order_details as $row){?>        
            <div class="order_detail-content mt-4 text-center">
              <div class="order_detail-product">
                <img src="./assets/img/shop_img/<?php echo $row['product_image'];?>" alt="">
                <p><?php echo $row['product_name']; ?></p>
              </div>
              <span>$<?php echo $row['product_price'];?></span>
              <span><?php echo $row['product_quantity'];?></span>
            </div>
          <?php }?>
      </div>

      <?php if ($order_status == "not paid"){ ?>
        <form style="float: right;" action="payment.php" method="POST">
          <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
          <input type="hidden" name="total_order_price" value="<?php echo $total_order_price ?>">
          <input type="hidden" name="order_status" value="<?php echo $order_status ?>">
          <input type="submit" name="order_pay_btn" class="button" value="Pay Now">
        </form>
      <?php }?>
            
    </section>  


    <?php 
      include('layout/footer.php');
    ?>
