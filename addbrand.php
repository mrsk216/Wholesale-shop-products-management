<?php      
    @include("config.php");

    $brand = $_GET['brand'];
    
    $sql = "INSERT INTO `brand`(`brand_name`) VALUES ('$brand')";

    $conn->query($sql);
    header("Location: /zihan");

    $conn->close();    
?>