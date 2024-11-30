<?php
ob_start();
session_start();
include("./functions/userfunctions.php");
$search =   "";
$page   =   1;
$type   =   "";

if (isset($_GET["search"])){$search    = $_GET["search"]; }
if (isset($_GET["type"])){ $type        = $_GET["type"]; }
if (isset($_GET["page"])){ $page        = $_GET["page"]; }

$page = $page - 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANDORA</title>
    <!-- font awesome  -->
    <link rel="stylesheet" href="./assets/font/fontawesome-free-6.2.0-web/css/all.min.css">
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- app css -->
    <link rel="stylesheet" href="./assets/css/grid.css"/>
    <link rel="stylesheet" href="./assets/css/app.css"/>
    <link rel="stylesheet" href="./assets/css/index.css"/>
    <link rel="icon" href="./images/OIP.jpg"/>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <style>
        .search_icon{
            width: 20px;
            height: 20px;
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%)
        }
    </style>
</head>
<body>
 <!-- mobile menu -->
 <div class="mobile-menu bg-second">
            <a href="#" class="mb-logo">PANDORA</a>
            <span class="mb-menu-toggle" id="mb-menu-toggle">
                <i class='bx bx-menu'></i>
            </span>
        </div>
        <!-- end mobile menu -->
        <!-- main header -->
        <div class="header-wrapper" id="header-wrapper">
            <span class="mb-menu-toggle mb-menu-close" id="mb-menu-close">
                <i class='bx bx-x'></i>
            </span>
            <!-- top header -->
            <!-- <div class="bg-second">
                <div class="top-header container">
                    <ul class="devided">
                        <li>
                            <a href="#">+84938338637</a>
                        </li>
                        <li>
                            <a href="#">pandora@mail.com</a>
                        </li>
                    </ul>                    
                </div>
            </div> -->
            <!-- end top header -->
            <!-- mid header -->
            <div class="bg-main">
                <div class="mid-header container Jewelry_header" >
                    <a href="index.php" class="logo">PANDORA</a>
                    <?php if (!isset($type_post)) { ?>
                        <form class="search" method="get" action="./products.php">
                    <?php } else { ?>
                        <form class="search" method="get" action="./blog.php">
                    <?php } ?>
                        <input required name="search" type="text" value="<?= $search ?>" placeholder="Tìm kiếm" style="position:relative">
                        <button type="submit" style="display:inline; border:none" >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.8 19.8" aria-label="icon search" class="search_icon">
                                <path
                                    d="M13.4 12.8c1.2-1.4 1.9-3.1 1.9-5.1 0-4.2-3.4-7.7-7.7-7.7S0 3.4 0 7.7s3.4 7.7 7.7 7.7c2 0 3.7-.7 5.1-1.9l6.4 6.4.6-.6-6.4-6.5zm-5.7 1.7C4 14.5.9 11.5.9 7.7S3.9.9 7.7.9s6.8 3 6.8 6.8-3.1 6.8-6.8 6.8z">
                                </path>
                            </svg>
                        </button>
                        
                    </form>
                    
                    <ul class="user-menu nav-left m-0">
                        <!-- <li><a href="#"><i class='bx bx-bell'></i></a></li> -->
                            <?php
                            if(isset($_SESSION['auth']))
                            {                                   
                                $users= getAll("users");        
                                $row= mysqli_fetch_array($users);                              
                                    ?>
                                    <li class="mega-dropdown"> 
                                    <a href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox=" 0 0 24 23.77">
                                    <path
                                        d="M18.545 15.03A5.432 5.432 0 0124 20.485v3.273h-1.09v-3.273a4.345 4.345 0 00-4.365-4.364H5.455a4.345 4.345 0 00-4.364 4.364v3.273H0v-3.273a5.432 5.432 0 015.455-5.455zM12 0a6.518 6.518 0 016.545 6.545A6.518 6.518 0 0112 13.091a6.518 6.518 0 01-6.545-6.546A6.518 6.518 0 0112 0zm0 1.09a5.432 5.432 0 00-5.455 5.455A5.432 5.432 0 0012 12a5.432 5.432 0 005.455-5.455A5.432 5.432 0 0012 1.091z">
                                    </path>
                                </svg></a>
                                    <div class="mega-content">
                                            <div class="row">
                                                <div class="box">
                                                    <h3>Xin chào <?= $_SESSION['auth_user']['name'] ?>!</h3>
                                                        <ul>   
                                                            <li><a href="user-profile.php">Trang cá nhân</a></li>
                                                            <li><a href="./cart-status.php">Đơn hàng</a></li>
                                                            <li><a href="logout.php">Đăng Xuất</a></li>        
                                                        </ul>
                                                </div>                                          
                                            </div>  
                                        </div>       
                                    </li>      
                                    <?php                                                
                                // unset($_SESSION['auth']);
                            }
                            else{
                            ?>
                            <li class="mega-dropdown">
                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox=" 0 0 24 23.77">
                                    <path
                                        d="M18.545 15.03A5.432 5.432 0 0124 20.485v3.273h-1.09v-3.273a4.345 4.345 0 00-4.365-4.364H5.455a4.345 4.345 0 00-4.364 4.364v3.273H0v-3.273a5.432 5.432 0 015.455-5.455zM12 0a6.518 6.518 0 016.545 6.545A6.518 6.518 0 0112 13.091a6.518 6.518 0 01-6.545-6.546A6.518 6.518 0 0112 0zm0 1.09a5.432 5.432 0 00-5.455 5.455A5.432 5.432 0 0012 12a5.432 5.432 0 005.455-5.455A5.432 5.432 0 0012 1.091z">
                                    </path>
                                </svg></a>
                                <div class="mega-content">
                                    <div class="row">
                                        <div class="box">
                                            <ul>
                                                <li><a href="login.php">Đăng nhập</a></li>
                                                <li><a href="register.php">Đăng ký</a></li>                                                         
                                            </ul>
                                        </div>                                          
                                    </div>  
                                </div>       
                            </li>  
                            <?php
                            }
                            ?>
                        <li><a href="./cart.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16.2 19.8">
                                    <path
                                        d="M5.4 5.4V3.6C5.4 2.2 6.6.9 8.1.9s2.7 1.3 2.7 2.7v1.8H5.4zM.9 18.9V6.3h3.6v2.2c0 .3.2.5.4.5.3 0 .4-.2.4-.4V6.3h5.4v2.2c.1.3.3.5.5.5.3 0 .4-.2.4-.4V6.3h3.6v12.6H.9zm-.9.4c0 .3.1.4.4.4h15.3c.3 0 .4-.1.4-.4V5.8c0-.3-.1-.4-.4-.4h-4V3.6c0-2-1.5-3.6-3.6-3.6S4.5 1.6 4.5 3.6v1.8h-4c-.4 0-.5.1-.5.4v13.5z">
                                    </path>
                                </svg></i></a></li>
                    </ul>
                </div>
            </div>

            <!-- menu-main -->
            <div class="bg-second">
                <div class="bottom-header container">
                    <ul class="main-menu my-3">
                        <li><a href="index.php">Trang chủ</a></li>
                        <!-- mega menu -->
                        <li class="mega-dropdown">
                            <a href="index.php">Sản phẩm<i class='bx bxs-chevron-down'></i></a>
                            <div class="mega-content">
                                <div class="row">                                  
                                    <div class="col-md-12">
                                        <div class="box">
                                            <ul>
                                                <li><a href="./products.php">TẤT CẢ</a></li>
                                            <?php
                                                $categories= getAllActive("categories");
                                                
                                                if(mysqli_num_rows($categories)>0)
                                                {
                                                    foreach($categories as $item)
                                                    {
                                                        ?>
                                                            <li><a href="./products.php?type=<?= $item['slug'] ?>"><?= $item['name']; ?></a></li> 
                                                        <?php
                                                    }
                                                }else
                                                {
                                                    echo "no";
                                                }
                                            ?>                                              
                                            </ul>
                                        </div>
                                    </div>                                
                                </div>                                
                            </div>
                        </li>
                        <!-- end mega menu -->
                        <li><a href="#footer">Liên hệ</a></li>
                        <li><a href="./about.php">Giới thiệu</a></li>
                    </ul>
                </div>
            </div>
            <!-- end bottom header -->
        </div>
        <!-- end main header -->
</body>
</html>    


