@extends('layouts.home')
@section('content')
<!-- START SECTION BANNER -->
<div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
    <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow" data-ride="carousel">
        <div class="carousel-inner">
            <?php $ds = DIRECTORY_SEPARATOR;?>
            @if(count($bannerData)>0)
                <?php $i = 1; ?>
                @foreach($bannerData as $banner)    
                    @if(file_exists(public_path().$ds."uploads"."$ds"."banners"."$ds"."1280x404"."$ds"."$banner->banner_images"))
                            @if($i == 1) 
                            <?php $i++; ?>
                            <div class="carousel-item background_bg active" data-img-src="uploads/banners/1280x404/{{$banner->banner_images}}">
                                <div class="banner_slide_content banner_content_inner">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-7 col-10">
                                                <div class="banner_content overflow-hidden">
                                                    @if($banner->short_text != '.' && $banner->short_text != '-')
                                                    <h4 class="mb-3 mb-sm-4 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="0.3s" style="color: #fff;">{{$banner->short_text}}</h4>
                                                    @endif
                                                    @if($banner->banner_heading != '.' && $banner->banner_heading != '-')
                                                    <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="0.9s" style="color: #fff;">{{$banner->banner_heading}}</h2>
                                                    @endif
                                                    <a class="btn btn-fill-out staggered-animation text-uppercase" href="{{$banner->banner_url}}" target="_blank" data-animation="slideInLeft" data-animation-delay="1.5s">Shop Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else 
                            <div class="carousel-item background_bg" data-img-src="uploads/banners/1280x404/{{$banner->banner_images}}">
                                <div class="banner_slide_content banner_content_inner">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-7 col-10">
                                                <div class="banner_content overflow-hidden">
                                                    @if($banner->short_text != '.' && $banner->short_text != '-' )
                                                    <h4 class="mb-3 mb-sm-4 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="0.3s" style="color: #fff;">{{$banner->short_text}}</h4>
                                                    @endif
                                                    @if($banner->banner_heading != '.' && $banner->banner_heading != '-')
                                                    <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="0.9s" style="color: #fff;">{{$banner->banner_heading}}</h2>
                                                    @endif
                                                    <a class="btn btn-fill-out staggered-animation text-uppercase" href="{{$banner->banner_url}}" target="_blank" data-animation="slideInLeft" data-animation-delay="1.5s">Shop Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                    @endif
                @endforeach
            @else
            <div class="carousel-item background_bg active" data-img-src="{{ asset('images/banner-1.jpg')}}">
                <div class="banner_slide_content banner_content_inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 col-10">
                                <div class="banner_content overflow-hidden">
                                    <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="0.5s">-A New You-</h2>
                                    <h5 class="mb-3 mb-sm-4 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="1s">Swimsuit</h5>
                                    <a class="btn btn-fill-out staggered-animation text-uppercase" href="shop-left-sidebar.html" data-animation="slideInLeft" data-animation-delay="1.5s">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
    </div>
</div>
<!-- END SECTION BANNER -->

<!-- START SECTION BANNER --> 
<div class="section pb_20 small_pt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s4 text-center">
                    <h2>Top Categories</h2>
                </div>
                <p class="text-center leads">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim Nullam nunc varius.</p>
            </div>
        </div>
        <div class="row">
            @foreach($topCategories as $topCategory)
            <div class="col-lg-4 col-md-6">
                <div class="sale-banner mb-3 mb-md-4">
                    <a class="hover_effect1" href="/category/{{$topCategory['slug']}}?page=1">
                        <img src="/uploads/categories/426x210/{{$topCategory['image']}}" alt="{{$topCategory['name']}}" style="border-radius: 15px;">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- END SECTION BANNER -->


<!-- START SECTION SHOP -->
<div class="section small_pt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s1 text-center">
                    <h2>FEATURED PRODUCTS</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
                    @foreach($featuredProduct as $key=>$product)
                    <div class="item">
                        <div class="product_wrap">
                            @if($product->icon!=null)
                            <span class="pr_flash"><img src="/uploads/product_icon/{{$product->id}}/{{$product->icon}}"></span>
                            @endif
                            <div class="product_img">
                                <a href="/product/details/{{$product['slug']}}">
                                    @if($product->image!=null)
                                    <img src="/uploads/products/images/{{$product->id}}/250x250/{{$product->image}}" alt="product">
                                    <img class="product_hover_img" src="/uploads/products/images/{{$product->id}}/250x250/{{$product->image}}" alt="el_hover_img2">
                                    @else
                                    <img src="/images/no-image-available.png" alt="product">
                                    <img class="product_hover_img" src="/images/no-image-available.png" alt="el_hover_img2">
                                    @endif
                                </a>
                                <div class="product_action_box">
                                    <ul class="list_none pr_action_btn">
                                        <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                        <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                                        <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                        <li><a href="#"><i class="icon-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title" style="text-align: center; font-size: 12px;"><a href="/product/details/{{$product['slug']}}">{{$product['name']}}</a></h6>
                                <div class="product_price">
                                    <div style="text-align:center;">
                                    <span class="price">&#x20b9 {{number_format($product['price'] - $product['discount_price'],2)}}</span>
                                    @if($product['price']!=($product['price'] - $product['discount_price']))
                                        <del>&#x20b9 {{number_format($product['price'],2)}}</del>
                                    @endif
                                    </div>
                                    <div class="on_sale">
                                        @if($product->offer!=null)
                                            <h6 style="text-align:center;" >{{$product->offer['name']}}</h6>
                                            <span style="text-align: center">({{$product->offer['discount']}}% OFF)</span>
                                            <h6 style="font-size: 14px; text-align: center; color: #444;">*Any color</h6>
                                        @else 
                                            <h6 >&nbsp;</h6>
                                            <p>&nbsp;</p>
                                            <h6 >&nbsp;</h6>
                                        @endif
                                    </div>
                                    @if($product['video_url']!=null)
                                            <a class="playI" data-vid="{{$product['video_url']}}" id="youtube"  data-toggle="modal" data-target="#youtube_video" data-keyboard="true" href="#">
                                            <img src="{{ asset('/images/you_tube.png')}}" style="margin-left: auto; margin-right: auto; width: 30px;">
                                            </a>
                                    @else 
                                            <div style="margin-top: 30px;"></div>
                                    @endif
                                </div>
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width:68%"></div>
                                    </div>
                                    <span class="rating_num">(15)</span>
                                </div>
                                <div class="pr_desc">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->
@endsection

