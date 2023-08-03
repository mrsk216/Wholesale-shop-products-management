function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}

$('#printBtn').click(function(){
    $(this).css('display',"none");
    window.print();
});

const myTimeout = setTimeout(alert, 5000);

function alert(){
    document.querySelector('.alert').style.display = 'none';
}

$('.addquantity').click(function(){
    $addQuantityId = $(this).attr('id');
    $("#id").val($addQuantityId);
});











$(".save-btn").click(function(){
    $product_load = $("#memoProductLoad").val();
    $product_return = $("#memoProductReturn").val();
    $product_sale = ($product_load - $product_return);
    $("#memoProductSale").val($product_sale);
    $(this).slideUp();
    $(".create-btn").slideDown();
});