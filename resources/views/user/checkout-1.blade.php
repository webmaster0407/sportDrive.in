@extends('layouts.user')
@section('content')
    <div class="content">
        <div class="listingContent">
            <div class="container">
                @if(Session::has('errors'))
                    <div class="alert alert-danger">
                        @if ($errors->has('billing_address_id'))
                            {{"Please add/select billing address."}}<br>
                        @endif
                        @if ($errors->has('shipping_address_id'))
                            {{"Please add/select shipping address."}}<br>
                        @endif
                        @if ($errors->has('delivery'))
                            {{"Please select delivery method."}}<br>
                        @endif
                        @if ($errors->has('payment'))
                            {{"Please select payment method."}}<br>
                        @endif
                    </div>
                @endif
                <div class="cart-Div">
                    <h2>Checkout</h2>
                    <ul class="check-tabs">
                        <li><a href="/cart/view">View Cart</a></li>
                        <li class="active"><a href="#">Checkout Information</a></li>
                        <li><a href="#">Review Order</a></li>
                    </ul>
                    <form name="checkout" action="/checkout/2" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="std_del_ch" name="std_del_ch" value="{{ number_format($standardCharges,2)  }}">
                        <input type="hidden" id="ex_del_ch" name="ex_del_ch" value="{{ number_format($expressCharges,2) }}">
                    <div class="cart-List">
                        <div class="address-section">
                            <div class="ship-addr">
                                <h3>Shipping Address</h3>
								<div id="error"></div>
                                @if(count($allShippingAddresses)>0)
                                    @if(count($defaultShippingAddress)<=0){{--if there is no default shipping address--}}
                                    <?php $defaultShippingAddress = $allShippingAddresses[0]?>
                                    @endif
                                    <div class="exist-address">
                                        <div id="default_shipping_address">
                                            <input type="hidden" name="shipping_address_id" id="shipping_address_id" value="{{$defaultShippingAddress['id']}}">
                                            <p><strong>{{$defaultShippingAddress['address_title']}}</strong></p>
                                            <p><strong>{{$defaultShippingAddress['full_name']}}</strong></p>
                                            <p>{{$defaultShippingAddress['address_line_1']}}</p>
                                            <p>{{$defaultShippingAddress['address_line_2']}} {{$defaultShippingAddress['city']}}{{$defaultShippingAddress['state']}} </p>
                                            <p>{{$defaultShippingAddress['country']}}</p>
                                            <p>{{$defaultShippingAddress['pin_code']}}</p>
                                        </div>
                                        <div class="edit-add">
                                            <a href="/checkout/edit-address/{{$defaultShippingAddress['id']}}"><input type="button" name="edit" value="Edit" class="btn btn-info btn-lg" {{--data-toggle="modal" data-target="#myModal"--}}></a>
                                            <a href="/checkout/add-shipping-address"><input type="button" name="add new" value="Add New Address"  class="btn btn-info btn-lg" {{--data-toggle="modal" data-target="#myModal"--}}></a>
                                        </div>
                                        <input type="button" name="change new" value="Change Address" class="change_add" data-toggle="modal" data-target="#shipping_model"  data-keyboard="true">
                                    </div>
                                @else
                                    <div class="exist-address">
                                        <div id="default_shipping_address"></div>
                                    </div>
                                    <div class="edit-add">
                                        <a href="/checkout/add-shipping-address"><input type="button" name="add new" value="Add New Address"  class="btn btn-info btn-lg" {{--data-toggle="modal" data-target="#myModal"--}}></a>
                                    </div>
                                @endif

                            </div>
                            <div class="ship-addr">
                                <div class="same-as"><input type="checkbox" name="same" value="Y" id="same_as_ship"><span>Same as Shipping Address</span></div>
                                <h3>Billing Address</h3>
                                @if(count($allBillingAddresses)>0)
                                    @if(count($defaultBillingAddress)<=0){{--if there is no default billing address--}}
                                    <?php $defaultBillingAddress = $allBillingAddresses[0]?>
                                    @endif
                                    <div class="exist-address">
                                        <div id="default_billing_address">
                                            <input type="hidden" name="billing_address_id" id="billing_address_id" value="{{$defaultBillingAddress['id']}}">
                                            <p><strong>{{$defaultBillingAddress['address_title']}}</strong></p>
                                            <p><strong>{{$defaultBillingAddress['full_name']}}</strong></p>
                                            <p>{{$defaultBillingAddress['address_line_1']}}</p>
                                            <p>{{$defaultBillingAddress['address_line_2']}} {{$defaultBillingAddress['city']}}{{$defaultBillingAddress['state']}} </p>
                                            <p>{{$defaultBillingAddress['country']}}</p>
                                            <p>{{$defaultBillingAddress['pin_code']}}</p>
                                        </div>
                                        <div class="edit-add">
                                           <a href="/checkout/edit-address/{{$defaultBillingAddress['id']}}"><input type="button" name="edit" value="Edit" class="btn btn-info btn-lg" {{--data-toggle="modal" data-target="#myModal"--}}></a>
                                           <a href="/checkout/add-billing-address"><input type="button" name="add new" value="Add New Address"  class="btn btn-info btn-lg" {{--data-toggle="modal" data-target="#myModal"--}}></a>
                                        </div>
                                        <input type="button" name="change new" value="Change Address" class="change_add" data-toggle="modal" data-target="#billing_model"  data-keyboard="true">
                                    </div>
                                @else
                                    <div class="exist-address">
                                         <div id="default_billing_address"></div>
                                    </div>
                                    <div class="edit-add">
                                        <a href="/checkout/add-billing-address"><input type="button" name="add new" value="Add New Address"  class="btn btn-info btn-lg" {{--data-toggle="modal" data-target="#myModal"--}}></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                            <div class="address-section">
                                <h3>Delivery Method</h3>
                                <ul>
                                    <li><div class="input-left"><input class="delivery_type" type="radio" name="delivery" value="express" checked disabled><span>Express Shipping (Delivery is usually within 2-4 working days after dispatch date)</span></div><span>Rs.{{number_format($offersPrices['totalShippingCharge'],2)}}</span></li>
                                </ul>
                            </div>
                        <div class="make-payment">
                            <div class="gift">
                                <h3>Payment Method</h3>
                                <select name="payment">
                                    <option value="online">Payment with NetBanking / Credit / Debit Card</option>
                                    <!--<option  value="cod">Cash on Delivery</option>-->
                                </select>
                                <p>You will be redirected to your external payment gateway after reviewing your order on the next step. Once your order is placed, you will return to our store to see your order confirmation.</p>
                                <ul class="visa-master">
                                    <li><img src="/images/visa.png" alt="visa"></li>
                                    <li><img src="/images/master_card.png" alt="master"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="proceed-btn">
                            <input type="submit" name="proceed" id="Continue" value="Continue" class="proceed-B">
                        </div>
                    </div>

                    <div class="summary-coupon">
                        <div class="order-summary">
                            <h3>Order Summary</h3>
                            <div class="order-S">
                                <div class="ord">
                                    <div class="leftN">Subtotal ({{$cartCount}}) items</div>
                                    <input type="hidden" name="hidden_subtotal" id="hidden_subtotal" value="{{$subtotal}}">
                                    <div class="rightC"><span id="checkout_subtotal">{{$subtotal}}</span></div>
                                </div>
                                 <?php $shipping = $offersPrices['totalShippingCharge']; ?>
                                <div class="ord">
                                    <div class="leftN">Shipping Charge</div>
                                    <div class="rightC"><span id="shipping_charges">{{$shipping}}</span></div>
                                </div>
                                @if($offersPrices['finalDiscount']>0)
                                    <div class="ord" style="color: red">
                                        <div class="leftN">Discount</div>
                                        <div class="rightC"><span id="estimated_total">-{{number_format($offersPrices['finalDiscount'],2)}}</span></div>
                                    </div>
                                @endif
                                <hr>
                                <div class="ord">
                                    <div class="leftN">Estimated Total</div>
                                    <div class="rightC"><span id="checkout_estimated_total">{{number_format($offersPrices['finalDiscountedAmount']+$shipping,2)}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--change shipping address model start here--}}
    <div class="modal fade" id="shipping_model" role="dialog" tabindex='-1'>
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content address-modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Address List</h4>
                </div>
                <div class="modal-body">
                    <ul class="address-List">
                        @foreach($allShippingAddresses as $shippingAddress)
                            <li>
                                <div class="same-as"><input type="radio" name="same" value="{{$shippingAddress->id}}" class="select_shipping"><span>Select Address</span></div>
                                <div id="all_shipping_{{$shippingAddress->id}}">
                                    <input type="hidden" name="shipping_address_id" id="shipping_address_id" value="{{$shippingAddress['id']}}">
                                    <p><strong>{{$shippingAddress['address_title']}}</strong></p>
                                    <p><strong>{{$shippingAddress['full_name']}}</strong></p>
                                    <p>{{$shippingAddress['address_line_1']}}</p>
                                    <p>{{$shippingAddress['address_line_2']}} {{$shippingAddress['city']}}{{$shippingAddress['state']}} </p>
                                    <p>{{$shippingAddress['country']}}</p>
                                    <p>{{$shippingAddress['pin_code']}}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="select-btn"><button type="button" class="btn-success" data-dismiss="modal">Select</button></div>
            </div>
        </div>
    </div>
    {{--change shipping address model ends here--}}

    {{--change billing address model start here--}}

    <div class="modal fade" id="billing_model" role="dialog" tabindex='-1'>
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content address-modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Address List</h4>
                </div>
                <div class="modal-body">
                    <ul class="address-List">
                        @foreach($allBillingAddresses as $billingAddress)
                            <li>
                                <div class="same-as"><input type="radio" name="same" class="select_billing" value="{{$billingAddress->id}}"><span>Select Address</span></div>
                                <div id="all_billing_{{$billingAddress->id}}">
                                    <input type="hidden" name="billing_address_id" id="shipping_address_id" value="{{$billingAddress['id']}}">
                                    <p><strong>{{$billingAddress['address_title']}}</strong></p>
                                    <p><strong>{{$billingAddress['full_name']}}</strong></p>
                                    <p>{{$billingAddress['address_line_1']}}</p>
                                    <p>{{$billingAddress['address_line_2']}} {{$billingAddress['city']}}{{$billingAddress['state']}} </p>
                                    <p>{{$billingAddress['country']}}</p>
                                    <p>{{$billingAddress['pin_code']}}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="select-btn"> <button type="button" class="btn-success" data-dismiss="modal">Select</button></div>
            </div>
        </div>
    </div>
    {{--change billing address model ends here--}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="/carouselengine/amazingcarousel.js"></script>
    <script type="text/javascript" src="/carouselengine/initcarousel-1.js"></script>
    <script type="text/javascript" src="/js/checkout.js"></script>
@endsection