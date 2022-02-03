@extends('layouts.user')
@section('content')
    <div class="content">
        <div class="breadcrums">
            <div class="container">
                <ul>
                    <li><a href="#">Home / </a></li>
                    <li><a href="#">Product Listing / </a></li>
                    <li><a href="#" class="active">Checkout</a></li>
                </ul>
            </div>
        </div>
        <div class="listingContent">
            <div class="container">
                <div class="cart-Div">
                    <h2>Checkout</h2>
                    <ul class="check-tabs">
                        <li><a href="/cart/view">View Cart</a></li>
                        <li><a href="/checkout/1">Checkout Information</a></li>
                        <li class="active"><a href="#">Review Order</a></li>
                    </ul>
                    <form name="review_order" action="/payment/request/{{base64_encode($order->id)}}" method="post">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <input type="hidden" name="order_id" id="order_id" value="{{base64_encode($order->id)}}">
                        <input type="hidden" name="applied_code" id="hidden_code" value="">
                    <div class="cart-List">
                        <div class="address-section">
                            <div class="ship-addr">
                                <h3>Shipping Address</h3>
                                <div class="exist-address">
                                    <input type="hidden" name="shipping_address_id" id="shipping_address_id" value="{{$defaultShippingAddress['id']}}">
                                    <p><strong>{{$defaultShippingAddress['address_title']}}</strong></p>
                                    <p><strong>{{$defaultShippingAddress['full_name']}}</strong></p>
                                    <p>{{$defaultShippingAddress['address_line_1']}}</p>
                                    <p>{{$defaultShippingAddress['address_line_2']}} {{$defaultShippingAddress['city']}}{{$defaultShippingAddress['state']}} </p>
                                    <p>{{$defaultShippingAddress['country']}}</p>
                                    <p>{{$defaultShippingAddress['pin_code']}}</p>
                                </div>
                            </div>
                            <div class="ship-addr">
                                <h3>Billing Address</h3>
                                <div class="exist-address">
                                    <input type="hidden" name="billing_address_id" id="billing_address_id" value="{{$defaultBillingAddress['id']}}">
                                    <p><strong>{{$defaultBillingAddress['address_title']}}</strong></p>
                                    <p><strong>{{$defaultBillingAddress['full_name']}}</strong></p>
                                    <p>{{$defaultBillingAddress['address_line_1']}}</p>
                                    <p>{{$defaultBillingAddress['address_line_2']}} {{$defaultBillingAddress['city']}}{{$defaultBillingAddress['state']}} </p>
                                    <p>{{$defaultBillingAddress['country']}}</p>
                                    <p>{{$defaultBillingAddress['pin_code']}}</p>
                                </div>
                            </div>
                        </div>
                            <div class="address-section">
                                <h3>Delivery Method</h3>
                                <ul>
                                   <li><div class="input-left"><input type="radio" name="delivery" checked="checked" disabled value="express"><span>Express Shipping (Delivery is usually within 2-4 working days after dispatch date)</span></div><span>Rs.{{number_format($offersPrices['totalShippingCharge'])}}</span></li>
                                </ul>
                            </div>
                        <div class="make-payment">
                            <div class="gift">
                                <h3>Payment Method</h3>
                                <select name="payment">
                                    @if($data['payment']=="online")
                                        <option selected value="online">Payment with NetBanking / Credit / Debit Card</option>
                                    @else
                                        <option selected value="cod">Cash on Delivery</option>
                                    @endif
                                </select>
                                <p>You will be redirected to your external payment gateway after reviewing your order on the next step. Once your order is placed, you will return to our store to see your order confirmation.</p>
                                <ul class="visa-master">
                                    <li><img src="/images/visa.png" alt="visa"></li>
                                    <li><img src="/images/master_card.png" alt="master"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="proceed-btn">
                            @if($data['payment']=="online")
                                <p>You will be redirected to a secure site to confirm your payment.</p>
                                <a href="/checkout/1"><input type="button" name="back" value="Back" class="proceed-B"></a>
                                <input type="submit" name="proceed" value="Proceed to Payment Gateway" class="proceed-B">
                            @else
                                <a href="/checkout/1"><input type="button" name="back" value="Back" class="proceed-B"></a>
                                <input type="submit" name="proceed" value="Place Order" class="proceed-B">
                            @endif
                        </div>
                    </div>
                    <div class="summary-coupon">
                        <div class="order-summary">
                            <h3>Order Summary</h3>
                            <div class="order-S">
                                <div class="ord">
                                    <div class="leftN">Subtotal ({{$cartCount}}) items</div>
                                    <div class="rightC"><span>{{number_format($offersPrices['finalDiscountedAmount'],2)}}</span></div>
                                </div>
                                <div class="ord">
                                     <?php $shipping = $offersPrices['totalShippingCharge']; ?>
                                    <div class="leftN">Shipping</div>
                                    <div class="rightC"><span>{{number_format($shipping,2)}}</span></div>
                                </div>
                                @if($offersPrices['finalDiscount']>0)
                                    <div class="ord" style="color: red">
                                        <div class="leftN">Discount</div>
                                        <div class="rightC"><span id="discount">-{{number_format($offersPrices['finalDiscount'],2)}}</span></div>
                                    </div>
                                @endif

                                <div class="ord" id="additional_discount_div" style="color: red;display: none">
                                    <div class="leftN">Coupon Discount</div>
                                    <div class="rightC"><span id="additional_discount"></span></div>
                                </div>

                                <div class="ord">
                                    <div class="leftN">Estimated Total</div>
                                    <div class="rightC"><span id="estimated_total">{{number_format($offersPrices['finalDiscountedAmount']+$shipping,2)}}</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="coupon-div">
                            <h3>Add Coupon Code<small style="color: red">{{" (Case Sensitive)"}}</small></h3>
                            <div class="at_coupon_form review_order_page">
                                <div class="input_cross">
                                    <input type="text" name="code" id="coupon_code" class="input-text" value="" placeholder="Enter your coupon code">
                                    <div class="remove-link" style="display:none;" id="remove_div">
                                        <a href="#">
                                            <i class="fa fa-times remove-from-cart" id="remove_coupon" aria-hidden="true" data-cart-id="4"></i>
                                        </a>
                                    </div>
                                </div>
                                <input type="button" class="sub_button" name="apply_coupon" id="apply_coupon" value="Apply Coupon">
                            </div>
                            <br>
                            <span id="coupon_message"></span>
                        </div>
                        <div class="proceed-btn right-summary-btn">
                           <input type="submit" name="proceed" value="Proceed to Payment Gateway" class="proceed-B">
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#apply_coupon").click(function(){
            $("#coupon_message").hide();
            var code = $("#coupon_code").val();
            var order_id = $("#order_id").val();
            var token = $('#token').val();
            if(code!=""){
                $.ajax({
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': token},
                    url: "/order/apply-coupon",
                    data: {"code": code,"order_id":order_id},
                    success: function (data) {
                        if(data['additionalDiscount']>0){
                            $("#remove_div").show();
                            $("#apply_coupon").hide();
                            $("#additional_discount_div").show();
                            $("#additional_discount").text("-"+data['additionalDiscount'].toFixed(2));
                            $("#estimated_total").text(data['finalDiscountAmount'].toFixed(2));
                            $( "#coupon_code" ).prop( "disabled", true ); //Disable
                            if(data['status'] == 200){
                                $("#coupon_message").show();
                                var msgHtml = "<strong style='color:green'>"+data['message']+"</strong>"
                                $("#coupon_message").html(msgHtml);
                                $("#hidden_code").val(code);
                            }else{
                                $("#coupon_message").show();
                                var msgHtml = "<strong style='color:red'>"+data['message']+"</strong>"
                                $("#coupon_message").html(msgHtml);
                            }
                        }else{
                            if(data['status'] == 200){
                                $("#coupon_message").show();
                                var msgHtml = "<strong style='color:red'>Sorry! The Coupon("+code+") is not applicable to your cart items.</strong>";
                                $("#coupon_message").html(msgHtml);
                            }else{
                                $("#coupon_message").show();
                                var msgHtml = "<strong style='color:red'>"+data['message']+"</strong>";
                                $("#coupon_message").html(msgHtml);
                            }
                        }
                    }
                });
            }else{
                var message = "Please enter valid coupon code.";
            }
        });

        $("#remove_coupon").click(function(event){
            event.preventDefault();
            var code = $("#coupon_code").val();
            if(code!=""){
                location.reload();
            }
        });

    </script>
@endsection