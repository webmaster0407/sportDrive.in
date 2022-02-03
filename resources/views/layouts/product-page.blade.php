<!doctype html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE11" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="X-UA-Compatible" content="IE=IE8" />
<meta http-equiv="X-UA-Compatible" content="IE=IE9" />
<meta http-equiv="X-UA-Compatible" content="IE=IE10" />
<meta http-equiv="X-UA-Compatible" content="IE=IE11" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]> <html class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <!--<![endif]-->
<!--[if lt IE 9]>
   <script>
      document.createElement('header');
      document.createElement('nav');
      document.createElement('section');
      document.createElement('article');
      document.createElement('aside');
      document.createElement('footer');
   </script>
<![endif]-->
<title>{{$product['name']}}</title>
<meta name="title" content="{{$product['meta_title']}}">
<meta name="keywords" content="{{$product['meta_keyword']}}">
<meta name="description" content="{{$product['meta_description']}}">
<script src="{{asset("js/min.js")}}" type="text/javascript" language="javascript"></script>
@if(Route::currentRouteName()!= null && (Route::currentRouteName()== "checkout1" || Route::currentRouteName()== "orderDetail" || Route::currentRouteName()== "orderList" || Route::currentRouteName()== "product_details")){{--apply bootstrap css for checkout page only--}}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endif

{{--font awesome--}}
<link href="{{asset("css/font-awesome.css")}}" rel="stylesheet" type="text/css">
{{--pace js & css--}}
<script src="{{asset("js/pace.min.js")}}" type="text/javascript" language="javascript"></script>
<link href="{{asset("css/pace.css")}}" rel="stylesheet" type="text/css">

{{--custom css--}}
<link href="{{asset("css/style.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("css/custome_front.css")}}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

<style>

.swiper-container{margin:0 auto;position:relative;overflow:hidden;list-style:none;padding:0;z-index:1}.swiper-container-no-flexbox .swiper-slide{float:left}.swiper-container-vertical>.swiper-wrapper{-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}.swiper-wrapper{position:relative;width:100%;height:100%;z-index:1;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-transition-property:-webkit-transform;transition-property:-webkit-transform;-o-transition-property:transform;transition-property:transform;transition-property:transform,-webkit-transform;-webkit-box-sizing:content-box;box-sizing:content-box}.swiper-container-android .swiper-slide,.swiper-wrapper{-webkit-transform:translate3d(0,0,0);transform:translate3d(0,0,0)}.swiper-container-multirow>.swiper-wrapper{-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap}.swiper-container-free-mode>.swiper-wrapper{-webkit-transition-timing-function:ease-out;-o-transition-timing-function:ease-out;transition-timing-function:ease-out;margin:0 auto}.swiper-slide{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;width:100%;height:100%;position:relative;-webkit-transition-property:-webkit-transform;transition-property:-webkit-transform;-o-transition-property:transform;transition-property:transform;transition-property:transform,-webkit-transform}.swiper-invisible-blank-slide{visibility:hidden}.swiper-container-autoheight,.swiper-container-autoheight .swiper-slide{height:auto}.swiper-container-autoheight .swiper-wrapper{-webkit-box-align:start;-webkit-align-items:flex-start;-ms-flex-align:start;align-items:flex-start;-webkit-transition-property:height,-webkit-transform;transition-property:height,-webkit-transform;-o-transition-property:transform,height;transition-property:transform,height;transition-property:transform,height,-webkit-transform}.swiper-container-3d{-webkit-perspective:1200px;perspective:1200px}.swiper-container-3d .swiper-cube-shadow,.swiper-container-3d .swiper-slide,.swiper-container-3d .swiper-slide-shadow-bottom,.swiper-container-3d .swiper-slide-shadow-left,.swiper-container-3d .swiper-slide-shadow-right,.swiper-container-3d .swiper-slide-shadow-top,.swiper-container-3d .swiper-wrapper{-webkit-transform-style:preserve-3d;transform-style:preserve-3d}.swiper-container-3d .swiper-slide-shadow-bottom,.swiper-container-3d .swiper-slide-shadow-left,.swiper-container-3d .swiper-slide-shadow-right,.swiper-container-3d .swiper-slide-shadow-top{position:absolute;left:0;top:0;width:100%;height:100%;pointer-events:none;z-index:10}.swiper-container-3d .swiper-slide-shadow-left{background-image:-webkit-gradient(linear,right top,left top,from(rgba(0,0,0,.5)),to(rgba(0,0,0,0)));background-image:-webkit-linear-gradient(right,rgba(0,0,0,.5),rgba(0,0,0,0));background-image:-o-linear-gradient(right,rgba(0,0,0,.5),rgba(0,0,0,0));background-image:linear-gradient(to left,rgba(0,0,0,.5),rgba(0,0,0,0))}.swiper-container-3d .swiper-slide-shadow-right{background-image:-webkit-gradient(linear,left top,right top,from(rgba(0,0,0,.5)),to(rgba(0,0,0,0)));background-image:-webkit-linear-gradient(left,rgba(0,0,0,.5),rgba(0,0,0,0));background-image:-o-linear-gradient(left,rgba(0,0,0,.5),rgba(0,0,0,0));background-image:linear-gradient(to right,rgba(0,0,0,.5),rgba(0,0,0,0))}.swiper-container-3d .swiper-slide-shadow-top{background-image:-webkit-gradient(linear,left bottom,left top,from(rgba(0,0,0,.5)),to(rgba(0,0,0,0)));background-image:-webkit-linear-gradient(bottom,rgba(0,0,0,.5),rgba(0,0,0,0));background-image:-o-linear-gradient(bottom,rgba(0,0,0,.5),rgba(0,0,0,0));background-image:linear-gradient(to top,rgba(0,0,0,.5),rgba(0,0,0,0))}.swiper-container-3d .swiper-slide-shadow-bottom{background-image:-webkit-gradient(linear,left top,left bottom,from(rgba(0,0,0,.5)),to(rgba(0,0,0,0)));background-image:-webkit-linear-gradient(top,rgba(0,0,0,.5),rgba(0,0,0,0));background-image:-o-linear-gradient(top,rgba(0,0,0,.5),rgba(0,0,0,0));background-image:linear-gradient(to bottom,rgba(0,0,0,.5),rgba(0,0,0,0))}.swiper-container-wp8-horizontal,.swiper-container-wp8-horizontal>.swiper-wrapper{-ms-touch-action:pan-y;touch-action:pan-y}.swiper-container-wp8-vertical,.swiper-container-wp8-vertical>.swiper-wrapper{-ms-touch-action:pan-x;touch-action:pan-x}.swiper-button-next,.swiper-button-prev{position:absolute;top:50%;width:27px;height:44px;margin-top:-22px;z-index:10;cursor:pointer;background-size:27px 44px;background-position:center;background-repeat:no-repeat}.swiper-button-next.swiper-button-disabled,.swiper-button-prev.swiper-button-disabled{opacity:.35;cursor:auto;pointer-events:none}.swiper-button-prev,.swiper-container-rtl .swiper-button-next{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'%23636363'%2F%3E%3C%2Fsvg%3E");left:10px;right:auto}.swiper-button-next,.swiper-container-rtl .swiper-button-prev{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'%23636363'%2F%3E%3C%2Fsvg%3E");right:10px;left:auto}.swiper-button-prev.swiper-button-white,.swiper-container-rtl .swiper-button-next.swiper-button-white{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'%23ffffff'%2F%3E%3C%2Fsvg%3E")}.swiper-button-next.swiper-button-white,.swiper-container-rtl .swiper-button-prev.swiper-button-white{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'%23ffffff'%2F%3E%3C%2Fsvg%3E")}.swiper-button-prev.swiper-button-black,.swiper-container-rtl .swiper-button-next.swiper-button-black{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'%23000000'%2F%3E%3C%2Fsvg%3E")}.swiper-button-next.swiper-button-black,.swiper-container-rtl .swiper-button-prev.swiper-button-black{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'%23000000'%2F%3E%3C%2Fsvg%3E")}.swiper-zoom-container{width:100%;height:100%;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;text-align:center}.swiper-zoom-container>canvas,.swiper-zoom-container>img,.swiper-zoom-container>svg{max-width:100%;max-height:100%;-o-object-fit:contain;object-fit:contain}.swiper-slide-zoomed{cursor:move}
    .product-thumbs{overflow:hidden;}	
    #colorimgList li{ width:70px;box-sizing:border-box;-webkit-flex-shrink: 0;-ms-flex-negative: 0;flex-shrink: 0; cursor:pointer;}
    
    .product-main-img{overflow:hidden; position:relative;}
    .product-main-img .product-img{-webkit-flex-shrink: 0;-ms-flex-negative: 0;flex-shrink: 0;}
    .product-main-img .product-img img{width:100%; }
    .product-zoom-img{overflow:hidden; width:80%; margin:0 auto;}
    .product-zoom-img .product-img{-webkit-flex-shrink: 0;-ms-flex-negative: 0;flex-shrink: 0;}
    .product-zoom-img .product-img img{height:100%; }
    @media only screen  and (max-width:768px){
        .product-zoom-img{overflow:hidden; width:auto; margin:0 auto;}
        .leftImg{width:100%}
    }
    
</style>

</head>
<body>
    <div class="full_wrapper">
        <header>
          @include('user.includes.header')  
        </header>	
		  @yield('content')
    </div>
<footer>
@include('user.includes.footer')
</footer>


<script src="{{asset("js/search.js")}}" type="text/javascript" language="javascript"></script>

<script>

	var isMobileNav=window.matchMedia('max-width:980px').matches;
	
	if(!isMobileNav){
		var menuLi=document.querySelectorAll('.navigation .navBar li i.ico');
		console.log(menuLi)
		menuLi.forEach(function(li){
			li.addEventListener('click',toggleMenu);
		})
	}
	function toggleMenu(e){
		e.target.parentNode.classList.toggle('show');
	}
	$('.menuOverlay').on('click',function(){$(this).prev().removeClass('show')})
</script>

@stack('scripts')
    <script>
        var label=document.querySelector('.all-search span'),
        catfilter = document.querySelector('.category-select');
        catfilter.addEventListener('change',updateLabel);
        function updateLabel(){
            var ind=this.selectedIndex+1;
            label.innerHTML = $('option:nth-child('+ind+')',catfilter).text();
        }
    </script>
</body>
</html>

