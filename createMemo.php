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
        $productDamage = (int)$_GET['product_damage'][$key];

        $productRateData = "SELECT `product_rate` FROM `stock` WHERE `product_name` = '$productName'";
        $resultRate = $conn->query($productRateData);
        if ($resultRate->num_rows > 0) {
            while($row = $resultRate->fetch_assoc()) {
                $productRate = $row['product_rate'];
            }
        }
        
        $sql = "INSERT INTO `memo`(`brand_name`, `area_name`, `delivery_man`, `product_name`, `product_load`, `product_return`, `product_sale`,`product_damage`,`product_rate`) VALUES ('$brandName','$areaName','$delManName','$productName','$productLoad','$productReturn','$sale','$productDamage','$productRate')";

        if ($conn->query($sql) === TRUE) {
            $msg = "পণ্য যুক্ত হয়েছে";
            header("Localtion: memo.php");
        } else {
            $msg = mysqli_error($conn);
            header("Localtion: create-sheet.php");
        }
        echo $msg;
    }
    $conn->close();
?>