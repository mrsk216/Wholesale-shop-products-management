<?php      
    @include("config.php");

    $id = $_GET['pid'];
    $brand = $_GET['pbrand'];
    $date = $_GET['pc'];
    $dAmount = $_GET['product_damage'];

    $sql = "UPDATE `memo` SET `damage_amount`='$dAmount' where `id` = '$id'";

    $conn->query($sql);
    header("Location: /zihan/history.php?brand=".$brand."&history=".$date);

    $conn->close();    
?>