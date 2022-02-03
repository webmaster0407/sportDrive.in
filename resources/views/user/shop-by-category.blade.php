@extends('layouts.user')
@section('content')
    <div class="content">
        <div class="container">
            <div class="listingContent">
                <h2>Shop By Category</h2>
                <div class="shop_category">
                    <ul class="shop-by-cat">
                       @foreach($categories as $mainKey=>$category)
                        <li><h3><a href="/category/{{$category['slug']}}?page=1">{{$category['name']}}</a>@if(count($category['sub_categories'])>0)<i class="plus-icon"></i>@endif
                               </h3>
                           @foreach($category['sub_categories'] as $subKey=>$subCategories)
                                <ul class="shop-sub-cat">
                                    <h4><a href="/category/{{$subCategories['slug']}}?page=1">{{$subCategories['name']}}</a></h4>
                                    @foreach($subCategories['subSubCategories'] as $subSubCategories)
                                        <li><a href="/category/{{$subSubCategories['slug']}}?page=1">{{$subSubCategories['name']}}</a></li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </li>
                       @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.shop-by-cat i.plus-icon').on('click',function(){
            var that=$(this),parent=that.parents('li');
            parent.toggleClass('sub');

        })
    </script>
@endsection