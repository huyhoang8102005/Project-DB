<?php 
include('server/connection.php');
include('server/get_featured_products.php');

if (isset($_GET['product_id'])) {

  $product_id = $_GET['product_id'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
  $stmt->bind_param("i",$product_id);

  $stmt->execute();

  $product = $stmt->get_result();
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
    <link rel="stylesheet" href="./assets/css/single-product.css">
    <link rel="stylesheet" href="assets/css/featured.css" />
  </head>
  <body>
    <?php 
      include('layout/navbar.php');
    ?>


    <!-- Single-product  -->
    <section class="single-product my-5 pt-5">
      <div class="container">
        <div class="row mt-5">

       <?php while($row = $product->fetch_assoc()){ ?>
          <div class="col-lg-5">
            <img class="img-fluid w-100 pb-1 single-product_img" src="assets/img/shop_img/<?php echo $row['product_image']; ?>" alt="" id="mainImg">
            <div class="small-img-group mt-4">
              <div class="small-img-col">
                <img src="assets/img/shop_img/<?php echo $row['product_image']; ?>" width="100%" alt="" class="small-img">
              </div>
              <div class="small-img-col">
                <img src="assets/img/shop_img/<?php echo $row['product_image2']; ?>" width="100%" alt="" class="small-img">
              </div>
              <div class="small-img-col">
                <img src="assets/img/shop_img/<?php echo $row['product_image3']; ?>" width="100%" alt="" class="small-img">
              </div>
              <div class="small-img-col">
                <img src="assets/img/shop_img/<?php echo $row['product_image4']; ?>" width="100%" alt="" class="small-img">
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <h6 class="single-product_type-product">Men/Shoes</h6>
            <h3 class="py-4 single-product_title"><?php echo $row['product_name']; ?></h3>
            <h2 class="single-product_price">$<?php echo $row['product_price']; ?></h2>
            <form method="POST" action="cart.php">
              <input type="hidden" name="product_id" value="<?php echo $row       ['product_id'];?>">
              <input type="hidden" name="product_image" value="<?php echo $row       ['product_image'];?>">
              <input type="hidden" name="product_name" value="<?php echo $row       ['product_name'];?>">
              <input type="hidden" name="product_price" value="<?php echo $row       ['product_price'];?>">
              <input type="number" name="product_quantity" value="1" class="single-product_input">
              <button class="button" type="submit" name="add_to_cart">Add To Cart</button>
            </form>
            <h4 class="mt-5 mb-3">Product details</h4>
            <span style="line-height: 24px;"><?php echo $row['product_description']; ?></span>
          </div>

       <?php }?>

        </div>
      </div>
    </section>

     <!-- Related product  -->
     <section class="featured">
      <div class="container">
        <div class="featured_top text-center mt-5 py-5">
          <h2>Related Products</h2>
          <hr />
          <p class="featured_top-desc">
            Here you can check out our featured products
          </p>
        </div>
        <div class="row">
          <?php while($row = $featured_products->fetch_assoc()){ ?>
            <div class="product text-center col-lg-3">
              <img src="./assets/img/shop_img/<?php echo $row['product_image']; ?>" alt="" class="product_img" />
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="product_name"><?php echo $row['product_name']; ?></h5>
              <h4 class="product_price"><?php echo $row['product_price']; ?></h4>
              <button class="button product_button"><a href="<?php echo "single_product.php?product_id=".$row['product_id'];?>">Buy Now</a></button>
            </div>
          <?php }?>
        </div>
      </div>
    </section>

    <!-- Footer  -->
    <footer class="footer">
      <div class="container">
        <div class="footer_inner">
          <div class="footer_left">
            <img src="./assets/img/footer_logo.svg" alt="" class="footer_logo" />
            <p>2023 Sehlvet . All Rights Reserved</p>
            <ul class="footer_society">
              <li>
                <img src="./assets/img/facebook.svg" alt="" class="footer_icon" />
              </li>
              <li>
                <img src="./assets/img/in.svg" alt="" class="footer_icon" />
              </li>
              <li>
                <img src="./assets/img/ins.svg" alt="" class="footer_icon" />
              </li>
              <li>
                <img src="./assets/img/twi.svg" alt="" class="footer_icon" />
              </li>
            </ul>
          </div>
          <div>
            <div class="footer_page">
              <h5>Home</h5>
              <h5>Collections</h5>
              <h5>Brands</h5>
              <h5>About Us</h5>
            </div>
          </div>
          <div>
            <div class="footer_contact">
              <h5>Contact Us</h5>
              <h5>525-252-4244</h5>
              <h5>sehlvet@gmail.com</h5>
              <h5>www.selvet.com</h5>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script>

      var mainImg = document.getElementById("mainImg");
      var smallImgs = document.querySelectorAll(".small-img");

      smallImgs.forEach(smallImg => {
        smallImg.onclick = () => mainImg.src = smallImg.src
      })

    </script>
  </body>
</html>
