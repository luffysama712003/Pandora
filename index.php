<?php
include("./includes/header.php");

$bestSellingProducts = getBestSelling(8);
$LatestProducts = getLatestProducts(8);

?>

<body>
    <!-- hero section -->
    <div class="hero">
        <div class="slider">
            <div class="container">
                <?php
                $count = 0;
                foreach ($bestSellingProducts as $product) {
                    if ($count == 3) {
                        break;
                    }
                ?>
                    <!-- slide item -->
                    <div class="slide">
                        <div class="info">
                            <div class="info-content">
                                <!-- <h3 class="top-down">
                                    <?= $product['name'] ?>
                                </h3> -->
                                <h2 class="top-down trans-delay-0-2">
                                    <?= $product['name'] ?>
                                </h2>
                                <p class="top-down trans-delay-0-4">
                                    <?= $product['description'] ?>
                                </p>
                                <div class="top-down trans-delay-0-6">
                                    <a href="./product-detail.php?slug=<?= $product['slug'] ?>">
                                        <button class="btn-flat btn-hover">
                                            <span>Mua ngay</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="img right-left">
                            <img src="./images/<?= $product['image'] ?>" alt="">
                        </div>
                    </div>
                    <!-- end slide item -->
                <?php
                    $count++;
                }
                ?>
            </div>
            <!-- slider controller -->
            <button class="slide-controll slide-next">
                <i class='bx bxs-chevron-right'></i>
            </button>
            <button class="slide-controll slide-prev">
                <i class='bx bxs-chevron-left'></i>
            </button>
            <!-- end slider controller -->
        </div>
    </div>
    <!-- end hero section -->

    <!-- promotion section -->
    <!-- <div class="promotion">
        <div class="row">
        <?php
        $count = 0;
        foreach ($LatestProducts as $product) {
            if ($count == 3) {
                break;
            }
        ?>
            <div class="col-4 col-md-12 col-sm-12">
                <div class="promotion-box">
                    <div class="text">
                        <h3><?= $product['name'] ?></h3>
                        <a href="./product-detail.php?slug=<?= $product['slug'] ?>">
                            <button class="btn-flat btn-hover"><span>Xem chi tiết</span></button>
                        </a>
                    </div>
                    <img src="./images/<?= $product['image'] ?>" alt="">
                </div>
            </div>
        <?php
            $count++;
        }
        ?>
        </div>
    </div> -->
    <!-- end promotion section -->

    <!-- product list -->
    <div class="section">
        <div class="container">
            <div class="section-header" style="margin:0px 0 30px">
                <h2>Những sản phẩm mới nhất</h2>
            </div>
            <div class="row" id="latest-products">
                <?php
                foreach ($LatestProducts as $product) {
                ?>
                    <div class="col-3 col-md-6 col-sm-12">
                        <div class="product-card">
                            <div class="product-card-img">
                                <a href="./product-detail.php?slug=<?= $product['slug'] ?>">
                                    <img src="./images/<?= $product['image'] ?>" alt="">
                                    <img src="./images/<?= $product['image'] ?>" alt="">
                                </a>
                            </div>
                            <div class="product-card-info">
                                <form method="post" action="./functions/ordercode.php">
                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                    <input type="hidden" name="quantity" id="quantity" value="1">
                                    <input type="hidden" name="order" value="true">
                                    <?php if (!isset($_SESSION['auth_user']['id'])) { ?>
                                        <a href="./login.php">
                                            <button type="button" class="btn-flat btn-hover">Mua Ngay</button>
                                        </a>
                                        <?php } else {
                                        $check = checkOrder($product['id']);
                                        if ($check == 1) { ?>
                                            <a href="./cart.php">
                                                <button type="button" class="btn-flat btn-hover">Mua ngay</button>
                                            </a>
                                    <?php
                                        } else {
                                            echo '<button class="btn-flat btn-hover">Thêm vào giỏ hàng</button>';
                                        }
                                    }
                                    ?>
                                </form>

                                <div class="product-card-name">
                                    <?= $product['name'] ?>
                                </div>
                                <div class="product-card-price">
                                    <?php
                                    if ($product['selling_price'] != NULL) {
                                    ?>
                                        <span><del><?= $product['original_price'] ?></del>$</span>
                                        <span class="curr-price"><?= $product['selling_price'] ?>$</span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="ms-2 fs-5 fw-semibold" style="color:black"><?= $product['original_price'] ?>$</span>
                                    <?php
                                    }
                                    ?> 
                                </div>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="section-footer">
                <a href="./products.php" class="btn-flat btn-hover">Xem tất cả</a>
            </div>
        </div>
    </div>
    <!-- end product list -->

    <!-- special product -->
    <!-- <div class="bg-second">
        <div class="section container">
            <div class="row">
            <?php
            foreach ($bestSellingProducts as $product) {
            ?>
                <div class="col-4 col-md-4">
                    <div class="sp-item-img">
                        <img src="./images/<?= $product['image'] ?>" alt="">
                    </div>
                </div>
                <div class="col-7 col-md-8">
                    <div class="sp-item-info">
                        <div class="sp-item-name"><?= $product['name'] ?></div>
                        <p class="sp-item-description">
                            <?= $product['small_description'] ?>
                        </p>
                        <a href="./product-detail.php?slug=<?= $product['slug'] ?>">
                            <button class="btn-flat btn-hover">Xem chi tiết</button>
                        </a>
                    </div>
                </div>
            <?php
                break;
            }
            ?>
            </div>
        </div>
    </div> -->
    <!-- end special product -->

    <!-- product list -->
    <!-- <div class="section">
        <div class="container">
            <div class="section-header">
                <h2>Những sản phẩm bán chạy nhất</h2>
            </div>
            <div class="row" id="best-products">
                <?php
                foreach ($bestSellingProducts as $product) {
                ?>
                <div class="col-3 col-md-6 col-sm-12">
                    <div class="product-card">
                    <div class="product-card-img">
                        <a href="./product-detail.php?slug=<?= $product['slug'] ?>">
                            <img src="./images/<?= $product['image'] ?>" alt="">
                            <img src="./images/<?= $product['image'] ?>" alt="">
                        </a>
                        </div>
                        <div class="product-card-info">
                        <form method="post" action="./functions/ordercode.php">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="quantity" id="quantity" value="1">
                            <input type="hidden" name="order" value="true">
                            <?php if (!isset($_SESSION['auth_user']['id'])) { ?>
                                <a href="./login.php">
                                    <button type="button" class="btn-flat btn-hover">Mua Ngay</button>
                                </a>
                            <?php } else {
                                $check = checkOrder($product['id']);
                                if ($check == 1) { ?>
                                    <a href="./cart.php">
                                        <button type="button" class="btn-flat btn-hover">Mua ngay</button>
                                    </a>
                            <?php
                                } else {
                                    echo '<button class="btn-flat btn-hover">Thêm vào giỏ hàng</button>';
                                }
                            }
                            ?>
                        </form>
                            <div class="product-card-name">
                                <?= $product['name'] ?>
                            </div>
                            <div class="product-card-price">
                                <span><del>$<?= $product['original_price'] ?></del></span>
                                <span class="curr-price">$<?= $product['selling_price'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="section-footer">
                <a href="./products.php" class="btn-flat btn-hover">Xem tất cả</a>
            </div>
        </div>
    </div>  -->
    <!-- end product list -->



    <?php include("./includes/footer.php") ?>
    <script src="./assets/js/app.js"></script>
    <script src="./assets/js/index.js"></script>
</body>

</html>