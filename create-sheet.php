<?php @include("layout/header.php") ?>
<?php
    @include("config.php");

    $brandName = $_GET['brand'];
    if(isset($_GET['brand'])){
        $stock_data = "SELECT * FROM `stock` where `brand_name` = '$brandName'";
    }
    $result = $conn->query($stock_data);
    if ($result->num_rows <= 0){
      header("Location: /zihan");
    }

    $conn->close();
?>


<section class="my-4">
  <div class="container">
    <form action="createMemo.php" method="GET" class="row flex-column justify-content-center align-items-center">
      <div class="col-12 col-md-6 col-lg-4 mt-4">
        <div class="tab d-none">
          <div class="mb-3">
            <label for="brand_name" class="form-label">কোম্পানি</label>
            <input type="text" class="form-control" name="brand_name" id="brand_name" value="<?php echo $_GET['brand']; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="area_name" class="form-label">এরিয়া</label>
            <select class="form-control" name="area_name" id="area_name" required> 
              <option value="">সিলেক্ট করুন</option>            
              <option value="হরিরামপুর">হরিরামপুর</option>
              <option value="ঝিটকা">ঝিটকা</option>
              <option value="বালিরটেক">বালিরটেক</option>
              <option value="বেরিবাধ">বেরিবাধ</option>
              <option value="বনপারিল">বনপারিল</option>
              <option value="হাটিপাড়া">হাটিপাড়া</option>
              <option value="অন্যান্য">অন্যান্য</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="deliveryman_name" class="form-label">ডেলিভারী ম্যানের নাম</label>
            <input type="text" class="form-control" name="deliveryman_name" id="deliveryman_name" required>
          </div>
        </div>

        <div class="tab d-none">
          <div id="moreForm">
            <div id="card">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="mb-3">
                    <label for="product_name" class="form-label">প্রোডাক্টের নাম</label>
                    <select class="form-control pro-name" name="product_name[]" required>
                      <option value="">সিলেক্ট করুন</option>
                      <?php
                        if ($result->num_rows > 0) { 
                          while($row = $result->fetch_assoc()) {
                            echo '<option value="'.$row['product_name'].'" class="pro-name-val">'.$row['product_name'].'</option>';
                          }
                        }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="product_load" class="form-label">লোড</label>
                    <input type="number" class="form-control" name="product_load[]">
                  </div>
                  <div class="mb-3">
                    <label for="product_free" class="form-label">ফ্রী</label>
                    <input type="number" class="form-control" name="product_free[]">
                  </div>
                  <div class="mb-3">
                      <label for="product_return" class="form-label">ফেরত</label>
                      <input type="number" class="form-control" name="product_return[]">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <button type="button" onclick="addMore()" class="w-100 btn btn-info">আরো প্রোডাক্ট যুক্ত করুন</button>
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

<script>
  //when the Add Field button is clicked
  function addMore() {    
    $formCard = $("#card").html();
    $("#moreForm").append(    
      $formCard
    );  
  }  
  // $('.pro-name').click(function (){
  //     $(".pro-name option:selected").addClass('d-none');
  // });
</script>
<?php @include("layout/footer.php") ?>