<?php @include("layout/header.php") ?>
<?php
    @include("config.php");
    $brandName = $_GET['brand'];
    if(isset($_GET['brand'])){
        $stock_data = "SELECT * FROM `stock` where `brand_name` = '$brandName'";
    }
    $result = $conn->query($stock_data);
    $conn->close();
?>
<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 mt-4">
                <div id="printBtn-wapper" class="d-flex justify-content-between gap-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addStock">
                    স্টক যুক্ত করুন
                    </button>
                    <button class="btn btn-info d-flex align-items-center" onclick="printDiv('table-wapper')"><i class="fa-solid fa-print me-2"></i>প্রিন্ট</button>
                </div>
            </div>
            <div id="table-wapper" class="col-12 mt-4">
                <h4 class="text-center fw-bold">স্টকে থাকা পণ্যের তালিকা</h4>
                <?php 
                    if(isset($_GET['message'])){                      
                        echo '<div class="alert alert-success text-center" role="alert">'.$_GET['message'].'</div>';
                    }                   
                ?>
                <div id="DataTable" class="w-100">
                    <table class="table table-responsive table-striped mt-4">
                        <thead>
                            <tr class="text-center">
                                <th>ক্রমিক নং</th>
                                <th>কোম্পানি নাম</th>
                                <th>পণ্যের নাম</th>
                                <th>পরিমাণ</th>
                                <th>ফ্রী</th>
                                <th>দর</th>
                                <th>মূল্য</th>
                                <th>তারিখ</th>
                                <th>কার্যক্রম</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if ($result->num_rows > 0) { 
                                    $num = '1';
                                    $sum = 0;
                                    while($row = $result->fetch_assoc()) {
                                        $date = date_create($row["created_date"]);
                                        echo '<tr class="text-center">';
                                        echo '<td>'.$num++.'</td=>';
                                        echo '<td id="brandName">'.$row["brand_name"].'</td>';
                                        echo '<td>'.$row["product_name"].'</td>';
                                        echo '<td class="fw-bold">'.$row["product_quantity"].'</td>';
                                        echo '<td class="fw-bold">'.$row["product_free"].'</td>';
                                        echo '<td>'.$row["product_rate"].'</td>';
                                        echo '<td class="fw-bold">'.$row["total_price"].'</td>';
                                        echo '<td>'.date_format($date,"d/m/Y").'</td>';
                                        echo '<td><div class="d-flex justify-content-center align-items-center gap-2"><a href="stock.php?id='.$row["id"].'&brand='.$row["brand_name"].'&name='.$row["product_name"].'&quantity='.$row["product_quantity"].'&free='.$row["product_free"].'&rate='.$row["product_rate"].'&total_price='.$row["total_price"].'"><i class="fa-solid fa-pen-to-square fs-4"></i></a>|<a href="" class="addquantity" id="'.$row["id"].'" data-bs-toggle="modal" data-bs-target="#addquantity"><i class="fa-solid fa-circle-plus fs-4"></i></a></div></td>';
                                        echo '</tr>';
                                        $sum += $row["total_price"];
                                    }
                                    echo '
                                        <tr class="text-center">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>মোটঃ</td>
                                            <td class="fw-bold">'.$sum.'</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    ';
                                }else{
                                    echo '<tr class="text-center">'; 
                                    echo '<td colspan="9">কোনো প্রডাক্ট নেই!</td>';
                                    echo '</tr>';
                                }
                            ?>                            
                        </tbody>
                    </table>                    
                    <div id="table_box_bootstrap"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Add Product Modal -->
<div class="modal fade" id="addStock" tabindex="-1" aria-labelledby="Add Product Modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addModalLabel">পণ্য যুক্ত করুন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="addStock.php" method="GET" class="row justify-content-center">
                    <div class="form-group mb-3">
                        <label for="brand_name" class="text-secondary">কোম্পানি নাম</label>
                        <input type="text" name="brand_name" class="form-control form-control-lg rounded-pill" value="<?php echo $_GET['brand']; ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_name" class="text-secondary">পণ্যের নাম</label>
                        <input type="text" name="product_name" class="form-control form-control-lg rounded-pill" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_quantity" class="text-secondary">পরিমাণ</label>
                        <input type="number" name="product_quantity" class="form-control form-control-lg rounded-pill" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_free" class="text-secondary">ফ্রী</label>
                        <input type="number" name="product_free" class="form-control form-control-lg rounded-pill">
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_rate" class="text-secondary">দর</label>
                        <div class="input-group mb-3">
                            <input type="text" name="product_rate" class="form-control form-control-lg rounded-pill rounded-end" aria-label="Brand Name" aria-describedby="taka" required>
                            <span class="input-group-text rounded-pill rounded-start" id="taka">tk</span>
                        </div>
                    </div>
                    <div class="form-group d-flex gap-3 mb-3">
                        <button type="submit" class="btn btn-info">যুক্ত করুন</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .modal.fade.show.d-block {
        background: #0000007a;
    }
</style>
<!-- Edit Product Modal -->
<?php if(isset($_GET['id'])){ ?>
<div class="modal fade show d-block" id="editStock" tabindex="-1" aria-labelledby="Edit Product Modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editModalLabel">পণ্য পরিবর্তন করুন</h5>
                <a href="stock.php?brand=<?php echo $_GET['brand']; ?>" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form action="editStock.php" method="GET" class="row justify-content-center">
                    <input type="hidden" name="pro_id" class="form-control form-control-lg rounded-pill" value="<?php echo $_GET['id']; ?>" readonly>
                    <div class="form-group mb-3">
                        <label for="brand_name" class="text-secondary">কোম্পানি নাম</label>
                        <input type="text" name="brand_name" class="form-control form-control-lg rounded-pill" value="<?php echo $_GET['brand']; ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_name" class="text-secondary">পণ্যের নাম</label>
                        <input type="text" name="product_name" class="form-control form-control-lg rounded-pill" value="<?php echo $_GET['name']; ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_quantity" class="text-secondary">পরিমাণ</label>
                        <input type="number" name="product_quantity" class="form-control form-control-lg rounded-pill" value="<?php echo $_GET['quantity']; ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_free" class="text-secondary">ফ্রী</label>
                        <input type="number" name="product_free" class="form-control form-control-lg rounded-pill" value="<?php echo $_GET['free']; ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_rate" class="text-secondary">দর</label>
                        <div class="input-group mb-3">
                            <input type="text" name="product_rate" class="form-control form-control-lg rounded-pill rounded-end" value="<?php echo $_GET['rate']; ?>" aria-label="Brand Name" aria-describedby="tk" required>
                            <span class="input-group-text rounded-pill rounded-start" id="tk">tk</span>
                        </div>
                    </div>
                    </div>
                    <div class="form-group d-flex gap-3 mb-3 px-3">
                        <button type="submit" class="btn btn-info">পরিবর্তন করুন</button>
                        <a href="stock.php?brand=<?php echo $_GET['brand']; ?>" type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল করুন</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Add Quantity -->
<div class="modal fade" id="addquantity" tabindex="-1" aria-labelledby="Add Quantity Modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form action="stock.php" method="GET">
                    <div class="form-group mb-3">
                        <label for="product_ex_quantity" class="text-secondary">পরিমাণ</label>
                        <input type="number" name="product_ex_quantity" class="form-control form-control-lg rounded-pill" required>
                        <input type="hidden" name="product_id" id="id" class="form-control form-control-lg rounded-pill">
                        <input type="hidden" name="brand" class="form-control form-control-lg rounded-pill" value="<?php echo $_GET['brand']; ?>">
                        <input type="hidden" name="req" class="form-control form-control-lg rounded-pill" value="addquantity">
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_ex_free" class="text-secondary">ফ্রী</label>
                        <input type="number" name="product_ex_free" class="form-control form-control-lg rounded-pill">
                    </div>
                    <div class="form-group d-flex gap-3 mb-3">
                        <button type="submit" class="btn btn-info">যুক্ত করুন</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php  
    if(isset($_GET['req']) == 'addquantity'){
        @include("config.php");
        $id = $_GET['product_id'];
        $brand = $_GET['brand'];
        $date = date('Y-m-d H:i:s');
        $UpdatableProductData = "SELECT * FROM `stock` where `id` = '$id'";
        $mainData = $conn->query($UpdatableProductData);
        $mainDataArray = $mainData->fetch_assoc();
        $quantity = $mainDataArray['product_quantity'] + $_GET['product_ex_quantity'];        
        $free = $mainDataArray['product_free'] + $_GET['product_ex_free'];        
        $total_price = $quantity * $mainDataArray['product_rate'];
        $sql = "UPDATE `stock` SET `product_quantity`='$quantity',`product_free`='$free',`total_price`='$total_price',`created_date`='$date' where `id` = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">window.location.href = "stock.php?brand='.$brand.'";</script>';
        }        
        $conn->close();
    }    
?>
<?php @include("layout/footer.php") ?>
