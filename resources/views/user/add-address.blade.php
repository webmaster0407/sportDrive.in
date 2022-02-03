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
        <h1 class="title">Add Address</h1>
        <form class="login" id="frmAddAddress" action="/address/add" method="post" name="frmAddAddress">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="is_shipping" value="{{ $data['is_shipping'] }}">
        <input type="hidden" name="is_billing" value="{{ $data['is_billing'] }}">
        <input type="hidden" name="route" value="{{ $data['route'] }}">
          <div class="row paraRow">
            <p></p>
          </div>
          <div class="row">
            <label>Full Name<span>*</span></label>
            <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}">
          <div class="bar"></div>
          @if ($errors->has('full_name'))
            <div class="alert alert-danger">
                {{ $errors->first('full_name') }}
            </div>
          @endif
          </div>
          <div class="row">
            <label>Address Title<span>*</span></label><br>
            <select name="address_title" id="address_title">
              <option <?php if(old('address_title')=="Home") echo "selected";?> value="Home">Home</option>
              <option  <?php if(old('address_title')=="Office") echo "selected";?> value="Office">Office</option>
              <option  <?php if(old('address_title')=="Other") echo "selected";?> value="Other">Other</option>
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
            <input type="text" name="address_line_1" id="address_line_1" value="{{ old('address_line_1') }}" onkeypress="return allowAlphaNumericSpace(event);" >
          <div class="bar"></div>
          @if ($errors->has('address_line_1'))
            <div class="alert alert-danger">
                {{ $errors->first('address_line_1') }}
            </div>
        @endif
          </div>
          <div class="row">
            <label>Address Line 2<span>*</span></label>
            <input type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2') }}" onkeypress="return allowAlphaNumericSpace(event);">
          <div class="bar"></div>
          @if ($errors->has('address_line_2'))
            <div class="alert alert-danger">
                {{ $errors->first('address_line_2') }}
            </div>
        @endif
          </div>
          <div class="row">
          <label>City<span>*</span></label>
            <input type="text" name="city" id="city" value="{{ old('city') }}" onkeypress="return allowAlphaNumericSpace(event);">
            <div class="bar"></div>
            @if ($errors->has('city'))
            <div class="alert alert-danger">
                {{ $errors->first('city') }}
            </div>
        @endif
          </div>
          <div class="row">
          <label>State<span>*</span></label>
            <input type="text" name="state" id="state" value="{{ old('state') }}" onkeypress="return allowAlphaNumericSpace(event);">
            <div class="bar"></div>
            @if ($errors->has('state'))
            <div class="alert alert-danger">
                {{ $errors->first('state') }}
            </div>
        @endif
          </div>
          <div class="row">
          <label>Country<span>*</span></label>
            <input type="text" name="country" id="country" value="{{ old('country') }}" onkeypress="return allowAlphaNumericSpace(event);">
            <div class="bar"></div>
            @if ($errors->has('country'))
            <div class="alert alert-danger">
                {{ $errors->first('country') }}
            </div>
        @endif
          </div>
          <div class="row">
          <label>Pin Code<span>*</span></label>
            <input type="number" name="pin_code" id="pin_code" value="{{ old('pin_code') }}">
            <div class="bar"></div>
            @if ($errors->has('pin_code'))
            <div class="alert alert-danger">
                {{ $errors->first('pin_code') }}
            </div>
        @endif
          </div>
          <div class="row">
          <label>Contact No.<span>*</span></label>
            <input type="number" name="contact_no" id="contact_no" value="{{ old('contact_no') }}">
            <div class="bar"></div>
            @if ($errors->has('contact_no'))
            <div class="alert alert-danger">
                {{ $errors->first('contact_no') }}
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