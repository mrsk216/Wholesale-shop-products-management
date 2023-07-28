<?php
    @include("config.php");

    foreach($_GET['product_name'] as $key => $value){
        $brandName = $_GET['brand_name'];
        $areaName = $_GET['area_name'];
        $delManName = $_GET['deliveryman_name'];
        $productName = $_GET['product_name'][$key];
        $productLoad = (int)$_GET['product_load'][$key];
        $productReturn = (int)$_GET['product_return'][$key];
        $sale = $productLoad-$productReturn;

        $productRateData = "SELECT `product_rate` FROM `stock` WHERE `product_name` = '$productName'";
        $resultRate = $conn->query($productRateData);
        if ($resultRate->num_rows > 0) {
            while($row = $resultRate->fetch_assoc()) {
                $productRate = $row['product_rate'];
            }
        }
        
        $sql = "INSERT INTO `memo`(`brand_name`, `area_name`, `delivery_man`, `product_name`, `product_load`, `product_return`, `product_sale`, `product_rate`) VALUES ('$brandName','$areaName','$delManName','$productName','$productLoad','$productReturn','$sale','$productRate')";

        if ($conn->query($sql) === TRUE) {
            $msg = "পণ্য যুক্ত হয়েছে";
            $url = "memo";
        } else {
            $msg = mysqli_error($conn);
            $url = "create-sheet";
        }
    }

    $conn->close();

    echo $msg;
    echo $url;
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
                        <a href="<?php echo $url; ?>.php?brand=<?php echo $brandName; ?>" class="btn btn-info text-center">পেছনে যান</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php @include('layout/footer.php'); ?>