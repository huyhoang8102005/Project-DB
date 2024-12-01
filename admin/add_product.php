<?php include('header.php'); ?>
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
          <h2 class="mb-3" style="font-size: 34px; font-weight: 500">Add Product</h2>
          <form id="create-form" enctype="multipart/form-data" action="create_product.php" method="POST">
             <div class="form-group">
              <input type="hidden" name="product_id" value="">
              <label>Title</label>
              <input type="text" value="" class="form-control" id="product-name" name="title" placeholder="Title">
             </div>
             <div class="form-group">
              <label>Description</label>
              <input type="text" value="" class="form-control" id="product-description" name="description" placeholder="Description">
             </div>
             <div class="form-group">
              <label>Price</label>
              <input type="text" value="" class="form-control" id="product-price" name="price" placeholder="Price">
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
              <input type="text" value="" class="form-control" id="product-color" name="color" placeholder="Color">
             </div>
             <div class="form-group">
              <label>Special offer</label>
              <input type="text" value="" class="form-control" id="product-offer" name="offer" placeholder="Sale %">
             </div>
             <div class="form-group">
              <label>Image</label>
              <input type="file" value="" class="form-control" id="product-image" name="image1" placeholder="Image">
             </div>
             <div class="form-group">
              <label>Image 2</label>
              <input type="file" value="" class="form-control" id="product-image" name="image2" placeholder="Image 2">
             </div>
             <div class="form-group">
              <label>Image 3</label>
              <input type="file" value="" class="form-control" id="product-image" name="image3" placeholder="Image 3">
             </div>
             <div class="form-group">
              <label>Image 4</label>
              <input type="file" value="" class="form-control" id="product-image" name="image4" placeholder="Image 4">
             </div>
             <div class="form-group mb-3">
              <input type="submit" class="btn btn-primary" name="create_product" value="Create Product">
             </div>
          </form>
        </main>
      </div>
    </div>
  </body>
</html>
