@extends('front.layouts.app')

@section('title')
	<title>{{ 'Flinnt | Cart' }}</title>
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

	<!-- Cart -->
	<section class="cart bgwhite p-b-100">
		<div class="container width-95">
			@if(Session::has('message'))
			<div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-block" id="alert-message">
				<button type="button" class="close" data-dismiss="alert">×</button>	
			    <strong>{{ Session::get('message') }}</strong>
			</div>
			@endif
			<div class="alert alert-success alert-block" style="display: none;" id="alert-message"></div>
			<!-- Cart item -->
			@if (sizeof($carts) > 0)
			<div class="container-table-cart pos-relative" id="shopping-cart-table">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart m-width-0">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Product</th>
							<th class="column-3">Price</th>
							<th class="column-4">Quantity</th>
							<th class="column-5">Total</th>
							<th class="column-6"></th>
						</tr>
						@foreach ( $carts as $cart)
						<tr class="table-row">
							<td class="column-1 p-t-10 p-b-10">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="{{URL::asset('/'.$cart->options->image)}}" alt="IMG-PRODUCT">
								</div>
							</td>
							<td class="column-2 m-text14 p-t-10 p-b-10">{{ $cart->name }}</td>
							<td class="column-3 m-text14 p-t-10 p-b-10"><i class="fa fa-rupee"></i>{{ $cart->price }}</td>
							<td class="column-4 p-t-10 p-b-10">
								<div class="flex-w bo5 of-hidden w-size22">
									<button class="btn-num-product-down color1 flex-c-m qty-btn bg8 eff2">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>

									<input class="qty-btn m-text18 t-center num-product quantity" data-id="{{ $cart->rowId }}" type="number" name="qty" value="{{ $cart->qty }}">

									<button class="btn-num-product-up color1 flex-c-m qty-btn bg8 eff2">
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
							</td>
							<td class="column-5 m-text14 p-t-10 p-b-10"><i class="fa fa-rupee"></i> {{ $cart->subtotal }}</td>
							<td class="column-6 m-text14 p-t-10 p-b-10">
								<i class="fa fa-trash-o fa-2x trash-color" aria-hidden="true" id="item-delete" data-id="{{ $cart->rowId }}"></i>
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>

			<!-- <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="flex-w flex-m w-full-sm">
					<div class="size11 bo4 m-r-10">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code" placeholder="Coupon Code">
					</div>

					<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Apply coupon
						</button>
					</div>
				</div>

				<div class="size10 trans-0-4 m-t-10 m-b-10">
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Update Cart
					</button>
				</div>
			</div> -->
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6 p-t-25 p-b-25 p-l-25 p-r-25 p-lr-15-sm">
					<div class="">
						<div class="">
							<a href="{{route('front_home')}}" class="btn btn-info flinnt-bg-color">
								Countinue Shopping
							</a>
						</div>
					</div>
				</div>

				<!-- Total -->
				<div class="col-sm-12 col-md-6 col-lg-6 p-t-25 p-b-25 p-l-25 p-r-25 p-lr-15-sm" id="shopping-cart-shipping">
					<div class="bo9 p-t-25 p-b-25 p-l-35 p-r-25 p-lr-15-sm">
						<h5 class="m-text20 p-b-24">
							Cart Totals
						</h5>

						<!--  -->
							<!-- <div class="flex-w flex-sb-m p-b-12">
								<span class="s-text18 w-size19 w-full-sm">
									Subtotal:
								</span>

								<span class="m-text21 w-size20 w-full-sm m-text14">
									<i class="fa fa-rupee"></i> {{Cart::subtotal()}}
								</span>
							</div> -->

						<!-- <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
							<span class="s-text18 w-size19 w-full-sm">
								Delivery:
							</span>

							<div class="w-size20 w-full-sm">
								<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
									<select class="selection-2 m-text14" name="country">
										<option>Select a location...</option>
										<option>Home</option>
										<option>School</option>
									</select>
								</div>
							</div>
						</div> -->

						<!--  -->
						<!-- <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
							<span class="s-text18 w-size19 w-full-sm">
								Shipping:
							</span>

							<div class="w-size20 w-full-sm">
								<p class="s-text8 p-b-23">
									There are no shipping methods available. Please double check your address, or contact us if you need any help.
								</p> -->

								<!-- <span class="s-text19">
									Calculate Shipping
								</span>

								<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
									<select class="selection-2" name="country">
										<option>Select a country...</option>
										<option>US</option>
										<option>UK</option>
										<option>Japan</option>
									</select>
								</div>

								<div class="size13 bo4 m-b-12">
								<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="state" placeholder="State /  country">
								</div>

								<div class="size13 bo4 m-b-22">
									<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="postcode" placeholder="Postcode / Zip">
								</div> -->

								<!-- <div class="size14 trans-0-4 m-b-10">
									<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
										Update Totals
									</button>
								</div> -->
						<!-- 	</div>
						</div> -->

						<!--  -->
						<div class="flex-w flex-sb-m p-t-26 p-b-30">
							<span class="m-text22 w-size19 w-full-sm">
								Total:
							</span>

							<span class="m-text21 w-size20 w-full-sm m-text14">
								<i class="fa fa-rupee"></i> {{Cart::subtotal()}}
							</span>
						</div>

						<div class="size15 trans-0-4">
							<!-- Button -->
							<!-- <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
								Proceed to Checkout
							</button> -->
							<a href="{{route('select_address')}}" class="btn btn-info flinnt-bg-color">Proceed to Checkout</a>
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="container-table-cart pos-relative bgwhite empty-cart" id="shopping-cart-table">
				<div class="empty-default">
					<img src="{{URL::asset('/images/empty-cart.png')}}" class="empty-cart-height">
					<span class="empty-cart-img">Your Shopping Cart is empty</span>
				</div>
			</div>
			@endif
		</div>
	</section>
@endsection


@section('script')
	<script type="text/javascript">
		$( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Update cart item and total on change of quantity
			$('#shopping-cart-table').on('change', '.quantity', function(){
                var id = $(this).attr('data-id');
                var shoppingCartHeader = $('.shopping-cart-header');
                var shoppingCartTable = $('#shopping-cart-table');
                var shoppingCartShipping = $('#shopping-cart-shipping');
                var alertMessage = $('#alert-message');
                $("#ajax_loader").css("display", "block");
                $.ajax({
                    type: "POST",
                    url: '{{ url("/cart/update") }}',
                    dataType: 'json',
                    data: {
                        'quantity': this.value,
                        'id' : id,
                    },
                    success: function(data) {
                    	$("#ajax_loader").css("display", "none");
                    	shoppingCartHeader.html(data.header);
                    	shoppingCartTable.html(data.table);
                    	shoppingCartShipping.html(data.shipping);
                        $(".selection-2").select2({
				            minimumResultsForSearch: 20,
				            dropdownParent: $('#dropDownSelect2')
				        });
                        alertMessage.html("<strong>"+data.msg+"</strong><button type='button' class='close' data-dismiss='alert'>×</button>");
                        alertMessage.css("display", "block");
                    }
                });
            });

			// Update cart item and total on click of quantity down button
			$('#shopping-cart-table').on('click', '.btn-num-product-down', function(){
                var numProduct = Number($(this).next().val());
                var id = $(this).next().attr('data-id');
                var shoppingCartHeader = $('.shopping-cart-header');
                var shoppingCartTable = $('#shopping-cart-table');
                var shoppingCartShipping = $('#shopping-cart-shipping');
                var alertMessage = $('#alert-message');
                $("#ajax_loader").css("display", "block");
                $.ajax({
                    type: "POST",
                    url: '{{ url("/cart/update") }}',
                    dataType: 'json',
                    data: {
                        'quantity': numProduct,
                        'id' : id,
                    },
                    success: function(data) {
                    	$("#ajax_loader").css("display", "none");
                    	shoppingCartHeader.html(data.header);
                    	shoppingCartTable.html(data.table);
                    	shoppingCartShipping.html(data.shipping);
                        $(".selection-2").select2({
				            minimumResultsForSearch: 20,
				            dropdownParent: $('#dropDownSelect2')
				        });
				        alertMessage.html("<strong>"+data.msg+"</strong><button type='button' class='close' data-dismiss='alert'>×</button>");
				        alertMessage.css("display", "block");
                    }
                });
            });

			// Update cart item and total on click of quantity up button
			$('#shopping-cart-table').on('click', '.btn-num-product-up', function(){
                var numProduct = Number($(this).prev().val());
                var id = $(this).prev().attr('data-id');
                var shoppingCartHeader = $('.shopping-cart-header');
                var shoppingCartTable = $('#shopping-cart-table');
                var shoppingCartShipping = $('#shopping-cart-shipping');
                var alertMessage = $('#alert-message');
                $("#ajax_loader").css("display", "block");
                $.ajax({
                    type: "POST",
                    url: '{{ url("/cart/update") }}',
                    dataType: 'json',
                    data: {
                        'quantity': numProduct,
                        'id' : id,
                    },
                    success: function(data) {
                    	$("#ajax_loader").css("display", "none");
                    	shoppingCartHeader.html(data.header);
                    	shoppingCartTable.html(data.table);
                    	shoppingCartShipping.html(data.shipping);
                        $(".selection-2").select2({
				            minimumResultsForSearch: 20,
				            dropdownParent: $('#dropDownSelect2')
				        });
				        alertMessage.text(data.msg);
				        alertMessage.html("<strong>"+data.msg+"</strong><button type='button' class='close' data-dismiss='alert'>×</button>");
				        alertMessage.css("display", "block");
                    }
                });
            });

			// Update cart item and total on click of delete button
			$('#shopping-cart-table').on('click', '#item-delete', function(){
                var id = $(this).attr('data-id');
                var shoppingCartHeader = $('.shopping-cart-header');
                var shoppingCartTable = $('#shopping-cart-table');
                var shoppingCartShipping = $('#shopping-cart-shipping');
                var alertMessage = $('#alert-message');
                $("#ajax_loader").css("display", "block");
                $.ajax({
                    type: "POST",
                    url: '{{ url("/cart/destroy") }}',
                    dataType: 'json',
                    data: {
                        'id' : id,
                    },
                    success: function(data) {
                    	$("#ajax_loader").css("display", "none");
                    	shoppingCartHeader.html(data.header);
                    	shoppingCartTable.html(data.table);
                    	shoppingCartShipping.html(data.shipping);
                        $(".selection-2").select2({
				            minimumResultsForSearch: 20,
				            dropdownParent: $('#dropDownSelect2')
				        });
				        alertMessage.html("<strong>"+data.msg+"</strong><button type='button' class='close' data-dismiss='alert'>×</button>");
				        alertMessage.css("display", "block");
                    }
                });
            });

        });
	</script>
@endsection