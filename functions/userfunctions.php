<?php
include("./config/dbcon.php");

function getAllActive($table)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE `status`='0'";
    return $query_run = mysqli_query($conn, $query);
}

// function getIDActive()
// {
//     global $conn;
//     $query = "SELECT * FROM product WHERE id='$id' AND status='0' AND `type`='$type'";
//     return $query_run = mysqli_query($conn, $query);
// }
function getByID($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE id='$id'";
    return $query_run = mysqli_query($conn, $query);
}
function getAll($table)
{
    global $conn;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($conn, $query);
}
function getBySlug($table, $slug)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE slug='$slug'";
    return $query_run = mysqli_query($conn, $query);
}
function totalValue($table,$type="",$search="")
{
    global $conn;
    if ($type != "") {
        $categoryId = getBySlug("categories", $type);
        $categoryId = mysqli_fetch_array($categoryId)['id'];
        $query = "SELECT COUNT(*) as `number` FROM $table 
        WHERE (`name` LIKE '%$search%' OR `description` LIKE '%$search%') 
        AND `category_id`='$categoryId'";
    }
    else if($search != ""){
        $query ="SELECT COUNT(*) as `number` FROM $table 
        WHERE (`name` LIKE '%$search%' OR `description` LIKE '%$search%')";
    }
    else{
        $query = "SELECT COUNT(*) as `number` FROM $table";
    }
    $totalValue = mysqli_query($conn, $query);
    $totalValue = mysqli_fetch_array($totalValue);
    if ($totalValue['number'] == 0) {
        return "Không tìm thấy kết quả.";
    }
    return $totalValue['number'];
}
function totalValueProducts($type="",$search="")
{
    global $conn;
    if ($type != "") {
        $categoryId = getBySlug("categories", $type);
        $categoryId = mysqli_fetch_array($categoryId)['id'];
        $query = "SELECT COUNT(*) as `number` FROM `products` 
        WHERE (`name` LIKE '%$search%' OR `description` LIKE '%$search%') 
        AND `category_id`='$categoryId' AND `status` = 0";
    }
    else if($search != ""){
        $search = mysqli_real_escape_string($conn, $search);
        $query ="SELECT COUNT(*) as `number` FROM `products` 
        WHERE (`name` LIKE '%$search%' OR `description` LIKE '%$search%') AND `status` = 0";
       
    }
    else{
        $query = "SELECT COUNT(*) as `number` FROM `products` WHERE `status` = 0";
    }
    $totalValue = mysqli_query($conn, $query);
    if (!$totalValue) {
        redirect('../products.php', 'Có lỗi xảy ra. Vui lòng thử lại sau.');
        return; 
    }
    $totalValue = mysqli_fetch_array($totalValue);
    if ($totalValue['number'] == 0) {
        redirect('../products.php','Không tìm thấy kết quả !');
        return 0;
    }
    return $totalValue['number'];
}


function getBestSelling($numberGet)
{
    global $conn;
    $query = "SELECT `products`.*, COUNT(`order_detail`.id) as total_buy FROM `products`
                LEFT JOIN `order_detail` ON `products`.`id` = `order_detail`.`product_id`
                WHERE `products`.`status` = 0
                GROUP BY `products`.`id`
                ORDER BY `total_buy` DESC
                LIMIT $numberGet";
    return mysqli_query($conn, $query);
}

function getLatestProducts($numberGet, $page = 0, $type = "", $search = "")
{
    global $conn;
    $page_extra = $numberGet * $page;
    $search = mysqli_real_escape_string($conn, $search);
    if ($type != "") {
        $categoryId = getBySlug("categories", $type);
        $categoryId = mysqli_fetch_array($categoryId)['id'];
        $query = "SELECT * FROM `products` 
                WHERE (`name` LIKE '%$search%' OR `description` LIKE '%$search%') 
                AND `category_id` = '$categoryId' AND `status` = 0
                ORDER BY `id` DESC 
                LIMIT $numberGet OFFSET $page_extra";
    } else if($search != "") {
        $query = "SELECT * FROM `products` 
                WHERE (`name` LIKE '%$search%' OR `description` LIKE '%$search%') AND `status` = 0
                ORDER BY `id` DESC 
                LIMIT $numberGet OFFSET $page_extra";
    }
    else {
        $query = "SELECT * FROM `products` 
                WHERE `status` = 0
                ORDER BY `id` DESC 
                LIMIT $numberGet OFFSET $page_extra";
    }

    return mysqli_query($conn, $query);
}

// order
function checkOrder($id_product)
{
    global $conn;
    $user_id = $_SESSION['auth_user']['id'];
    $query = "SELECT `status` FROM `order_detail` 
                WHERE `product_id` = '$id_product' AND `user_id` = '$user_id' AND `status` != 0 
                ORDER BY `status`";
    $checkOrsder = mysqli_query($conn, $query);
    if (mysqli_num_rows($checkOrsder)) {
        $checkOrsder = mysqli_fetch_array($checkOrsder)['status'];
        return $checkOrsder;
    } else {
        return 0;
    }
}

function getMyOrders()
{
    global $conn;
    $user_id = $_SESSION['auth_user']['id'];
    $query = "SELECT `order_detail`.*, `products`.`name`, `products`.`slug` FROM `order_detail` 
                JOIN `products` on `order_detail`.`product_id` = `products`.`id`
                WHERE `order_detail`.`user_id` = '$user_id' AND `order_detail`.`status` = 1";
    return mysqli_query($conn, $query);
}

function getMyOrderVote($id)
{
    global $conn;
    $user_id = $_SESSION['auth_user']['id'];
    $query = "SELECT `order_detail`.*, `products`.`name`,`products`.`description`,`products`.`small_description`,`products`.`image`,`products`.`slug` FROM `order_detail` 
                JOIN `products` on `order_detail`.`product_id` = `products`.`id`
                WHERE `order_detail`.`order_id` = '$id' AND `order_detail`.`status` = 4 AND `order_detail`.`user_id` = $user_id";
    return mysqli_query($conn, $query);
}

function getOrderWasBuy($cart_id)
{
    global $conn;
    $user_id = $_SESSION['auth_user']['id'];
    $query = "SELECT `order_detail`.`created_at`,`order_detail`.`selling_price`, `order_detail`.`quantity`, `products`.`name`, `products`.`slug` FROM `order_detail` 
                JOIN `products` on `order_detail`.`product_id` = `products`.`id`
                WHERE `order_detail`.`user_id` = '$user_id' AND `order_detail`.`status` NOT IN (0,1) and `order_detail`.`order_id` = '$cart_id'
                ORDER BY `order_detail`.`id` DESC";
    $result = mysqli_query($conn, $query);

    $orders = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }
    return $orders;
}

// function getOrderByUserId()
// {
//     global $conn;
//     $user_id = $_SESSION['auth_user']['id'];
//     $query = "SELECT
//                         o.payment,
//                         SUM(od.quantity * od.selling_price) AS total,
//                         o.status,
//                         o.id,
//                         o.created_at,
//                         o.addtional,
//                         od.rate
//                     FROM
//                         orders o
//                     JOIN
//                         order_detail od ON od.order_id = o.id
//                     WHERE
//                         o.user_id = '$user_id'
//                     GROUP BY
//                         o.id
//                 ";
//     return mysqli_query($conn, $query);
// }
function getOrderByUserId()
{
    global $conn;
    $user_id = $_SESSION['auth_user']['id'];
    $query = "SELECT
                        o.payment,
                        SUM(od.quantity * od.selling_price) AS total,
                        o.status,
                        o.id,
                        o.created_at,
                        o.addtional,
                        AVG(od.rate) AS avg_rate  -- Tính trung bình điểm đánh giá
                    FROM
                        orders o
                    JOIN
                        order_detail od ON od.order_id = o.id
                    WHERE
                        o.user_id = '$user_id'
                    GROUP BY
                        o.id
                ";
    return mysqli_query($conn, $query);
}

function getRate($product_id)
{
    global $conn;
    $query = "SELECT `order_detail`.*, `users`.`name` FROM `order_detail` 
            JOIN `users` ON `order_detail`.`user_id` = `users`.`id`
            WHERE `order_detail`.`product_id` = '$product_id' AND `order_detail`.`status` = 4 AND `order_detail`.`rate` > 0";

    return mysqli_query($conn, $query);
}

function avgRate($product_id)
{
    global $conn;
    $query = "SELECT AVG(`rate`) as `avg_rate` FROM `order_detail` WHERE `product_id` = '$product_id' AND `status` = 4 AND `rate` > 0";
    $rate = mysqli_query($conn, $query);
    $rate = mysqli_fetch_array($rate);
     if ($rate['avg_rate'] === null) {
        return 0;
    }
    return round($rate['avg_rate'], 1);
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location:' . $url);
    exit();
}

?>