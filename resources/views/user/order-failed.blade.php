@extends('layouts.user')
@section('content')
    <div class="content">
        <div class="container">
            <div class="listingContent">
                <div class="order_fail">
                    <div class="top-fail">
                        <h2>Order Failed</h2>
                        @if($order->payment_custom_message!=null)
                        <p>{{$order->payment_custom_message}}</p>
                        @else
                            <p>Sorry! Your order has been failed. Please ty again.</p>
                        @endif
                    </div>
                    <div class="transaction-details">
                        <h3>Payment Details</h3>
                        <div class="order-name">
                            <h4>Order ID:</h4>
                            <span>{{$userShownOrderId}}</span>
                        </div>
                        <div class="order-name">
                            <h4>Payment ID:</h4>
                            <span>{{$order->payu_payment_id}}</span>
                        </div>
                    </div>
                    <div class="back_home">
                        <a href="/"><input type="button" value="Back To Home" class="back_to_home"></a>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection