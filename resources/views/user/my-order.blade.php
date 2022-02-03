@extends('layouts.user')
<style type="text/css">
.pagination>li>span{
    padding: 0px !important;
}
</style>
@section('content')
    <div class="content">
        <div class="breadcrums">
            <div class="container">
                <ul>
                    <li><a href="#">Home / </a></li>
                    <li><a href="#">My orders</a></li>
                </ul>
            </div>
        </div>
        
        <div class="listingContent">
            <div class="container">

                @if(count($orders)>0)
                <div class="cart-Div">
                    <div class="my_order">
                        <div class="page-number">
                            {{ $orders->links() }}
                        </div>
                        <ul class="order-list">
                        @foreach($orders as $order)
                            <li>
                                <div class="order_num">
                                    <div class="left_order_id"><a href="/order/details/{{base64_encode($order['id'])}}">{{$order['userShownOrderId']}}</a></div>
                                    @if($deliveredStatus[0] == $order['order_status'] || $shippedStatus[0] == $order['order_status'] )
                                    <div class="right-track">
                                       <a target="_blank" href="{{$order['trackURL']}}"><svg width="12" height="12" viewBox="0 0 9 12" class="location_img">
                                                <path fill="#2874f0" class="location_img" d="M4.2 5.7c-.828 0-1.5-.672-1.5-1.5 0-.398.158-.78.44-1.06.28-.282.662-.44 1.06-.44.828 0 1.5.672 1.5 1.5 0 .398-.158.78-.44 1.06-.28.282-.662.44-1.06.44zm0-5.7C1.88 0 0 1.88 0 4.2 0 7.35 4.2 12 4.2 12s4.2-4.65 4.2-7.8C8.4 1.88 6.52 0 4.2 0z" fill-rule="evenodd"></path>
                                            </svg>Track Order</a>
                                       <!--  <div class="detail-Div"><input  type="button" name="cancel" value="Cancel" class="cancel-btn" data-toggle="modal" data-target="#myModal"  data-val="{{$order['id']}}"></div> -->
                                    </div>
                                    @endif
                                </div>
                                @foreach($order['cart'] as $key=>$cart)
                                <div class="order_details">
                                    <div class="inner_order_wrp">
                                        <div class="left-details">
                                            @if($cart->configuration_image!=null)
                                                @if($cart->configuration_id!=null)
                                                    <div class="imgWrp">
                                                        <a href="/product/details/{{$cart->product_slug}}"><img src="/uploads/products/images/{{$cart->product_id}}/80x85/{{$cart->configuration_image}}" alt="image"></a>
                                                    </div>
                                                @else
                                                    <div class="imgWrp">
                                                        <a href="/product/details/{{$cart->product_slug}}"><img src="/uploads/products/images/{{$cart->product_id}}/80x85/{{$cart->configuration_image}}" alt="product"></a>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="imgWrp">
                                                    <a href="/product/details/{{$cart->product_slug}}"><img src="/images/no-image-available.png" alt="product"></a>
                                                </div>
                                            @endif
                                            <div class="txtWrp">
                                                <a href="/product/details/{{$cart->product_slug}}">{{$cart->product_name}}</a>
                                                <div class="other-info">
                                                    @if($cart->color!=null) <p><span>Color:</span>{{$cart->color}}</p> @endif
                                                    @if($cart->size!=null) <p><span>Size:</span>{{$cart->size}}</p> @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="qnty-div">
                                            <span>{{$cart->quantity}}</span>
                                        </div>
										<div class="price-div">
                                            <span>₹{{number_format($cart->final_price,2)}}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="order-date">
                                    <div class="date-left">
                                        <p><span>Ordered On</span> {{date("D, M, d 'y",strtotime($order['created_at']))}}</p>
                                        <div class="status-Div">
                                            @if($order['payment_status'] != 9 && $order['payment_status'] != 11)
                                                <p>{{"Order Pending"}}</p>
                                            @else
                                                <p>@if(count($order['status'])>0)@if($order['status'][0] == "Pending"){{"Order Received"}} @else {{$order['status'][0]}} @endif @else Not Available @endif</p>
                                            @endif
                                            <div class="smallNote">
                                                <p>@if($order['payment_status'] != 9 && $order['payment_status'] != 11){{"We have received your order but your payment is in Pending from Bank. Once we receive the payment, We will process the order."}} @else {{$order['note']}} @endif</p>
                                            </div>
                                        </div>
                                    </div>
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
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <div class="page-number">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
               @else
                    <div class="cart-Div empty-cart">
                        <img src="/images/no-order.png" alt="empty-order">
                        <h3>Empty Orders.</h3>
                        <p>Looks like you haven't made your choice yet.</p>
                        {{--<input type="button" name="back_to_menu" value="Back to Menu" class="back_menu">--}}

                    </div>
                @endif
                {{--<!--Modal start here-->
                <div class="modal fade order-cancel-modal" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Cancellation Request</h4>
                            </div>
                            <div class="modal-body">
                                <div class="item-details">
                                    <table>
                                        <thead>
                                        <tr>
                                            <td>Item Details</td>
                                            <td>Qty.</td>
                                            <td>Subtoal</td>
                                        </tr>
                                        </thead>
                                        <tbody id="CancelOrder">
                                        </tbody>
                                    </table>
                                    <form class="cancel-form" id="frmCancelOrder" action="/order/cancel" method="post" name="frmCancelOrder">
									   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                       <input type="hidden" name="order_id" id="order_id" value="">
                                        <div class="f-row">
                                            <label>Reason for cancellation<span>*</span></label>
                                            <select name="reason">
                                                <option selected disabled>Select Reason</option>
                                                <option value="The delivery is delayed">The delivery is delayed</option>
                                                <option value="Shopping cost is too much">Shopping cost is too much</option>
                                                <option value="Need to change shipping address">Need to change shipping address</option>
                                            </select>
                                        </div>
                                        <div class="f-row">
                                            <label>Comments</label>
                                            <textarea name="comments"></textarea>
                                        </div>
                                        <div class="f-row less-row">
                                            <p><span>Note:</span> There will be no refund as the order is purchased using Cash-On-Delivery</p>
                                        </div>
                                        <div class="f-row less-row right-btn">
                                            <input type="submit" name="cancellation" value="Confirm" class="confirm-btn">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Modal End here-->
				<!--Modal start here-->
                <div class="modal fade order-cancel-modal" id="myModal1" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Return Order Request</h4>
                            </div>
                            <div class="modal-body">
                                <div class="item-details">
                                    <table>
                                        <thead>
                                        <tr>
                                            <td>Item Details</td>
                                            <td>Qty.</td>
                                            <td>Subtoal</td>
                                        </tr>
                                        </thead>
                                        <tbody id="ReturnOrder">
                                        </tbody>
                                    </table>
                                    <form class="cancel-form" id="frmReturnOrder" action="/order/return" method="post" name="frmReturnOrder">
									   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                       <input type="hidden" name="order_id1" id="order_id1" value="">
                                        <div class="f-row">
                                            <label>Reason for Return Order<span>*</span></label>
                                            <select name="reason">
                                                <option selected disabled>Select Reason</option>
                                                <option value="Product damaged, but shipping box OK">Product damaged, but shipping box OK</option>
                                                <option value="Wrong item was sent">Wrong item was sent</option>
                                                <option value="Performance or quality not adequate">Performance or quality not adequate</option>
                                            </select>
                                        </div>
                                        <div class="f-row">
                                            <label>Comments</label>
                                            <textarea name="comments"></textarea>
                                        </div>
                                        <div class="f-row less-row">
                                            <p><span>Note:</span> There will be no refund as the order is purchased using Cash-On-Delivery</p>
                                        </div>
                                        <div class="f-row less-row right-btn">
                                            <input type="submit" name="returnorder" value="Confirm" class="confirm-btn">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <!--Modal End here-->--}}
            </div>
        </div>
    </div>
<script src="{{asset("js/order.js")}}" type="text/javascript" language="javascript"></script>
@endsection