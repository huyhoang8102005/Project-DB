<?php include('header.php'); ?>
   

<?php 

if (isset($_GET['order_id'])) {
  $order_id = $_GET['order_id'];
  $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
  $stmt->bind_param('i', $order_id );
  $stmt->execute();
  $orders = $stmt->get_result();
} elseif (isset($_POST['edit_order'])) {
    $order_status = $_POST['status'];
    $order_id = $_POST['order_id'];

  $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");

  $stmt->bind_param("si", $order_status, $order_id);

  if ($stmt->execute()) {
    header('location: dashboard.php?order_success_message=Order has been updated');
  } else {
    header('location: dashboard.php?order_failure_message=Error occured. Please try again!');
  }
} else {
  header('location: dashboard.php?');
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
                <a class="nav-link" href="add_product.php">
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
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">
                  Share
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary">
                  Export
                </button>
              </div>
              <button
                type="button"
                class="btn btn-sm btn-outline-secondary dropdown-toggle"
              >
                <span data-feather="calendar"></span> This week
              </button>
            </div>
          </div>
          <h2 class="mb-3" style="font-size: 34px; font-weight: 500">Edit Products</h2>
          <form id="edit-form" action="edit_order.php" method="POST">
            <?php foreach($orders as $order){?>
             <div class="form-group edit_order">
              <input type="hidden" name="order_id" value="<?php echo $order['order_id'];?>">
              <label class="mt-3 mb-3">Order Id: <?php echo $order['order_id'];?> </label>
             </div>
             <div class="form-group edit_order">
              <label class="mb-3">Order Price: $<?php echo $order['order_cost'];?></label>
             </div>
             <div class="form-group edit_order">
              <label class="mb-3">Order date: <?php echo $order['order_date'];?></label>
             </div>
             <div class="form-group edit_order">
              <label style="display: block;">Order Status</label>
              <select id="form-select" required name="status">
                <option value="not paid" <?php if($order['order_status'] == 'not paid'){echo "selected";}?> >Not Paid</option>
                <option value="paid" <?php if($order['order_status'] == 'paid'){echo "selected";}?>>Paid</option>
                <option value="shipped" <?php if($order['order_status'] == 'shipped'){echo "selected";}?>>Shipped</option>
                <option value="delivered" <?php if($order['order_status'] == 'delivered'){echo "selected";}?>>Delivered</option>
              </select>
             </div>
             <div class="form-group">
              <input type="submit" class="btn btn-primary" name="edit_order" value="Edit">
             </div>
             <?php };?>
          </form>
        </main>
      </div>
    </div>
  </body>
</html>
