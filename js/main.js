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

// Get order details
$(function(){
    $(".order-details").click(function(e){
        $("#order-details-name").text( $(this).attr('data-product-name') );
        $("#order-details-image").css("background", "transparent url('" + $(this).attr('data-product-image') + "') no-repeat center");
        $("#order-details-image").css("background-size", "100%");
        $("#order-details-description").text( $(this).attr('data-product-description') );
        $("#order-details-price").text("DKK " + $(this).attr('data-product-price') );
        $("#place-order").attr('href', '/place-guest-order.php?productId=' + $(this).attr('data-product-id') + '&vendorId=' + $(this).attr('data-product-vendor-id') + '&userId=0');
        return e.preventDefault();
    });
});

$(function(){
    $("#saveGuestCustomerEmailAddress").click(function(e){
        var currentHref = $("#place-order").attr("href");
        $("#place-order").attr("href", currentHref + "&guestEmail=" + $("#guestCustomerEmailAddress").val());
        $("#place-order").css("visibility", "visible");
        return e.preventDefault();
    });
});