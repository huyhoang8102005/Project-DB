<nav class="navbar">
      <div class="container">
        <div class="nav_inner">
          <a href="home.php">
            <div>
              <img src="/assets/img/logo.png" alt="brand-logo" class="nav_logo"/>
            </div>
          </a>
          <div class="nav_right">
            <ul class="nav_content">
              <a href="home.php">
                <li class="nav_link">Home</li>
              </a>
              <a href="shop.php?page_no=1">
                <li class="nav_link">Shop</li>
              </a>
              <a href="blog.php">
                <li class="nav_link">Blog</li>
              </a>
              <a href="contact.php">
                <li class="nav_link">Contact us</li>
              </a>
              <a href="/admin/login.php">
                <li class="nav_link">Admin</li>
              </a>
            </ul>
            <div class="nav_icon">
              <a href="cart.php" style="position: relative;">
                <img src="./assets/img/nav_bag.svg" alt="" />
                <?php if(isset($_SESSION['total_quantity']) && $_SESSION['total_quantity'] != 0){?>
                    <div class="total_quantity"><?php echo $_SESSION['total_quantity'];?></div>
                <?php }?>
              </a>
              <a href="account.php"><img src="./assets/img/nav_user.svg" alt="" /></a>
            </div>
          </div>
        </div>
      </div>
    </nav>