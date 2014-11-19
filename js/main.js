// Header resize
$(window).scroll(function(){
    if($(document).scrollTop() > 100) {
        $('#header').addClass('small');
    } else {
        $('#header').removeClass('small');
    }
});

// Delete product
$(function(){
    $(".remove").click(function(e){
        $("#remove-product").attr('href', '/admin/remove-product.php?id=' + $(this).attr('data-remove-product'));
        return e.preventDefault();
    });
});

// Order review
$(function(){

    $(".review-order").click(function(){

        var pId = $(this).attr('data-product-id');
        var pName = $(this).attr('data-product-name');
        var pDesc = $(this).attr('data-product-description');
        var pImg = $(this).attr('data-product-image');
        var pPrice = $(this).attr('data-product-price');

        var guestOrderProductDetails = [pName, pDesc, pImg, pPrice];

        localStorage.setItem('orderReview', JSON.stringify(guestOrderProductDetails));

        window.location.href = $(this).attr('href');

    });
});

// Get guest order details
$(function(){

    var orderReviewProductDetails = JSON.parse(localStorage.getItem('orderReview'));

    $("#order-details-name").text( orderReviewProductDetails[0] );
    $("#order-details-image")
        .css("background", "transparent url('" + orderReviewProductDetails[2] + "') no-repeat center")
        .css("background-size", "100%");
    $("#order-details-description").text( orderReviewProductDetails[1] );
    $("#order-details-price").text("DKK " + orderReviewProductDetails[3] );
    $(".productPriceFromLocalStorage").val( orderReviewProductDetails[3] );

});

