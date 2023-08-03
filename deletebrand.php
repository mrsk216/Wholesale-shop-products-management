<?php      
    @include("config.php");

    $id = $_GET['brand_id'];
    
    $sql = "DELETE FROM `brand` WHERE `id` = '$id'";

    $conn->query($sql);
    header("Location: /zihan");

    $conn->close();    
?>