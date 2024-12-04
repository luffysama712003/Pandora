<?php
include_once("../config/dbcon.php");
include("../functions/myfunctions.php");
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';
session_start(); 
if(isset($_POST['verify_email_btn'])){
    $email = $_POST['email'];  
    $email_query = "SELECT * FROM `users` WHERE `email`='$email'";
    $email_query_run=mysqli_query($conn,  $email_query);

    if (mysqli_num_rows($email_query_run) > 0) {
        $_SESSION['email'] = $email;
        $otp = random_int(100000, 999999); 
        $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

        $update_otp_query = "UPDATE `users` SET `otp`='$otp', `otp_expiry`='$expiry' WHERE `email`='$email'";
        mysqli_query($conn, $update_otp_query);

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'arridngo@gmail.com'; 
            $mail->Password = 'ipvw nlrs wazb dyhm'; 
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('arridngo@gmail.com', 'Pandora');
            $mail->addAddress($email);  

            
             $mail->isHTML(true);
             $mail->Subject = 'Reset your password from Pandora';
             $mail->Body = "Mã OTP của bạn là: $otp";

           
            $mail->send();
           
            redirect("../verify-otp.php", "Mã OTP đã được gửi đến địa chỉ gmail của bạn !");
        } catch (Exception $e) {
            echo "Không thể gửi tin nhắn. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        redirect("../forgot-password.php", "Email không tồn tại !");;
    }
}
if(isset($_POST['verify_otp_btn'])){
        $email = $_SESSION['email'];
        $otp = $_POST['otp'];
        $query = "SELECT * FROM `users` WHERE `email`='$email' AND `otp`='$otp' AND CONVERT_TZ(otp_expiry, '+00:00', @@session.time_zone)  > NOW()";
        $result = mysqli_query($conn, $query);
    
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['otp'] = $otp;
            $clear_otp_query = "UPDATE `users` SET `otp`=NULL, `otp_expiry`=NULL WHERE `email`='$email'";
            mysqli_query($conn, $clear_otp_query);
    
            redirect("../reset-password.php", "Xác minh OTP thành công. Bạn có thể đặt lại mật khẩu.");
        } else {
            redirect("../verify-otp.php", "Mã OTP không hợp lệ hoặc đã hết hạn.");
        }
    
}
if (isset($_POST['repass_btn'])&&isset($_SESSION['otp'])){
            $email = $_SESSION['email'];
            $pass = $_POST['password'];
            $cpass = $_POST['cpassword'];

            if ($pass === $cpass) {
                $p_hash = password_hash($pass, PASSWORD_DEFAULT);
                $updatepass_query = "UPDATE `users` SET `password`='$p_hash', `otp`=NULL, `otp_expiry`=NULL WHERE `email`='$email'";
                $updatepass_query_run = mysqli_query($conn, $updatepass_query);
                if ($updatepass_query_run) {
                    redirect("../login.php", "Cập nhật mật khẩu thành công vui lòng đăng nhập lại.");
                } else {
                    redirect("../reset-password.php", "Cập nhật mật khẩu thất bại.");
                }
            } else {
                redirect("../reset-password.php", "Mật khẩu và xác nhận mật khẩu không khớp.");
            }
        }
     else {
        redirect("../forgot-password.php", "Liên kết không hợp lệ hoặc đã hết hạn.");
    }

?>