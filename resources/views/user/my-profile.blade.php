@extends('layouts.user')
@section('content')
<div class="content">

<div class="listingContent">
    @if(Session::has('error'))
        <div class="alert alert-danger address-fail">
            {{Session::get('error')}}
        </div>
    @endif
    @if(Session::has('success'))
        <div class="alert alert-success address-success">
            {{Session::get('success')}}
        </div>
    @endif
  <div class="container">
    <div class="cart-Div">
      
      <div class="address-edit">
        <div class="address-section">
          
                <div class="edit_address" id="edit_address" role="dialog">
                    <h4>My Profile</h4>
                    
                        <form class="editForm" id="frmRegister" action="/my-profile" method="post" name="frmRegister">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="form-row">
                          <p class="note-msg"></p>
                        </div>      
                        <div class="form-row">
                          <label>First Name<span>*</span></label>
                          <input type="text" name="first_name" id="first_name" value="{{$user->first_name}}">
                          @if ($errors->has('first_name'))
                         <div class="alert alert-danger">
                           {{ $errors->first('first_name') }}
                         </div>
                         @endif
                        </div>
                         <div class="form-row">
                          <label>Last Name<span>*</span></label>
                          <input type="text" name="last_name" id="last_name" value="{{$user->last_name}}">
                          @if ($errors->has('last_name'))
                           <div class="alert alert-danger">
                            {{ $errors->first('last_name') }}
                           </div>
                          @endif
                        </div>
                        <div class="form-row">
                          <label>Email<span>*</span></label>
                          <input type="email" name="email_address" id="email_address" value="{{$user->email_address}}" readonly>
                        </div>
                          <div class="form-row">
                          <label>Mobile No.<span>*</span></label>
                          <input type="text" name="phone" id="phone" value="{{$user->phone}}" readonly>
                          @if ($errors->has('phone'))
                          <div class="alert alert-danger">
                          {{ $errors->first('phone') }}
                          </div>
                          @endif
                        </div>
                          <div class="form-row btnDiv">
                          <input type="submit" name="Submit" value="Submit">
                          <input type="button" value="Cancel" onClick="window.location='{{  url('/login') }}';">
                          </div>
                      </form>
                  </div>
                    </div>
        </div>  
    </div>
  </div>
</div>
</div>
@endsection