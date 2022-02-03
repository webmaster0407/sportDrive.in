@extends('layouts.product-page')
@push('stylesheets1')
   
@endpush
@section('content')
	<script src="{{asset("js/slider.min.js")}}" type="text/javascript" language="javascript"></script>
	<style>
		.zoom:after {
			content:'';
			display:block;
			width:33px;
			height:33px;
			position:absolute;
			top:0;
			right:0;
		}
		.zoom img {
			display: block;
		}
		.zoom img::selection { background-color: transparent; }
		
		.rating ul{margin:0;padding:0;}
		.rating li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
		.rating .highlight, .rating .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
		.ajaxLoader{
			z-index: 1;display:none;width:100%;height:100%;position:absolute;top:0%;left:0%;padding:2px; background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4);
		}
		.ajaxLoader .loaderImg{
			margin-left: 50%; margin-top: 30%;
		}
		.sizechartDiv img{width:100%;}
		.selColorInit {
			border:2px !important;
			border-color: black !important;
			border-style: solid !important;
		}
		.outstockSize{pointer-events: none;background: #c3c3c3!important;cursor: default;color: #fff!important;}
		.product-main-img > i,.product-zoom-img > i.zoomClose{position: absolute;top: 0;right: 0;z-index: 2;width: 30px;height: 30px;background: rgba(0,0,0,.1);border-radius: 50%;display: flex;align-items: center;justify-content: center;font-size: 18px;color: #888; cursor:pointer; transition: all 0.5s;-webkit-transition: all 0.5s;-moz-transition: all 0.5s;-ms-transition: all 0.5s;-o-transition: all 0.5s;}
		.product-zoom-img > i.zoomClose{border-radius:6px; width:36px; height:36px; background:rgba(0,0,0,0.0);top:15px; right:10px;}
	.product-main-img > i:hover,.product-zoom-img > i:hover{background:#de4d4d; color:#fff;}
	.product-zoom-img > i:hover svg{fill:#fff;}
    #productZoom{width:100%; height:100%;position:fixed;top:0;left:0; background:rgba(255,255,255,1); opacity:0; visibility:hidden;z-index:99;}
	.zoom--open #productZoom{opacity:1;visibility:visible;}
	.zoom--open{overflow:hidden;}
	.product-zoom-img{height:100%;}
	.product-main-img .swiper-button-next{height:24px;}
	.product-main-img .swiper-button-prev{height:24px;}
	</style>
	<div class="content">
		<div class="listingContent">
			@if(Session::has('error'))
				<div class="alert alert-danger" id="errorMessage">
					{{Session::get('error')}}
				</div>
			@endif
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="pid" id="pid" value="{{$product->id}}">
			<div class="container">
				<div class="leftImg">
					<div class="product-main-img">
						@if($product->icon!=null)
							<div class="justarrive">
								<span> <img src="/uploads/product_icon/{{$product->id}}/{{$product->icon}}"></span>
							</div>
						@endif
					<i class="fa fa-search-plus expandProd" aria-hidden="true"></i>
						<ul class="swiper-wrapper">
						@if(count($productConfiguration) >0)
								@foreach($productConfiguration as $pConfig)
									@if($pConfig->config_img != null)
										<li class="product-img" ><img src="{{URL::asset('uploads/products/images/'.$pConfig->product_id.'/1024x1024/'.$pConfig->config_img)}}" alt=""></li>
									@endif
								@endforeach
							@endif
						</ul>
						<div class="swiper-button-prev"></div>
    					<div class="swiper-button-next"></div>
					</div>
					<!-- config images list -->
					<div class="product-thumbs">
						<ul class="swiper-wrapper imgList listingSlider" id="colorimgList">
							@if(count($productConfiguration) >0)
								@foreach($productConfiguration as $pConfig)
									@if($pConfig->config_img != null)
										<li class="configimgList changeImg" data-val="{{$pConfig->config_img}}" data-config="{{$pConfig->color_id}}"><img src="{{URL::asset('uploads/products/images/'.$pConfig->product_id.'/80x85/'.$pConfig->config_img)}}" alt="config-image"></li>
									@endif
								@endforeach
							@endif
							
						</ul>
					</div>
				</div>
				<script>
					function addZoomContent(){var o=$("<div />",{html:zoomImgs});$(".expandProd",o).remove(),o.find("img").each(function(){$(this).wrap('<div class="swiper-zoom-container"></div>')}),$(".product-main-img",o).addClass("product-zoom-img").removeClass("product-main-img").append('<i class="zoomClose" aria-hidden="true" onclick="javascript:document.body.classList.remove(\'zoom--open\')"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" version="1.1" width="32px" height="32px"><g id="surface1"><path style=" " d="M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z "/></g></svg></i>'),$("#productZoom").html(o.html()),zoomSlider=new Slider(".product-zoom-img",{zoom:{maxRatio:3},spaceBetween:10,loop:!1,keyboard:!0,slideClass:"product-img",navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"}})}var zoomImgs=$(".product-main-img").clone(),slider=new Slider(".product-main-img",{spaceBetween:10,init:!0,loop:!1,keyboard:!0,slideClass:"product-img",navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"}}),thumbslider=new Slider(".product-thumbs",{slidesPerView:"auto",loop:!1,slideClass:"configimgList",spaceBetween:5,touchRatio:.2});slider.controller.control=thumbslider,$("#colorimgList li").on("click",function(){slider.slideTo($(this).index(),0)});var zoomSlider=null,executed=!1;$(".expandProd").on("click",function(){!executed&&addZoomContent(),document.body.classList.add("zoom--open"),zoomSlider&&zoomSlider.slideTo(slider.realIndex,0)});
				</script>
				<div class="right-description">
					<h3>{{$product->name}}</h3>
					<small>{{$product->sku}}</small>
					<p><strong>({{$brandName->name}})</strong></p>
					<div class="page-wrap">
						@if($totalRatings>0)
							<div class="rating">
								<ul >
                                    <?php
                                    for($j=1;$j<=5;$j++) {
                                    $selected = "";
                                    if($ratingAvg != 0 && $j<=$ratingAvg) {
                                        $selected = "selected";
                                    }
                                    ?>
									<li class="<?php echo $selected; ?>" >&#9733;</li>
                                    <?php }  ?>
									</ul>
								<div class="rating-num">
									<p>({{$totalRatings}} reviews)</p>
								</div>
								@if($product->video_url!=null)
									<div class="you_tube"><img src="/images/you_tube.png" alt="you tube">
										<a id="youtube"  data-toggle="modal" data-target="#youtube_video" data-keyboard="true" href="#">Click to watch product video</a>
									</div>
								@endif
							</div>
						@else
							<div class="rating">
								<p>(No reviews yet.)</p>
								@if($product->video_url!=null)
									<div class="you_tube">
										<img src="/images/you_tube.png" alt="you tube">
										<a id="youtube"  data-toggle="modal" data-target="#youtube_video" data-keyboard="true" href="#">Click here to check video</a>
									</div>
								@endif
							</div>
						@endif
					</div>
					@if($product->price!=$finalprice)<h3 class="strike-span"> ₹ {{number_format($product->price,2)}}</h3>@endif
					<p id="configPrice"><span> ₹ {{number_format($finalprice,2)}}</span></p>
					<ul class="notes">
						<p>{!! nl2br(e($product->short_description)) !!}</p>
					</ul>
					<form action="/product/add-to-cart/{{$product->id}}" name="frmAddCart" id="frmAddCart" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						@if((count($getattributesSize)>=1) || (count($getattributesColor)>=1))
							<div class="size-color">
								@if(count($getattributesColor)>=1)
									<div class="size">
										@if(strcasecmp($getattributesColor[0]->name ,"No Color") != 0 )
										<h4>Color</h4>
										@endif
										<input type="hidden" name="selectedColor" id="selectedColor" value="@if(count($getattributesColor)== 1) {{$getattributesColor[0]->AttributeColor}} @endif">
										<ul class="size-list color">
											@foreach($getattributesColor as $color)
											  <?php if(strcasecmp($color->name ,"No Color") != 0 ) {?>
												<li class="colorselect" data-val="{{$color->AttributeColor}}" data-img="@if($color->colorImage != null){{$color->colorImage}}  @endif" >
													<div title="{{$color->name}}" id="{{$color->AttributeColor}}" style="min-height: 45px; @if($color->colorImage== null) background-color: #{{$color->hex_color}}@endif">
														@if($color->colorImage != null)
															<img src="{{URL::asset('uploads/products/images/'.$color->product_id.'/80x85/'.$color->colorImage)}}
																	" width="45" height="45" align="center">
														@endif
													</div>
												</li>
												<?php } ?>
											@endforeach

										</ul>
									</div>
								@endif
								@if(count($getattributesSize)>=1)
									<div class="size">
										<h4>Size</h4>
										<input type="hidden" name="selectedSize" id="selectedSize" value="@if(count($getattributesSize)== 1) {{$getattributesSize[0]->AttributeSize}} @endif">
										<ul class="size-list" id="size-list">
											@foreach($getattributesSize as $size)
												<li class="sizeselect @if($size->quantity >0)@else outstockSize @endif" data-val="{{$size->AttributeSize}}">{{$size->name}}</li>
											@endforeach
										</ul>
									</div>
								@endif
									<div class="size">
										<h4 class="blank_h">&nbsp;</h4>
										@if(($product->size_chart_type =="image" && $product->size_chart_image != null) ||($product->size_chart_type =="desc" && $product->size_chart_description!=null))
												<div class="size-chart">
													<a href="#" id="myBtn"  data-toggle="modal" data-target="#size_chart" data-keyboard="true">Size Chart</a>
												</div>

										@endif
										<div class="stock-Div">
											<a href="#" id="stockBtn"  data-toggle="modal" data-target="#stock_model" data-keyboard="true">Stock Availability</a>
										</div>
									</div>
							</div>
						@endif
						<div class="quantity-Div">
							<span class="qnty-minus btn-number" data-type="minus" data-field="quantity" id="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
							<span><input class="input-number" type="text" name="quantity" value="1" data-price="{{$finalprice}}" min="1" max= "{{$product->quantity}}"></span>
							<span class="qnty-add btn-number" data-type="plus" data-field="quantity" id="add"><i class="fa fa-plus" aria-hidden="true"></i></span>
						</div>

						{{--new chnage by sagar for offers starts--}}
						@if($offer!=null)
							<input type="hidden" name="offer_discount" id="offer_discount" value="{{$offer['discount']}}">
							<input type="hidden" name="offer_quantity" id="offer_quantity" value="{{$offer['quantity']}}">
							<input type="hidden" name="total_price" id="total_price" value="{{$finalprice}}">
							<input type="hidden" name="clicked_type" id="clicked_type" value="">

						<div class="chose-second">
							<h4>{!! $offer->short_description !!}</h4>
							<span class="any">*Any color</span>
							<ul>
								@foreach($productOffers as $productOffer)
									<li>
										<a href="/product/details/{{$productOffer->slug}}" target="_blank"><img src="{{URL::asset('uploads/products/images/'.$productOffer->id.'/80x85/'.$productOffer->image)}}" alt="config-image"></a>
										<div class="quantity-Div" id="price" >
											<span class="qnty-minus btn-number" data-type="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
											<span><input class="input-number" min="0" max="10" type="text" data-price="{{$productOffer['price']-$productOffer['discount_price']}}" name="otherQuantity[{{$productOffer->id}}][quantity]" value="0"></span>
											<span class="qnty-add btn-number" data-type="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
										</div>
									</li>
							    @endforeach
							</ul>
							<h4>{!! $offer->description !!}</h4>
							<ul class="total ammount" style="display: none">
								<li><span>{{$product->sku}}</span><span>1</span><span>₹ {{number_format($finalprice,2)}}</span></li>{{--main products sku and price--}}
								@foreach($productOffers as $productOffer)
									<li style="display: none" class="other-sku"><span>{{$productOffer->sku}}</span><span>1</span><span>&#8377 {{number_format(($productOffer->price - $productOffer->discount_price),2)}}</span></li>
								@endforeach
								<li><span class="off">Less-{{$offer->discount}}%</span><span></span><span></span></li>
								<li><span>Total</span><span></span><span>₹ {{number_format($finalprice,2)}}</span></li>
							</ul>
						</div>
						@endif
						{{--new chnage by sagar for offers ends--}}

						<div class="btn-list">
							<input type="submit"   name="AddToCart"  class="add-button add-cart" value="ADD TO CART"/>
						</div>
					</form>
				</div>
				<div class="clear"></div>
				<div id="tab-list">
					<ul class="tab-list">
						<li class="active" id="tab-desc"><a href="#description">Description</a></li>
						<li id="tab-spec"><a href="#specification">Specification</a></li>
						<!-- <li><a href="#technology">Technologies</a></li> -->
						<li id="tab-review"><a href="#review">Rating & Reviews</a></li>
					</ul>
					<div class="description-list" id="description">
						<h2>Description</h2>
						<p>{!! $product->description !!}</p>
					</div>
					<div class="description-list" id="specification">
						<h2>Specification</h2>
						<div>{!! $product->product_specifications !!}</div>
					</div>
					<div class="description-list" id="review">
						<h2>Write a Review</h2>
					@if($flag == false && $user != null)
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
							<form  method="POST" name="frmReview" id="review-form" action="/product/add-review/{{$product->id}}" >
								<input type="hidden" name="review_url" id="review_url" value="{{\Illuminate\Support\Facades\Request::fullUrl()}}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="row">
									<label>Name<span>*</span></label>
									<input type="text" name="name"  required value="@if($user != null){{$user->first_name}}@endif">
								</div>
								<div class="row">
									<label>Email Id<span>*</span></label>
									<input type="email" required name="email" @if($user != null)  value="{{$user->email_address}}" readonly  @endif>
								</div>
								<div class="row fullrow">
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
								<div class="row fullrow">
									<label>Message</label>
									<textarea name="message"></textarea>
								</div>
								<div class="row fullrow">
									<input type="submit" value="Submit" required name="submit" class="add-button" >
								</div>
							</form>
						@elseif($user == null)
							<p><b>Please login to add review & rating.</b></p>
						@elseif($flag == true)
							<p><b>You are already rated this Product.</b></p>
						@else
							<p></p>
						@endif
						<div class="review-List">
							<div class="page-Headername">
								<h2>Rating & Reviews</h2>
								@if(count($ratingReviews) >0)
									<div class="toppaging paginationLink">
										{{ $ratingReviews->links() }}
									</div>
							</div>
							<ul class="review-name" id="reviewList">
								@foreach($ratingReviews as $review)
									<li>
										<h4>{{$review->name}}</h4>
										<div class="rating">
											<ul class="star-rating-name">
                                                <?php
                                                $i=1;
                                                for($i=1;$i<=5;$i++) {
                                                $selected = "";
                                                if(!empty($review["rating"]) && $i<=$review["rating"]) {
                                                    $selected = "selected";
                                                }
                                                ?>
												<li class="<?php echo $selected; ?>" >&#9733;</li>
                                                <?php }  ?>
												</ul>

										</div>
										<p>{{$review->message}}</p>
									</li>
								@endforeach
							</ul>
							@else
								<div id="empty_list">
									<p>There are no reviews yet.</p>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- size_chart model start here--}}
	<div class="modal fade" id="size_chart" role="dialog" tabindex='-1'>
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content address-modal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Size Chart</h4>
				</div>
				<div class="modal-body">
					<div style="text-align: center;" class="sizechartDiv">
						@if($product->size_chart_type =="image" && $product->size_chart_image != null)
							<img src="{{ URL::asset('uploads/sizechart/'.$product->id.'/500x500/'.$product->size_chart_image)}}" alt="sizechart"  align="center">
						@elseif($product->size_chart_type =="desc" && $product->size_chart_description!=null)

							<p>{!! $product->size_chart_description !!}</p>
						@else
							<P>Not Present !!</P>
						@endif

					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- size_chart model ends here--}}

	{{--change stock_model model start here--}}
	<div class="modal fade" id="stock_model" role="dialog" tabindex='-1'>
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content address-modal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Stock Availability</h4>
				</div>
				<div class="modal-body">
					<ul class="address-List stock-modal">
						<div class="stock-available" style="text-align: center;">
							@if(count($pConfiguration)>0)
								<table class="stock-table" cellspacing="1" cellpadding="1">
									<thead>
									<tr>
										<th>Color</th>
										<th>Size</th>
										<th>Status</th>
									</tr>
									</thead>
									<tbody>
									@foreach($pConfiguration as $config)
										<tr>
											<td>@if($config->AttributeColor['name']!= null){{$config->AttributeColor['name']}}@else NA @endif</td>
											<td>@if($config->AttributeSize['name']!= null){{$config->AttributeSize['name']}}@else NA @endif</td>
											<td>@if($config->quantity >0 )<span style="color:green;"> In stock </span> @else <span style="color:red;">Out of stock</span> @endif</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							@else
								<table class="stock-table" cellspacing="1" cellpadding="1">
									<thead>
									<tr><th>Product Total Quantity</th></tr>
									</thead>
									<tbody>
									<tr><td>{{$product->quantity}}</td></tr>
									</tbody>
								</table>
							@endif
						</div>
					</ul>
				</div>
			</div>
		</div>
	</div>
	{{--change stock_model model ends here--}}

	@if($product->video_url!=null)
	{{--youtube model start here--}}
	<div class="modal fade" id="youtube_video" role="dialog" tabindex='-1'>
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content youtube-modal">
				<div class="modal-header">
					<button type="button" id="youtube_button_close" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Watch Youtube Video</h4>
				</div>
				<div class="modal-body">
					<?php $videoData = preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $product->video_url, $match);$youtube_id = $match[1]; ?>
					<iframe id="youtube_player" width="100%" height="345" src="https://www.youtube.com/embed/{{$youtube_id}}?rel=0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
	{{--youtube model ends here--}}
	@endif
<div id="productZoom"></div>{{--product zoom div--}}
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="{{asset("js/jquery.zoom.js")}}"></script>
	<script>
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
	</script>
	<script>
        $( function() {
            $( "#tab-list" ).tabs();
        } );
		/*closing error msg after 5 sec time*/
        $(function() {
            // setTimeout() function will be fired after page is loaded
            // it will wait for 5 sec. and then will fire
            // $("#successMessage").hide() function
            setTimeout(function() {
                $("#errorMessage").hide('blind', {}, 500)
            }, 5000);
        });
	</script>	
	<script  type="text/javascript" src="{{asset("js/product-detail-page.js")}}"></script>
@endsection
