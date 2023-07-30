<?php
    @include("config.php");

    $id = $_GET['id'];
    $brand_name = $_GET['brand_name'];
    $area_name = $_GET['area_name'];
    $deliveryman_name = $_GET['deliveryman_name'];
    $product_name = $_GET['product_name'];
    $product_load = $_GET['product_load'];
    $product_return = $_GET['product_return'];
    $product_damage = $_GET['product_damage'];
    $created_at = $_GET['created_at'];
    $update_date = date('Y-m-d H:i:s');
    
    $sql = "UPDATE `memo` SET `product_load`='$product_load',`product_return`='$product_return',`product_damage`='$product_damage',`updated_at`='$update_date' where `id` = '$id'";

    
    
    if ($conn->query($sql) === TRUE) {
        $msg = "মেমো পরিবর্তন হয়েছে";
    } else {
        $msg = "মেমো পরিবর্তন হয়েছে <br>".mysqli_error($conn);
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