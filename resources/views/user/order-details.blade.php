@extends('layouts.user')
@section('content')


<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Checkout</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Checkout - Checkout Information</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">
    <div class="section">
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success">
                  {{Session::get('success')}}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">
                  {{Session::get('error')}}
                </div>
            @endif
            @if ($errors->has('rating'))
                <div class="alert alert-danger">
                    {{ $errors->first('rating') }}
                </div>
            @endif
            @if ($errors->has('message'))
                <div class="alert alert-danger">
                    {{ $errors->first('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8 col-md-10 col-sm-12 order_review" style="margin: auto">
                    <div class="order-invoice">
                        <h4 class="idTag">Order ID {{$order['userShownOrderId']}}</h4>
                        <h4 class="idTag"> 
                            @if($trackingResponse != NULL  && isset($trackingResponse['tracking_data']['track_url'])) 
                            <button type="button" class="btn btn-fill-out btn-sm" data-toggle="modal" data-target="#trackOrder">    Track Order
                            </button>
                             @endif
                         </h4>
                        <div class="request-invoice">
                            {{--<a href="#">
                                <svg fill="#c2c2c2" height="24" viewBox="0 0 24 24" width="24" class="invoice_sv"><path d="M0 0h24v24H0z" fill="none"></path><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"></path></svg><span>Request Invoice</span>
                            </a>--}}
                        </div>
                    </div>     

                    <div class="order-detail-section">
                        <ul class="three-list">
                            <li>
                                <h4>Customer Details</h4>
                                <div class="order-row">
                                    <span>Customer Name:</span>
                                    <span>{{$user->first_name}} {{$user->last_name}}</span>
                                </div>
                                <div class="order-row">
                                    <span>Contact No:</span>                            
                                    <span>{{$user->phone}}</span>
                                </div>
                                <div class="order-row">
                                    <span>Email Id:</span>
                                    <span>{{$user->email_address}}</span>
                                </div>
                                <div class="order-row">
                                    <span>Order Date:</span>
                                    <span>{{date("d M Y h:i:s A",strtotime($order->order_date))}}</span>
                                </div>
                                <div class="order-row">
                                    <span>Total items in Cart:</span>
                                    <span>({{count($carts)}})</span>
                                </div>
                                <div class="order-row">
                                    <span>Payment Id:</span>
                                    <span>@if($order->payu_payment_id != null){{$order->payu_payment_id}}@else NA @endif</span>
                                </div>
                                <div class="order-row">
                                    <span>Bank Reference NO:</span>
                                    <span>@if($order->payu_bank_ref_num!= null){{$order->payu_bank_ref_num}}@else NA @endif</span>
                                </div>
                                
                            </li>
                        </ul>
                        <?php
                        $defaultShippingAddress = json_decode($order->shipping_address,true);
                        $defaultBillingAddress = json_decode($order->billing_address,true)
                        ?>
                        <ul class="three-list two-list">
                            <li>
                                <h4>Shipping Address</h4>
                                <p><strong>{{$defaultShippingAddress['address_title']}}</strong></p>
                                <p><strong>{{$defaultShippingAddress['full_name']}}</strong></p>
                                <p>{{$defaultShippingAddress['address_line_1']}}</p>
                                <p>{{$defaultShippingAddress['address_line_2']}} {{$defaultShippingAddress['city']}} {{$defaultShippingAddress['state']}} </p>
                                <p>{{$defaultShippingAddress['country']}}</p>
                                <p>{{$defaultShippingAddress['pin_code']}}</p>
                            </li>
                            <li>
                                <h4>Billing Address</h4>
                                <p><strong>{{$defaultBillingAddress['address_title']}}</strong></p>
                                <p><strong>{{$defaultBillingAddress['full_name']}}</strong></p>
                                <p>{{$defaultBillingAddress['address_line_1']}}</p>
                                <p>{{$defaultBillingAddress['address_line_2']}} {{$defaultBillingAddress['city']}} {{$defaultBillingAddress['state']}} </p>
                                <p>{{$defaultBillingAddress['country']}}</p>
                                <p>{{$defaultBillingAddress['pin_code']}}</p>
                            </li>
                        </ul>
                    </div>

                        <ul class="order-list">
                            <li>
                                <div class="order_num">
                                    <div class="left_order_id"><p><span>Ordered On</span> {{date("d M Y h:i:s A",strtotime($order->order_date))}}</p></div>
                                    {{--<div class="right-track">
                                        <a href="#"><svg width="12" height="12" viewBox="0 0 9 12" class="location_img"><path fill="#2874f0" class="location_img" d="M4.2 5.7c-.828 0-1.5-.672-1.5-1.5 0-.398.158-.78.44-1.06.28-.282.662-.44 1.06-.44.828 0 1.5.672 1.5 1.5 0 .398-.158.78-.44 1.06-.28.282-.662.44-1.06.44zm0-5.7C1.88 0 0 1.88 0 4.2 0 7.35 4.2 12 4.2 12s4.2-4.65 4.2-7.8C8.4 1.88 6.52 0 4.2 0z" fill-rule="evenodd"></path></svg>Track Order</a><div class="detail-Div"><input type="button" name="return" value="Return" class="return-btn"></div>
                                    </div>--}}
                                </div>
                                @foreach($carts as $cart)
                                <div class="order_details">
                                    <div class="inner_order_wrp">
                                        <div class="left-details">
                                            <div class="imgWrp">
                                                <a href="#">
                                                    @if($cart->configuration_image != null)
                                                    <img src="/uploads/products/images/{{$cart->product_id}}/80x85/{{$cart->configuration_image}}" alt="Image">
                                                  @elseif($cart->image!= null)
                                                    <img src="/uploads/products/images/{{$cart->product_id}}/80x85/{{$cart->image}}" alt="Image">
                                                  @else
                                                     <img src="/images/no-image-available.png" alt="Image">
                                                  @endif</a>
                                            </div>
                                            <div class="txtWrp">
                                                <a href="/product/details/{{$cart->product_slug}}">{{$cart->product_name}}</a>
                                                <div class="other-info">
                                                 @if($cart->color!=null) <p><span><b>Color: </b></span>{{$cart->color}}</p> @endif
                                                 @if($cart->size!=null) <p><span><b>Size: </b></span>{{$cart->size}}</p> @endif
                                            </div>
                                            </div>
                                        </div>
                                        <div class="qnty-div">
                                            <span>{{$cart->quantity}}</span>    
                                        </div>
                                        <div class="price-div">
                                            <span>₹{{number_format($cart->final_price,2)}}</span>
                                            @if(count($order['status'])>0 && $order['status'][0] == $deliveredStatus[0] && empty($reviews[$cart->product_id]))
                                                <a href="#" class="rate-link" data-toggle="modal" data-target="#myModal">Rate This Products</a>
                                            @endif
                                            @if(!empty($reviews[$cart->product_id]))
                                            <div>
                                                <p>My Ratings</p>
                                                <div class="rating">
                                                <ul class="star-rating-name">
                                                <?php
                                                $i=1;
                                                for($i=1;$i<=5;$i++) {
                                                $selected = "";
                                                if(!empty($reviews[$cart->product_id]) && $i<=$reviews[$cart->product_id]) {
                                                    $selected = "selected";
                                                }
                                                ?>
                                                <li class="<?php echo $selected; ?>" >&#9733;</li>
                                                <?php }  ?>
                                                </ul>

                                                </div>
                                            </div>
                                            @endif

                                            <div id="myModel" class="modal fade rate_product" role="dialog" tabindex="-1">
                                                <div class="modal-dialog">
                                                <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Rate this product</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form  method="POST" class="rate-review" name="frmReview" id="review-form" action="/product/add-review/{{$cart->id}}" >
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <div class="rate-row">
                                                                    <label>Customer Name</label>
                                                                    <input type="text" name="name"  required value="@if($user != null){{$user->first_name}}@endif">
                                                                </div>
                                                                <div class="rate-row">
                                                                    <label>Email Id</label>
                                                                    <input type="email" required name="email" @if($user != null)  value="{{$user->email_address}}" readonly  @endif>
                                                                </div>
                                                                <div class="rate-row">
                                                                    <label>Your Rating</label>
                                                                    <div class="page-wrap">
                                                                        <div class="rating" id="enterRating">
                                                                            <input type="hidden" name="rating" required id="rating" value="" />
                                                                            <ul  onmouseout="resetRating();">
                                                                                <?php
                                                                                for($i=1;$i<=5;$i++) {
                                                                                $selected = "";
                                                                                ?>
                                                                                <li class="<?php echo $selected; ?>" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);" >&#9733;</li>
                                                                                <?php }  ?>
                                                                                </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="rate-row">
                                                                    <label>Message</label>
                                                                    <textarea name="message"></textarea>
                                                                </div>

                                                                <div class="rate-row btn-row">
                                                                    <input type="submit" value="Submit" name="submit" class="confirm-btn" >
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @if($trackingResponse != NULL && isset($trackingResponse['tracking_data']['track_url']))
                                                <div id="trackOrder" class="modal fade " role="dialog" tabindex="-1">
                                                <div class="modal-fullscreen" >
                                                <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" style="color: black">Close</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <iframe src="{{$trackingResponse['tracking_data']['track_url']}}"></iframe>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="order-date">
                                    <div class="order-total">
                                        <div class="total-am">
                                                <p><span>Subtotal</span> ₹{{number_format($order->sub_total+$order->discount+$order->coupon_discount,2)}}</p>
                                                <p><span>Shipping Charges</span> ₹{{number_format($order->total_shipping_amount,2)}}</p>
                                                @if($order->discount>0)
                                                    <p style="color: red"><span style="color: red">Offer Discount:</span>- ₹{{ number_format($order->discount,2)}}</p>
                                                @endif
                                            @if($order->coupon_discount>0)
                                                <p style="color: red"><span style="color: red">Coupon Discount({{$order->coupon_code}}):</span>- ₹{{ number_format($order->coupon_discount,2)}}</p>
                                            @endif
                                                <hr>
                                                <p><span>Order Total</span> ₹{{number_format($order->sub_total+$order->total_shipping_amount,2)}}</p>
                                        </div>
                                    </div>
                                    <div class="date-left">
                                        <div class="status-Div">
                                            @if($order['payment_status'] != 9  && $order['payment_status'] != 11)
                                                <p>{{"Order Pending"}}</p>
                                            @else
                                                <p>@if(count($order['status'])>0)@if($order['status'][0] == "Pending"){{"Order Received"}} @else {{$order['status'][0]}} @endif @else Not Available @endif</p>
                                            @endif
                                            <div class="smallNote">
                                                <p>@if($order['payment_status'] != 9  && $order['payment_status'] != 11){{"We have received your order but your payment is in Pending from Bank. Once we receive the payment, We will process the order."}} @else {{$order['note']}} @endif</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection