<?php @include("layout/header.php") ?>

<section>
    <div class="container">
        <div class="row align-items-center brands">
            <div class="col-12">
                <div class="row justify-content-center gap-5">
                    <div class="col-10 col-md-7 col-lg-4">
                        <a href="create-sheet.php?brand=<?php echo $_GET['brand']; ?>" class="btn btn-lg btn-info fw-bold w-100">মেমো তৈরি করুন</a>
                    </div>
                    <div class="col-10 col-md-7 col-lg-4">
                        <a href="history.php?brand=<?php echo $_GET['brand']; ?>" class="btn btn-lg btn-info fw-bold w-100">পূর্ববর্তী মেমো দেখুন</a>
                    </div>
                    <div class="col-10 col-md-7 col-lg-4">
                        <a href="stock.php?brand=<?php echo $_GET['brand']; ?>" class="btn btn-lg btn-info fw-bold w-100">স্টক দেখুন</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php @include("layout/footer.php") ?>