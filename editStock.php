<?php
    @include("config.php");

    $id = $_GET['pro_id'];
    $brand_name = $_GET['brand_name'];
    $product_name = $_GET['product_name'];
    $product_quantity = $_GET['product_quantity'];
    $product_rate = $_GET['product_rate'];
    
    $sql = "UPDATE `stock` SET `brand_name`='$brand_name',`product_name`='$product_name',`product_quantity`='$product_quantity',`product_rate`='$product_rate' where `id` = '$id'";

    
    
    if ($conn->query($sql) === TRUE) {
        $msg = "পণ্য পরিবর্তন হয়েছে";
    } else {
        $msg = "পণ্য পরিবর্তন হয়নি";
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
                        <a href="stock.php?brand=<?php echo $brand_name; ?>" class="btn btn-info text-center">পেছনে যান</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php @include('layout/footer.php'); ?>