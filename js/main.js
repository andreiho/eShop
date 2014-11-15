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
        $(".remove-product").attr('href', '/admin/remove-product.php?id=' + $(this).attr('data-remove-product'));
        return e.preventDefault();
    });
});