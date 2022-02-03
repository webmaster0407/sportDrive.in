@extends('layouts.user')
@section('content')
<div class="content">
  <div class="container">
    <div class="loginMiddle">

      <div class="middleCard">
      @if(Session::has('success'))
          <div class="confirmBox" id="confirmBox">
            <div class="message"> {{Session::get('success')}}</div>
          </div>
        @endif
        <h1 class="title">Forgot Password</h1>
        <form class="login" action="forgot-password" method="post" name="frmLogin" id="frmLogin">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row paraRow">
          </div>
          <div class="row">
          <label>Email<span>*</span></label>
            <input type="email" name="email_address" id="email_address" value="{{ old('email_address') }}">
            <div class="bar"></div>
            @if ($errors->has('email_address'))
            <div class="alert alert-danger">
                {{ $errors->first('email_address') }}
            </div>
        @endif
             @if(Session::has('error'))
            <div class="alert alert-danger">
            {{Session::get('error')}}
          </div>
        @endif
          </div>
         
          <div class="row subBtn">
            <button type="submit"><span>Submit</span></button> 
          </div>
          <div class="row  btnRow">
            <a href="{{  url('/login') }}">Login Here</a>
          </div>
          
        </form>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(window).load(function() {
       $('#confirmBox').delay(10000).fadeOut();
    }); 
</script>
@endsection