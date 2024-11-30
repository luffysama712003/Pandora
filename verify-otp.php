<?php
include("./includes/header.php");
if(isset($_SESSION['otp'])){
    redirect("../reset-password.php", "Xác minh OTP thành công. Bạn có thể đặt lại mật khẩu.");
}
else{
    header("../verify-otp.php");
}
?>
<script src="../assets/js/boostrap.bundle.js"></script>
<link rel="stylesheet" href="./assets/css/author.css">
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h1 style="color:white ;" class="fs-3">Xác nhận mã OTP</h1>
                    </div>
                    <div class="card-body">
                        <form action="./functions/repass.php" method="POST">
                            <div class="mb-3">
                                <input required type="text" name="otp" class="form-control" id="otpInput" placeholder="Nhập mã OTP" maxlength="6">
                            </div>
                            <button type="submit" name="verify_otp_btn" class="btn btn-dark">Xác nhận</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("./includes/footer.php") ?>