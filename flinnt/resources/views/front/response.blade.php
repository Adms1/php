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
					<li><a href="#" class="checkout-step">Customer Details</a></li>
		            <li><a href="#" class="checkout-step">Review &amp; Pay</a></li>
		            <li><a href="#" class="checkout-step always-active active">Confirmation</a></li>
				</ul>
			</div>

			<div class="alert alert-success alert-block" style="display: none;" id="alert-message"></div>
			<!-- Cart item -->
			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-35 p-lr-15-sm bot">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 flex-w flex-sb p-t-15 p-b-20">
						<div class="row place-order">
							<div class="col-sm-12 col-md-12 col-lg-12 flex-w flex-sb p-t-15 p-b-20">
								@if(Session::has('message'))
								<div class="col-sm-12 col-md-8 col-lg-8 alert {{ Session::get('alert-class', 'alert-info') }} alert-block">	
									<strong>{{ Session::get('message') }}</strong>
								</div>
								@endif
								@if ($response['order_status'] != 'Success')
						        <div class="col-sm-12 col-md-8 col-lg-8">	
									<p class="m-t-10 m-b-10">Your checkout process is {{$response['order_status']}} due to {{$response['status_message']}}
									</p>
									<a href="{{route('front_home')}}" class="btn flinnt-btn">
										Goto Home
									</a>
								</div>
								@endif
								@if ($response['order_status'] === 'Success')
						        <div class="col-sm-12 col-md-8 col-lg-8">	
									<p><a href="{{route('invoice_pdf', $response['order_id'])}}">Download Invoice</a></p>
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection