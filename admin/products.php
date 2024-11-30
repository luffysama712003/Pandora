<?php 
include ("../admin/includes/header.php");
$type = -1;
if(isset($_GET['type'])){
    $type = $_GET['type'];
}
$products=getProducts($type);
?>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sản phẩm</h4>
                </div>
                <div class="card-body">
                    <div class="list-choose mb-3">
                    <a href='./products.php' style="margin-left: 20px"><span class="badge badge-sm bg-gradient-secondary">Tất cả</span></a>
                            <a href='./products.php?type=3' style="margin-left: 20px"><span class="badge badge-sm bg-gradient-primary">Hết hàng</span></a>
                            <a href='./products.php?type=2' style="margin-left: 20px"><span class='badge badge-sm bg-gradient-info'>Sắp hết</span></a>
                            <a href='./products.php?type=1' style="margin-left: 20px"><span class="badge badge-sm bg-gradient-success">Còn hàng</span></a>
                    </div>
                           
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Hình ảnh</th>
                                <th>Trạng thái</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                                <th>Trong kho</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(mysqli_num_rows($products) >0)
                                {
                                    foreach($products as $item)
                                    {
                                    ?>
                                        <tr>
                                            <td><?= $item['id'];?> </td>
                                            <td><?= $item['name'];?></td>
                                            <td>
                                                <img src="../images/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name'];?>">
                                            <td>
                                                <?= $item['status'] == '0' ? "Hiển thị":"Ẩn"?>
                                            </td> 
                                            <td>
                                                <a href="edit-product.php?id=<?= $item['id'];?>" class="btn btn-primary">Sửa</a>                                 
                                            </td>
                                            <td>
                                                <form action="code.php" method="POST">
                                                    <input type="hidden" name="product_id" value="<?= $item['id']; ?>">
                                                    <button type="submit" name="delete_product_btn" class="btn btn-danger">Xóa</button>
                                                </form>   
                                            </td>  
                                            <td class="text-center">
                                                <?php
                                                if ($item['inventory_status'] == 1){
                                                    echo '<span>Còn hàng</span>';
                                                }
                                                else if($item['inventory_status'] == 2){
                                                    echo '<span>Sắp hết</span>';
                                                }
                                                else if($item['inventory_status'] == 3){
                                                    echo '<span>Hết hàng</span>';
                                                }
                                                ?>
                                            </td>                    
                                        </tr>
                                    <?php
                                    }
                                }else
                                {
                                    echo "No records found";
                                }
                            ?>
    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include ("../admin/includes/footer.php"); ?>