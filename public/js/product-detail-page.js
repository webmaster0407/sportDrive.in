
var userAgent=window.navigator.userAgent;
var isMobile=/iPhone|iPad|android/i.test(userAgent);
console.log(isMobile)
var options={on:isMobile?'click':'mouseover',touch:isMobile?false:true}
    $('#ex3').zoom(options);

$(document).ready(function(){
   
    if($(".colorselect").length == 1)
	{
        $(".colorselect").addClass('selColorInit');
	}
});
/*// display w.r.t sizes available on select color
    $('.colorselect').click(function () {
        var img = $(this);
        var color = $(this).attr('data-val');
        var token = $('input[name=_token]').val();
        var pid = $('input[name=pid]').val();
        var changeImgName = $(this).attr('data-img');

        $('#'+color).closest('li').siblings().css({
            'border':'none',
        });
        //alert(changeImg);
        $.ajax({

            url: "/product/display-size",
            headers: {'X-CSRF-TOKEN': token},
            data: {"color":color,"pid":pid},
            type: 'POST',
            datatype: 'JSON',
            success: function (resp) {
                $('#size-list').html(resp['sizeList']);
                $('#colorimgList').html(resp['imgList']);
                $('#selectedColor').val(color);
                $('#'+color).closest('li').css({
                    'border':'2px',
                    'border-color':'black',
                    'border-style': 'solid',
                });
                if(changeImgName != ''){

                    var imghtm ="<img src='/uploads/products/images/"+pid+"/1024x1024/"+changeImgName+"'>";
                    $('#ex3').html(imghtm);
                    
                    $('#ex3').zoom(options);
                }

            }
        });
    });*/
// size select  & display price w.r.t selected config
    if($('#size-list li').length>0) {
        $("#size-list").on("click",".sizeselect", function(){
            var size = $(this).attr('data-val');
            $(this).siblings().css({
                'border-color':'#fff',
            });
            $('#selectedSize').val(size);
            $(this).css({
                'border-color':'black',
            });
            var token = $('input[name=_token]').val();
            var pid = $('input[name=pid]').val();
            var selectedColor = $('#selectedColor').val();

            if(selectedColor == ""){
                event.preventDefault();
                return false;
            }

            var selectedSize = size;
            $.ajax({
                url: "/product/display-price",
                headers: {'X-CSRF-TOKEN': token},
                data: {"selectedColor":selectedColor,"pid":pid,"selectedSize":selectedSize},
                type: 'POST',
                datatype: 'JSON',
                success: function (resp) {
                    $('#configPrice').html(resp);
                }
            });
        });
    }else{
      /*  $("#color-list").on("click",".colorselect", function(){
            var color = $(this).attr('data-val');

            $('#selectedColor').val(color);

            var token = $('input[name=_token]').val();
            var pid = $('input[name=pid]').val();
            var selectedSize = $('#selectedSize').val();

            if(selectedSize == ""){
                event.preventDefault();
                return false;
            }

            var selectedColor = color;
            $.ajax({
                url: "/product/display-price",
                headers: {'X-CSRF-TOKEN': token},
                data: {"selectedColor":selectedColor,"pid":pid,"selectedSize":selectedSize},
                type: 'POST',
                datatype: 'JSON',
                success: function (resp) {
                    $('#configPrice').html(resp);
                }
            });
        });*/
    }
// change image of large box onclick config images       
	/*$(document).on("click",".changeImg", function(){
        var imgName = $(this).attr('data-val');
        var cid = $(this).attr('data-config');
        var token = $('input[name=_token]').val();
        var pid = $('input[name=pid]').val();

        $.ajax({
            url: "/product/display-image",
            headers: {'X-CSRF-TOKEN': token},
            data: {"imgName":imgName,"pid":pid,"cid":cid},
            type: 'POST',
            datatype: 'JSON',
            success: function (resp) {
            	console.log(resp);
                $('#ex3').html(resp);
                // $('#ex3').zoom({ on:'click' });
                $('#ex3').zoom(options);
            }
        });

    });*/
       
	// quantity count plus/minus 
    //plugin bootstrap minus and plus
    //http://jsfiddle.net/laelitenetwork/puJ6G/
    $('.btn-number').click(function(e){
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type      = $(this).attr('data-type');
        $("#clicked_type").val(type);
        var input = fieldName?$("input[name='"+fieldName+"']"):$(this).parent().find('input.input-number');
		
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {

                if(currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }else{
					alert('Sorry, the minimum value was reached');
				}
                if(parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }
            } else if(type == 'plus') {

                if(currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }else{
					alert('Sorry, the maximum value was reached');
				}
                if(parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }
            }
        } else {
            input.val(0);
        }
    });

    $('.input-number').focusin(function(){
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {
        minValue =  parseInt($(this).attr('min'));
        maxValue =  parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());
        name = $(this).attr('name');
        if(valueCurrent >= minValue) {
            $(".btn-number[data-type='minus']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }

        if(valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }

        /*discount and price calculations*/
        var thisProductPricePrice =  parseInt($(this).attr('data-price'));
        var offer_discount = parseInt($("#offer_discount").val()) ;
        var offer_quantity = parseInt($("#offer_quantity").val()) ;
        var totalCount = 0;
        var priceArray = [];
        var sumArray = [];
        var subtotalAfterDiscount = 0;
        var sum = 0;
        var message = "";
        $(".input-number").each(function() {
             var i=0;
             var count= parseInt($(this).val());
             totalCount = totalCount + count;
             var price = parseInt($(this).attr('data-price'));
             if(count>0 && totalCount>1){
                 for (i = 0; i < count; i++) {
                     priceArray.push(price);
                 }
                sumArray.push(price*count);
                sum = sum+(price*count);
                 if(totalCount % offer_quantity == 0){
                     totalDiscount = (sum * offer_discount) / 100;
                     subtotalAfterDiscount = sum - totalDiscount;
                      message = "ADD ABOVE ITEMS FOR "+subtotalAfterDiscount+" IN TO THE CART";
                      $("#add-to-cart").val(message);
                 }else{
                     var CartsDoesNotHaveOffers = totalCount % offer_quantity;
                     var totalOfferApplicableProducts = totalCount - CartsDoesNotHaveOffers;
                     priceArray.sort();//sorting array price wise
                     var offerApplicableProducts = priceArray.slice(0, totalOfferApplicableProducts);
                     var offerNotApplicableProducts = priceArray.slice(totalOfferApplicableProducts, totalCount);
                     function getSum(total, num) {
                         return total + num;
                     }
                     var totalAmountApplicableForDiscount= offerApplicableProducts.reduce(getSum)
                     var totalDiscount = (totalAmountApplicableForDiscount*offer_discount)/100;
                     var subtotalAfterDiscount = totalAmountApplicableForDiscount - totalDiscount;
                     var offerNotApplicableProductsSum = offerNotApplicableProducts.reduce(getSum)
                     subtotalAfterDiscount = subtotalAfterDiscount + offerNotApplicableProductsSum;
                      message = "ADD ABOVE ITEMS FOR "+subtotalAfterDiscount+" IN TO THE CART";
                     $("#add-to-cart").val(message);
                 }
             }else if(totalCount == 1){
                message = "ADD ABOVE ITEMS FOR "+thisProductPricePrice+" IN TO THE CART";
                $("#add-to-cart").val(message);
                $("#total_price").val(thisProductPricePrice);
            }

        });

console.log(subtotalAfterDiscount);

    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	// tab active
        $('.tab-list li').click(function(){
            $(this).addClass('active');
            $(this).siblings().removeClass('active');
        });
	// star rating 

        function highlightStar(obj) {
            removeHighlight(this);
            $('.rating#enterRating  li').each(function(index) {
                $(this).addClass('highlight');
                if(index == $('.rating#enterRating li').index(obj)) {
                    return false;
                }
            });
        }

        function removeHighlight() {
            $('.rating#enterRating li').removeClass('selected');
            $('.rating#enterRating li').removeClass('highlight');
        }
        function addRating(obj) {
            $('.rating#enterRating   li').each(function(index) {
                $(this).addClass('selected');
                $('#rating').val((index+1));
                if(index == $('.rating#enterRating   li').index(obj)) {
                    return false;
                }
            });
        }
        function resetRating() {
            if($('#rating').val() != 0) {
                $('.rating#enterRating  li').each(function(index) {
                    $(this).addClass('selected');
                    if((index+1) == $('#rating').val()) {
                        return false;
                    }
                });
            }
        }
 // review rating pagination 

        $(document).on("click", 'ul.pagination a', function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            var nextPage = url.split('page=')[1];
            var  review_url = $("#review_url").val();
            var reviewVal = review_url.replace(/,\s*$/, "");
            var n = reviewVal.includes("page=");
            if(n){
                var currentPage = reviewVal.split('page=')[1];
                if(currentPage == "undefined"){
                    currentPage = 1;
                }else{
                    currentPage = currentPage.split('&')[0];
                }
            }else{
                currentPage = 1;
            }
            var pid = $('input[name=pid]').val();
            var token = $('input[name=_token]').val();
            $.ajax({
                type: "POST",
                headers: {'X-CSRF-TOKEN': token},
                url: "/product/rating-review/"+pid,
                data: {"reviewPara": reviewVal,"page":nextPage},
                success: function (data) {
                    $("#reviewList").html(data['result']);
                    $(".pagination").replaceWith(data['links']);

                }
            });

        });

        $('.add-cart').click(function(event){
            var selectedColor= $('#selectedColor').val();
            var selectedSize = $('#selectedSize').val();
            if(selectedColor=="" || selectedSize== ""){
                alert("Please Select configuration attributes.");
                event.preventDefault();
                return false;
            }
        });
/*close video on close button*/
$('#youtube_button_close').click(function(){
    var video = $("#youtube_player").attr("src");
        $("#youtube_player").attr("src","");
        $("#youtube_player").attr("src",video);
});