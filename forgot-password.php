<?php 
include("./includes/header.php");

?>
<script src="../assets/js/boostrap.bundle.js"></script>
<link rel="stylesheet" href="./assets/css/author.css">
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-dark">
                        <h1 style="color:white ;">Quên mật khẩu</h1>
                        </div>
                        <div class="card-body">
                            <form action="./functions/repass.php" method="POST"> 
                                    <div class="mb-3">
                                        <b><label for="exampleInputEmail1" class="form-label">Địa chỉ Email</label></b>
                                        <input required type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  placeholder="Nhập Email">
                                    </div>
                                    <button type="submit" name="verify_email_btn" class="btn btn-dark">Xác nhận</button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div> 
</div>
<?php include("./includes/footer.php")?>