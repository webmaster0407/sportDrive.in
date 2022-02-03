@extends('layouts.user')
@section('content')
  <script language="Javascript" type="text/javascript">
    function allowAlphaNumericSpace(e) {
      var code = ('charCode' in e) ? e.charCode : e.keyCode;
      if (!(code == 32) && // space
              !(code > 47 && code < 58) && // numeric (0-9)
              !(code > 64 && code < 91) && // upper alpha (A-Z)
              !(code >= 44 && code <= 45) && // - and ,
              !(code > 96 && code < 123)) { // lower alpha (a-z)
        alert("Only Alphabets, Numbers , hyphen(-)  and commas(,) are allowed in address fields");
        return false;
      }
    }
  </script>
<div class="content">
  <div class="container">
    <div class="loginMiddle">

      <div class="middleCard">
        <h1 class="title">Edit Address</h1>
        
        <form class="login" id="frmEditAddress" action="/address/edit/{{$address_display->id}}" method="post" name="frmEditAddress">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="route" value="{{ $data['route'] }}">
          <div class="row paraRow">
            <p></p>
          </div>
          <div class="row">
            <label>Full Name<span>*</span></label>
            <input type="text" name="full_name" id="full_name" value="{{$address_display->full_name}}">
          <div class="bar"></div>
          @if ($errors->has('full_name'))
            <div class="alert alert-danger">
                {{ $errors->first('full_name') }}
            </div>
          @endif
          </div>
          <div class="row">
            <label>Address Title<span>*</span></label>
            <select name="address_title" id="address_title">
              <option <?php if(old('address_title')=="Home") echo "selected"; elseif($address_display->address_title=="Home") echo "selected";?> value="Home">Home</option>
              <option  <?php if(old('address_title')=="Office") echo "selected"; elseif($address_display->address_title=="Office") echo "selected";?> value="Office">Office</option>
              <option  <?php if(old('address_title')=="Other") echo "selected"; elseif($address_display->address_title=="Other") echo "selected";?> value="Other">Other</option>
            </select>
          <div class="bar"></div>
          @if ($errors->has('address_title'))
            <div class="alert alert-danger">
                {{ $errors->first('address_title') }}
            </div>
        @endif
          </div>
          <div class="row">
            <label>Address Line 1<span>*</span></label>
            <input type="text" name="address_line_1" id="address_line_1" value="{{$address_display->address_line_1}}" onkeypress="return allowAlphaNumericSpace(event);">
          <div class="bar"></div>
          @if ($errors->has('address_line_1'))
            <div class="alert alert-danger">
                {{ $errors->first('address_line_1') }}
            </div>
        @endif
          </div>
          <div class="row">
            <label>Address Line 2<span>*</span></label>
            <input type="text" name="address_line_2" id="address_line_2" value="{{$address_display->address_line_2}}" onkeypress="return allowAlphaNumericSpace(event);">
          <div class="bar"></div>
          @if ($errors->has('address_line_2'))
            <div class="alert alert-danger">
                {{ $errors->first('address_line_2') }}
            </div>
        @endif
          </div>
          <div class="row">
          <label>City<span>*</span></label>
            <input type="text" name="city" id="city" value="{{$address_display->city}}" onkeypress="return allowAlphaNumericSpace(event);">
            <div class="bar"></div>
            @if ($errors->has('city'))
            <div class="alert alert-danger">
                {{ $errors->first('city') }}
            </div>
        @endif
          </div>
          <div class="row">
          <label>State<span>*</span></label>
            <input type="text" name="state" id="state" value="{{$address_display->state}}" onkeypress="return allowAlphaNumericSpace(event);">
            <div class="bar"></div>
            @if ($errors->has('state'))
            <div class="alert alert-danger">
                {{ $errors->first('state') }}
            </div>
        @endif
          </div>
          <div class="row">
          <label>Country<span>*</span></label>
            <input type="text" name="country" id="country" value="{{$address_display->country}}" onkeypress="return allowAlphaNumericSpace(event);">
            <div class="bar"></div>
            @if ($errors->has('country'))
            <div class="alert alert-danger">
                {{ $errors->first('country') }}
            </div>
        @endif
          </div>
          <div class="row">
          <label>Pin Code<span>*</span></label>
            <input type="number" name="pinCode" id="pinCode" value="{{$address_display->pin_code}}">
            <div class="bar"></div>
            @if ($errors->has('pinCode'))
            <div class="alert alert-danger">
                {{ $errors->first('pinCode') }}
            </div>
        @endif
          </div>
          <div class="row">
          <label>Contact No.<span>*</span></label>
            <input type="number" name="phone" id="phone" value="{{$address_display->contact_no}}">
            <div class="bar"></div>
            @if ($errors->has('phone'))
            <div class="alert alert-danger">
                {{ $errors->first('phone') }}
            </div>
        @endif
          </div>
          <div class="row subBtn">
            <button type="submit"><span>Submit</span></button> 
          </div>
          <div class="row  btnRow">
            <a href="{{  url('/login') }}">Back To Login</a>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>
@endsection