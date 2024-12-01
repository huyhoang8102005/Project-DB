<?php 
  session_start();
  
  include('layout/navbar.php');
  include('server/get_featured_products.php');
  include('server/get_bags.php');
  include('server/get_shoes.php');
  include('server/get_coats.php');
  include('server/get_watches.php');

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CAT SHOP</title>
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
    <link rel="stylesheet" href="assets/css/hero.css" />
    <link rel="stylesheet" href="assets/css/brand.css" />
    <link rel="stylesheet" href="assets/css/new.css" />
    <link rel="stylesheet" href="assets/css/featured.css" />
    <link rel="stylesheet" href="assets/css/clothes.css" />
    <link rel="stylesheet" href="assets/css/footer.css">
  </head>
  <body>
     

    <!-- Hero -->
    <section class="hero">
      <div class="container">
        <div class="hero_inner">
          <div class="hero_left">
            <h1 class="hero_left-content">Elevate Style, Embrace Story</h1>
            <h5 class="hero_left-desc">
              We provide the largest clothing collection for any season. You can
              choose trendy or classy design according to your preferences. Our
              services are super fast and we update within 24 hours.
            </h5>
            <a href="shop.php"><button class="hero_button button" style="width: 160px;">Shop Now</button></a>
          </div>
          <div class="hero_right">
            <img class="hero_img" src="./assets/img/hero_img.png" alt="" />
          </div>
        </div>
      </div>
    </section>

    <!-- Brand  -->
    <section class="brand">
      <div class="container">
        <div class="brand_inner">
          <img src="./assets/img/brand_chanel.png" alt="" class="brand_img" />
          <img src="./assets/img/brand_sup.webp" alt="" class="brand_img" />
          <img
            src="./assets/img/brand_newyorker.png"
            alt=""
            class="brand_img"
          />
          <img src="./assets/img/brand_nike.png" alt="" class="brand_img" />
        </div>
      </div>
    </section>

    <!-- New  -->
    <section class="new">
      <div class="container">
        <div class="row">
          <!-- Product 1  -->
          <div class="col-lg-4">
            <div class="new_item">
              <img class="new_img" src="./assets/img/new_jacket.png" alt="" />
              <div class="new_details">
                <h2 class="new_details-content">Extreamely Awesome Shoes</h2>
                <a href="shop.php"><button class="button">Shop Now</button></a>
              </div>
            </div>
          </div>
          <!-- Product 2  -->
          <div class="col-lg-4">
            <div class="new_item">
              <img class="new_img" src="./assets/img/new_shoes.png" alt="" />
              <div class="new_details">
                <h2 class="new_details-content">Awesome Jacket</h2>
                <a href="shop.php"><button class="button">Shop Now</button></a>
              </div>
            </div>
          </div>
          <!-- Product 3  -->
          <div class="col-lg-4">
            <div class="new_item">
              <img class="new_img" src="./assets/img/new_watch.png" alt="" />
              <div class="new_details">
                <h2 class="new_details-content">50% OFF Watches</h2>
                <a href="shop.php"><button class="button">Shop Now</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured  -->
    <section class="featured">
      <div class="container">
        <div class="featured_top text-center mt-5 py-5">
          <h2>Our Feartured</h2>
          <hr />
          <p class="featured_top-desc">
            Here you can check out our featured products
          </p>
        </div>
        <div class="row">
          <?php while($row = $featured_products->fetch_assoc()){ ?>
            <div onclick="window.location.href='<?php echo 'single_product.php?product_id='.$row['product_id'];?>';" class="product text-center col-lg-3">
              <img src="./assets/img/shop_img/<?php echo $row['product_image'];?>" alt="" class="product_img" />
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="product_name"><?php echo $row['product_name']; ?></h5>
              <h4 class="product_price">$ <?php echo $row['product_price']; ?></h4>
              <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">
                <button class="button product_button">Buy Now</button>
              </a>
            </div>
          <?php }?> 

        </div>
      </div>
    </section>

    <!-- Bags  -->
    <section class="clothes">
      <div class="container">
        <div class="clothes_top text-center mt-5 py-5">
          <h2>Bags</h2>
          <hr />
          <p class="featured_top-desc">
            Here you can check out our amazing clothes
          </p>
        </div>
        <div class="row">
          <?php while($row = $bags->fetch_assoc()){ ?>
            <div onclick="window.location.href='<?php echo 'single_product.php?product_id='.$row['product_id'];?>';" class="product text-center col-lg-3">
              <img src="./assets/img/shop_img/<?php echo $row['product_image'] ?>" alt="" class="product_img" />
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="product_name"><?php echo $row['product_name']; ?></h5>
              <h4 class="product_price">$<?php echo $row['product_price']; ?></h4>
              <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">
                <button class="button product_button">Buy Now</button>
              </a>
            </div>
          <?php }?>
        </div>
      </div>
    </section>

    <!-- Coats  -->
    <section class="clothes">
      <div class="container">
        <div class="clothes_top text-center mt-5 py-5">
          <h2>Coats</h2>
          <hr />
          <p class="featured_top-desc">
            Here you can check out our amazing clothes
          </p>
        </div>
        <div class="row">
        <?php while($row = $coats->fetch_assoc()){ ?>
          <div onclick="window.location.href='<?php echo 'single_product.php?product_id='.$row['product_id'];?>';" class="product text-center col-lg-3">
            <img src="./assets/img/shop_img/<?php echo $row['product_image']; ?>" alt="" class="product_img" />
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="product_name"><?php echo $row['product_name']; ?></h5>
            <h4 class="product_price">$<?php echo $row['product_price']; ?></h4>
            <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">
              <button class="button product_button">Buy Now</button>
            </a>
          </div>
        <?php }?>
        </div>
      </div>
    </section>

    <!-- Shoes  -->
    <section class="clothes">
      <div class="container">
        <div class="clothes_top text-center mt-5 py-5">
          <h2>Shoes</h2>
          <hr />
          <p class="featured_top-desc">
            Here you can check out our amazing clothes
          </p>
        </div>
        <div class="row">
          <?php while($row = $shoes->fetch_assoc()){ ?>
            <div onclick="window.location.href='<?php echo 'single_product.php?product_id='.$row['product_id'];?>';" class="product text-center col-lg-3">
              <img src="./assets/img/shop_img/<?php echo $row['product_image']; ?>" alt="" class="product_img" />
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="product_name"><?php echo $row['product_name']; ?></h5>
              <h4 class="product_price">$<?php echo $row['product_price']; ?></h4>
              <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">
                <button class="button product_button">Buy Now</button>
              </a>
            </div>
          <?php }?>
        </div>
      </div>
    </section>

    <!-- Watches  -->
    <section class="clothes">
      <div class="container">
        <div class="clothes_top text-center mt-5 py-5">
          <h2>Watches</h2>
          <hr />
          <p class="featured_top-desc">
            Here you can check out our amazing clothes
          </p>
        </div>
        <div class="row">
          <?php while($row = $watches->fetch_assoc()){ ?>
            <div onclick="window.location.href='<?php echo 'single_product.php?product_id='.$row['product_id'];?>';" class="product text-center col-lg-3">
              <img src="./assets/img/shop_img/<?php echo $row['product_image']; ?>" alt="" class="product_img" />
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="product_name"><?php echo $row['product_name']; ?></h5>
              <h4 class="product_price">$<?php echo $row['product_price']; ?></h4>
              <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">
                <button class="button product_button">Buy Now</button>
              </a>
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
  </body>
</html>
