<?php 

session_start();

include('server/connection.php');

if (isset($_POST['search'])) {
  if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
  } else {
      $page_no = 1;
  }
   $category = $_POST['category'];
   $price = $_POST['price'];

   $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products WHERE product_category = ? AND product_price <= ?");
   $stmt1->bind_param("si",$category,$price);
   $stmt1->execute();
   $stmt1->bind_result($total_records);
   $stmt1->store_result();
   $stmt1->fetch();

   // product per page
   $total_records_per_page = 8;
   $offset = ($page_no - 1) * $total_records_per_page;
   $previous_page = $page_no - 1;
   $next_page = $page_no + 1;
   // số trang hiển thị
   $adjacents = "2";
   $total_no_of_pages = ceil($total_records / $total_records_per_page);

   // get product
   $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price <= ? LIMIT $offset,$total_records_per_page");
   $stmt2->bind_param("si",$category,$price);
   $stmt2->execute();
   $products = $stmt2->get_result();

} else {
  // if user has already in another page which different page 1
   if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
      $page_no = $_GET['page_no'];

    // if user has already in default page 
   } else {
      $page_no = 1;
   }

  //  return number of product 
   $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
   $stmt1->execute();
   $stmt1->bind_result($total_records);
   $stmt1->store_result();
   $stmt1->fetch();


   // product per page
   $total_records_per_page = 8;
   $offset = ($page_no - 1) * $total_records_per_page;
   $previous_page = $page_no - 1;
   $next_page = $page_no + 1;
   // số trang hiển thị
   $adjacents = "2";
   $total_no_of_pages = ceil($total_records / $total_records_per_page);


   // get product
   $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
   $stmt2->execute();
   $products = $stmt2->get_result();
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
    <link rel="stylesheet" href="assets/css/featured.css" />
    <link rel="stylesheet" href="./assets/css/shop.css">
    <link rel="stylesheet" href="assets/css/footer.css">
  </head>
  <body>
    <?php 
      include('layout/navbar.php');
    ?>

    <!-- Search  -->
    <section id="search" class="my-5 py-5 ms-2">
      <div class="container mt-5 py-5">
        <p style="font-size: 24px;">Search Products</p>
        <div class="line"></div>
      </div>

      <form action="shop.php" method="POST">
        <div class="row mx-auto container">
          <div class="col-12">
            <p class="mb-3">Category</p>
            <div class="form-check">
              <input type="radio" value="shoes" class="form-check-input" name="category" id="category_one" <?php if(isset($category) && $category == "shoes"){echo "checked";}?>>
              <label class="form-check-label" for="flexRadioDefault">
                Shoes
              </label>
            </div>

            <div class="form-check">
              <input type="radio" value="coat" class="form-check-input" name="category" id="category_two" <?php if(isset($category) && $category == "coat"){echo "checked";}?>>
              <label class="form-check-label" for="flexRadioDefault2">
                Coats
              </label>
            </div>

            <div class="form-check">
              <input type="radio" value="watch" class="form-check-input" name="category" id="category_two" <?php if(isset($category) && $category == "watch"){echo "checked";}?>>
              <label class="form-check-label" for="flexRadioDefault2">
                Watches
              </label>
            </div>

            <div class="form-check">
              <input type="radio" value="bag" class="form-check-input" name="category" id="category_two" <?php if(isset($category) && $category == 'bag'){echo "checked";}?>>
              <label class="form-check-label" for="flexRadioDefault2">
                Bags
              </label>
            </div>
          </div>
        </div>

        <div class="row mx-auto container mt-5">
          <div style="width: 200px;">
            <p class="mb-3">Price</p>
            <input type="range" class="form-range" value="<?php if(isset($price)){echo $price;} else {echo "500";}?>" min="1" name="price" max="1000" id="customRange2">
            <p id="rangeValue" class="text-center">$<?php if(isset($price)){echo $price;} else {echo 500;}?></p>
          </div>
        </div>

        <div class="form-group my-3 mx-3">
          <input type="submit" name="search" value="Search" class="button">
        </div>
      </form>
    </section>


     <!-- Shop  -->
     <section class="shop_no-padding featured">
      <div class="container">
        <div class="featured_top mt-5 py-5">
          <h2 class="shop_title">Our Shop</h2>
          <div class="line" style="width: 110px;"></div>
          <p class="featured_top-shop-desc">
            Here you can check out our shop products
          </p>
        </div>
        <div class="row shop">
          <?php while($row = $products->fetch_assoc()){ ?>
            <div onclick="window.location.href='<?php echo 'single_product.php?product_id='.$row['product_id'];?>';" class="product product_shop text-center col-lg-3">
              <img src="./assets/img/shop_img/<?php echo $row['product_image'];?>" alt="" class="product_img" />
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="product_name"><?php echo $row['product_name'];?></h5>
              <h4 class="product_price">$<?php echo $row['product_price'];?></h4>
              <button class="button product_button"><a href="<?php echo "single_product.php?product_id=".$row['product_id'];?>">Buy Now</a></button>
            </div>
            <?php }?>
        </div>

        

      </div>
    </section>

    <!-- Next/Previous page  -->
    <div class="container">
      <nav class="shop_navigation" aria-label="Page navigation example">
            <ul class="pagination mt-5">
              <li class="page-item <?php if($page_no <= 1){echo 'disabled';} ?>">
                <a href="<?php if($page_no <= 1){echo '#';} else {echo "?page_no=".($page_no)-1;} ?>" class="page-link">Previous</a>
              </li>
              <li class="page-item">
                <a href="?page_no=1" class="page-link">1</a>
              </li>
              <li class="page-item" <?php if($total_no_of_pages == 1){echo "hidden";} ?>>
                <a href="?page_no=2" class="page-link">2</a>
              </li>
              
              <?php if($page_no >= 3){ ?>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="<?php echo '?page_no='.$page_no;?>"><?php echo $page_no;?></a></li>
              <?php }?>

              <li class="page-item <?php if($page_no >= $total_no_of_pages){echo 'disabled';} ?>">
                <a href="<?php if($page_no >= $total_no_of_pages){echo '#';} else {echo "?page_no=".($page_no+1);} ?>" class="page-link">Next</a>
              </li>
            </ul>
      </nav>
    </div>


    <!-- Footer  -->
    <footer style="margin-top: 120px;" class="footer">
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
      const rangeInput = document.getElementById('customRange2')
      const rangeValue = document.getElementById('rangeValue')

      rangeInput.addEventListener('input', () => {
        rangeValue.textContent = "$" + rangeInput.value
      })
    </script>
  </body>
</html>
