<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomTraits\ProductTrait;
use App\Http\Controllers\CustomTraits\VisitorsTrait;
use App\Product;
use App\ProductCategoryMap;
use App\ProductsOffers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Jenssegers\Agent\Agent;

class SearchController extends Controller
{

    use ProductTrait;
    use VisitorsTrait;
    public function __construct(){
        $this->middleware('checkVisitors');
    }
    /**
     * @param Request $request
     * @return null|string
     */

    public function autoSuggest(Request $request){
      try{
		  $data = $request->all();
          $searchText = $data['keyword'];
          $user = Auth::user();
          if(!$user){
              $user = (object) [];
              $user->id = "";
              $user->first_name = "Visitor";
              $user->last_name = "";
          }
          $user->searckKeyword = $searchText;
          $this->StoreNotificationData($user, "search");
          if($request->ajax()){
              if($data['cat']!=null && $data['cat'] != 0){
                  $categoryProducts = ProductCategoryMap::where('category_id', $data['cat'])->pluck('product_id')->toArray();
                  $products = Product::whereIn("id",$categoryProducts)->where("products.name", 'LIKE', "%$searchText%")->orwhere("products.slug", 'LIKE', "%$searchText%")->orwhere("products.meta_title", 'LIKE', "%$searchText%")->orwhere("products.meta_keyword", 'LIKE', "%$searchText%")->orwhere("products.meta_description", 'LIKE', "%$searchText%")->orwhere("products.sku", 'LIKE', "%$searchText%")->orwhere("products..price", 'LIKE', "%$searchText%")->orwhere("products.product_specifications", 'LIKE', "%$searchText%")->orwhere("products.description", 'LIKE', "%$searchText%")->orderby("products.sort_order", "ASC")->pluck("id")->toArray();
                  $products = Product::whereIn("id",$categoryProducts)->whereIn("id",$products)->pluck("id");
              }else{
                  $category_ids = Category::where('name', 'LIKE', "%$searchText%")->pluck('id')->toArray();
                  $finalProducts = ProductCategoryMap::whereIn('category_id', $category_ids)->pluck('product_id')->toArray();
                  $products = Product::where("products.name", 'LIKE', "%$searchText%")->orwhere("products.slug", 'LIKE', "%$searchText%")->orwhere("products.meta_title", 'LIKE', "%$searchText%")->orwhere("products.meta_keyword", 'LIKE', "%$searchText%")->orwhere("products.meta_description", 'LIKE', "%$searchText%")->orwhere("products.sku", 'LIKE', "%$searchText%")->orwhere("products..price", 'LIKE', "%$searchText%")->orwhere("products.product_specifications", 'LIKE', "%$searchText%")->orwhere("products.description", 'LIKE', "%$searchText%")->orderby("products.sort_order", "ASC")->pluck("id")->toArray();
                  $products = array_unique(array_merge($finalProducts,$products));
              }
              $products = Product::whereIn("id",$products)->where("is_completed","Y")->where("is_active","Y")->limit(20)->get();
              $searchData = null;
              $ds = DIRECTORY_SEPARATOR;
              if(count($products)>0){
                  $searchData.="<span><a href='#'><i class='fa fa-times' aria-hidden='true' id='close-search-box'></i></a></span>";
                  $searchData.="<ul class='autoList'>";
                  foreach ($products as $product){
                      $image = $ds.'uploads'.$ds.'products'.$ds.'images'.$ds.$product->id.$ds.'80x85'.$ds.$product->image;
                      $fullImagePath = public_path().$ds.'uploads'.$ds.'products'.$ds.'images'.$ds.$product->id.$ds.'80x85'.$ds.$product->image;
                      if(file_exists($fullImagePath))
                          $img = "<img src='$image' width='50' height='50'>";
                      else
                          $img ="<img src='/images/no-image-available.png' width='50' height='50'>";
                      $searchData.="<li>";
                      $searchData.="<div class='img-d'>$img</div>";
                      $searchData.="<div class='name-price'><a href='/product/details/$product->slug'>$product->name</a>";
                      $searchData.="<span>₹ $product->price</span></div></li>";
                  }
                  $searchData.="</ul>";
              }else{
                  $searchData .= "<p>Sorry ! No products found for this keyword.</p>";
              }
              return $searchData;
          }else{
              $take = ENV("pagination_result");
              $orderBy = "sort_order";
              $sortOrderType ="DESC";
              $searchText = $data['keyword'];
              $category_ids = Category::where('name', 'LIKE', "%$searchText%")->pluck('id')->toArray();
              $finalProducts = ProductCategoryMap::whereIn('category_id', $category_ids)->pluck('product_id')->toArray();
              $products = Product::where("products.name", 'LIKE', "%$searchText%")->orwhere("products.slug", 'LIKE', "%$searchText%")->orwhere("products.meta_title", 'LIKE', "%$searchText%")->orwhere("products.meta_keyword", 'LIKE', "%$searchText%")->orwhere("products.meta_description", 'LIKE', "%$searchText%")->orwhere("products.sku", 'LIKE', "%$searchText%")->orwhere("products..price", 'LIKE', "%$searchText%")->orwhere("products.product_specifications", 'LIKE', "%$searchText%")->orwhere("products.description", 'LIKE', "%$searchText%")->orderby("products.sort_order", "ASC")->pluck("id")->toArray();
              $allProductIdsData = array_unique(array_merge($finalProducts,$products));
              $parentCategoryIds = Category::where("parent_id", 0)->pluck("id")->toArray();
              if(array_key_exists("c",$data) && $data['c'] != 0 && !in_array($data['c'],$parentCategoryIds)){
                  $selectedCategories = explode(",",$data['c']);
                  $selectedCategories = array_unique($selectedCategories);
              }else{
                  if(array_key_exists("c",$data) && $data['c'] != 0){
                      $selectedCategories = array_map('intval', explode(',', $data['c']));
                      $subCat = Category::whereIn("parent_id",$selectedCategories)->pluck("id")->toArray();
                      $subSubCat  = array();
                      if(count($subCat)>0)
                        $subSubCat = Category::whereIn("parent_id",$subCat)->pluck("id")->toArray();
                      $selectedCategories = array_merge($selectedCategories,$subCat);
                      $selectedCategories = array_merge($selectedCategories,$subSubCat);
                      $selectedCategories = ProductCategoryMap::whereIn("product_id",$allProductIdsData)->whereIn("category_id",$selectedCategories)->pluck("category_id")->toArray();
                  }else{
                      $selectedCategories = ProductCategoryMap::whereIn("product_id",$allProductIdsData)->pluck("category_id")->toArray();
                      $selectedCategories = Category::whereIn("id",$selectedCategories)->where("level_id","!=",0)->where("is_active","Y")->pluck("id")->toArray();
                      if($selectedCategories!=null){
                          $selectedCategories = array_unique($selectedCategories);
                          $data['c'] = implode(",",$selectedCategories);
                          $qs="";
                          $len = count($data);
                          $cnt = 0;
                          foreach($data as $key =>$val){
                              $cnt++;
                              $qs.= $key."=".$val.($len!=$cnt?"&":"");
                          }
                          return redirect("/search?$qs");
                      }
                  }
              }
              $mainCategories = $this->getInnerCategory(0);
              foreach ($mainCategories as $key => $value) {
                  $subCategories =  $this->getInnerCategory($value['id']);
                  if(count($subCategories) > 0)
                      $mainCategories[$key]["subCategories"] = $subCategories;
                  else
                      $mainCategories[$key]["subCategories"] = null;
              }
              foreach ($mainCategories as $mainCategoriesKey => $subCategories) {
                  if($subCategories['subCategories']!=null){
                      foreach ($subCategories['subCategories'] as $subCategoriesKey => $subSubCategories) {
                          $subSubCategories =  $this->getInnerCategory($subSubCategories['id']);
                          if(count($subSubCategories)>0)
                              $mainCategories[$mainCategoriesKey]["subCategories"][$subCategoriesKey]['subSubCategories'] = $subSubCategories;
                          else
                              $mainCategories[$mainCategoriesKey]["subCategories"][$subCategoriesKey]['subSubCategories'] = null;
                      }
                  }
              }
              if(array_key_exists("pp",$data))//check for result per page
                  $take = $data['pp'];
              if(array_key_exists("sortBy",$data)) {// check for sort by
                  $orderBy = "price";
                  if($data['sortBy']=="l2h")
                      $sortOrderType="ASC";
                  elseif($data['sortBy']=="h2l")
                      $sortOrderType ="DESC";
                  else{
                      $orderBy = "is_new";
                      $sortOrderType="ASC";
                  }
              }
              $allProductIdsData = ProductCategoryMap::whereIn("category_id",$selectedCategories)->whereIn("product_id",$allProductIdsData)->pluck("product_id")->toArray();
              $products = Product::whereIn("id",$allProductIdsData)->where("is_completed","Y")->where("is_active","Y")->orderBy($orderBy,$sortOrderType)->paginate($take);
              foreach($products as $key=>$product){
                  $offer = ProductsOffers::join("offers","products_offers.offer_id","=","offers.id")->where("offers.is_active","Y")->where("product_id",$product->id)->first();
                  $products[$key]['offer'] = $offer;
              }
              //meta data info
              $category['name'] = $category['meta_title'] = $category['meta_keyword'] = $category['meta_desc'] = "Search - ".$searchText;
              return view("user.search-list")->with(compact("products","allProductIdsData","searchText","category","selectedCategories","mainCategories"));
          }
      }catch (\Exception $e){
          $data = [
              'input_params' => $request->all(),
              'action' => 'Keyword Search',
              'exception' => $e->getMessage()
          ];
          Log::info(json_encode($data));
          abort(500);
      }
    }

    public function getInnerCategory($catID) {
        $category = Category::select('id', 'name', 'level_id','slug')
            ->where([["parent_id", $catID], ["is_active", "Y"]])
            ->get();
        $category = $category->each(function ($item, $key) {
            if (is_array($item) && count($item) > 0 && $item != null) {
                $category[$key]= $item;
            }
        });
        return $category;
    }

    public function filterSearch(Request $request){
        try{
            $data = $request->all();
            $finalFilters = array();
            $orderBy = "sort_order";
            $sortOrderType ="DESC";
            $take = ENV("pagination_result");
            $productIds = $data['product_ids'];
            $filters = explode('?',$data['filterPara']);
            $filters = explode('&',$filters[1]);
            $categoryArray = array();
            foreach ($filters as $filter){
                $filter = explode('=',$filter);
                $finalFilters[$filter[0]] = $filter[1];
            }
            if(array_key_exists("pp",$finalFilters))//check for result per page
                $take = $finalFilters['pp'];
            if(array_key_exists("sortBy",$finalFilters)) {// check for sort by
                $orderBy = "price";
                if($finalFilters['sortBy']=="l2h")
                    $sortOrderType="ASC";
                elseif($finalFilters['sortBy']=="h2l")
                    $sortOrderType ="DESC";
                else{
                    $orderBy = "is_new";
                    $sortOrderType="ASC";
                }
            }
            $allProductIdsData = explode(",",$productIds);
            if(array_key_exists("c",$finalFilters)){
                $categoryArray = explode(",",$finalFilters['c']);
                $subCat = Category::whereIn("parent_id",$categoryArray)->pluck("id")->toArray();
                if(count($subCat)>0){
                    $subSubCat = Category::whereIn("parent_id",$subCat)->pluck("id")->toArray();
                    $categoryArray = array_merge($categoryArray,$subCat);
                    $categoryArray = array_merge($categoryArray,$subSubCat);
                }else{
                    $categoryArray = array_merge($categoryArray,$subCat);
                }
                $categoryArray = array_unique($categoryArray);
            }
            if($categoryArray != null)
                $allProductIdsData = ProductCategoryMap::whereIn("category_id",$categoryArray)->whereIn("product_id",$allProductIdsData)->pluck("product_id")->toArray();
            $products = Product::whereIn("id",$allProductIdsData)->where("is_active","Y")->where('is_completed','Y')->orderby($orderBy,$sortOrderType)->paginate($take);
            $paginationCount = 0;
            if(count($allProductIdsData)<=count($products)){
                $paginationCount = 1;
            }
            $pagination = $products->links();
            $ds = DIRECTORY_SEPARATOR;
            $productData = null;
            foreach($products as $product) {
                /*'uploads/products/images/'.$product->id.'/1024x1024/'.$product->image*/
                $filePath = $ds . "uploads" . $ds . "products" . $ds . "images" . $ds . $product['id'] . $ds. "250x250". $ds . $product['image'];
                $fileFullPath = public_path().$ds . "uploads" . $ds . "products" . $ds . "images" . $ds . $product['id'] . $ds. "250x250". $ds . $product['image'];
                $price = number_format($product->price-$product->discount_price,2);
                $offer = $offer = ProductsOffers::join("offers","products_offers.offer_id","=","offers.id")->where("offers.is_active","Y")->where("product_id",$product->id)->first();
                $productData .= "<li>";
                if (file_exists($fileFullPath))
                    $productData .= "<div class='imgWrp'><a href='/product/details/$product->slug'><img src='$filePath' alt='product'></a></div>";
                else
                    $productData .= "<div class='imgWrp'><a href='/product/details/$product->slug'><img src='/images/no-image-available.png' alt='product'></a></div>";
                $productData .= "<div class='content-Right'>";
                if($product->icon!=null){
                    $productData .= "<div class='justarrive'><img src='/uploads/product_icon/$product->id/$product->icon'></div>";
                }
                $productData .= "<div class='textData'><h4><a href='/product/details/$product->slug'>$product->name</a></h4><p>$product->name</p>";
                if($product->price!=$product->price-$product->discount_price){
                    $originalPrice =  number_format($product->price,2);
                    $productData .= "<h5 class='strike-span'> &#8377 $originalPrice</h5></div>";
                }
                $productData .= "<p><span> &#8377 $price</span></p></div>";
                $productData .= "<div class='item-offer'>";
                if($offer!=null){
                    $pName = $offer['name'];
                    $discount = $offer['discount'];
                    $productData .= "<h3>$pName</h3><span class='off-dis'>($discount% OFF)</span><p>*Any color</p>";
                }
                if($product['video_url']!=null){
                    $vURL = $product['video_url'];
                    $productData .= "<a class='playI' data-vid='$vURL' id='youtube'  data-toggle='modal' data-target='#youtube_video' data-keyboard='true' href='#'>";
                    $productData .= "<img src='/images/you_tube.png'><p>Click to watch product video</p></a>";
                }
                $productData .="</div><div class='view-add'><div class='quickview'><a href='/product/details/$product->slug' class='view'></a><a href='/product/details/$product->slug' class='addLink'>Shop Now</a><a href='/product/details/$product->slug'><input type='button' value='Shop Now' class='add-button'></a></div></div></div>";
                /*product offers div ends*/

                $productData .= "<div class='view-add'><div class='quickview'><a href='/product/details/$product->slug' class='view'></a><a href='/product/details/$product->slug' class='addLink'>Shop Now</a><a href='/product/details/$product->slug'><input type='button' value='Shop Now' class='add-button'></a></div></div></div>";
            }
            $pagination = "$pagination";
            $finalData = [
                'links'=>$pagination,
                'productData'=>$productData,
                'paginationCount'=>$paginationCount
            ];
            return $finalData;
        }catch(\Exception $e){
            $data = [
                'input_params' => $finalFilters,
                'action' => 'policies page',
                'exception' => $e->getMessage(),
            ];
            Log::info(json_encode($data));
            abort(500);
        }
    }
}
