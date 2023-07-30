<?php @include("layout/header.php") ?>
<?php
    @include("config.php");
    $createdDate = $_GET['created_at'];
    if($_GET['brand'] == "কোকোলা ফুড প্রোডাক্টস্ লিঃ"){
        $memo_data = "SELECT * FROM `memo` where `brand_name` = 'কোকোলা ফুড প্রোডাক্টস্ লিঃ' AND `created_at` = '$createdDate'";
    }else if($_GET['brand'] == "CBL মানচি"){
        $memo_data = "SELECT * FROM `memo` where `brand_name` = 'CBL মানচি' AND `created_at` = '$createdDate'";
    }else if($_GET['brand'] == "একমি কনজুমার লিঃ"){
        $memo_data = "SELECT * FROM `memo` where `brand_name` = 'একমি কনজুমার লিঃ' AND `created_at` = '$createdDate'";
    }
    $result = $conn->query($memo_data);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    $conn->close();
?>
<style>
    header{
        display:none;
    }
    .memo{
        width:100%;
        min-height:100vh;
        padding-top:50px;
    }
</style>
<section class="memo bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="w-100 d-flex gap-3 mb-3">
                    <a href="./" class="btn btn-info">হোম পেজে যান</a>                    
                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-info" onclick="printDiv('memo')"><i class="fa-solid fa-print me-2"></i>প্রিন্ট</button>
                    </div>
                </div>
                <div id="memo" class="card">
                    <div class="card-body">
                        <h3 class="h1 fw-bold text-center">খান এন্টারপ্রাইজ</h3>
                        <div class="w-100 d-flex justify-content-between">
                            <div class="w-25">
                                <ul class="ps-0">                                    
                                    <li class="my-2">এরিয়াঃ <?php echo $data[0]['area_name']; ?></li>
                                    <li>ডেলিভারিঃ <?php echo $data[0]['delivery_man']; ?></li>
                                </ul>
                            </div>
                            <div class="w-50">
                                <ul>
                                    <li class="text-center">মোঃ রিপন ও জাহিদ খান</li>
                                    <li class="text-center"><a href="tel:+8801713532203">০১৭১৩৫৩২২০৩</a></li>
                                    <li class="text-center"><a href="tel:+8801716021815">০১৭১৬০২১৮১৫</a></li>
                                </ul>
                            </div>
                            <div class="w-25">
                                <ul>
                                    <li class="text-end">তারিখঃ <?php   $date=date_create($_GET['created_at']); echo date_format($date,"d/m/Y"); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div id="DataTable" class="w-100">
                            <table class="table table-responsive table-striped mt-4">
                                <thead>
                                    <tr class="text-center">
                                        <th>ক্রঃমিঃ</th>
                                        <th>কোম্পানি নাম</th>
                                        <th>পণ্যের নাম</th>
                                        <th>লোড</th>
                                        <th>ফেরত</th>
                                        <th>বিক্রি</th>
                                        <th>ড্যামেজ</th>
                                        <th>দর</th>
                                        <th>টাকা</th>
                                    </tr>
                                </thead>
                            <tbody>
                                <?php 
                                    if ($result->num_rows > 0) { 
                                        $num = '1';
                                        $sum = 0;
                                        for($i = 0;$i<count($data);$i++) {
                                            echo '<tr class="text-center">';
                                            echo '<td width="30px">'.$num++.'</td=>';
                                            echo '<td id="brandName">'.$data[$i]["brand_name"].'</td>';
                                            echo '<td>'.$data[$i]["product_name"].'</td>';
                                            echo '<td>'.$data[$i]["product_load"].'</td>';
                                            echo '<td>'.$data[$i]["product_return"].'</td>';
                                            echo '<td class="fw-bold">'.$data[$i]["product_sale"].'</td>';
                                            echo '<td>'.$data[$i]["product_damage"].'</td>';
                                            echo '<td class="fw-bold">'.$data[$i]["product_rate"].'</td>';
                                            echo '<td class="fw-bold">'.($data[$i]["product_sale"]*$data[$i]["product_rate"])-($data[$i]["product_damage"]*$data[$i]["product_rate"]).'</td>';
                                            echo '</tr>';
                                            $sum += ($data[$i]["product_sale"]*$data[$i]["product_rate"])-($data[$i]["product_damage"]*$data[$i]["product_rate"]);
                                        }
                                        echo '
                                            <tr class="text-center">
                                                <td colspan="7"></td>
                                                <td>মোটঃ</td>
                                                <td class="fw-bold">'.$sum.'</td>
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
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>
<?php @include("layout/footer.php") ?>
