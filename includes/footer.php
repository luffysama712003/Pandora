<!-- <footer class="bg-second" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-4 col-md-6 ">
                    <h3 class="footer-head">Liên hệ</h3>
                    <ul class="menu p-0">
                        <li><a href="#"> Điện thoại: (083) 8338637</a></li>
                        <li><a href="#">Email: cossoft@mail.com</a></li>
                        <li><a href="#">Địa chỉ: 273 Đ. An D. Vương, Phường 3, Quận 5, Thành phố Hồ Chí Minh</a></li>
                        <li><a href="#">Thời gian làm việc: 8:00 - 18:00 Thứ 2 - Chủ Nhật</a></li>
                    </ul>
                </div>

                <div class="col-4 col-md-6">
                    <h3 class="footer-head">Chăm sóc khách hàng</h3>
                    <ul class="menu p-0">
                        <li><a href="#">Câu hỏi thường gặp</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Chính sách thanh toán</a></li>
                        <li><a href="#">Cách thức bảo quản</a></li>
                        
                    </ul>
                </div>
                <div class="col-4 col-md-6 col-sm-12">
                    <div class="contact">
                        <h3 class="contact-header">
                            PANDORA
                        </h3>
                        <ul class="contact-socials">
                            <li><a href="#">
                                    <i class='bx bxl-facebook-circle'></i>
                                </a></li>
                            <li><a href="#">
                                    <i class='bx bxl-instagram-alt'></i>
                                </a></li>
                            <li><a href="#">
                                    <i class='bx bxl-youtube'></i>
                                </a></li>
                            <li><a href="#">
                                    <i class='bx bxl-twitter'></i>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</footer> -->
<footer style="background: #f5f5f5" id="footer">
        <div class="Jewelry_footer">
            <div class="footer-top py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-9 col-md-6 col-lg-9">
                            <a class="logo fs-3 p-0" style="color: black;" href="#">PANDORA</a>
                            <p class="mb-0">Nhận ưu đãi 10% độc quyền online cho khách hàng mới</p>
                        </div>
                        <div class="col-3 col-md-3 d-flex align-items-center m-0">
                            <div class="action">
                                <a class="btn rounded-0 btn-dark" href="./register.php">ĐĂNG KÝ NGAY</a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="footer-between section">
                <div class="footer-left">
                    <h3 class="title">liên hệ</h3>
                    <nav class="nav flex-column">
                        <a class="nav-link" ><i class="fas fa-phone-alt"></i>(083) 8338637</a>
                        <a class="nav-link" >
                            <ion-icon name="mail-outline" style="padding-right: 10px;"></ion-icon>
                            pandora@mail.com</a>
                        <a class="nav-link" ><i class="fas fa-map-marker-alt"></i>
                            273 Đ. An D. Vương, Phường 3, Quận 5, Thành phố Hồ Chí Minh
                        </a>
                        <a class="nav-link"><i class="fas fa-clock"></i>
                            8:00 - 21:00 Thứ 2 - Chủ Nhật
                        </a>
                    </nav>
                </div>
                <div class="footer-right ">
                    <h3 class="title">chăm sóc khách hàng</h3>
                    <nav class="nav flex-column">
                        <a class="nav-link" href="./question.php">Câu hỏi thường gặp</a>
                        <a class="nav-link" href="./security.php">Chính sách bảo mật</a>
                        <a class="nav-link" href="./payment.php">Chính sách thanh toán</a>
                        <a class="nav-link" href="./preserve.php">Cách thức bảo quản</a>
                    </nav>
                </div>
            </div>
            <div class="footer-bottom" style="padding: 20px 0;">
                <div class="d-flex justify-content-between container-fluid">
                    <P class="m-0">© Pandora Jewelry, LLC. All rights reserved.
                    </P>
                    <nav class="nav flex-row">
                        <a class="nav-link" href="#">
                            <ion-icon name="logo-facebook"></ion-icon>
                        </a>
                        <a class="nav-link" href="#">
                            <ion-icon name="logo-youtube"></ion-icon>
                        </a>
                        <a class="nav-link" href="#">
                            <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                        <a class="nav-link" href="#">
                            <ion-icon name="logo-twitter"></ion-icon>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </footer>


<!-- app js -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="./assets/js/bootstrap.bundle.js"></script>
<script src="./assets/js/util.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script>
  <?php if(isset($_SESSION['message']))
  {
  ?>
    alertify.set('notifier','position', 'top-right');
    alertify.success('<?= $_SESSION['message'] ?>');
  <?php 
    unset($_SESSION['message']);
  }
  ?>
</script>
