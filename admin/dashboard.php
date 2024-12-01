<?php include('header.php'); ?>

<?php
    if(!isset($_SESSION['admin_logged_in'])) {
      header('location: login.php');
      exit;
    }
?>


<?php 
      if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        $page_no = $_GET['page_no'];

      // if user has already in default page 
    } else {
        $page_no = 1;
    }

    //  return number of product 
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
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
    $stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset,$total_records_per_page");
    $stmt2->execute();
    $orders = $stmt2->get_result();

?>

<?php if(isset($_GET['edit_success_message']) || isset($_GET['edit_failure_message']) || isset($_GET['order_success_message']) || isset($_GET['order_failure_message'])){ ?>
      <!-- Modal  -->
      <div class="modal_custom modal-active">
        <div class="modal_custom-dialog">
          <div class="modal_custom-content">
            <div class="modal_custom-header">
              <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal_custom-body">
              <?php if(isset($_GET['edit_success_message'])){?>
                <p style="color: #28a745;"><?php {echo $_GET['edit_success_message'];}?></p>
              <?php }?>
              <?php if(isset($_GET['edit_failure_message'])){?>
                <p style="color: #c82333;"><?php {echo $_GET['edit_failure_message'];} ?></p>
              <?php }?>
              <?php if(isset($_GET['order_success_message'])){?>
                <p style="color: #28a745;"><?php {echo $_GET['order_success_message'];} ?></p>
              <?php }?>
              <?php if(isset($_GET['order_failure_message'])){?>
                <p style="color: #c82333;"><?php {echo $_GET['order_failure_message'];} ?></p>
              <?php }?>
            </div>
            <div class="modal_custom-footer">
              <button type="button" class="btn btn-secondary close_btn" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
<?php };?>


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
          <h2 class="mb-3" style="font-size: 34px; font-weight: 500">Orders</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Order Id</th>
                  <th>Order Status</th>
                  <th>User Id</th>
                  <th>User Phone</th>
                  <th>User Address</th>
                  <th>Order Date</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($orders as $order){ ?>
                  <tr>
                    <td><?php echo $order['order_id'] ?></td>
                    <td><?php echo $order['order_status'] ?></td>
                    <td><?php echo $order['user_id'] ?></td>
                    <td><?php echo $order['user_phone'] ?></td>
                    <td><?php echo $order['user_address'] ?></td>
                    <td><?php echo $order['order_date'] ?></td>
                    <td><a class="btn btn-success" href="edit_order.php?order_id=<?php echo $order['order_id'];?>">Edit</a></td>
                    <td><a class="btn btn-danger" href="">Delete</a></td>
                  </tr>
                <?php };?>
              </tbody>
            </table>
          </div>
          <!-- Next / Previous page  -->
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
        </main>
      </div>
    </div>
    <script>
      const modal = document.querySelector('.modal_custom');
      const btnModal = document.querySelector(".btn-close");
      const closeBtn = document.querySelector(".close_btn");
      btnModal.addEventListener('click', () => {
        modal.classList.remove('modal-active');
      })
      closeBtn.addEventListener('click', () => {
        modal.classList.remove('modal-active');
      })
    </script>
  </body>
</html>
