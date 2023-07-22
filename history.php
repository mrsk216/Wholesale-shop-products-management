<?php @include("layout/header.php") ?>

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
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="search" tabindex="-1" aria-labelledby="Search Modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/" method="" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">তারিখ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="date" name="history" class="form-control form-control-lg rounded-pill my-3">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                <button type="submit" class="btn btn-info">খুজুন</button>
            </div>
        </form>
    </div>
</div>
<?php @include("layout/footer.php") ?>