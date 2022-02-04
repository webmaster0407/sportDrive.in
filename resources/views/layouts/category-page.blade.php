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
<title>{{$category['name']}}</title>
<meta name="title" content="{{$category['meta_title']}}">
<meta name="keywords" content="{{$category['meta_keyword']}}">
<meta name="description" content="{{$category['meta_desc']}}">
@if(Route::currentRouteName()!= null && (Route::currentRouteName()== "checkout1" || Route::currentRouteName()== "orderDetail" || Route::currentRouteName()== "orderList" || Route::currentRouteName()== "ListCategoryProduct")){{--apply bootstrap css for checkout page only--}}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endif
    <!-- Animation CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css')}}">   
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet"> 
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/linearicons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/simple-line-icons.css')}}">
    <!--- owl carousel CSS-->
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.theme.default.min.css')}}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css')}}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}">



    <!-- Custom Common Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-common.css') }}">
    <!-- Css for only Home -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/category/category-page.css') }}">

</head>
<body>
<!-- LOADER -->
<div class="preloader">
    <div class="lds-ellipsis">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!-- END LOADER -->
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

    $('.featureProduct').owlCarousel({
        itemsDesktop : [1199,4],
        itemsDesktopSmall : [980,3],
        itemsTablet: [768,2],
        itemsTabletSmall: false,
        itemsMobile : [479,1],
        singleItem : false,
        loop:true,
        margin:10,
        autoplay:true,
        rewindNav:true,
        stopOnHover:true,
        autoplayHoverPause:true,
        navigation:true,
        navigationText : false,
        responsiveClass:true,
        responsive: true,
        responsiveRefreshRate : 200
       /* responsive:{
            0:{
                items:3,
                nav:true
            },
            600:{
                items:5,
                nav:true
            },
            1000:{
                items:8,
                nav:true,
                loop:false
            }
        }*/
    });
    $(document).ready(function(){
     $('.listingSlider').owlCarousel({
         loop:true,
         margin:10,
         autoplay:true,
         rewindNav:true,
         stopOnHover:true,
         slideSpeed :200,
         autoplayHoverPause:true,
         navigation:true,
         navigationText : false,
         responsiveClass:true,
         itemsDesktop : [1199,4],
         itemsDesktopSmall : [980,3],
         itemsTablet: [768,2],
         itemsTabletSmall: false,
         itemsMobile : [479,1],
         singleItem : false,
         responsiveRefreshRate : 200,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:5,
                nav:true,
                loop:false
            }
        }
    });

    });

</script>
    <script>
        var label=document.querySelector('.all-search span'),
            catfilter = document.querySelector('.category-select');
        catfilter.addEventListener('change',updateLabel);
        function updateLabel(){
            var ind=this.selectedIndex+1;
            label.innerHTML = $('option:nth-child('+ind+')',catfilter).text();
        }
    </script>
@stack('scripts')

</body>
</html>

