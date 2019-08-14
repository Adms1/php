@extends('admin.layouts.app')

@section('content')
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add Vendor Inventory<small>Vendor</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">X</button> 
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                {!! Form::open(['route'=>'inventory_store', 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'vendor-form', 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="vendor_id">Vendor <span class="required">*</span></label>
                        {!! Form::select('vendor_id',$vendors, old('vendor_id'), ['class'=>'form-control', 'placeholder'=>'Select Vendor', 'id'=>'vendor_id', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('vendor_id') }}</span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="product_id">Product <span class="required">*</span></label>
                        {!! Form::select('product_id',$products, old('product_id'), ['class'=>'form-control', 'placeholder'=>'Select Product', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('product_id') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="size_id">Size <span class="required">*</span></label>
                        {!! Form::select('size_id',$sizes, old('size_id'), ['class'=>'form-control', 'placeholder'=>'Select Size', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('size_id') }}</span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="color_id">Color <span class="required">*</span></label>
                        {!! Form::select('color_id',$colors, old('color_id'), ['class'=>'form-control', 'placeholder'=>'Select Color', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('color_id') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="style_id">Style <span class="required">*</span></label>
                        {!! Form::select('style_id',$styles, old('style_id'), ['class'=>'form-control', 'placeholder'=>'Select Style', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('style_id') }}</span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="unit_price">Unite Price <span class="required">*</span></label>
                        {!! Form::text('unite_price', old('unite_price'), ['class'=>'form-control', 'placeholder'=>'Enter Unite Price', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('unite_price') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-primary" type="button">Cancel</button>
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <button type="submit" class="btn btn-success">Add</button>
                    </div>
                  </div>
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection