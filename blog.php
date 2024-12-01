<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Blog</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/navbar.css" />
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <!-- Navigation Bar -->
    <?php 
      include('layout/navbar.php');
    ?>


    <!-- Blog Content -->
    <div class="container my-5">
        <div class="row">
            <!-- Blog Post 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://images.pexels.com/photos/50987/money-card-business-credit-card-50987.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top" alt="Blog Post 1">
                    <div class="card-body">
                        <h5 class="card-title">5 Tips for Smart Online Shopping</h5>
                        <p style="color: black;" class="card-text mb-3">Learn how to shop smarter and save money with these essential tips for online shopping.</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            <!-- Blog Post 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://images.pexels.com/photos/230544/pexels-photo-230544.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top" alt="Blog Post 2">
                    <div class="card-body">
                        <h5 class="card-title">Top 10 Products for 2024</h5>
                        <p style="color: black;" class="card-text mb-3">Check out our list of the hottest products to look out for in 2024!</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            <!-- Blog Post 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://images.pexels.com/photos/3756345/pexels-photo-3756345.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top" alt="Blog Post 3">
                    <div class="card-body">
                        <h5 class="card-title">How to Spot Fake Deals</h5>
                        <p style="color: black;" class="card-text mb-3">Don't get scammed! Learn how to identify fake deals and shop safely online.</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
      include('layout/footer.php');
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
