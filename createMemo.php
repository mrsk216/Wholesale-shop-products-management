<?php
    @include("config.php");
    if($_GET['area_name'] != ''||$_GET['product_name'] != ['']){
        foreach($_GET['product_name'] as $key => $value){
            $brandName = $_GET['brand_name'];
            $areaName = $_GET['area_name'];
            $delManName = $_GET['deliveryman_name'];
            $productName = $_GET['product_name'][$key];
            $productLoad = (int)$_GET['product_load'][$key];
            $productFree = (int)$_GET['product_free'][$key];
            $productReturn = (int)$_GET['product_return'][$key];
            $sale = $productLoad-$productReturn;

            $stock_data = "SELECT * FROM `stock` where `product_name` = '$productName'";
            $result = $conn->query($stock_data);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $oldProductQuantity = $row['product_quantity'];
                    $oldFreeProduct = $row['product_free'];
                    $oldPrice = $row['total_price'];
                    $productRate = $row['product_rate'];
                }
            }
            $newProductQuantity = $oldProductQuantity - $sale;
            $newFreeProduct = $oldFreeProduct - $productFree;
            $newPrice = $newProductQuantity * $productRate;
            

            $productRateData = "SELECT `product_rate` FROM `stock` WHERE `product_name` = '$productName'";
            $resultRate = $conn->query($productRateData);
            if ($resultRate->num_rows > 0) {
                while($row = $resultRate->fetch_assoc()) {
                    $productRate = $row['product_rate'];
                }
            }

            if($oldFreeProduct >= $productFree){
                if($oldProductQuantity >= $productLoad){
                    if($productLoad >= $productReturn){
                        $stocksql = "UPDATE `stock` SET `product_quantity`='$newProductQuantity',`product_free`='$newFreeProduct',`total_price`='$newPrice' where `product_name` = '$productName'";
                        $sql = "INSERT INTO `memo`(`brand_name`, `area_name`, `delivery_man`, `product_name`, `product_load`, `product_free`, `product_return`, `product_sale`,`product_rate`) VALUES ('$brandName','$areaName','$delManName','$productName','$productLoad','$productFree','$productReturn','$sale','$productRate')";

                        if ($conn->query($sql) === TRUE && $conn->query($stocksql) === TRUE) {
                            $msg = 'মেমো তৈরি হয়েছে';
                            $url = 'memo.php?brand='.$brandName.'&created_at='.date("Y-m-d");
                            $btn = 'মেমোতে যান';
                        } else {
                            $msg = mysqli_error($conn);
                            $url = 'create-sheet.php?brand='.$brandName;
                            $btn = 'পুনরায় চেষ্টা করুন';
                        }
                    }else{
                        $msg = "লোডের তুলনায় ফেরত বেশি হয়েছে, পুনরায় চেষ্টা করুন";
                        $url = 'create-sheet.php?brand='.$brandName;
                        $btn = 'পুনরায় চেষ্টা করুন';
                    }
                }else{
                    $msg = "লোড বেশি হয়েছে, পুনরায় চেষ্টা করুন";
                    $url = 'create-sheet.php?brand='.$brandName;
                    $btn = 'পুনরায় চেষ্টা করুন';
                }
            }else{
                $msg = "ফ্রী সংখ্যা বেশি হয়েছে, পুনরায় চেষ্টা করুন";
                $url = 'create-sheet.php?brand='.$brandName;
                $btn = 'পুনরায় চেষ্টা করুন';
            }
        }
    }else{
        $brandName = $_GET['brand_name'];
        $msg = 'এরিয়া/প্রোডাক্টের নাম খালি রাখা যাবে না';
        $url = 'create-sheet.php?brand='.$brandName;
        $btn = 'পুনরায় চেষ্টা করুন';
    }
    $conn->close();
    echo "<p>".$msg."</p>";
    echo "<p>".$url."</p>";
    echo "<p>".$btn."</p>";
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
                        <a href="<?php echo $url; ?>" class="btn btn-info text-center"><?php echo $btn; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php @include('layout/footer.php'); ?>