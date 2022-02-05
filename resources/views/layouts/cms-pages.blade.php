<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">
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

<title>{{$cmsPage['page_title']}}</title>
<meta name="title" content="{{$cmsPage['meta_title']}}">
<meta name="keywords" content="{{$cmsPage['meta_keyword']}}">
<meta name="description" content="{{$cmsPage['meta_desc']}}">

    <script src="{{asset("js/min.js")}}" type="text/javascript" language="javascript"></script>
@if(\Request::getRequestUri()== "/register"){{--apply bootstrap css for checkout page only--}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endif
{{--slick css--}}
<link href="{{asset("css/slick.css")}}" rel="stylesheet" type="text/css">
{{--font awesome--}}
<link href="{{asset("css/font-awesome.css")}}" rel="stylesheet" type="text/css">
{{--pace js & css--}}
<script src="{{asset("js/pace.min.js")}}" type="text/javascript" language="javascript"></script>
<link href="{{asset("css/pace.css")}}" rel="stylesheet" type="text/css">

{{--custom css--}}
<link href="{{asset("css/style.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("css/custome_front.css")}}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
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

<script src="{{asset("js/main.js")}}" type="text/javascript" language="javascript"></script>
<script src="{{asset("js/search.js")}}" type="text/javascript" language="javascript"></script>
<script src="{{asset("js/slick.js")}}" type="text/javascript" language="javascript"></script>
<script src="{{asset("js/owl.carousel.min.js")}}" type="text/javascript" language="javascript"></script>
<script src="{{asset("js/jquery-ui.js")}}" type="text/javascript" language="javascript"></script>
<script>



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

