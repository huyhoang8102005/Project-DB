<?php include('header.php'); ?>

<?php  
  if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $products = $stmt->get_result();
  } elseif (isset($_POST['edit_product'])) {
   
    $product_id = $_POST['product_id'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $offer = $_POST['offer'];

    $stmt = $conn->prepare("UPDATE products SET product_name = ?, product_description = ?, product_price = ?, product_color = ?, product_special_offer = ?, product_category = ? WHERE product_id = ?");

    $stmt->bind_param("ssssssi",$title,$description,$price,$color,$offer,$category,$product_id);

    if ($stmt->execute()) {
      header('location: products.php?edit_success_message=Product has been updated');
    } else {
      header('location: products.php?edit_failure_message=Error occured. Please try again!');
    }
    

  } 
  
  else {
    header('location: products.php');
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
          <form id="edit-form" action="edit_product.php" method="POST">
            <?php foreach($products as $product){?>
             <div class="form-group">
              <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>">
              <label>Title</label>
              <input type="text" value="<?php echo $product['product_name'];?>" class="form-control" id="product-name" name="title" placeholder="Title">
             </div>
             <div class="form-group">
              <label>Description</label>
              <input type="text" value="<?php echo $product['product_description'];?>" class="form-control" id="product-description" name="description" placeholder="Description">
             </div>
             <div class="form-group">
              <label>Price</label>
              <input type="text" value="<?php echo $product['product_price'];?>" class="form-control" id="product-price" name="price" placeholder="Price">
             </div>
             <div class="form-group">
              <label style="display: block;">Category</label>
              <select id="form-select" required name="category">
                <option value="bag">Bag</option>
                <option value="shoes">Shoes</option>
                <option value="watch">Watch</option>
                <option value="coat">Coat</option>
              </select>
             </div>
             <div class="form-group">
              <label>Color</label>
              <input type="text" value="<?php echo $product['product_color'];?>" class="form-control" id="product-color" name="color" placeholder="Color">
             </div>
             <div class="form-group">
              <label>Special offer</label>
              <input type="text" value="<?php echo $product['product_special_offer'];?>" class="form-control" id="product-offer" name="offer" placeholder="Sale %">
             </div>
             <div class="form-group">
              <input type="submit" class="btn btn-primary" name="edit_product" value="Edit">
             </div>
             <?php };?>
          </form>
        </main>
      </div>
    </div>
  </body>
</html>
