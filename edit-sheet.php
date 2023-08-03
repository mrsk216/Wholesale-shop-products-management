<?php @include("layout/header.php") ?>
<?php
    @include("config.php");
    $id = $_GET['id'];
    $memo_data = "SELECT * FROM `memo` where `id` = '$id'";
    $result = $conn->query($memo_data);
    if ($result->num_rows > 0) { 
      while($row = $result->fetch_assoc()) {
        $data = $row;
      }
    }
    $conn->close();
?>


<section class="my-4">
  <div class="container">
    <form action="editmemo.php" method="GET" class="row flex-column justify-content-center align-items-center">
      <div class="col-12 col-md-6 col-lg-4 mt-4">
        <div class="tab d-none">
          <div class="mb-3">
            <label for="brand_name" class="form-label">কোম্পানি</label>
            <input type="text" class="form-control" name="brand_name" id="brand_name" value="<?php echo $data['brand_name']; ?>" readonly>
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $data['id']; ?>" readonly>
            <input type="hidden" class="form-control" name="created_at" id="created_at" value="<?php echo $data['created_at']; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="area_name" class="form-label">এরিয়া</label>
            <input type="text" class="form-control" name="area_name" id="area_name" value="<?php echo $data['area_name']; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="deliveryman_name" class="form-label">ডেলিভারী ম্যানের নাম</label>
            <input type="text" class="form-control" name="deliveryman_name" id="deliveryman_name" value="<?php echo $data['delivery_man']; ?>" readonly>
          </div>
        </div>

        <div class="tab d-none">
          <div id="moreForm">
            <div id="card">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="mb-3">
                    <label for="product_name" class="form-label">প্রোডাক্টের নাম</label>
                    <input type="text" class="form-control" name="product_name" id="product_name" value="<?php echo $data['product_name']; ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="product_load" class="form-label">লোড</label>
                    <input type="number" class="form-control" name="product_load" value="<?php echo $data['product_load']; ?>" require>
                  </div>
                  <div class="mb-3">
                    <label for="product_free" class="form-label">ফ্রী</label>
                    <input type="number" class="form-control" name="product_free" value="<?php echo $data['product_free']; ?>" require>
                  </div>
                  <div class="mb-3">
                      <label for="product_return" class="form-label">ফেরত</label>
                      <input type="number" class="form-control" name="product_return" value="<?php echo $data['product_return']; ?>">
                  </div>
                  <div class="mb-3">
                      <label for="product_damage" class="form-label">ড্যামেজ</label>
                      <input type="number" class="form-control" name="product_damage" value="<?php echo $data['product_damage']; ?>">
                  </div>
                </div>
              </div>
            </div>
          </div>     
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4 text-end">
        <div class="d-flex">
          <button type="button" id="back_button" class="btn btn-info" onclick="back()">আগে যান</button>
          <button type="button" id="next_button" class="btn btn-info ms-auto" onclick="next()">সামনে যান</button>
        </div>
      </div>
    </form>
  </div>
</section>
<?php @include("layout/footer.php") ?>