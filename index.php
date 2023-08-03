<?php @include("layout/header.php") ?>
<?php
    @include("config.php");

    $brandData = "SELECT * FROM `brand`";
    $result = $conn->query($brandData);

    $conn->close();
?>
<section>
    <div class="container">
        <div class="row align-items-center brands">
            <div class="col-12">
                <div class="row justify-content-center gap-5">
                    <?php
                        if ($result->num_rows > 0) { 
                            while($row = $result->fetch_assoc()) {
                                echo '<div class="col-10 col-md-7 col-lg-4">';
                                echo '<a href="features.php?brand='.$row['brand_name'].'" class="btn btn-lg btn-info fw-bold w-100">'.$row['brand_name'].'</a>';
                                echo '</div>';
                            }
                        }
                    ?>
                </div>
                <div class="d-flex justify-content-center gap-3 mt-5">
                    <a href="" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addbrand">কোম্পানি যুক্ত করুন</a>
                    <a href="" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#deletebrand">কোম্পানি মুছে ফেলুন</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Brand -->
<div class="modal fade" id="addbrand" tabindex="-1" aria-labelledby="Add Brand Modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form action="addbrand.php" method="GET">
                    <div class="form-group mb-3">
                        <label for="brand" class="text-secondary">কোম্পানির নাম</label>
                        <input type="text" name="brand" class="form-control form-control-lg rounded-pill" required>
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

<!-- Delete Brand -->
<?php
    @include("config.php");

    $brand_data = "SELECT * FROM `brand`";
    $result = $conn->query($brand_data);

    $conn->close();
?>
<div class="modal fade" id="deletebrand" tabindex="-1" aria-labelledby="Add Brand Modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form action="deletebrand.php" method="GET">
                    <div class="form-group mb-3">
                        <label for="brand_id" class="text-secondary">কোম্পানির নাম</label>
                        <select name="brand_id" class="form-control">
                            <option value="">সিলেক্ট করুন</option> 
                            <?php
                                if ($result->num_rows > 0) { 
                                    $i = 0;
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["id"].'">'.$row["brand_name"].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group d-flex gap-3 mb-3">
                        <button type="submit" class="btn btn-info">মুছে ফেলুন</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php @include("layout/footer.php") ?>