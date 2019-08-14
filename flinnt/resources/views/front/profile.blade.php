@extends('front.layouts.app')

@section('title')
    <title>{{ config('app.name', 'Flinnt') }}</title>
@endsection

<!--===============================================================================================-->

@section('content')
    <!-- Title Page -->
    <section class="place-order">
        <div class="container width-95">
            <div class="row ">
                <div class="col-lg-12 s-text7 m-b-15 m-t-15">
                    <h4>Update Profile</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Content page -->
    <section class="bgwhite p-b-65 p-t-20">
        <div class="container width-95">

            @if ($message = Session::get('response.message'))
            <div class="alert alert-{{ session('response.status') }} alert-block">
                <button type="button" class="close" data-dismiss="alert">X</button> 
                <strong>{{ $message }}</strong>
            </div>
            @endif
            
            <div class="row">    
                <div class="col-md-2 col-lg-2 p-b-50">
                    <div class="leftbar p-r-0-sm">
                        <ul>
                            <li class="m-text14 profile-head">PROFILE
                            </li>
                            <li class="m-text14 selected profile-tab">
                                <a href="{{route('user_profile')}}"><i class="fa fa fa-user pd-5"></i>Profile</a>
                            </li>
                            <li class="m-text14 profile-tab">
                                <a href="{{route('user_order')}}"><i class="fa fa fa-wpforms pd-5"></i>Order List</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-10 p-b-50">
                    {!! Form::open(['route'=>'profile_update', 'name' =>'profile-form',  'class' =>'', 'data-parsley-validate', 'id'=>'profile-form', 'novalidate'=>'novalidate']) !!}
                    <div class="row m-b-10">
                        <div class="col-lg-12 place-order">
                            <div class="p-l-20 m-t-10 m-b-10">
                                <span class="flinnt-color">{{'Personal'}}</span>
                                <span>{{'Details'}}</span>
                            </div>
                        </div>
                        <div class="col-lg-12 profile-block">
                            <div class="row p-t-10 p-b-10 m-0">
                                <label class="s-text15 m-l-15 m-r-15 p-t-8 col-md-3 col-sm-3 col-xs-12" for="user_name"><b>Full Name : </b><abbr class="required" title="required">*</abbr></label> 
                                <div class="col-md-7 col-sm-7 col-xs-12 m-l-15 m-r-15">
                                    {!! Form::text('user_name', $user->user_name , ['class'=>'form-control', 'required'=>'required']) !!}
                                    <span class="text-danger">{{ $errors->first('user_name') }}</span>
                                </div>
                            </div>
                            <div class="row p-t-10 p-b-10 m-0">
                                <label class="s-text15 m-l-15 m-r-15 p-t-8 col-md-3 col-sm-3 col-xs-12" for="address1"><b>Address1 : </b><abbr class="required" title="required">*</abbr></label> 
                                <div class="col-md-7 col-sm-7 col-xs-12 m-l-15 m-r-15">
                                    {!! Form::text('address1', $user->address1, ['class'=>'form-control', 'required'=>'required']) !!}
                                    <span class="text-danger">{{ $errors->first('address1') }}</span>
                                </div>
                            </div>
                            <div class="row p-t-10 p-b-10 m-0">
                                <label class="s-text15 m-l-15 m-r-15 p-t-8 col-md-3 col-sm-3 col-xs-12" for="address2"><b>Address2 : </b></label> 
                                <div class="col-md-7 col-sm-7 col-xs-12 m-l-15 m-r-15">
                                    {!! Form::text('address2', $user->address2, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="row p-t-10 p-b-10 m-0">
                                <label class="s-text15 m-l-15 m-r-15 p-t-8 col-md-3 col-sm-3 col-xs-12" for="city"><b>Town/City : </b><abbr class="required" title="required">*</abbr></label> 
                                <div class="col-md-7 col-sm-7 col-xs-12 m-l-15 m-r-15">
                                    {!! Form::text('city', $user->city, ['class'=>'form-control ', 'required'=>'required']) !!}
                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                </div>
                            </div>
                            <div class="row p-t-10 p-b-10 m-0">
                                <label class="s-text15 m-l-15 m-r-15 p-t-8 col-md-3 col-sm-3 col-xs-12" for="state_id"><b>State : </b><abbr class="required" title="required">*</abbr></label> 
                                <div class="col-md-7 col-sm-7 col-xs-12 m-l-15 m-r-15">
                                    {!! Form::select('state_id',$states, $user->state_id, [ 'id'=>'state_id', 'required'=>'required']) !!}
                                    <span class="text-danger">{{ $errors->first('state_id') }}</span>
                                </div>
                            </div>
                            <div class="row p-t-10 p-b-10 m-0">
                                <label class="s-text15 m-l-15 m-r-15 p-t-8 col-md-3 col-sm-3 col-xs-12" for="pin"><b>Pincode : </b><abbr class="required" title="required">*</abbr></label> 
                                <div class="col-md-7 col-sm-7 col-xs-12 m-l-15 m-r-15">
                                    {!! Form::text('pin', $user->pin, ['class'=>'form-control', 'required'=>'required']) !!}
                                    <span class="text-danger">{{ $errors->first('pin') }}</span>
                                </div>
                            </div>
                            <div class="row p-t-10 p-b-10 m-0">
                                <label class="s-text15 m-l-15 m-r-15 p-t-8 col-md-3 col-sm-3 col-xs-12" for="phone"><b>Mobile number : </b><abbr class="required" title="required">*</abbr></label> 
                                <div class="col-md-7 col-sm-7 col-xs-12 m-l-15 m-r-15">
                                    {!! Form::text('phone', $user->phone, ['class'=>'form-control', 'required'=>'required', 'data-parsley-pattern' => '^[\d\+\-\.\(\)\/\s]*$']) !!}
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                </div>
                            </div>
                            <div class="row p-t-10 p-b-10 m-0">
                                <label class="s-text15 m-l-15 m-r-15 p-t-8 col-md-3 col-sm-3 col-xs-12" for="email"><b>Email : </b><abbr class="required" title="required">*</abbr></label> 
                                <div class="col-md-7 col-sm-7 col-xs-12 m-l-15 m-r-15">
                                    {!! Form::text('email', $user->email, ['class'=>'form-control', 'required'=>'required']) !!}
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 place-order">
                            <div class="p-l-20 m-t-10 m-b-10">
                                <span class="flinnt-color" >{{'School'}}</span>
                                <span>{{'Details'}}</span>
                            </div>
                        </div>
                        <div class="col-lg-12 profile-block">
                            <div class="row p-t-10 p-b-10 m-0">
                                <label class="s-text15 m-l-15 m-r-15 p-t-8 col-md-3 col-sm-3 col-xs-12" for="institution_id"><b>Institution Name : </b><abbr class="required" title="required">*</abbr></label> 
                                <div class="col-md-7 col-sm-7 col-xs-12 m-l-15 m-r-15">
                                    {!! Form::select('institution_id',$institutions, $user->institution_id, [ 'id'=>'institution_id', 'required'=>'required']) !!}
                                    <span class="text-danger">{{ $errors->first('institution_id') }}</span>
                                </div>
                            </div>
                            <div class="row p-t-10 p-b-10 m-0">
                                <label class="s-text15 m-l-15 m-r-15 p-t-8 col-md-3 col-sm-3 col-xs-12" for="board_id"><b>Board Name : </b><abbr class="required" title="required">*</abbr></label> 
                                <div class="col-md-7 col-sm-7 col-xs-12 m-l-15 m-r-15">
                                    {!! Form::select('board_id',$boards, $user->board_id, [ 'id'=>'board_id', 'required'=>'required']) !!}
                                    <span class="text-danger">{{ $errors->first('board_id') }}</span>
                                </div>
                            </div>
                            <div class="row p-t-10 p-b-10 m-0">
                                <label class="s-text15 m-l-15 m-r-15 p-t-8 col-md-3 col-sm-3 col-xs-12" for="standard_id"><b>Standard Name : </b><abbr class="required" title="required">*</abbr></label> 
                                <div class="col-md-7 col-sm-7 col-xs-12 m-l-15 m-r-15">
                                    {!! Form::select('standard_id',$classes, $user->standard_id, [ 'id'=>'standard_id', 'required'=>'required']) !!}
                                    <span class="text-danger">{{ $errors->first('standard_id') }}</span>
                                </div>
                            </div>
                            <div class="p-t-15 p-l-15 p-r-15 p-b-15">
                                <button type="submit" class="btn flinnt-btn" name="place_order" id="place_order" value="Save" data-value="Save">Update</button>
                                <button type="button" class="btn flinnt-btn" name="place_order" id="place_order" value="Cancel" data-value="Cancel" onclick="window.location='{{route("front_home")}}'">Cancel</button>
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
    <script src="{{asset('vendors/parsleyjs/dist/parsley.min.js')}}"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#institution_id').select2({
                placeholder: 'Select Institution'
            });
            $('#board_id').select2({
                placeholder: 'Select Board'
            });
            $('#standard_id').select2({
                placeholder: 'Select Standard'
            });
            $('#state_id').select2({
                placeholder: 'Select State'
            });
            $('#address_type').select2({
                placeholder: 'Select Address Type'
            });
        });
    </script>
@endsection