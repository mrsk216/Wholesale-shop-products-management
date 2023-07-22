<?php
    @include('config.php');

    $brand_name = $_GET['brand'];
    $product_id = $_GET['id'];

    $product_delete = "DELETE FROM `stock` WHERE `id` = '$product_id'";

    if ($conn->query($product_delete) === TRUE) {
        $msg = "পণ্য মুছে ফেলা হয়েছে";
    } else {
        $msg = "কোনো সমস্যা হয়েছে";
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