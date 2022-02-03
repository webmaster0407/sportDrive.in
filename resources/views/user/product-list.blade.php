@extends('layouts.category-page')
@section('content')
{{--page content starts here--}}
    <?php

    if(!is_array($allProductIdsData)) $allProductIdsData = $allProductIdsData->toArray();?>
    <input type="hidden" name="filter_url" id="filter_url" value="{{\Illuminate\Support\Facades\Request::fullUrl()}}">
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
                <div class="filter-Left">
                    <h2>Filter</h2>
                    <a class="filter-toggle hidden-lg hidden-md active" href="javascript:;" id="filterToggle">Filters</a>
                    <div id="catlogFilters" class="catalog-filters">
                        <div class="filter-item">
                            <div class="filter-collapse">
                            </div>
                        </div>
                        <div class="resetDiv"><a href="javascript:void(0)" id="reset_filters">Reset<i class="fa fa-share" aria-hidden="true"></i></a></div>
                        <ul class="select-cat" id="selected_filters">
                            @if($selected!=null) {!! $selected !!} @endif
                        </ul>
                        <div class="filter filter-item" data-filter-type="f">
                            <h3 class="filter-heading">
                                <a data-toggle="collapse" aria-expanded="" class="collapsed" data-id="collapse21">For<span id=for_plus_minus class="pricehide icon-plus"></span></a></h3>
                            <div id="collapse21" class="filter-collapse collapse" aria-expanded="">
                                <ul class="checkList">
                                    <li><input  class ="for" type="checkbox" name="select" value="m" data-name="Men" id="f_m"><span>Men</span></li>
                                    <li><input  class ="for" type="checkbox" name="select" value="w" data-name="Women" id="f_w"><span>Women</span></li>
                                    <li><input  class ="for" type="checkbox" name="select" value="g" data-name="Girls" id="f_g"><span>Girls</span></li>
                                    <li><input  class ="for" type="checkbox" name="select" value="b" data-name="Boys" id="f_b"><span>Boys</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="filter filter-item" data-filter-type="p">
                            <h3 class="filter-heading">
                                <a data-toggle="collapse" href="javascript:void(0)" aria-expanded="" data-id="collapse3" class="collapsed">Price<span id=price_plus_minus class="icon-plus"></span></a></h3>
                            <div id="collapse3" class="filter-collapse collapse" aria-expanded="">
                                <ul class="checkList">
                                    <?php
                                        $slot = ($productsAvg-$productsMin)/3;
                                        $aboveAgvSlot = ($productsMax-$productsAvg)/2;
                                    ?>
                                    @if($productsMax>0)
                                        <li><input class ="filter-field" type="checkbox" name="select" value="{{round($productsMin)}}-{{round($productsMin+($slot*1))}}" id="p_1000-2999"><span>{{number_format(round($productsMin),2)}}-{{number_format(round($productsMin+($slot*1)),2)}}</span></li>
                                        <li><input class ="filter-field" type="checkbox" name="select" value="{{round($productsMin+($slot*1))}}-{{round($productsMin+($slot*2))}}" id="p_3000-6999"><span>{{number_format(round($productsMin+($slot*1)),2)}}-{{number_format(round($productsMin+($slot*2)),2)}}</span></li>
                                        <li><input class ="filter-field" type="checkbox" name="select" value="{{round($productsMin+($slot*2))}}-{{round($productsMin+($slot*3))}}" id="p_7000-9999" ><span>{{number_format(round($productsMin+($slot*2)),2)}}-{{number_format(round($productsMin+($slot*3)),2)}}</span></li>
                                        <li><input class ="filter-field" type="checkbox" name="select" value="{{round($productsMin+($slot*3))}}-{{round($productsMin+($slot*3)+$aboveAgvSlot)}}" id="p_10000-14999"><span>{{number_format(round($productsMin+($slot*3)),2)}}-{{number_format(round($productsMin+($slot*3)+$aboveAgvSlot),2)}}</span></li>
                                        <li><input class ="filter-field" type="checkbox" name="select" value="{{round($productsMin+($slot*3)+$aboveAgvSlot)}}-{{round($productsMax)}}" id="p_15000-999999"><span>{{number_format(round($productsMin+($slot*3)+$aboveAgvSlot),2)}}-Above</span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="filter filter-item">
                            <h3 class="filter-heading"><a data-toggle="collapse" href="javascript:void(0)" aria-expanded=""  data-id="collapse4" class="collapsed">Category<span id=category_plus_minus class="icon-plus"></span></a></h3>
                            <div id="collapse4" class="filter-collapse collapse" aria-expanded="">
                                <ul class="checkList">
                                    <li><input type="checkbox" name="select" checked disabled="true"><span>{{$category['name']}}</span></li>
                                </ul>
                            </div>
                        </div>
                        @if($subCategories!=null)
                            <div class="filter filter-item" data-filter-type="sc">
                                <h3 class="filter-heading">
                                    <a data-toggle="collapse" href="javascript:void(0)" aria-expanded="" data-id="collapse5"  class="collapsed">Category List<span id=sub_category_plus_minus class="icon-plus"></span></a>
                                </h3>
                                <div id="collapse5" class="filter-collapse collapse" aria-expanded="">
                                    <ul class="checkList">
                                        @foreach($subCategories as $subCategory)
                                            <li><input class="categories" type="checkbox" name="select" id="sc_{{$subCategory['id']}}" value="{{$subCategory['id']}}" data-name="{{$subCategory['name']}}"><span>{{$subCategory['name']}}</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if($subSubCategories!=null)
                            <div class="filter filter-item" data-filter-type="ssc">
                                <h3 class="filter-heading">
                                    <a data-toggle="collapse" href="javascript:void(0)" data-id="collapse6" aria-expanded="" class="collapsed">Subcategory List<span id=sub_sub_category_plus_minus class="icon-plus"></span></a>
                                </h3>
                                <div id="collapse6" class="filter-collapse collapse" aria-expanded="">
                                    <ul class="checkList largeheight">
                                        @foreach($subSubCategories as $subSubCategory)
                                            <li><input class ="subCategories" type="checkbox" name="select" id="ssc_{{$subSubCategory['id']}}" value="{{$subSubCategory['id']}}" data-name="{{$subSubCategory['name']}}"><span>{{$subSubCategory['name']}}</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if($brands!= null)
                        <div class="filter filter-item" data-filter-type="b">
                            <h3 class="filter-heading">
                                <a data-toggle="collapse" href="javascript:void(0)" aria-expanded="" data-id="collapse7" class="collapsed">Brand List<span id=price_plus_minus class="icon-plus"></span></a></h3>
                            <div id="collapse7" class="filter-collapse collapse" aria-expanded="">
                                <div class="frmSearch">
                                    <input type="text" id="searchBrand" placeholder="Enter brand" style="margin-top: 5px;padding: 10px;border: #a6a6a6 1px solid;border-radius:4px;" />
                                        <ul class="checkList" id="suggesstion-box" style="max-height:218px !important;overflow-y: scroll;">
                                            @foreach($brands as $brand)
                                            <li><input class ="filter-field-brand" type="checkbox" name="select" value="{{$brand['id']}}" id="b_{{$brand['id']}}" data-name="{{$brand['name']}}"><span>{{$brand['name']}}</span></li>
                                            @endforeach
                                        </ul>
                                </div>
                            </div>
                        </div>
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
                                        <p><a href="/product/details/{{$product->slug}}">{{$product->name}}</a></p>
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

                                   {{-- <div class="description">
                                        <p>{{$product->short_description}}</p>
                                    </div>--}}
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

{{--youtube model start here--}}
<div class="modal fade" id="youtube_video" role="dialog" tabindex='-1'>
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content youtube-modal">
            <div class="modal-header">
                <button type="button" id="youtube_button_close" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Watch Youtube Video</h4>
            </div>
            <div class="modal-body">
                {{----}}
                <iframe id="youtube111" width="100%" height="345" frameborder="0" allowfullscreen src=""></iframe>
                {{----}}
            </div>
        </div>
    </div>
</div>
{{--youtube model ends here--}}
<script>
    $(document).on("click",".playI",function(e){
        var value = $(this).attr("data-vid");
        $("#youtube111").show()
        var ytpattrn=/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i
        var vid=ytpattrn.exec(value);
        var yt='https://www.youtube.com/embed/'+vid[1]
        $("#youtube111")[0].src=yt+'?autoplay=1&rel=0';
    });
    $('#youtube_button_close').click(function(){
        var frame=$("#youtube111")[0],fsrc=frame.src;
        frame.src=fsrc.replace('autoplay=1','autoplay=0')
        $('#video')[0].pause();
    });
</script>
    <script>
        $(document).on("keyup", '#searchBrand', function(event) {
            var token = $('input[name=token]').val();
            var key = $(this).val();
            $.ajax({
            url: "/search-brand",
            headers: {'X-CSRF-TOKEN': token},
            data:{"key":key},
            type: "POST",
            datatype: 'JSON',
            success: function(data){
                $("#suggesstion-box").html(data);
                $("#searchBrand").css("background","#FFF");
            }
            });
        });
   
    </script>
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
    <script src="{{asset("js/filters.js")}}" type="text/javascript" language="javascript"></script>
@endsection