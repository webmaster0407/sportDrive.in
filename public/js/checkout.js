/*cart methods start here*/

/*update qty*/
$('.update-qty').click(function (event) {
    event.preventDefault();
    var cart_id = $(this).attr("data-cart-id");
    var qty =  $('#'+cart_id+"_qty").val();
    var token = $('input[id=token]').val();
    if(qty<=0) return false;
    $.ajax({
        type: "POST",
        headers: {'X-CSRF-TOKEN': token},
        url: "/cart/update",
        data: {"cart_id": cart_id,"qty":qty},
        success: function (data) {
            if(data['status']=="403"){
               var error = "<div class='error-msg'> <span>"+data['message']+"</span></div>"
                $('#'+cart_id).append(error);
                $('#'+cart_id+"_qty").val(data['quantity']);
            }else{
                $('#'+cart_id+"_original_price").text(data['originalPricePerProduct']);
                $('#'+cart_id+"_final_price").text(data['finalPricePerProduct']);
                $('#'+cart_id+"_total").text(data['cart_total']);
                $('#subtotal').text(data['final_total']);
                $('#offer_discount').text(data['final_discount']);
                $('#estimated_total').text(data['estimated_total']);
            }
        }
    });
});

$('.remove-from-cart').click(function (event) {
    event.preventDefault();
    var token = $('input[id=token]').val();
    var cart_id = $(this).attr("data-cart-id");
    $.ajax({
        type: "POST",
        headers: {'X-CSRF-TOKEN': token},
        url: "/cart/remove",
        data: {"cart_id": cart_id},
        success: function (data) {
            if(data==403){
                location.reload();
            }else{
                //hide the deleted cart
                    $("#"+cart_id).hide();
                if(data['total_cart_count']>0){
                    $('#subtotal').text(data['final_total']);
                    $('#offer_discount').text(data['final_discount']);
                    $('#estimated_total').text(data['estimated_total']);
                    $("#cart_count").text(data['total_cart_count']);
                }else{
                    $("#all_cart_data").hide();
                    $("#empty_cart_show").show();
                    $("#cart_count").hide();

                }
            }
        }
    });

});
/*cart methods ends  here*/





/*checkout methods starts  here*/
$('.delivery_type').click(function(){
    var val = $(this).val();
    var std_del_ch = $("#std_del_ch").val();
    var ex_del_ch = $("#ex_del_ch").val();
    var checkout_subtotal = $("#hidden_subtotal").val();
    var checkout_estimated_total=+checkout_subtotal+(+ex_del_ch);
    if(val=="express"){
        $("#checkout_estimated_total").text(checkout_estimated_total+".00");
        $("#shipping_charges").text(ex_del_ch);
    }else{
        var checkout_estimated_total=+checkout_subtotal+(+std_del_ch);
        $("#checkout_estimated_total").text(checkout_estimated_total+".00");
        $("#shipping_charges").text(std_del_ch);
    }
});

//select shipping Address
$('.select_shipping').click(function(){
    var val = $(this).val();
    var divData = $("#all_shipping_"+val).html();
    $("#default_shipping_address").html(divData);
});

//select Billing Address
$('.select_billing').click(function(){
    var val = $(this).val();
    var divData = $("#all_billing_"+val).html();
    $("#default_billing_address").html(divData);
});

//make billing and shipping address same
$('#same_as_ship').click(function(){
    var divData = $("#default_shipping_address").html();
    $("#default_billing_address").html(divData);
});


/*checkout methods ends  here*/


/*other methods*/
var clickTimer;
$('.static-right-content > div').on('touchstart',function(){
    clearTimeout(clickTimer);
    $(".mob-menu").removeClass("show");
    $(".mob-menu").addClass("hide");
    $(".nav").addClass('hide');
    $(".nav").removeClass("show");

    $(this).addClass('tray').siblings().removeClass('tray');
    clickTimer=setTimeout(function(){$('.static-right-content div').removeClass('tray')},7000)
});
$('body').on('touchstart',function(e){var _tray=$(e.target).parents('.static-right-content').length; if(_tray>0){return false}$('.static-right-content div').removeClass('tray')});

$('#Continue').click(function(){
	var val =  $('#shipping_address_id').val();
	if(val == "")
	  $("#error").html("<div class='alert alert-danger'>Please add address.</div>");
});

