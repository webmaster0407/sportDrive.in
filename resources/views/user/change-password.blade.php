@extends('layouts.user')
@section('content')
<div class="content">
  <div class="container">
    <div class="loginMiddle">
      <div class="middleCard">
        <h1 class="title">Change Password</h1>
          <!-- vishakha 27 oct -->
          <div class="row">
              @if(Session::has('error'))
                  <div class="alert alert-danger">
                      {{Session::get('error')}}
                  </div>
                  <br>
                  <br>
              @endif
              @if(Session::has('success'))
                  <div class="alert alert-success">
                      {{Session::get('success')}}
                  </div>
              @endif
          </div>
      <!-- end -->
        <form class="login" action="/change-password" method="post" name="frmLogin" id="frmLogin">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row paraRow">
            <p></p>
          </div>
          <div class="row">
            <label>Old Password<span>*</span></label>
            <input type="password" name="oldPassword" id="oldPassword" value="{{ old('oldPassword') }}">
          <div class="bar"></div>
          @if ($errors->has('oldPassword'))
            <div class="alert alert-danger">
                {{ $errors->first('oldPassword') }}
            </div>
        @endif
          </div>
          <div class="row">
            <label>New Password<span>*</span></label>
            <input type="password" name="password" id="password" value="{{ old('password') }}">
          <div class="bar"></div>
          @if ($errors->has('password'))
            <div class="alert alert-danger">
                {{ $errors->first('password') }}
            </div>
        @endif
          </div>
          <div class="row">
          <label>Confirm Password<span>*</span></label>
            <input type="password" name="confirmPassword" id="confirmPassword" value="{{ old('confirmPassword') }}">
            <div class="bar"></div>
            @if ($errors->has('confirmPassword'))
            <div class="alert alert-danger">
                {{ $errors->first('confirmPassword') }}
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
@endsection