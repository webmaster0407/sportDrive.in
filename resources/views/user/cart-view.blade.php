@extends('layouts.user')
@section('content')
<?php $cartErrors = null;?>
<div class="content">
<?php $totalFinalPrice = 0;?>
<div class="listingContent">
	@if(Session::has('errorArray'))
        <?php $errorArray = Session::get('errorArray');?>
			@if($errorArray!=null)
				<div class="alert alert-danger">
					@foreach($errorArray as $error)
							{{$error}}<br>
					@endforeach
				</div>
			@endif
			<?php session()->forget('errorArray');?>
	@endif
	<div class="container">
		<div class="cart-Div" id="all_cart_data">
			<h2>Your Cart</h2>
			@if(count($cartData)>0)
				<ul class="check-tabs">
					<li class="active"><a href="javascript:void(0);">View Cart</a></li>
					<li><a href="/checkout/1">Checkout Information</a></li>
					<li><a href="javascript:void(0);">Review Order</a></li>
				</ul>
			<div class="cart-List">
				<div class="checkout-table">
					<input type="hidden" name="token" id="token" value="{{csrf_token()}}">
					<div class="cart-table-Div">
					<div class="row-Div">
						<div class="cell-Div"><span>Product</span></div>
						<div class="cell-Div"><span></span></div>
						<div class="cell-Div"><span>Price</span></div>
						<div class="cell-Div"><span>Quantity</span></div>
						<div class="cell-Div"><span>Total</span></div>
						<div class="cell-Div"><span>Remove</span></div>
						</div>
						@foreach($cartData as $cart)
						<div class="row-Div" id="{{$cart->id}}">
							<!-- display config image if null display main img else NA -->
							<div class="cell-Div"><div class="imgDiv">
									@if($cart->image!=null) {{--if config image is not null--}}
										<img src="/uploads/products/images/{{$cart->product_id}}/80x85/{{$cart->image}}" alt="product">
									@else
										@if($cart->mainImage!=null){{--if config is null but main is present--}}
											<img src="/uploads/products/images/{{$cart->product_id}}/80x85/{{$cart->mainImage}}" alt="product">
										@else{{-- no image avilable--}}
											<img src="/images/no-image-available.png" alt="product">
										@endif
									@endif
								</div></div>
							<div class="cell-Div"><a href="/product/details/{{$cart->slug}}">{{$cart->name}}</a>
								<div class="other-info">
									<!-- display attribute names -->
									@if(count($cart->color))
										<p><span>Color:</span>{{$cart->color[0]}}</p>
									@endif
									@if(count($cart->size))
										<p><span>Size:</span>{{$cart->size[0]}}</p>
									@endif
								</div>
								</div>
								<!-- calculate price after discount & display-->
							@if($cart->configPrice!= null)
								<?php $originalPrice = $cart->configPrice;$finalPrice = $cart->configPrice-$cart->discount_price;  ?>
							@else
                                <?php $originalPrice = $cart->price;$finalPrice = $cart->price-$cart->discount_price; ?>
							@endif
                            <?php $totalFinalPrice=$totalFinalPrice+($finalPrice*$cart->cartQuantity) ?>
							<div class="cell-Div">
								@if($originalPrice!=$finalPrice)
									<span class="strikeSpan">
										&#8377; <span id="{{$cart->id}}_original_price">{{number_format($originalPrice,2)}} </span>
									</span>
								@endif
								<span class="price">
									&#8377;  <span id="{{$cart->id}}_final_price"> {{number_format($finalPrice,2)}} </span>
								</span>
							</div>
							<div class="cell-Div"><div class="quantity-select"><span class="qnty-Input"><input id="{{$cart->id}}_qty" type="text" value="{{$cart->cartQuantity}}" name="qnty" min="1" max="{{$cart->configQuantity}}"></span></div><div class="update"><a href="#"><i class="fa fa-refresh update-qty" aria-hidden="true" data-cart-id="{{$cart->id}}"></i></a></div></div>
							<!-- change thiss on update quantity -->
							<div class="cell-Div"><span class="price" id="pricePerProduct">&#8377; <span id="{{$cart->id}}_total">{{number_format($finalPrice*$cart->cartQuantity,2)}}</span></span></div>
							<!-- remove this from cart on click ajax -->
							<div class="cell-Div">
								<div class="remove-link"><a href="#"><i class="fa fa-times remove-from-cart" aria-hidden="true" data-cart-id="{{$cart->id}}"></i></a></div>
							</div>
							@if($cartErrors != null && array_key_exists($cart->id,$cartErrors))
							<div class="error-msg"> <span>{{$cartErrors[$cart->id]}}</span></div>
							@endif
						</div>
						@endforeach
				</div>
				</div>
				<div class="proceed-btn">
					<a  href="/"> <input type="button" name="proceed" value="Continue shopping" class="proceed-B"> </a>
					<a  href="/checkout/1"> <input type="button" name="proceed" value="Proceed to Checkout" class="proceed-B"> </a>
				</div>
			
			</div>
			<div class="summary-coupon">
				<div class="order-summary">
					<h3>Order Summary</h3>
					<div class="order-S">
						<div class="ord">
								<div class="leftN">Subtotal(<span id="product_count"> {{count($cartData)}}</span> items) </div>
								<!-- sum of pricePerProduct col here -->
								<div class="rightC"><span id="subtotal">{{number_format($totalFinalPrice,2)}}</span></div>
						</div>
							<div class="ord" style="color: red">
								<div class="leftN">Discount</div>
								<div class="rightC">-<span id="offer_discount">{{number_format($offersPrices['finalDiscount'],2)}}</span></div>
							</div>
						<hr>
						<div class="ord">
							<div class="leftN">Estimated Total</div>
							<div class="rightC"><span id="estimated_total">{{number_format($offersPrices['finalDiscountedAmount'],2)}}</span></div>
						</div>
							</div>
					
				</div>
			</div>
			@else
				<div class="cart-Div empty-cart">
			<img src="/images/empty-cart.png" alt="empty-cart">
				<h3>Empty cart.</h3>
			<p>Looks like you haven't made your choice yet.</p>
			{{--<input type="button" name="back_to_menu" value="Back to Menu" class="back_menu">--}}

				</div>
					@endif
		</div>
		<div class="cart-Div empty-cart" id="empty_cart_show" style="display: none;">

			<img src="/images/empty-cart.png" alt="empty-cart">
			<h3>Empty cart.</h3>
			<p>Looks like you haven't made your choice yet.</p>
			{{--<input type="button" name="back_to_menu" value="Back to Menu" class="back_menu">--}}
		</div>
	</div>
</div>
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="/carouselengine/amazingcarousel.js"></script>
<script type="text/javascript" src="/carouselengine/initcarousel-1.js"></script>
<script type="text/javascript" src="/js/checkout.js"></script>
@endsection