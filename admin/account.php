<?php include('header.php'); ?>

<?php
    if(!isset($_SESSION['admin_logged_in'])) {
      header('location: login.php');
      exit;
    }
?>
    <div class="container-fluid">
      <div class="row">
        <nav
          id="sidebarMenu"
          class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse"
        >
          <div class="sidebar-sticky pt-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="dashboard.php">
                  <span data-feather="home">Dashboard</span> 
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                  <span data-feather="file">Orders</span> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="products.php">
                  <span data-feather="shopping-cart">Products</span> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="add_new_product.php">
                  <span data-feather="users">Add New Product</span> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="account.php">
                  <span data-feather="users">Account</span> 
                </a>
              </li>
            </ul>
            <h6
              class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted"
            >
          </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
          <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
          >
            <h1 class="h2">Dashboard</h1>      
          </div>
            <h3 class="mb-3" style="font-size: 20px;">ID: <?php echo $_SESSION['admin_id']?></h3>
            <h3 class="mb-3" style="font-size: 20px;">Name: <?php echo $_SESSION['admin_name']?></h3>
            <h3 style="font-size: 20px;">Email: <?php echo $_SESSION['admin_email']?></h3>   
        </main>
      </div>
    </div>
  </body>
</html>
