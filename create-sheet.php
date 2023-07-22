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
<p class="d-none">company,area,delivery,product,load,ferot,bikri,dor</p>
<section class="mt-4">
  <div class="container">
    <form class="card">
      <div class="card-header">
        <nav class="nav nav-pills nav-fill">
          <a class="nav-link tab-pills" href="#">Step 1</a>
          <a class="nav-link tab-pills" href="#">Step 2</a>
          <a class="nav-link tab-pills" href="#">Step 3</a>
          <a class="nav-link tab-pills" href="#">Finish</a>
        </nav>
      </div>
      <div class="card-body">
        <div class="tab d-none">
          <div class="mb-3">
            <label for="brand_name" class="form-label">কোম্পানি</label>
            <input type="text" class="form-control" name="brand_name" id="brand_name">
          </div>
          <div class="mb-3">
            <label for="area_name" class="form-label">এড়িয়া</label>
            <input type="text" class="form-control" name="area_name" id="area_name">
          </div>
          <div class="mb-3">
            <label for="deliveryman_name" class="form-label">ডেলিভারী ম্যানের নাম</label>
            <input type="text" class="form-control" name="deliveryman_name" id="deliveryman_name">
          </div>
        </div>

        <div class="tab d-none">
          <div class="mb-3">
            <label for="product_name" class="form-label">প্রোডাক্টের নাম</label>
            <select name="product_name" id="product_name">
                <option muted>সিলেক্ট করুন</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="product_load" class="form-label">লোড</label>
            <input type="number" class="form-control" name="product_load" id="product_load">
          </div>
        <div class="mb-3 col-md-6">
            <label for="product_return" class="form-label">ফেরত</label>
            <input type="number" class="form-control" name="product_return" id="product_return">
        </div>
        <div class="mb-3 col-md-6">
            <label for="sale" class="form-label">বিক্রি</label>
            <input type="number" class="form-control" name="sale" id="sale" placeholder="Please enter state">
        </div>
        <div class="mb-3 col-md-6">
            <label for="product_rate" class="form-label">দর</label>
            <input type="number" class="form-control" name="product_rate" id="product_rate">
        </div>
        </div>

        <div class="tab d-none">
          <div class="mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Please enter company name">
          </div>
          <div class="mb-3">
            <label for="company_address" class="form-label">Company Address</label>
            <textarea class="form-control" name="company_address" id="company_address" placeholder="Please enter company address"></textarea>
          </div>
        </div>

        <div class="tab d-none">
          <p>All Set! Please submit to continue. Thank you</p>
        </div>
      </div>
      <div class="card-footer text-end">
        <div class="d-flex">
          <button type="button" id="back_button" class="btn btn-link" onclick="back()">Back</button>
          <button type="button" id="next_button" class="btn btn-primary ms-auto" onclick="next()">Next</button>
        </div>
      </div>
    </form>
  </div>
</section>
<?php @include("layout/footer.php") ?>