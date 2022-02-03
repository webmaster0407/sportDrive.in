@extends('layouts.user')
@section('content')
<form>
 
<div class="content">
<input type="hidden" name="_token_" id="csrf-token" value="{{ csrf_token() }}" />
  
<div class="breadcrums">
    <div class="container">
        <ul>
            <li><a href="{{  url('/login') }}">Home / </a></li>
            <li class="active"><a href="{{  url('/address') }}" class="active">My Addresses</a></li>
        </ul>
    </div>
</div>
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
            <div class="my_order address_wrp">
                <div class="add-address">
                   
                <a href="{{  url('/address/add') }}" class="add_new_btn">Add New Address</a>
                </div>
                <ul class="address-list">  
 
                      @foreach($Address as $val) 
                    <li>
                        <div class="select-address"><input type="radio" value="{{$val['id']}}" <?php if($val['is_default']=="Y") echo "checked";?> id="default_Add" name="radio_button"><span>Set as default address</span> </div>
                        
                        <div class="address-detail">
                            <a href="{{ url('/address/edit/'.$val['id']) }}"><h4> {{$val['address_title']}}</h4></a>
                            
                            <p>{{$val['full_name']}}</p>
                            <p>{{$val['address_line_1']}}</p>
                            <p>{{$val['address_line_2']}}</p>
                            <p>{{$val['city']}}</p>
                            <p>{{$val['state']}}</p>
                            <p>{{$val['country']}}</p>
                            <p>{{$val['pin_code']}}</p>
                        </div>   
                    </li>
                    @endforeach
                    @if(count($Address)==0)
                              <li>{{"Sorry ! No address found."}}</li>
                    @endif
                </ul>
            </div>
        </div>
    
    </div>
</div>
</div>
</form>
<script type="text/javascript">
$(document).on("click", '#default_Add', function(event){
        var id = $(this).val();
        var token = $('input[name=_token_]').val();
        //alert(token);
         $.ajax({
      url: "/address/update_default",  // this is just update the db 
      headers: {'X-CSRF-TOKEN': token},
      type: "POST",
      data: {"id":id},
      dataType: "JSON",
      success: function(data) {
        //alert(data);
      }
   });
    });
</script>
@endsection