<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ asset('/images/favicon.png')}}" type="image/x-icon">
    <meta name="google-site-verification" content="NBp6CA9871quqS2gevVZ9AOHvEoqDrQbMbU2Ga7Hlkc" />
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


    <title>{{$homePage['meta_title']}}</title>
    <meta name="title" content="{{$homePage['meta_title']}}">
    <meta name="keywords" content="{{$homePage['meta_keyword']}}">
    <meta name="description" content="{{$homePage['meta_desc']}}">

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


    @stack('stylesheets')
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
    $(document).ready(function(){
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
    });

});
</script>
<script type="text/javascript">
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top
            }, 1500);
        }
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

