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
					<li><a href="#" class="checkout-step always-active active">Customer Details</a></li>
		            <li><a href="#" class="checkout-step review-step">Review &amp; Pay</a></li>
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
			<div class="p-t-25 p-b-25 bo8 p-l-35 p-r-35 p-lr-15-sm bot">
				@if (count($user_address) > 0)
				<h5 class="m-text19 m-b-10 width-100">
					<b>Other addresses</b>
				</h5>
				<div class="row">
					@foreach ($user_address as $address)
					<div class="col-sm-12 col-md-3 col-lg-3 flex-w flex-sb bo10 p-t-15 p-b-20">
						<p class="col-sm-12 p-b-23 s-text8">
							<b>{{$address['fullname']}}</b>
							@if ($address['address1'])
							, <br>{{$address['address1']}}
							@endif
							@if ($address['address2'])
							, <br>{{$address['address2']}}
							@endif
							, <br>{{$address['city']}}, {{$address['name']}} {{$address['pin']}},<br>
							India
						</p>
						<div class="col-md-6 trans-0-4 m-b-10">
							<a href="{{route('address_edit', $address['user_address_id'])}}" class="flex-c-m trans-0-4 btn flinnt-btn">
								Edit
							</a>
						</div>
						<div class="col-md-6 trans-0-4 m-b-10">
							<a href="{{route('address_destroy', $address['user_address_id'])}}" class="flex-c-m trans-0-4 btn flinnt-btn">
								Delete
							</a>
						</div>

						<div class="col-sm-12 trans-0-4 m-b-10">
							<a href="{{route('review_pay', $address['user_address_id'])}}" class="flex-c-m trans-0-4 btn flinnt-btn">
								Deliver to this address
							</a>
						</div>
					</div>
					@endforeach
				</div>
				@endif
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 flex-w flex-sb p-t-15 p-b-20">
						{!! Form::open(['route'=>'address_store', 'name' =>'checkout',  'class' =>'checkout', 'data-parsley-validate', 'id'=>'address-form', 'novalidate'=>'novalidate']) !!}
							<h3 id="ship-to-different-address" class="m-t-10 m-b-10 m-text19">
								{!! Form::checkbox('ship-to-different-address', old('ship-to-different-address'), '', ['value'=>'1']) !!}
								<span>Ship to a different address?</span>
							</h3>

							<div class="row shipping_address" style="display: none;">
								<div class="col-sm-12 col-md-12 col-lg-12 flex-w flex-sb p-t-15 p-b-20">
									<h5 class="m-text19 width-100 m-t-10 m-b-10">
										<b>Shipping Details</b>
									</h5>
									<div class="w-size20 w-full-sm">
										<p class="s-text8 m-t-10 m-b-10">
											There are no shipping methods available. Please double check your address, or contact us if you need any help.
										</p>
										<label class="s-text15" for="fullname"><b>Full Name : </b><abbr class="required" title="required">*</abbr></label>
										<div class="size4 bo4 m-b-15">
										{!! Form::text('fullname', old('fullname'), ['class'=>'sizefull s-text7 p-l-15 p-r-15', 'required'=>'required']) !!}
                    					<span class="text-danger">{{ $errors->first('vendor_name') }}</span>
										</div>

										<label class="s-text15" for="phone"><b> Mobile number : </b><abbr class="required" title="required">*</abbr></label>
										<div class="size4 bo4 m-b-15">
											{!! Form::text('phone', old('phone'), ['class'=>'sizefull s-text7 p-l-15 p-r-15', 'required'=>'required', 'data-parsley-pattern' => '^[\d\+\-\.\(\)\/\s]*$']) !!}
                        					<span class="text-danger">{{ $errors->first('phone') }}</span>
										</div>

										<label class="s-text15" for="address1"><b>Flat, House no., Building, Company, Apartment : </b><abbr class="required" title="required">*</abbr></label>
										<div class="size4 bo4 m-b-15">
										{!! Form::text('address1', old('address1'), ['class'=>'sizefull s-text7 p-l-15 p-r-15', 'required'=>'required']) !!}
                        				<span class="text-danger">{{ $errors->first('address1') }}</span>
										</div>

										<label class="s-text15" for="address2"><b>Area, Colony, Street, Sector, Village : </b></label>
										<div class="size4 bo4 m-b-15">
										{!! Form::text('address2', old('address2'), ['class'=>'sizefull s-text7 p-l-15 p-r-15']) !!}
                        				<span class="text-danger">{{ $errors->first('address2') }}</span>
										</div>

										<label class="s-text15" for="city"><b>Town/City: </b><abbr class="required" title="required">*</abbr></label>
										<div class="size4 bo4 m-b-15">
										{!! Form::text('city', old('city'), ['class'=>'sizefull s-text7 p-l-15 p-r-15', 'required'=>'required']) !!}
                        				<span class="text-danger">{{ $errors->first('city') }}</span>
										</div>

										<label class="s-text15" for="state_id"><b>State : </b><abbr class="required" title="required">*</abbr></label>
										<div class="form-control bo4 m-b-15">
										{!! Form::select('state_id',$states, '', [ 'id'=>'state_id', 'required'=>'required']) !!}
                 	 					<span class="text-danger">{{ $errors->first('state_id') }}</span>
										</div>

										<label class="s-text15" for="pin"><b>Pincode : </b><abbr class="required" title="required">*</abbr></label>
										<div class="size4 bo4 m-b-15">
										{!! Form::text('pin', old('pin'), ['class'=>'sizefull s-text7 p-l-15 p-r-15', 'required'=>'required']) !!}
                    					<span class="text-danger">{{ $errors->first('pin') }}</span>
										</div>

										<label class="s-text15" for="address_type"><b>Address Type : </b><abbr class="required" title="required">*</abbr></label>
										<div class="form-control bo4 m-b-15">
											<select class="sizefull p-l-15 p-r-15" id="address_type" name="address_type" required="required">
												<option value="home">Home</option>
												<option value="school">School</option>
											</select>
                    					<span class="text-danger">{{ $errors->first('address_type') }}</span>
										</div>
										<button type="submit" class="btn flinnt-btn m-t-10" name="place_order" id="place_order" value="Place order" data-value="Place order">Deliver to this address</button>
									</div>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
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
			$('#state_id').select2({
				placeholder: 'Select State'
			});
			$('#address_type').select2({
				placeholder: 'Select Address Type'
			});
			
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