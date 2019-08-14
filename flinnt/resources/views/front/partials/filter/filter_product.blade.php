@if (!empty($products) && count($products) > 0)
<div class="row pos-relative">
@php
    $main_standard = $products[0]->standard_id;
    $count = 1 ;
@endphp
<p class="width-100 white-color border-std-name m-b-20">
    <span class="span-std-name">{{$products[0]->standard_name}}</span>
    <a href="{{route('grade_list', $main_standard)}}"><span class="see-more">{{'see more'}}</span></a></p>
@foreach($products as $product)
@if ($main_standard == $product->standard_id)
@if ($count <= 6) 
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
                    <!-- <a href="#" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                        Add to Cart
                    </a> -->
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
@php 
    $count++;
@endphp
@endif
@else
@php
    $main_standard = $product->standard_id;
    $count = 1 ;
@endphp
</div>
<div class="row pos-relative">
    <p class="width-100 white-color border-std-name m-b-20">
    <span class="span-std-name">{{$product->standard_name}}</span><a href="{{route('grade_list', $main_standard)}}"><span class="see-more">{{'see more'}}</span></a></p>
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
                    <i class="fa fa-rupee flinnt-price-clr"></i> <b>{{$product->sale_price}}</b>
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
    @php 
    $count++;
    @endphp
@endif
@endforeach
</div>
@endif
