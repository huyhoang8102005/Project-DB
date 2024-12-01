<?php 

session_start();

// if user has yet logged in
if (!isset($_SESSION['logged_in'])) {
  header('location: login.php');
  exit;

  // if user logged in
} else {
  // function caculateTotalCart()
  function caculateTotalCart() {
    $total = 0;
    $total_quantity = 0;

    foreach($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total = $total + ($price * $quantity);
        $total_quantity = $total_quantity + $quantity;
    }

    $_SESSION['total'] = $total;
    $_SESSION['total_quantity'] = $total_quantity;
  }

  if (isset($_POST['add_to_cart'])) {
    // If user has already added a product to the cart
    if (isset($_SESSION['cart'])) {
      $product_array_ids = array_column($_SESSION['cart'],"product_id");
      if (!in_array($_POST['product_id'], $product_array_ids)) {
          $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity'],
          );
          $_SESSION['cart'][$_POST['product_id']] = $product_array;
      } else {
        echo '<script>alert("Product was already to cart")</script>';
      }
    } 
    // If this is the first time the user has addded a cart
    else {
      $product_id = $_POST['product_id'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];
      $product_array = array(
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'product_image' => $product_image,
        'product_quantity' => $product_quantity
      );
  
      $_SESSION['cart'][$product_id] = $product_array;
    }
  
    // Caculate total when adding a new product
    caculateTotalCart();
  
  } elseif(isset($_POST['remove_product'])) {
      $product_id = $_POST['product_id'];
      unset($_SESSION['cart'][$product_id]);
  
      // Caculate total when remove product
      caculateTotalCart();
  
  
  } elseif(isset($_POST['edit_quantity'])) {
      $product_id = $_POST['product_id'];
      $product_quantity = $_POST['product_quantity'];
  
      $product_array = $_SESSION['cart'][$product_id];
      $product_array['product_quantity'] = $product_quantity;
  
      $_SESSION['cart'][$product_id] = $product_array;
  
       // Caculate total when edit quantity
       caculateTotalCart();
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
    <link rel="stylesheet" href="./assets/css/cart.css">
  </head>
  <body>
    <?php 
      include('layout/navbar.php');
    ?>


    <!-- Cart  -->
    <section class="cart container my-5 py-5">
      <div class="mt-5">
        <h2 class="cart_title">Your cart</h2>
        <div class="line"></div>
      </div>
      <table class="mt-5 pt-5 cart_table">
        <tr class="d-flex justify-content-between" style="background-color:#754F23">
          <th>Product</th>
          <th>Quantity</th>
          <th>Subtotal</th>
        </tr>

       <?php if(isset($_SESSION['cart'])){ ?> 
        <?php foreach($_SESSION['cart'] as $key => $value){?>
          <tr class="d-flex justify-content-between align-items-center">
            <td>
              <div class="cart_product-info">
                <img src="./assets/img/shop_img/<?php echo $value['product_image'];?>" alt="" class="cart_img">
                <div class="cart_product-des">
                  <p class="cart_product-name"><?php echo $value['product_name'];?></p>
                  <div>
                    <p class="cart_product-price">$<?php echo $value['product_price'];?></p>
                    <form method="POST" action="cart.php">
                      <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
                      <input type="submit" name="remove_product" class="remove-btn" value="Remove"/>
                    </form>
                  </div>
                </div>
              </div>
            </td>

            <td>
              <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
                <input type="number" name="product_quantity" value="<?php echo $value['product_quantity'];?>" class="w-25 ps-1">
                <input type="submit" class="edit-btn" name="edit_quantity" value="Edit"/>
              </form>
            </td>

            <td>
              <span>$</span>
              <span class="cart_price-total"><?php echo $value['product_quantity'] * $value['product_price'];?></span>
            </td>
          </tr>
        <?php }?>
       <?php }?>

      </table>

      <div class="cart_total">
        <?php if(isset($_SESSION['cart'])){?>
          <div class="line" style="width: 300px;"></div>
        <?php };?>
        <div class="cart_end-total">
          <?php if(isset($_SESSION['cart'])){?>
            <p>Total:</p>
           <p>$<?php echo $_SESSION['total'];?></p>
          <?php };?>
        </div>
      </div>

      <div class="cart_checkout">
        <form method="POST" action="checkout.php">
         <?php if(isset($_SESSION['cart'])){?>
            <input type="submit" class="cart_btn" value="Checkout" name="checkout" />
         <?php };?>
        </form>
      </div>

    </section>  

    <?php 
      include('layout/footer.php');
    ?>
