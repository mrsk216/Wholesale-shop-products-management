<?php @include("layout/header.php") ?>
<?php
if(isset($_GET['brand']) && isset($_GET['history'])){
    @include("config.php");
    $srcdate = $_GET['history'];
    $brandName = $_GET['brand'];
    $memo_data = "SELECT * FROM `memo` where `brand_name` = '$brandName' AND `created_at` = '$srcdate'";
    $result = $conn->query($memo_data);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }else{
        $data[] = array('hay');
    }
    $conn->close();
}
?>
<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 mt-4">
                <div class="d-flex justify-content-center gap-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#search">
                    তারিখ দিয়ে খুজুন
                    </button>
                </div>
            </div>
        </div>
        <div id="searchRslt" class="row align-items-center mt-5 <?php if(isset($_GET['history'])){echo '';}else{echo 'd-none';}; ?>">
            <div class="col-12">
                <div class="w-100 d-flex gap-3 mb-3">
                    <a href="./" class="btn btn-info">হোম পেজে যান</a> 
                    <button type="button" class="btn btn-info" onclick="printDiv('memo')"><i class="fa-solid fa-print me-2"></i>প্রিন্ট</button>
                </div>
                <div id="memo" class="card">
                    <div class="card-body">
                        <?php if ($result->num_rows > 0) { ?>
                        <h3 class="h1 fw-bold text-center"><?php echo $data[0]['brand_name']; ?></h3>
                        <div class="w-100 d-flex justify-content-between">
                            <div class="w-100">
                                <ul>
                                    <li class="text-center">এরিয়াঃ <?php echo $data[0]['area_name']; ?></li>
                                    <li class="text-center">ডেলিভারিঃ <?php echo $data[0]['delivery_man']; ?></li>
                                    <li class="text-center">তারিখঃ <?php echo date_format(date_create($data[0]['created_at']),"d/m/Y"); ?></li>
                                </ul>
                            </div>
                        </div>
                        <?php } ?>
                        <div id="DataTable" class="w-100">
                            <table class="table table-responsive table-striped mt-4">
                                <thead>
                                    <tr class="text-center">
                                        <th>ক্রঃমিঃ</th>
                                        <th>পণ্যের নাম</th>
                                        <th>লোড</th>
                                        <th>ফ্রী</th>
                                        <th>ফেরত</th>
                                        <th>বিক্রি</th>
                                        <th>দর</th>
                                        <th>টাকা</th>
                                        <th>কার্যক্রম</th>
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
                                                echo '<td>'.$data[$i]["product_name"].'</td>';
                                                echo '<td>'.$data[$i]["product_load"].'</td>';
                                                echo '<td>'.$data[$i]["product_free"].'</td>';
                                                echo '<td>'.$data[$i]["product_return"].'</td>';
                                                echo '<td class="fw-bold">'.$data[$i]["product_sale"].'</td>';
                                                echo '<td class="fw-bold">'.$data[$i]["product_rate"].'</td>';
                                                echo '<td class="fw-bold">'.($data[$i]["product_sale"]*$data[$i]["product_rate"]).'</td>';
                                                echo '<td><a href="./edit-sheet.php?id='.$data[$i]["id"].'"><i class="fa-solid fa-pen-to-square fs-4"></i></a></td>';
                                                echo '</tr>';
                                                $sum += ($data[$i]["product_sale"]*$data[$i]["product_rate"]);
                                            }
                                            echo '
                                                <tr class="text-center">
                                                    <td>ড্যামেজ</td>
                                                    <td class="fw-bold">
                                                        <form action="addDamage.php" method="GET">
                                                            <input type="hidden" name="pid" value="'.$data[0]["id"].'">
                                                            <input type="hidden" name="pbrand" value="'.$data[0]["brand_name"].'">
                                                            <input type="hidden" name="pc" value="'.$data[0]["created_at"].'">
                                                            <div class="w-50 input-group mb-3">
                                                                <span class="input-group-text bg-transparent border-end-0" id="damagetk">টাকা</span>
                                                                <input type="text" name="product_damage" value="'.$data[0]["damage_amount"].'" class="form-control border-start-0" aria-label="damage" aria-describedby="damagetk">
                                                                <button class="btn btn-outline-secondary" type="submit">যোগ করুন</button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td colspan="4"></td>
                                                    <td class="h5 fw-bold">মোটঃ</td>
                                                    <td class="h5 fw-bold">'.$sum - (int)$data[0]["damage_amount"].'</td>
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
                        </div>
                    </div>
                </div>       
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="search" tabindex="-1" aria-labelledby="Search Modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="history.php" method="" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">তারিখ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="brand" class="form-control form-control-lg rounded-pill my-3" value="<?php echo $_GET['brand']; ?>">
                <input type="date" name="history" class="form-control form-control-lg rounded-pill my-3">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                <button type="submit" id="searchBtn" class="btn btn-info">খুজুন</button>
            </div>
        </form>
    </div>
</div>
<?php @include("layout/footer.php") ?>