$('#printBtn').click(function(){
    //$('#printBtn-wapper').addClass('d-none');
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