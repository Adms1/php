@extends('admin.layouts.app')

@section('css')
<style class="cp-pen-styles">
  .nopad {
      padding-left: 5 !important;
      padding-right: 5 !important;
  }
  /*image gallery*/
  .image-checkbox {
      cursor: pointer;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      border: 4px solid transparent;
      margin-bottom: 0;
      outline: 0;
  }
  .image-checkbox input[type="checkbox"] {
      display: none;
  }

  .image-checkbox-checked {
      border-color: #4783B0;
  }
  .image-checkbox .fa {
      position: absolute;
      color: #4A79A3;
      background-color: #fff;
      padding: 10px;
      top: 0;
      right: 0;
  }
  .image-checkbox-checked .fa {
      display: block !important;
  }
</style>
@endsection

@section('content')
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add Product Attribute<small>Main/Parent Attribute</small></h2>
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
                {!! Form::open(['route'=>'pr_atr_store', 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'category-form']) !!}
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attribute_type">Attribute Type 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <label class="control-label">Size</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attribute_value">Name <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('attribute_value', old('attribute_value'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Value', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('attribute_value') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_adjustment">Price Adjustment <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::number('price_adjustment', 0, ['class'=>'form-control col-md-7 col-xs-12', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('price_adjustment') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="weight_adjustment">Weight Adjustment <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::number('weight_adjustment', 0, ['class'=>'form-control col-md-7 col-xs-12', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('weight_adjustment') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="display_order">Display Order <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::number('display_order', 0, ['class'=>'form-control col-md-7 col-xs-12', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('display_order') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="picture">Picture <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="attribute-picture-selection-block clearfix">
                        <div class="checkbox">
                          <label>
                            {!! Form::radio('product_type','0', true, ['class'=>'form-control flat']) !!}
                            No picture
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            {!! Form::radio('product_type','0', true, ['class'=>'form-control flat']) !!}
                            <img width="75" src="{{URL::asset('/images/Tulips.jpg')}}" />
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            {!! Form::radio('product_type','1', null, ['class'=>'form-control flat']) !!}
                            <img width="75" src="{{URL::asset('/images/Tulips.jpg')}}" />
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            {!! Form::radio('product_type','2', null, ['class'=>'form-control flat']) !!}
                            <img width="75" src="{{URL::asset('/images/Tulips.jpg')}}" />
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="picture">Picture Combo <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="col-xs-4 col-sm-3 col-md-2 nopad text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{URL::asset('/images/Tulips.jpg')}}">
                                <input name="image[]" value="" type="checkbox">
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-2 nopad text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{URL::asset('/images/Tulips.jpg')}}">
                                <input name="image[]" value="" type="checkbox">
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-2 nopad text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{URL::asset('/images/Tulips.jpg')}}">
                                <input name="image[]" value="" type="checkbox">
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-2 nopad text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{URL::asset('/images/Tulips.jpg')}}">
                                <input name="image[]" value="" type="checkbox">
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                      </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button class="btn btn-primary" type="button" onclick="window.location='{{ URL::previous() }}'">Cancel</button>
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

@section('script')
  <script>// image gallery
      // init the state from the input
      $(".image-checkbox").each(function () {
          if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
              $(this).addClass('image-checkbox-checked');
          } else {
              $(this).removeClass('image-checkbox-checked');
          }
      });

      // sync the state to the input
      $(".image-checkbox").on("click", function (e) {
          $(this).toggleClass('image-checkbox-checked');
          var $checkbox = $(this).find('input[type="checkbox"]');
          $checkbox.prop("checked", !$checkbox.prop("checked"))

          e.preventDefault();
      });
      //# sourceURL=pen.js
  </script>
@endsection