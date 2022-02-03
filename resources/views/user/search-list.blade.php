@extends('layouts.category-page')
@section('content')
    {{--page content starts here--}}
    <?php
    if(!is_array($allProductIdsData)) $allProductIdsData = $allProductIdsData->toArray();?>
    <input type="hidden" name="filter_url" id="filter_url" value="{{str_replace('%2C', ',',url()->full())}}">
    <input type="hidden" name="product_ids" id="product_ids" value="{{implode(",",$allProductIdsData)}}">
    <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
    <div class="content">
        <div class="breadcrums">
            <div class="container">
                <ul>
                    <li><a href="#">Home / </a></li>
                    <li><a href="#" class="active">Product Listing</a></li>
                </ul>
            </div>
        </div>
        <div class="listingContent">
            <div class="container">
                <div class="topSort">
                    <div class="container">
                        <ul class="rightSort">
                            <li>
                                <select name="per_page_result" id ="per_page_result" data-filter-type="pp">
                                    <option value="15">15 per page</option>
                                    <option value="20">20 per page</option>
                                    <option value="30">30 per page</option>
                                </select>
                            </li>
                            <li>
                                <select class="sortBy" name="sortBy" id="sortBy" data-filter-type="sortBy">
                                    <option selected disabled>Sort By</option>
                                    <option value="l2h">Price Low To High</option>
                                    <option value="h2l">Price High To Low</option>
                                    <option value="n">Newest First</option>
                                </select>
                            </li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>
                {{--<div class="filter-Left"> this div is removed--}}

                <div class="filter-Left">
                    <h2>Filter</h2>
                    <a class="filter-toggle hidden-lg hidden-md active" href="javascript:;" id="filterToggle">Filters</a>
                    <div id="catlogFilters" class="catalog-filters">
                        <div class="filter-item">
                            <div class="filter-collapse">
                            </div>
                        </div>
                        @if($mainCategories!=null)
                            @foreach($mainCategories as $mainKey=>$mainCategory)
                                @if(count($mainCategory['subCategories'])>0)
                                    <div class="filter filter-item" data-filter-type="c">
                                        <h3 class="filter-heading">
                                            <a data-toggle="collapse" href="javascript:void(0)" aria-expanded="" data-id="collapse{{$mainKey}}"  class="collapsed">{{$mainCategory['name']}}<span id=sub_category_plus_minus class="icon-plus"></span></a>
                                        </h3>
                                        @if($mainCategory['subCategories']!=null)
                                            <div id="collapse{{$mainKey}}" class="filter-collapse collapse" aria-expanded="">
                                                <ul class="checkList">
                                                    @foreach($mainCategory['subCategories'] as $mainKey=>$subCategory)
                                                        <li>
                                                            <input class="categories" type="checkbox" <?php if(in_array($subCategory['id'],$selectedCategories)) echo "checked";?> name="select" id="{{$subCategory['id']}}" value="{{$subCategory['id']}}" data-name="{{$subCategory['name']}}"><span>{{$subCategory['name']}}</span>
                                                            @if($subCategory['subSubCategories']!=null)
                                                                <ul class="checkList subCategory">
                                                                    @foreach($subCategory['subSubCategories'] as $subSubCategories)
                                                                        <li><input class="categories" <?php if(in_array($subSubCategories['id'],$selectedCategories)) echo "checked";?> type="checkbox" name="select" id="{{$subSubCategories['id']}}" value="{{$subSubCategories['id']}}" data-name="{{$subSubCategories['name']}}"><span>{{$subSubCategories['name']}}</span></li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="prodList-Right">
                    @if(count($products)>0)
                        <div class="sort-pagination">
                            <ul class="leftSort">
                                <li data-type="grid"><a href="javascript:void(0)"><i class="fa fa-th" aria-hidden="true"></i></a></li>
                                <li data-type="list"><a href="javascript:void(0)"><i class="fa fa-th-list" aria-hidden="true"></i></a></li>
                            </ul>
                            {{ $products->links() }}
                        </div>
                        <div class="grid-view" id="grid-view">
                            <ul class="product-List grid" id="prod_list">
                                @foreach($products as $key=>$product)
                                    <li>
                                        <?php $ds = DIRECTORY_SEPARATOR;
                                        $filePath = public_path().$ds."uploads".$ds."products".$ds."images".$ds.$product->id.$ds."250x250".$ds.$product->image;
                                        $imagePath = $ds."uploads".$ds."products".$ds."images".$ds.$product->id.$ds."250x250".$ds.$product->image;
                                        ?>
                                        @if($product->image!=null)
                                            <div class="imgWrp"><a href="/product/details/{{$product->slug}}"><img src="{{$imagePath}}" alt="product"></a>					</div>
                                        @else
                                            <div class="imgWrp"><a href="/product/details/{{$product->slug}}"><img src="/images/no-image-available.png" alt="product"></a>					</div>
                                        @endif
                                        <div class="content-Right">
                                            @if($product->icon!=null)
                                                <div class="justarrive">
                                                    <img src="/uploads/product_icon/{{$product->id}}/{{$product->icon}}">
                                                </div>
                                            @endif
                                            <div class="textData">
                                                <h4><a href="/product/details/{{$product->slug}}">{{$product->name}}</a></h4>
                                                <p>{{$product->name}}</p>
                                                @if($product->price!=($product->price - $product->discount_price))<h5 class="strike-span"> &#8377 {{number_format(($product->price),2)}}</h5>@endif
                                                <p><span> &#8377 {{number_format(($product->price - $product->discount_price),2)}}</span></p>
                                            </div>
                                            <div class="item-offer">
                                                @if($product->offer!=null)
                                                    <h3>{{$product->offer['name']}}</h3>
                                                    <span class="off-dis">({{$product->offer['discount']}}% OFF)</span>
                                                    <p>*Any color</p>
                                                @endif
                                                @if($product['video_url']!=null)
                                                    <a class="playI" data-vid="{{$product['video_url']}}" id="youtube"  data-toggle="modal" data-target="#youtube_video" data-keyboard="true" href="#">
                                                        <img src="/images/you_tube.png">
                                                        <p>Click to watch product video</p>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="view-add">
                                                <div class="quickview">
                                                    <a href="/product/details/{{$product->slug}}" class="view">{{--<i class="fa fa-eye"></i>--}}</a>
                                                    <a href="/product/details/{{$product->slug}}" class="addLink">Shop Now</a>
                                                    <a href="/product/details/{{$product->slug}}"><input type="button" value="Shop Now" class="add-button"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div id="empty_list">
                                <h1 style="color: #0b3e6f">Sorry! No products found for this filter range.</h1>
                            </div>
                            {{ $products->links() }}
                            @else
                                <div class="empty_list">
                                    <h1 >Sorry! No products found for this filter range.</h1>
                                </div>
                            @endif
                        </div>
                        <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    {{--script for list and grid view starts here--}}
    <script>
        $('.leftSort li').on('click',function(){var w=this.dataset.type; if(w=='list'){$('.product-List').addClass('list')}else{$('.product-List').removeClass('list')}})
        var clickTimer;
        $('.static-right-content > div').on('touchstart',function(){
            clearTimeout(clickTimer);
            $(".mob-menu").removeClass("show");
            $(".mob-menu").addClass("hide");
            $(".nav").addClass('hide');
            $(".nav").removeClass("show");

            $(this).addClass('tray').siblings().removeClass('tray');
            clickTimer=setTimeout(function(){$('.static-right-content div').removeClass('tray')},7000)
        });
        $('body').on('touchstart',function(e){var _tray=$(e.target).parents('.static-right-content').length; if(_tray>0){return false}$('.static-right-content div').removeClass('tray')});
    </script>
    {{--script for list and grid view ends here--}}

    {{--page content ends here--}}
    <script>
        $("#empty_list").hide();
        var clickTimer;
        $('.static-right-content > div').on('touchstart',function(){
            clearTimeout(clickTimer);
            $(".mob-menu").removeClass("show");
            $(".mob-menu").addClass("hide");
            $(".nav").addClass('hide');
            $(".nav").removeClass("show");
            $(this).addClass('tray').siblings().removeClass('tray');
            clickTimer=setTimeout(function(){$('.static-right-content div').removeClass('tray')},7000)
        });
        $('body').on('touchstart',function(e){var _tray=$(e.target).parents('.static-right-content').length; if(_tray>0){return false}$('.static-right-content div').removeClass('tray')});
    </script>
    <script src="{{asset("js/search-filter.js")}}" type="text/javascript" language="javascript"></script>
@endsection