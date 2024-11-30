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
                        <h1 style="color:white ;">Thiết lập lại mật khẩu</h1>
                        </div>
                        <div class="card-body">
                            <form action="./functions/repass.php" method="POST"> 
                                    <div class="mb-3">
                                        <b><label for="exampleInputPassword1" class="form-label">Mật khẩu mới</label></b>
                                        <input required type="password" name="password" class="form-control"  placeholder="Nhập mật khẩu">
                                    </div>  
                                    <div class="mb-3">
                                        <b><label for="exampleInputPassword1" class="form-label">Nhập lại mật khẩu</label></b>
                                        <input required type="password" name="cpassword" class="form-control"  placeholder="Nhập lại mật khẩu">
                                    </div>            
                                    <button type="submit" name="repass_btn" class="btn btn-dark">Xác nhận</button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div> 
</div>
<?php include("./includes/footer.php")?>