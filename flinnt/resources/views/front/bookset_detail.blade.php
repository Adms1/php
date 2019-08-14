@extends('front.layouts.app')

@section('title')
    <title>{{ 'Flinnt | Product Detail' }}</title>
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
            </div>
        </div>
    </section>

	<!-- breadcrumb -->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-l-15-sm m-t-10 m-b-10">
		<a href="{{route('front_home')}}" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="{{route('front_home')}}" class="s-text16">
			Book
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="#" class="s-text16">
			Education
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			CBSE Computer Science Chapterwise Solved Papers Class 12th
		</span>
	</div>

	<!-- Bookset Detail -->
	<div class="container bgwhite p-t-10 p-b-10" >
		<div class="flex-w flex-sb">
			<div class="col-sm-12 col-md-12 col-lg-6 m-t-10 m-b-10 pl-0">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="slick3">
						@if (count($bookset->images) > 0)
						@foreach($bookset->images as $image)
						<div class="item-slick3" data-thumb="{{URL::asset('/'.Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH').$image->book_set_image_path)}}">
							<div class="wrap-pic-w margin-0">
								<img src="{{URL::asset('/'.Config::get('settings.ORIGINAL_BOOKSET_IMG_PATH').$image->book_set_image_path)}}" alt="IMG-PRODUCT" class="product-original margin-0">
							</div>
						</div>
						@endforeach
						@else
						<div class="item-slick3" data-thumb="{{URL::asset('/'.Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH').Config::get('settings.BOOKSET_DEFAULT_IMAGE'))}}">
							<div class="wrap-pic-w margin-0">
								<img src="{{URL::asset('/'.Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH').Config::get('settings.BOOKSET_DEFAULT_IMAGE'))}}" alt="IMG-PRODUCT" class="product-original margin-0">
							</div>
						</div>
						@endif
					</div>
					<div class="wrap-slick3-dots"></div>

				</div>
			</div>

			<div class="col-sm-12 col-md-12 col-lg-6 m-t-10 m-b-10">
				<h4 class="product-detail-name m-text16 p-b-13 flinnt-color">
					{{$bookset->book_set_name}}
				</h4>

				<span>
					<p class="ratings">
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#"><span class="fa fa-star-o"></span></a>
                        <i class="fa fa-angle-down"></i> 88
                  	</p>
				</span>

				<p class="s-text8 p-t-10">
					{{$book_set_descriptions[0]}}
				</p>

				<!--  -->
				<div class="p-t-10">
					<div class="flex-m flex-w p-b-10">
						<div class="s-text15 w-size11">
							Sold By
						</div>

						<div class="s-text15 w-size16">
							{{$book_set_vendor_price->vendor_name}}
						</div>
					</div>
					<div class="s-text8"><b>
						{{'The collection of the books consists of the following books per subject'}}</b>
					</div>
					@if (isset($book_list) && count($book_list) > 0)
					<div class="flex-r-m flex-w p-t-20">
						<div class="w-full flex-m flex-w">
							<table class="table-shopping-cart m-width-0">
								<tr class="table-row boall">
									<td class="column-1 m-text19 bookset-info-tbl"><span>Subject</span> 
									</td>
									<td class="column-2 m-text19 bookset-info-tbl">
										<span>Book Name</span>
									</td>
									<td class="column-3 m-text19 bookset-info-tbl">
										<span><i class="fa fa-rupee"></i>Price</span>
									</td>
								</tr>
								@foreach ($book_list as $book)
								<tr class="table-row boall">
									<td class="column-1 m-text14 bookset-info-tbl">{{$book['subject_name']}}</td>
									<td class="column-2 m-text14 bookset-info-tbl">
										<span></i> {{$book['book_name']}}</span></td>
									<td class="column-3 m-text14 bookset-info-tbl">
										<span><i class="fa fa-rupee"></i> {{$book['sale_price']}}</span></td>
								</tr>
								@endforeach
							</table>
						</div>
					</div>
					@endif

					<div class="flex-r-m flex-w p-t-10">
						<div class="w-full flex-m flex-w" id="shopping-cart-table">
							<form action="{{ url('/cart/store') }}" method="POST">
								{!! csrf_field() !!}
							<div class="s-text8 w-size17 trans-0-4 m-t-10 m-b-10 float-left p-t-10 p-r-10">
								Price: <span class="flinnt-price-clr"><i class="fa fa-rupee"></i>{{$book_set_vendor_price->sale_price}} </span>
								@if ($book_set_vendor_price->sale_price != $book_set_vendor_price->list_price)
								<span class="block2-oldprice m-text7 p-r-5"><i class="fa fa-rupee"></i> {{$book_set_vendor_price->list_price}}</span>
								@endif
							</div>

							<div class="flex-w bo5 of-hidden m-t-10 m-b-10 float-left">
								<button class="btn-num-product-down color1 flex-c-m qty-btn bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								<input class="qty-btn m-text18 t-center num-product" type="number" name="qty" value="1">

								<button class="btn-num-product-up color1 flex-c-m qty-btn bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>

							<div class="size17 trans-0-4 m-t-10 m-b-10 float-left">
								@if (Auth::guard('user')->check())
                                    @if (Auth::guard('user')->user()->institution_id != '')
					                <input type="hidden" name="id" value="{{ $book_set_vendor_price->institution_book_set_vendor_id }}">
					                <input type="hidden" name="name" value="{{ $bookset->book_set_name }}">
					                <input type="hidden" name="book_id" value="{{ $book_set_vendor_price->book_set_id }}">
					                <input type="hidden" name="price" value="{{ $book_set_vendor_price->sale_price }}">
					                <input type="hidden" name="type" value="{{ 'bookset' }}">
					                <input type="submit" class="btn btn-info btn-addcart-product-detail flinnt-bg-color float-right" value="Add to Cart">
					                @else
                                    <a href="#" class="btn btn-info btn-addcart-product-detail flinnt-bg-color float-right" data-toggle="modal" data-target=".show-notification">Add to Cart</a>
                                    @endif
                                @else
                                    <a href="{{route('user_profile')}}" class="btn btn-info btn-addcart-product-detail flinnt-bg-color float-right">Add to Cart</a>
                                @endif
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Relate Product -->
	<section class="relateproduct bgwhite p-b-138 p-t-20">
		<div class="container">

			<div class="bo6 p-t-15 p-b-14">
				<h5 class="flex-sb-m m-text19 trans-0-4">
					Bookset description
				</h5>

				<div class="m-text15 p-t-15">
					<p class="s-text8">
						{!! $book_set_descriptions[1] !!}
					</p>
				</div>
			</div>

			<div class="bo6 p-t-15 p-b-14">
				<h5 class="flex-sb-m m-text19 trans-0-4">
					Bookset details
				</h5>

				<div class="p-t-15">
					<p class="s-text8">
						<b>Average Customer Rating:</b> <span class="ratings">
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#"><span class="fa fa-star-o"></span></a>
                        <i class="fa fa-angle-down"></i><span class="flinnt-color"> 88 customer reviews</span>
					</p>
				</div>
			</div>
			<div class="bo6 p-t-15 p-b-14">
				<h5 class="flex-sb-m m-text19 trans-0-4">
					Customer reviews
				</h5>
				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-3 m-text15 p-t-15 p-b-23">
						<p class="s-text8">
							<span class="ratings">
	                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
	                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
	                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
	                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
	                        <a href="#"><span class="fa fa-star-o"></span></a>
	                        <span class="flinnt-color">88</span> 
						</p>
						<p class="s-text8">
							<span class="flinnt-color">4 out of 5 stars <i class="fa fa-angle-down"></i></span> 
						</p>
						<br>
						<div class="widget_summary width-100 review-star">
	                    	<div class="w_left w_25 float-left text-left width-25">
	                      		<a href="#" class="s-text8 flinnt-color"><span>5 star</span></a>
	                    	</div>
		                    <div class="w_center w_55 width-55 float-left">
		                      	<div class="progress review-progress">
		                        	<div class="progress-bar bg-green width-66 bg-star-progress-color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
		                          		<span class="sr-only">60% Complete</span>
		                        	</div>
		                      	</div>
		                    </div>
	                    	<div class="w_right w_20 float-left text-right width-20">
	                      		<a href="#" class="s-text8 flinnt-color"><span>66%</span></a>
	                    	</div>
	                    	<div class="clearfix"></div>
	                  	</div>

	                  	<div class="widget_summary width-100 review-star">
	                    	<div class="w_left w_25 float-left text-left width-25">
	                      		<a href="#" class="s-text8 flinnt-color"><span>4 star</span></a>
	                    	</div>
	                   		<div class="w_center w_55 width-55 float-left">
		                      	<div class="progress review-progress">
		                        	<div class="progress-bar bg-green width-45 bg-star-progress-color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
		                          		<span class="sr-only">60% Complete</span>
		                        	</div>
		                      	</div>
	                    	</div>
		                    <div class="w_right w_20 float-left text-right width-20">
		                 		<a href="#" class="s-text8 flinnt-color"><span>45%</span></a>
		                    </div>
	                    	<div class="clearfix"></div>
	                  	</div>
	                  	<div class="widget_summary width-100 review-star">
	                    	<div class="w_left w_25 float-left text-left width-25">
		                      	<a href="#" class="s-text8 flinnt-color"><span>3 star</span></a>
	                    	</div>
	                    	<div class="w_center w_55 width-55 float-left">
	                      		<div class="progress review-progress">
	                        		<div class="progress-bar bg-green width-25 bg-star-progress-color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
	                          			<span class="sr-only">60% Complete</span>
	                        		</div>
	                      		</div>
	                    	</div>
	                    	<div class="w_right w_20 float-left text-right width-20">
	                      		<a href="#" class="s-text8 flinnt-color"><span>25%</span></a>
	                    	</div>
	                    	<div class="clearfix"></div>
	                  	</div>
	                  	<div class="widget_summary width-100 review-star">
	                    	<div class="w_left w_25 float-left text-left width-25">
	                      		<a href="#" class="s-text8 flinnt-color"><span>2 star</span></a>
	                    	</div>
	                    	<div class="w_center w_55 width-55 float-left">
	                      		<div class="progress review-progress">
	                        		<div class="progress-bar bg-green width-5 bg-star-progress-color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
	                          			<span class="sr-only">60% Complete</span>
	                        		</div>
	                      		</div>
	                    	</div>
	                    	<div class="w_right w_20 float-left text-right width-20">
	                      		<a href="#" class="s-text8 flinnt-color"><span>5%</span></a>
	                    	</div>
	                		<div class="clearfix"></div>
	                  	</div>
	                  	<div class="widget_summary width-100 review-star">
	                    	<div class="w_left w_25 float-left text-left width-25">
	                      		<a href="#" class="s-text8 flinnt-color"><span>1 star</span></a>
	                    	</div>
	                    	<div class="w_center w_55 width-55 float-left">
	                      		<div class="progress review-progress">
	                        		<div class="progress-bar bg-green width-2 bg-star-progress-color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
	                          			<span class="sr-only">60% Complete</span>
	                        		</div>
	                      		</div>
	                    	</div>
	                    	<div class="w_right w_20 float-left text-right width-20">
	                      		<a href="#" class="s-text8 flinnt-color"><span>2%</span></a>
	                    	</div>
	                		<div class="clearfix"></div>
	                  	</div>
	                  	<p>
							<a href="#" class="s-text8"><span class="flinnt-color">Sell all 88 customer reviews <i class="fa fa-angle-down"></i></span></a>
						</p>
					</div>
					<div class="col-sm-12 col-md-6 col-lg-6 s-text8">
						<p>Share your thoughts with other customers</p>
						<br>
						<button class="btn btn-info m-text15 write-review">Write a product review</button>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection