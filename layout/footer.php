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