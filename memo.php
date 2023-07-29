<?php @include("layout/header.php") ?>
<?php
    @include("config.php");

    if($_GET['brand'] == "কোকোলা ফুড প্রোডাক্টস্ লিঃ"){
        $memo_data = "SELECT * FROM `memo` where `brand_name` = 'কোকোলা ফুড প্রোডাক্টস্ লিঃ'";
    }else if($_GET['brand'] == "CBL মানচি"){
        $memo_data = "SELECT * FROM `memo` where `brand_name` = 'CBL মানচি'";
    }else if($_GET['brand'] == "একমি কনজুমার লিঃ"){
        $memo_data = "SELECT * FROM `memo` where `brand_name` = 'একমি কনজুমার লিঃ'";
    }
    $result = $conn->query($memo_data);

    $conn->close();
?>
<section>
    <div class="container">
        <div class="row align-items-center">
            <div id="table-wapper" class="col-12 mt-4">
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
                                <th>Area Name</th>
                                <th>Delivery নাম</th>
                                <th>পণ্যের নাম</th>
                                <th>load</th>
                                <th>ferot</th>
                                <th>bikri</th>
                                <th>damage</th>
                                <th>rate</th>
                                <th>subtotal</th>
                                <th>কার্যক্রম</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if ($result->num_rows > 0) { 
                                    $num = '1';
                                    $subtotal = 0;
                                    $total = 0;
                                    while($row = $result->fetch_assoc()) {
                                        $subtotal = ($row["product_sale"]*$row["product_rate"])-($row["product_damage"]*$row["product_rate"]);
                                        $date = date_create($row["created_at"]);
                                        echo '<tr class="text-center">';
                                        echo '<td>'.$num++.'</td=>';
                                        echo '<td id="brandName">'.$row["brand_name"].'</td>';
                                        echo '<td>'.$row["area_name"].'</td>';
                                        echo '<td>'.$row["delivery_man"].'</td>';
                                        echo '<td>'.$row["product_name"].'</td>';
                                        echo '<td>'.$row["product_load"].'</td>';
                                        echo '<td>'.$row["product_return"].'</td>';
                                        echo '<td class="fw-bold">'.$row["product_sale"].'</td>';
                                        echo '<td class="fw-bold">'.$row["product_damage"].'</td>';
                                        echo '<td>'.$row["product_rate"].'</td>';
                                        echo '<td class="fw-bold">'.$subtotal.'</td>';
                                        echo '<td>'.date_format($date,"d/m/Y").'</td>';
                                        echo '</tr>';
                                        $total += $subtotal;
                                    }
                                    echo '
                                        <tr class="text-center">
                                            <td colspan="9"></td>
                                            <td>মোটঃ</td>
                                            <td class="fw-bold">'.$total.'</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    ';
                                }else{
                                    echo '<tr class="text-center">'; 
                                    echo '<td colspan="8">কোনো প্রডাক্ট নেই!</td>';
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

<?php @include("layout/footer.php") ?>
