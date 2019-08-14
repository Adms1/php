@extends('admin.layouts.app')

@section('css')
<!-- Select2 -->
<link href="{{asset('vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
<!-- Switchery -->
<link href="{{asset('vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Vendor</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </li>
                        <li>
                            <a class="close-link">
                                <i class="fa fa-close"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    @if ($message = Session::get('response.message'))
                    <div class="alert alert-{{ session('response.status') }} alert-block">
                        <button type="button" class="close" data-dismiss="alert">X</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    {!! Form::open(['route'=>'vendor_store', 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'vendor-form', 'enctype'=>'multipart/form-data']) !!}
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="name">Vendor Name 
                                <span class="required">*</span>
                            </label>
                            {!! Form::text('vendor_name', old('vendor_name'), ['class'=>'form-control', 'placeholder'=>'Enter Name', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('vendor_name') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="vendor_gst_number">GST Number 
                                <span class="required">*</span>
                            </label>
                            {!! Form::text('vendor_gst_number', old('vendor_gst_number'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter GST', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('vendor_gst_number') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="vendor_address1">Address1 
                                <span class="required">*</span>
                            </label>
                            {!! Form::text('vendor_address1', old('vendor_address1'), ['class'=>'form-control', 'placeholder'=>'Enter Address1', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('vendor_address1') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="vendor_address2">Address2</label>
                            {!! Form::text('vendor_address2', old('vendor_address2'), ['class'=>'form-control', 'placeholder'=>'Enter Address2']) !!}
                            <span class="text-danger">{{ $errors->first('vendor_address2') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="vendor_city">City 
                                <span class="required">*</span>
                            </label>
                            {!! Form::text('vendor_city', old('vendor_city'), ['class'=>'form-control', 'placeholder'=>'Enter City', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('vendor_city') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="vendor_state_id">State 
                                <span class="required">*</span>
                            </label>
                            {!! Form::select('vendor_state_id',$states, old('vendor_state_id'), ['class'=>'form-control', 'placeholder'=>'Select State', 'id'=>'vendor_state_id', 'required'=>'required', 'data-parsley-errors-container' => '#vendor_state_id_error']) !!}
                            <span id="vendor_state_id_error" class="text-danger">{{ $errors->first('vendor_state_id') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="vendor_pin">Pin Code 
                                <span class="required">*</span>
                            </label>
                            {!! Form::text('vendor_pin', old('vendor_pin'), ['class'=>'form-control', 'placeholder'=>'Enter Pin', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('vendor_pin') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="vendor_country_id">Country 
                                <span class="required">*</span>
                            </label>
                            {!! Form::select('vendor_country_id',$countries, old('vendor_country_id'), ['class'=>'form-control', 'placeholder'=>'Select Country', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('vendor_country_id') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="email">Email 
                                <span class="required">*</span>
                            </label>
                            {!! Form::email('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Enter Email', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="vendor_phone">Phone Number
                                <span class="required">*</span>
                            </label>
                            {!! Form::text('vendor_phone', old('vendor_phone'), ['class'=>'form-control', 'placeholder'=>'Enter Phone', 'required'=>'required', 'data-parsley-pattern' => '^[\d\+\-\.\(\)\/\s]*$']) !!}
                            <span class="text-danger">{{ $errors->first('vendor_phone') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="vendor_status_id">Vendor Status 
                                <span class="required">*</span>
                            </label>
                            {!! Form::select('vendor_status_id',$status, old('vendor_status_id'), ['class'=>'form-control', 'placeholder'=>'Select Vendor status', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('vendor_status_id') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="vendor_phone">Service Charge (%)
                                <span class="required">*</span>
                            </label>
                            {!! Form::text('flint_charge', 5, ['class'=>'form-control', 'placeholder'=>'Enter service charge', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('flint_charge') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <button class="btn btn-primary" type="button" onclick="window.location='{{route("vendor_list")}}'">Cancel</button>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Select2 -->
<script src="{{asset('vendors/select2/dist/js/select2.full.min.js')}}"></script>
<!-- Switchery -->
<script src="{{asset('vendors/switchery/dist/switchery.min.js')}}"></script>
<!-- Parsley -->
<script src="{{asset('vendors/parsleyjs/dist/parsley.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#vendor_state_id').select2({
            placeholder: 'Select Category',
            allowClear: true,
            closeOnSelect: true,
        });
    });

    /**** On reset button click clear selected values by select2 js  ****/
    $("button[type='reset']").on("click", function(event){
        $('select').val('').trigger('change');
        $('.remove_img_preview').trigger('click');

        $(this).closest('form').find("input").attr('value', '');
        $('#vendor-form').parsley().reset();
        $('.text-danger').hide();
    });
</script>
@endsection