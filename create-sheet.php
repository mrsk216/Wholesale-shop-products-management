<?php @include("layout/header.php") ?>
<?php
    @include("config.php");

    if($_GET['brand'] == "কোকোলা ফুড প্রোডাক্টস্ লিঃ"){
        $stock_data = "SELECT * FROM `stock` where `brand_name` = 'কোকোলা ফুড প্রোডাক্টস্ লিঃ'";
    }else if($_GET['brand'] == "CBL মানচি"){
        $stock_data = "SELECT * FROM `stock` where `brand_name` = 'CBL মানচি'";
    }else if($_GET['brand'] == "একমি কনজুমার লিঃ"){
        $stock_data = "SELECT * FROM `stock` where `brand_name` = 'একমি কনজুমার লিঃ'";
    }
    $result = $conn->query($stock_data);

    $conn->close();
?>

<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <form action="create-sheet" method="GET" class="row justify-content-center">
                    <div class="col-10 col-md-8 col-lg-6 col-xl-4">
                        <h4 class="text-center mt-4">শীট তৈরি করুন</h4>
                        <div class="form-group mb-3">
                            <label for="brand_name" class="text-secondary">কোম্পানি</label>
                            <input type="text" name="brand_name" class="form-control form-control-lg rounded-pill" value="<?php echo $_GET['brand']; ?>" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="area" class="text-secondary">এরিয়া</label>
                            <select name="area" class="form-control form-control-lg rounded-pill" required>
                                <option muted>সিলেক্ট করুন</option>
                                <option value="হরিরামপুর">হরিরামপুর</option>
                                <option value="ঝিটকা">ঝিটকা</option>
                                <option value="বালিরটেক">বালিরটেক</option>
                                <option value="বেরিবাধ">বেরিবাধ</option>
                                <option value="বনপারিল">বনপারিল</option>
                                <option value="হাটিপাড়া">হাটিপাড়া</option>
                                <option value="অন্যান্য">অন্যান্য</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="deliveryman" class="text-secondary">ডেলিভারি ম্যান</label>
                            <input type="text" name="deliveryman" class="form-control form-control-lg rounded-pill" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="product_name" class="text-secondary">পণ্যের নাম</label>
                            <select name="product_name" id="product_name" class="form-control form-control-lg rounded-pill" required>
                                <option muted>সিলেক্ট করুন</option>
                                <?php
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo '<option value="'.$row["product_name"].'">'.$row["product_name"].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="load" class="text-secondary">লোড</label>
                            <input type="number" name="load" id="memoProductLoad" class="form-control form-control-lg rounded-pill" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="return" class="text-secondary">ফেরত</label>
                            <input type="number" name="return" id="memoProductReturn" class="form-control form-control-lg rounded-pill" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="sale" class="text-secondary">বিক্রি</label>
                            <input type="number" name="sale" id="memoProductSale" class="form-control form-control-lg rounded-pill" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="rate" class="text-secondary">দর</label>
                            <div class="input-group mb-3">
                                <input type="number" name="rate" placeholder="stock theke auto asbe" class="form-control form-control-lg rounded-pill rounded-end" aria-label="Brand Name" aria-describedby="brand_name" required>
                                <span class="input-group-text rounded-pill rounded-start" id="brand_name">tk</span>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-info">Create</button>
                        </div>
                    </div>
                </form>
            </div>            
        </div>
    </div>
</section>
<?php @include("layout/footer.php") ?>