@extends('layouts.cms-pages')
@section('content')
<div class="content">
	<div class="listingContent">
 		<div class="container">
			<div class="cmsPageClass">
				
				<?php if(Request::path() == "register"){?>
					@include('user.register')
				<?php }elseif(Request::path() == "login"){?>
					@include('user.login')
				<?php }elseif(Request::path() == "contact-us"){?>
					@include('user.contact-us')
				<?php }else{?>
					{!! $cmsPage['description'] !!}
				<?php } ?>
				
			</div>
		</div>
	</div>
</div>
@endsection