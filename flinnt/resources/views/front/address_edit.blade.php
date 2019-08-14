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
			<div class="flex-w flex-sb-m p-b-25 bo8 p-l-60 p-r-60 p-lr-15-sm bot">
				<div class="">
					<div class="col-sm-12 col-md-12 col-lg-12 flex-w flex-sb p-t-15 p-b-20">
						{!! Form::open(['route'=>['address_update',$address['user_address_id']], 'name' =>'checkout',  'class' =>'checkout', 'data-parsley-validate', 'id'=>'address-form', 'novalidate'=>'novalidate']) !!}
							<div class="row shipping_address">
								<h5 class="m-text19 width-100 m-t-10 m-b-10">
									<b>Shipping Details</b>
								</h5>
								<div>
									<p class="s-text8 m-t-10 m-b-10">
										There are no shipping methods available. Please double check your address, or contact us if you need any help.
									</p>
									<label class="s-text15" for="fullname"><b>Full Name : </b><abbr class="required" title="required">*</abbr></label>
									<div class="size4 bo4 m-b-15">
									{!! Form::text('fullname', $address['fullname'], ['class'=>'sizefull s-text7 p-l-15 p-r-15', 'required'=>'required']) !!}
                					<span class="text-danger">{{ $errors->first('vendor_name') }}</span>
									</div>

									<label class="s-text15" for="phone"><b> Mobile number : </b><abbr class="required" title="required">*</abbr></label>
									<div class="size4 bo4 m-b-15">
										{!! Form::text('phone', $address['phone'], ['class'=>'sizefull s-text7 p-l-15 p-r-15', 'required'=>'required', 'data-parsley-pattern' => '^[\d\+\-\.\(\)\/\s]*$']) !!}
                    					<span class="text-danger">{{ $errors->first('phone') }}</span>
									</div>

									<label class="s-text15" for="address1"><b>Flat, House no., Building, Company, Apartment : </b><abbr class="required" title="required">*</abbr></label>
									<div class="size4 bo4 m-b-15">
									{!! Form::text('address1', $address['address1'], ['class'=>'sizefull s-text7 p-l-15 p-r-15', 'required'=>'required']) !!}
                    				<span class="text-danger">{{ $errors->first('address1') }}</span>
									</div>

									<label class="s-text15" for="address2"><b>Area, Colony, Street, Sector, Village : </b></label>
									<div class="size4 bo4 m-b-15">
									{!! Form::text('address2', $address['address2'], ['class'=>'sizefull s-text7 p-l-15 p-r-15']) !!}
                    				<span class="text-danger">{{ $errors->first('address2') }}</span>
									</div>

									<label class="s-text15" for="city"><b>Town/City: </b><abbr class="required" title="required">*</abbr></label>
									<div class="size4 bo4 m-b-15">
									{!! Form::text('city', $address['city'], ['class'=>'sizefull s-text7 p-l-15 p-r-15', 'required'=>'required']) !!}
                    				<span class="text-danger">{{ $errors->first('city') }}</span>
									</div>

									<label class="s-text15" for="state_id"><b>State : </b><abbr class="required" title="required">*</abbr></label>
									<div class="form-control bo4 m-b-15">
									{!! Form::select('state_id',$states, $address['state_id'], [ 'id'=>'state_id', 'required'=>'required']) !!}
             	 					<span class="text-danger">{{ $errors->first('state_id') }}</span>
									</div>

									<label class="s-text15" for="pin"><b>Pincode : </b><abbr class="required" title="required">*</abbr></label>
									<div class="size4 bo4 m-b-15">
									{!! Form::text('pin', $address['pin'], ['class'=>'sizefull s-text7 p-l-15 p-r-15', 'required'=>'required']) !!}
                					<span class="text-danger">{{ $errors->first('pin') }}</span>
									</div>

									<label class="s-text15" for="address_type"><b>Address Type : </b><abbr class="required" title="required">*</abbr></label>
									<div class="form-control bo4 m-b-15">
										<select class="sizefull p-l-15 p-r-15" id="address_type" name="address_type" required="required">
											<option value="home" {{($address['address_type'] == 'home') ? 'selected' : ''}}>Home</option>
											<option value="school" {{($address['address_type'] == 'school') ? 'selected' : ''}}>School</option>
										</select>
                					<span class="text-danger">{{ $errors->first('address_type') }}</span>
									</div>
									<button type="submit" class="btn flinnt-btn m-t-10" name="place_order" id="place_order" value="Place order" data-value="Place order">Update</button>
								</div>
							</div>
						</form>
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
        });
	</script>
@endsection