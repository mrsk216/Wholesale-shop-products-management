<?php
    @include("config.php");

    $id = $_GET['id'];
    $brand_name = $_GET['brand_name'];
    $area_name = $_GET['area_name'];
    $deliveryman_name = $_GET['deliveryman_name'];
    $product_name = $_GET['product_name'];
    $product_load = $_GET['product_load'];
    $product_free = $_GET['product_free'];
    $product_return = $_GET['product_return'];
    $product_damage = $_GET['product_damage'];
    $created_at = $_GET['created_at'];
    $update_date = date('Y-m-d H:i:s');


    $stock_data = "SELECT * FROM `stock` where `product_name` = '$product_name'";
    $stockResult = $conn->query($stock_data);
    if ($stockResult->num_rows > 0) {
        while($row = $stockResult->fetch_assoc()) {
            $oldProductQuantity = $row['product_quantity'];
            $oldFreeProduct = $row['product_free'];
            $oldPrice = $row['total_price'];
            $productRate = $row['product_rate'];
        }
    }
    $memo_data = "SELECT * FROM `memo` where `created_at` = '$created_at' AND `product_name` = '$product_name' AND `area_name` = '$area_name'";
    $memoResult = $conn->query($memo_data);
    if ($memoResult->num_rows > 0) {
        while($row1 = $memoResult->fetch_assoc()) {
            $oldproduct_load = $row1['product_load'];
            $oldproduct_free = $row1['product_free'];
            $oldproduct_return = $row1['product_return'];
            $oldproduct_sale = $row1['product_sale'];
            $oldproduct_damage = $row1['product_damage'];
        }
    }

    if($oldproduct_free > $product_free){
        $newStockFree = $oldFreeProduct + ($oldproduct_free - $product_free);
    }elseif($oldproduct_free < $product_free){
        $newStockFree = $oldFreeProduct - ($product_free - $oldproduct_free);
    }else{
        $newStockFree = $oldFreeProduct;
    }

    $new_sale = $product_load - $product_return;
    if($oldproduct_sale > $new_sale){
        $new_quantity = $oldProductQuantity + ($oldproduct_sale - $new_sale);
        $new_price = $new_quantity * $productRate;
    }elseif($oldproduct_sale < $new_sale){
        $new_quantity = $oldProductQuantity - ($new_sale - $oldproduct_sale);
        $new_price = $new_quantity * $productRate;
    }
    if($product_load>$product_return){
        if($oldProductQuantity>=$product_load){
            $stocksql = "UPDATE `stock` SET `product_quantity`='$new_quantity',`product_free`='$newStockFree',`total_price`='$new_price' where `product_name` = '$product_name'";
            $sql = "UPDATE `memo` SET `product_load`='$product_load',`product_free`='$product_free',`product_return`='$product_return',`product_sale`='$new_sale',`product_damage`='$product_damage',`updated_at`='$update_date' where `id` = '$id'";
            if ($conn->query($sql) === TRUE && $conn->query($stocksql) === TRUE) {
                $msg = "মেমো পরিবর্তন হয়েছে";
            } else {
                $msg = mysqli_error($conn);
            }
        }else{
            $msg = "লোড বেশি হয়েছে, পুনরায় চেষ্টা করুন";
        }
    }else{
        $msg = "লোডের তুলনায় ফেরত বেশি হয়েছে, পুনরায় চেষ্টা করুন";
    }

    
    
    
    $conn->close();

    echo "<p>".$msg."</p>";
?>
<?php @include('layout/header.php'); ?>
<style>
    .modal.fade.show.d-block {
        background: #0000007a;
    }
    header{display:none;opacity:0;}
    p{display:none;}
</style>

<!-- Modal -->
<div class="modal fade show d-block">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <span class="success-icon">&#10003;</span>
                <h3 class="text-center my-4"><?php echo $msg; ?></h3>
                <div class="d-flex justify-content-center">
                    <div>
                        <a href="history.php?brand=<?php echo $brand_name; ?>&history=<?php echo $created_at; ?>" class="btn btn-info text-center">পেছনে যান</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php @include('layout/footer.php'); ?>