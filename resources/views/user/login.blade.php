
<div class="content">
  <div class="container">
    <div class="loginMiddle">

      <div class="middleCard">
      @if(Session::has('success'))
            <div class="confirmBox" id="confirmBox">
           <div class="message"> {{Session::get('success')}}</div>
          </div>
        @endif
        <h1 class="title">{{$cmsPage['page_title']}}</h1>
        <form class="login" id="login" action="login" method="post" name="frmLogin">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row paraRow">
            {!! $cmsPage['description']!!}
          </div>
          <div class="row">
            <label>Email Id<span>*</span></label>
            <input type="email" name="email_address" id="email_address" value="{{ old('email_address') }}">
          <div class="bar"></div>
          @if ($errors->has('email_address'))
            <div class="alert alert-danger">
                {{ $errors->first('email_address') }}
            </div>
        @endif
          </div>
          <div class="row">
          <label>Password<span>*</span></label>
            <input type="password" name="password" id="password">
            <div class="bar"></div>
            @if ($errors->has('password'))
            <div class="alert alert-danger">
                {{ $errors->first('password') }}
            </div>
             @endif
        <!-- vishakha 27 oct -->
             @if(Session::has('error'))
            <div class="alert alert-danger">
            {{Session::get('error')}}
          </div>
        @endif
      <!-- end -->
          </div>
          <div class="row subBtn">
            <button type="submit"><span>Submit</span></button> 
          </div>
          <div class="row  btnRow">
            <a href="{{  url('/register') }}">Don't have an account?</a>
              <a href="{{  url('/forgot-password') }}">Forgot Password?</a>
          </div>
        </form>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(window).load(function() {
       $('#confirmBox').delay(500).fadeOut();
    }); 
</script>


