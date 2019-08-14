@extends('front.layouts.app')

@section('title')
    <title>{{ 'Flinnt | Product List' }}</title>
@endsection

<!--===============================================================================================-->

@section('content')
    <!-- Title Page -->
    <section>
        <div class="container width-95">

            <div class="row">
                <div class="col-lg-2">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 search-product pos-relative of-hidden m-b-20 m-t-20" >
                    <div class="input-group">
                        <input class="form-control s-text7 size6 h-40" type="text" name="product_name" placeholder="What is on your mind today?" id="product_name">
                        <button class="input-group-addon trans-0-4 flinnt-bg-color" id="search"><i class="fs-12 fa fa-search white-color" aria-hidden="true"></i></button>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4 w-size18 m-b-20 m-t-20">
                    <div class="flex-w flex-sb width-100">
                        <span class="width-15 m-text14 p-t-10">
                            Sort by
                        </span>
                        <div class="width-45 p-l-10 header-filter">
                            <div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21">
                                <select class="selection-2" name="sorting" id="sorting">
                                    <option value="">Default Sorting</option>
                                    <option value="">Popularity</option>
                                    <option value="ASC">Price: low to high</option>
                                    <option value="DESC">Price: high to low</option>
                                </select>
                            </div>
                        </div>
                        <div class="width-32 p-l-10 header-filter">
                            <div class="btn-group">
                                <a href="#" id="list" class="btn btn-default fh-border"><span class="fa fa-align-justify"></span></a> <a href="#" id="grid" class="btn btn-default fh-border"><span class="fa fa-th"></span></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Content page -->
    <section class="bgwhite p-b-65">
        <div class="container width-95">
            <div class="row">
                <div class="col-md-2 col-lg-2 p-b-50" id="mobile-filter-men">
                    <div class="leftbar p-r-0-sm">
                        <!--  -->
                        <h5 class="m-text14 p-b-7 p-t-7 bo3">
                            Show results for
                        </h5>
                        <h5 class="m-text14 p-b-7 p-t-7">
                            <b>Any Category</b>
                        </h5>

                        <ul class="p-b-20">
                            <li class="p-t-4">
                                <a href="{{route('front_home')}}" class="s-text13">
                                    All
                                </a>
                            </li>
                            @foreach ($categories as $category) 
                                <li class="p-t-4">
                                    <a href="{{route('front_home', $category['category_tree_id'])}}" class="s-text13">
                                        {{ $category['category_name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Bookset</b>
                        </h4>
                        <ul class="p-b-20">
                            <li class="p-t-4 s-text13">
                                <a href="{{route('bookset_home')}}" class="s-text13">{{ 'All' }}
                            </li>
                            @foreach ($standards  as $key => $standard) 
                                <li class="p-t-4">
                                    <a href="{{route('bookset_home', $key)}}" class="s-text13">
                                        {{ $standard }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Refine by</b>
                        </h4>
                        <h5 class="m-text14">English & Indian Languages</h5>

                        <ul class="p-b-20">
                            <li class="p-t-4 s-text13">
                                <input type="checkbox" name="English" value="English"> English
                            </li>

                            <li class="p-t-4 s-text13">
                                <input type="checkbox" name="Hindi" value="Hindi"> Hindi
                            </li>
                        </ul>

                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Format</b>
                        </h4>

                        <ul class="p-b-20">
                            <li class="p-t-4 s-text13">
                                <input type="checkbox" name="English" value="English"> Paperback
                            </li>

                            <li class="p-t-4 s-text13">
                                <input type="checkbox" name="Hindi" value="Hindi"> Kindal eBooks
                            </li>

                            <li class="p-t-4 s-text13">
                                <input type="checkbox" name="Hindi" value="Hindi"> Hardcover
                            </li>

                            <li class="p-t-4 s-text13">
                                <input type="checkbox" name="Hindi" value="Hindi"> Board Book
                            </li>
                        </ul>

                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Author</b>
                        </h4>

                        <ul class="p-b-20">
                            <li class="p-t-4 s-text13">
                                <input type="checkbox" name="English" value="English"> Savi Sharma
                            </li>

                            <li class="p-t-4 s-text13">
                                <input type="checkbox" name="Hindi" value="Hindi"> Josheph Murphy
                            </li>

                            <li class="p-t-4 s-text13">
                                <input type="checkbox" name="Hindi" value="Hindi"> Amish Tripathi
                            </li>

                            <li class="p-t-4 s-text13">
                                <input type="checkbox" name="Hindi" value="Hindi"> Robin Sharma
                            </li>

                            <li class="p-t-4 s-text13">
                                <input type="checkbox" name="Hindi" value="Hindi"> Durjoy Sharma
                            </li>
                        </ul>

                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Avg. Customer Review</b>
                        </h4>

                        <ul class="p-b-20">
                            <li class="p-t-4 s-text13">
                                <p class="ratings">
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    & Up
                                </p>
                            </li>

                            <li class="p-t-4 s-text13">
                                <p class="ratings">
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    & Up
                                </p>
                            </li>

                            <li class="p-t-4 s-text13">
                                <p class="ratings">
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    & Up
                                </p>
                            </li>

                            <li class="p-t-4 s-text13">
                                <p class="ratings">
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    & Up
                                </p>
                            </li>
                        </ul>

                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Item Condition</b>
                        </h4>

                        <ul class="p-b-20">
                            <li class="p-t-4 s-text13">
                                New
                            </li>

                            <li class="p-t-4 s-text13">
                                Certified Refurbished
                            </li>

                            <li class="p-t-4 s-text13">
                                Used
                            </li>
                        </ul>

                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Price</b>
                        </h4>

                        <ul class="p-b-20">
                            <li class="p-t-4 s-text13">
                                Under <i class="fa fa-rupee"></i> 100 
                            </li>

                            <li class="p-t-4 s-text13">
                                <i class="fa fa-rupee"></i> 100 - <i class="fa fa-rupee"></i> 200 
                            </li>

                            <li class="p-t-4 s-text13">
                                <i class="fa fa-rupee"></i> 200 - <i class="fa fa-rupee"></i> 500 
                            </li>

                            <li class="p-t-4 s-text13">
                                <i class="fa fa-rupee"></i> 500 - <i class="fa fa-rupee"></i> 1000 
                            </li>

                            <li class="p-t-4 s-text13">
                                Over <i class="fa fa-rupee"></i> 1000
                            </li>
                        </ul>
                        <p class="p-b-7">
                            <!-- HTML for rupes sign &#8377 --->
                            <input type="text" class="price_box" name="" placeholder='Min'>
                            <input type="text" class="price_box" name="" placeholder='Max'>
                            <button class="price_box btn-secondary width-27"> GO </button>

                        </p>

                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Discount</b>
                        </h4>

                        <ul class="p-b-20 border-discount">
                            <li class="p-t-4 s-text13">
                                10% Off or more
                            </li>

                            <li class="p-t-4 s-text13">
                                25% Off or more
                            </li>

                            <li class="p-t-4 s-text13">
                                35% Off or more
                            </li>

                            <li class="p-t-4 s-text13">
                                50% Off or more
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-10 p-b-50">
                    
                    <!-- Product -->
                    @if (!empty($products) && count($products) > 0)
                    <div class="row pos-relative">
                        <p class="width-100 white-color border-std-name m-b-20">
                            <span class="span-std-name">{{$products[0]->standard_name}}</span>
                        @foreach($products as $product)
                        <div class="col-sm-12 col-md-2 col-lg-2 p-b-30">
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block-center">
                                    <a href="{{route('product_detail', [$product->institution_book_vendor_id, $product->standard_id])}}"><img src="{{URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').$product->book_image_path)}}" alt="IMG-PRODUCT" class="product-thumbnail"></a>

                                    <div class="block2-overlay trans-0-4">
                                        <!-- <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a> -->

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            @if (Auth::guard('user')->check())
                                                @if (Auth::guard('user')->user()->institution_id != '')
                                                <form action="{{ url('/cart/store') }}" method="POST">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="id" value="{{ $product->institution_book_vendor_id }}">
                                                <input type="hidden" name="name" value="{{ $product->book_name }}">
                                                <input type="hidden" name="book_id" value="{{ $product->book_id }}">
                                                <input type="hidden" name="price" value="{{ $product->sale_price }}">
                                                <input type="hidden" name="type" value="{{ 'book' }}">
                                                <input type="submit" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" value="Add to Cart">
                                                </form>
                                                @else
                                                <a href="#" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" data-toggle="modal" data-target=".show-notification">Add to Cart</a>
                                                @endif
                                            @else
                                                <a href="{{route('user_profile')}}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Add to Cart</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="{{route('product_detail', [$product->institution_book_vendor_id, $product->standard_id])}}" class="block2-name dis-block s-text3 p-b-5 pr-title flinnt-color">
                                        {{$product->book_name}}
                                    </a>

                                    <span class="block2-newprice m-text8 p-r-5">
                                        <i class="fa fa-rupee flinnt-price-clr"></i> 
                                        <b>{{$product->sale_price}}</b>
                                    </span>
                                    @if ($product->sale_price != $product->list_price)
                                    <span class="block2-oldprice m-text7 p-r-5">
                                        <i class="fa fa-rupee"></i> {{$product->list_price}}
                                    </span>
                                    @endif

                                    <span>
                                        <i class="a-icon a-icon-star a-star-4"></i>
                                        <p class="ratings">
                                            <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                            <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                            <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                            <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                            <i class="fa fa-angle-down"></i><span class="flinnt-color"> 88 </span>
                                        </p>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

