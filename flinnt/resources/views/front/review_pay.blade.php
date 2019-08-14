@extends('front.layouts.app')

@section('title')
	<title>{{ 'Flinnt | Cart' }}</title>
@endsection

<!--===============================================================================================-->

@section('mobile_menu')
<div class="wrap-side-menu" >
	<nav class="side-menu">
	</nav>
</div>
@endsection

@section('content')
	<!-- main container -->
	<section class="cart bgwhite p-b-100">
		<div class="container width-95">
			<div class="checkout-page-header">
				<h1 class="checkout-page-title m-t-10 m-b-10">Complete Steps to Place Your Order</h1>
				<ul class="nav checkout-steps m-t-20" role="tablist">
					<li><a href="{{route('select_address')}}" class="checkout-step">Customer Details</a></li>
		            <li><a href="#" class="checkout-step always-active active">Review &amp; Pay</a></li>
		            <li><a href="#" class="checkout-step">Confirmation</a></li>
				</ul>
			</div>

			@if(Session::has('message'))
			<div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-block" id="alert-message">
				<button type="button" class="close" data-dismiss="alert">×</button>	
			    <strong>{{ Session::get('message') }}</strong>
			</div>
			@endif
			<div class="alert alert-success alert-block" style="display: none;" id="alert-message"></div>
			<!-- Cart item -->
			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-35 p-lr-15-sm bot">
				@if (count($address) > 0)				
				<div class="col-sm-12 col-md-12 col-lg-12 p-t-15 p-b-20">
					<div class="bo8 bot flex-w flex-sb p-t-15 p-b-20">
						<p class="p-l-15 p-r-15"><b>Shipping address</b> <a class="flinnt-clr" href="{{route('select_address')}}">change</a></p>
						<p class="p-l-15 p-r-15 width-100">
							{{$address['fullname']}}
							@if ($address['address1'])
							, <br>{{$address['address1']}}
							@endif
							@if ($address['address2'])
							, <br>{{$address['address2']}}
							@endif
							, <br>{{$address['city']}}, {{$address['state']['name']}} {{$address['pin']}},<br>
							India
							, <br>Phone: {{$address['phone']}}
						</p>
					</div>
				</div>
				@endif

				@if (sizeof($carts) > 0)
				<div class="col-sm-12 col-md-12 col-lg-12 p-t-15 p-b-20">
					<div class="wrap-table-shopping-cart bo8 bot flex-w flex-sb bgwhite">
						<table class="table-shopping-cart m-width-0">
							<tr class="table-head">
								<th class="column-1 text-center"></th>
								<th class="column-2 text-center">Product</th>
								<th class="column-3 text-center">Price</th>
								<th class="column-4 text-center">Quantity</th>
								<th class="column-6 text-center">Total</th>
							</tr>
							@foreach ( $carts as $cart)
							<tr class="table-row p-l-15 p-r-15">
								<td class="column-1 p-l-15 p-r-15 p-t-10 p-b-10">
									<div class="cart-img-product b-rad-4 o-f-hidden">
										<img src="{{URL::asset('/'.$cart->options->image)}}" alt="IMG-PRODUCT">
									</div>
								</td>
								<td class="column-2 p-l-15 p-r-15 m-text14 p-t-10 p-b-10">{{ $cart->name }}</td>
								<td class="column-3 text-right p-l-15 p-r-15 m-text14 p-t-10 p-b-10"><i class="fa fa-rupee"></i>{{ $cart->price }}</td>
								<td class="column-4 p-l-15 p-r-15 text-center p-t-10 p-b-10">
									{{ $cart->qty }}
								</td>
								<td class="column-6 text-right p-l-15 p-r-15 m-text14 p-t-10 p-b-10"><i class="fa fa-rupee"></i> {{ $cart->subtotal }}</td>
							</tr>
							@endforeach
						</table>
					</div>
				</div>
				@endif

				<div class="col-sm-12 col-md-12 col-lg-12 p-t-15 p-b-20">
					{!! Form::open(['route'=>'checkout', 'method'=>'GET', 'name' =>'checkout',  'class' =>'checkout', 'data-parsley-validate', 'id'=>'address-form', 'novalidate'=>'novalidate']) !!}
						<div class="row place-order">
							<div class="col-sm-12 col-md-12 col-lg-12 flex-w flex-sb p-t-15 p-b-20">
								<h5 class="m-text19 width-100 m-t-10 m-b-10">
									<b>Cart Total</b>
								</h5>
						        <div class="col-sm-12 col-md-8 col-lg-8">	
									<p class="m-t-10 m-b-10">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#" target="_blank">privacy policy</a>.
									</p>
									<p class="m-t-10 m-b-10">
										{!! Form::checkbox('terms', old('terms'), '', ['value'=>'1','required'=>'required', 'id' => 'terms']) !!}
										<span>I have read and agree to the website <a href="#" target="_blank">terms and conditions</a></span>&nbsp;<span class="required">*</span>
									</p>
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4 cart-total-checkout-right">
						            <div class="m-text16"><strong><span class="flinnt-price-clr"><i class="fa fa-rupee"></i> {{Cart::subtotal()}}</span></strong>
						            </div>
						            {!! Form::hidden('shipping_address_id', $address['user_address_id'], [ 'id' => 'user_address_id']) !!}
						            <button type="submit" class="btn flinnt-btn m-t-10" name="place_order" id="place_order" value="Place order" data-value="Place order">Place Your Order and Pay</button>
						        </div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</section>
@endsection


@section('script')
	<!-- Parsley -->
  	<script src="{{asset('vendors/parsleyjs/dist/parsley.min.js')}}"></script>

	<script type="text/javascript">
		$( document ).ready(function() {			
			jQuery(function (g) {
				var v = {
	            	$checkout_form: g("form.checkout"),
	            	init: function () {
	            		this.$checkout_form.on("change", "#ship-to-different-address input", this.ship_to_different_address)
	            	},
	            	ship_to_different_address: function () {
	                	g("div.shipping_address").hide(), g(this).is(":checked") && g("div.shipping_address").slideDown()
	                }
            	};
	            v.init();
	        });
        });
	</script>
@endsection