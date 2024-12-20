<?php
session_start();
include("../middleware/adminMiddleware.php");
include("../config/dbcon.php");

if(isset($_POST['add_category_btn']))
{

    $name= $_POST['name']; 
    $slug=$name . "-" . rand(10,99);
    $description=$_POST['description'];
    $status=isset($_POST['status']) ? '1':'0';
    $image= $_FILES['image']['name'];

    $path="../images"; 
    $image_ext=pathinfo($image, PATHINFO_EXTENSION);
    $filename= time().'.'.$image_ext;

    $check_slug_query = "SELECT * FROM categories WHERE slug = '$slug'";
    $check_slug_result = mysqli_query($conn, $check_slug_query);

    // Nếu slug đã tồn tại, tạo slug mới
    while (mysqli_num_rows($check_slug_result) > 0) {
        $slug = $name . "-" . rand(10, 99); // Tạo lại slug mới
        $check_slug_result = mysqli_query($conn, $check_slug_query); // Kiểm tra lại
    }

    $check_query = "SELECT * FROM categories WHERE `name`='$name'";
    $check_query_run = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($check_query_run) > 0) {
        redirect("add-category.php", "Danh mục đã tồn tại");
    }else{
        $cate_query = "INSERT INTO categories (name,slug,description,status,image) 
        VALUES ('$name', '$slug','$description',' $status', '$filename')";
        $cate_query_run=mysqli_query($conn, $cate_query);
        if($cate_query_run)
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
            redirect("add-category.php", "Thêm danh mục thành công");
        }else
        {
            redirect("add-category.php", "Đã xảy ra lỗi");
        }
    }
    
}else if(isset($_POST['update_category_btn']))
{

    $category_id= $_POST['category_id'];
    $name= $_POST['name'];
    $slug = $_POST['slug'];
    $description=$_POST['description'];
    $status=isset($_POST['status']) ? '1':'0';

    $new_image= $_FILES['image']['name'];
    $old_image= $_POST['old_image'];


    if($new_image != "")
    {
        //$update_filename= $new_image;
        //xử lí ảnh
        $image_ext=pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename= time().'.'.$image_ext;
    
    }
    else
    {
        $update_filename=$old_image;
    }
    $path="../images"; 
    $update_query= "UPDATE categories SET name='$name', slug='$slug', description='$description', status='$status', image='$update_filename' WHERE id='$category_id'";
    $update_query_run= mysqli_query($conn,$update_query);

    if($update_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'],$path.'/'. $update_filename);
            if(file_exists("../images/".$old_image))
            {
                unlink("../images/".$old_image);
            }
        }
        redirect("edit-category.php?id=$category_id","Cập nhật danh mục thành công");
    }
    else
    {
        redirect("edit-category.php?id=$category_id","Đã xảy ra lỗi");
    }
}
else if(isset($_POST['delete_category_btn']))
{
    $category_id=mysqli_real_escape_string($conn,$_POST['category_id']);

    $category_query="SELECT * FROM categories WHERE id='$category_id'";
    $category_query_run=mysqli_query($conn,$category_query);
    $category_data=mysqli_fetch_array($category_query_run);
    $image=$category_data['image'];
    
    $delete_query= "DELETE FROM categories WHERE id='$category_id'";
    $delete_query_run=mysqli_query($conn,$delete_query);
    
    if($delete_query_run)
    {
        if(file_exists("../images/".$image))
            {
                unlink("../images/".$image);
            }
        redirect("category.php","Xóa danh mục thành công");
    }else
    {
        redirect("caterory.php","Đã xảy ra lỗi");

    }
}
else if(isset($_POST['add_product_btn']))
{
    $category_id= $_POST['category_id'];

    $name= $_POST['name'];
    $name = preg_replace('/[^a-zA-Z0-9]/', '-', strtolower($name));
    $name = trim($name, '-');
    // $slug = isset($_POST['slug']) ? $_POST['slug'] . "-" . rand(10, 99) : rand(10, 99);

    // Tạo slug ban đầu
    $base_slug = isset($_POST['slug']) ? $_POST['slug'] : $name;
    $random_number = rand(10, 99);
    $slug = $base_slug . "-" . $random_number;
    $check_slug_query = "SELECT * FROM products WHERE slug = '$slug'";
    $check_slug_result = mysqli_query($conn, $check_slug_query);

    // if (mysqli_num_rows($check_slug_result) > 0) {
    //     $slug = $_POST['slug'] . "-" . rand(100, 999);
    // }
    while (mysqli_num_rows($check_slug_result) > 0) {
        $random_number = rand(100, 999); 
        $slug = $base_slug . "-" . $random_number;
        $check_slug_query = "SELECT * FROM products WHERE slug = '$slug'";
        $check_slug_result = mysqli_query($conn, $check_slug_query);
    }
    
    $small_description= $_POST['small_description'];
    $description= $_POST['description'];
    $original_price= $_POST['original_price'];
    $selling_price= $_POST['selling_price'];
    $status= isset($_POST['status']) ? '1':'0';
    $qty= $_POST['qty'];
    $image= $_FILES['image']['name'];
    $path="../images"; 
    $image_ext=pathinfo($image, PATHINFO_EXTENSION);
    $filename= time().'.'.$image_ext;
    // if (!is_numeric($original_price) || $original_price < 0) {
    //     $original_price = 0;
    // }
    // if (!is_numeric($selling_price) || $selling_price < 0) {
    //     $selling_price = 0;
    // }
    // if (!is_numeric($qty) || $qty < 0) {
    //     redirect("add-product.php", "Vui lòng nhập giá trị là hợp lệ");
    // }
    if($name != "" && $slug != "" && $description !="")
    {
        if($selling_price!=NULL){
            $product_query= "INSERT INTO products (category_id,name,slug,small_description,description,original_price,selling_price,image,qty,status) VALUES 
            ('$category_id','$name','$slug','$small_description','$description','$original_price','$selling_price','$filename','$qty','$status')";
    
            $product_query_run=mysqli_query($conn,$product_query);
        }else{
            $product_query= "INSERT INTO products (category_id,name,slug,small_description,description,original_price,image,qty,status) VALUES 
            ('$category_id','$name','$slug','$small_description','$description','$original_price','$filename','$qty','$status')";
    
            $product_query_run=mysqli_query($conn,$product_query);
        }
        

        if($product_query_run)
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
            redirect("add-product.php", "Thêm sản phẩm thành công");
        }else
        {
            redirect("add-product.php", "Đã xảy ra lỗi");
        }
    }else
    {
        redirect("add-product.php", "Bạn chưa điền đủ thông tin");
    }
}
else if(isset($_POST['update_product_btn']))
{
    // $product_id=$_POST['product_id'];
    // $category_id= $_POST['category_id'];
    // $name= $_POST['name'];
    // $slug= $_POST['slug']  . "-" . rand(10,99);
    // $small_description= $_POST['small_description'];
    // $description= $_POST['description'];
    // $original_price= $_POST['original_price'];
    // $selling_price= $_POST['selling_price'];
    // $status= isset($_POST['status']) ? '1':'0';
    // $qty= $_POST['qty'];
    // $slug = isset($_POST['slug']) && !empty($_POST['slug']) ? $_POST['slug'] . "-" . rand(10, 99) : null;

    $product_id = isset($_POST['product_id']) && !empty($_POST['product_id']) ? $_POST['product_id'] : null;
    $name = isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : null;
    $qty = isset($_POST['qty']) && $_POST['qty'] !== '' ? $_POST['qty'] : 0;
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
    $small_description = isset($_POST['small_description']) ? $_POST['small_description'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $original_price = isset($_POST['original_price']) ? $_POST['original_price'] : 0;
    $selling_price = isset($_POST['selling_price']) && $_POST['selling_price'] !== '' ? $_POST['selling_price'] : NULL;
    $status = isset($_POST['status']) ? '1' : '0';
   

  
    if ($product_id) {
    $query = "SELECT slug FROM products WHERE id = '$product_id'";
    $result = mysqli_query($conn, $query);

  
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); 
        $slug = $row['slug']; 
    } else {
        $slug = null; 
    }
    } else {
    $slug = null; // Nếu không có product_id, xử lý trường hợp này
    }
    $inventory_status = 1; // Mặc định là "Còn hàng"
    if ($qty <= 0) {
        $inventory_status = 3;  // Hết hàng
    } elseif ($qty < 3) {
        $inventory_status = 2;  // Sắp hết hàng
    }
    

    $path="../images"; 
    $new_image= $_FILES['image']['name'];
    $old_image= $_POST['old_image'];

    if($new_image != "")
    {
        //$update_filename= $new_image;
        $image_ext=pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename= time().'.'.$image_ext;
    
    }
    else
    {
        $update_filename=$old_image;
    }

    $update_product_query = "UPDATE products SET 
    category_id='$category_id',
    name='$name', 
    slug='$slug', 
    small_description='$small_description', 
    description='$description',
    original_price='$original_price', 
    selling_price='$selling_price', 
    status='$status', 
    qty='$qty', 
    image='$update_filename', 
    inventory_status='$inventory_status' 
    WHERE id='$product_id'";


$update_product_query_run = mysqli_query($conn, $update_product_query);

    if($update_product_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'],$path.'/'. $update_filename);
            if(file_exists("../images/".$old_image))
            {
                unlink("../images/".$old_image);
            }
        }
        redirect("edit-product.php?id=$product_id","Cập nhật sản phẩm thành công");
    }else
    {
        redirect("edit-product.php?id=$product_id","Đã xảy ra lỗi");
    }
}
else if(isset($_POST['delete_product_btn']))
{
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    // Kiểm tra sản phẩm trong đơn hàng
    $order_check_query = "SELECT * FROM order_detail WHERE product_id='$product_id'";
    $order_check_query_run = mysqli_query($conn, $order_check_query);

    if(mysqli_num_rows($order_check_query_run) > 0)
    {
        // Nếu sản phẩm có trong đơn hàng, không cho phép xóa
        redirect("products.php", "Không thể xóa sản phẩm vì có đơn hàng chứa sản phẩm");
    }
    else
    {
        // Lấy thông tin sản phẩm
        $product_query = "SELECT * FROM products WHERE id='$product_id'";
        $product_query_run = mysqli_query($conn, $product_query);
        $product_data = mysqli_fetch_array($product_query_run);
        $image = $product_data['image'];

        // Xóa sản phẩm
        $delete_query = "DELETE FROM products WHERE id='$product_id'";
        $delete_query_run = mysqli_query($conn, $delete_query);

        if($delete_query_run)
        {
            // Xóa ảnh nếu tồn tại
            if(file_exists("../images/" . $image))
            {
                unlink("../images/" . $image);
            }
            redirect("products.php", "Xóa sản phẩm thành công");
        }
        else
        {
            redirect("products.php", "Không thể xóa sản phẩm");
        }
    }
}

else if (isset($_GET['order'])){
    $order_id   = $_GET['id'];
    $type       = $_GET['order'];
    $query =    "UPDATE `orders` SET `status` = '$type'
                WHERE `id` = '$order_id'"; 
    mysqli_query($conn, $query);

    $query =    "UPDATE `order_detail` SET `status` = '$type'
                WHERE `order_id` = '$order_id'"; 
    mysqli_query($conn, $query);

    redirect("order-detail.php?id_order=$order_id","Cập nhập trạng thái thành công");
}
{
    header('Location: ./index.php');
}
?>