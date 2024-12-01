<?php 

session_start();

if (isset($_POST['order_pay_btn'])) {
  $order_status = $_POST['order_status'];
  $order_total_price = $_POST['total_order_price'];
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
    <link rel="stylesheet" href="./assets/css/checkout.css">
  </head>
  <body>
    <?php 
      include('layout/navbar.php');
    ?>


    <!-- Payment  -->
     <section class="checkout my-4 py-4">
      <div class="container text-center mt-3 pt-3">
        <h2 class="checkout_title">Payment</h2>
        <div class="line mx-auto" style="width: 60px;"></div>
      </div>
      <div class="mx-auto container text-center">
          <!-- order from detail  -->
          <?php if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid"){?>
            <?php $order_id = $_POST['order_id']; ?>
            <input type="hidden" class="paypal_value" value="<?php echo $_POST['total_order_price'];?>">
            <p style="color: black" class="mt-4 mb-4">Total payment: $ <?php echo $_POST['total_order_price'];?></p>
            <!-- Set up button paypal  -->
            <div id="paypal-button-container" class="mt-3" style="margin-left: 200px;"></div>
            <p id="result-message"></p>
            <!-- order from checkout  -->
          <?php } elseif(isset($_SESSION['total']) && $_SESSION['total'] != 0){ ?>
            <?php $order_id = $_SESSION['order_id']; ?>
            <input type="hidden" class="paypal_value" value="<?php echo $_SESSION['total'];?>">
            <p style="color:black" class="mt-4 mb-4">Total payment: $<?php echo $_SESSION['total'];?></p>
            <!-- Set up button paypal  -->
            <div id="paypal-button-container" class="mt-3" style="margin-left: 200px;"></div>
            <p id="result-message"></p>
            <!-- no order  -->
          <?php } else {?>
            <p style="color:black" class="mt-4 mb-4">Total payment: $0</p>
            <p style="color: black">You don't have an order</p>
          <?php }?>   
          
          
          
      </div>
     </section>

        <!-- Initialize the JS-SDK -->
      <script
          src="https://www.paypal.com/sdk/js?client-id=AeZYbbl1PCHoS5f1ZHpwGZ0N1gy1Hd9JAYXSTq73-xmf-WWJQ9lyNE-KBIaJuWvGSFF0pvyX0nk4WLrY&buyer-country=US&currency=USD&components=buttons&enable-funding=venmo,paylater,card"
          data-sdk-integration-source="developer-studio"
      ></script>
      <!-- paypal.js  -->
      <script>
        paypal
              .Buttons({
                  createOrder: function (data, actions) {
                      // Set the amount dynamically
                      const amount = document.querySelector('.paypal_value').value;
                      return actions.order.create({
                          purchase_units: [
                              {
                                  amount: {
                                      value: amount, // Ensure 2 decimal places
                                  },
                              },
                          ],
                      });
                  },
                  onApprove: function (data, actions) {
                      // Handle when the payment is approved
                      return actions.order.capture().then(function (orderData) {
                          // Show a success message to the user
                          console.log("Capture result", orderData, JSON.stringify(orderData,null, 2));
                          var transaction = orderData.purchase_units[0].payments.captures[0];
                          alert('Transaction ' + transaction.status + ": " + transaction.id);

                          window.location.href = "server/complete_payment.php?transaction_id=" + transaction.id + "&order_id="+<?php echo $order_id; ?>;
                      });
                  },
              })
              .render('#paypal-button-container'); 
          // Render the PayPal button in the specified container
      </script>
          

  <!-- Footer  -->
  <footer class="footer" style="padding-bottom: 150px; padding-top: 100px">
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