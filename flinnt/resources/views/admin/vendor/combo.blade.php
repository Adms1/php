@extends('admin.layouts.app')

@section('content')
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add Product Combo<small>combo</small></h2>
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
                {!! Form::open(['route'=>'combo_store', 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'product-form', 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="combo_name">Combo Name<span class="required">*</span></label>
                        {!! Form::text('combo_name', old('combo_name'), ['class'=>'form-control', 'placeholder'=>'Enter Combo Name', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('combo_name') }}</span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="vendor_id">Vendor <span class="required">*</span></label>
                        {!! Form::select('vendor_id',$vendors, old('vendor_id'), ['class'=>'form-control', 'placeholder'=>'Select Vendor', 'id'=>'vendor_id', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('vendor_id') }}</span>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <table class="form-group">
                      <thead >
                        <th class="col-md-6 col-sm-6 col-xs-12">Product</th>
                        <th class="col-md-2 col-sm-6 col-xs-12">Quantity</th>
                        <th class="col-md-2 col-sm-6 col-xs-12">Unit Price</th>
                        <th class="col-md-4 col-sm-6 col-xs-12">Action</th>
                      </thead>
                      <tbody class="inc">
                        <tr>
                          <td class="col-md-6 col-sm-6 col-xs-12 pd-5">
                            {!! Form::select("product_id",$products, old("product_id"), ["class"=>"form-control", "placeholder"=>"Select Product", "required"=>"required"]) !!}
                            <span class="text-danger">{{ $errors->first("product_id") }}</span>
                          </td>
                          <td class="col-md-2 col-sm-6 col-xs-12">
                            {!! Form::text("quantity", old("quantity"), ["class"=>"form-control", "placeholder"=>"Enter Quantity", "required"=>"required"]) !!}
                            <span class="text-danger">{{ $errors->first("quantity") }}</span>
                          </td>
                          <td class="col-md-2 col-sm-6 col-xs-12">
                            {!! Form::text("price", old("price"), ["class"=>"form-control", "placeholder"=>"Enter Price", "required"=>"required"]) !!}
                            <span class="text-danger">{{ $errors->first("price") }}</span>
                          </td>
                          <td class="col-md-2 col-sm-6 col-xs-12">
                            <button class="btn-info" id="append">+</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  <!-- <div class="inc">
                    <div class="form-group">
                      <div class="col-md-3 col-sm-3 col-xs-12">
                          {!! Form::select("product_id",$products, old("product_id"), ["class"=>"form-control", "placeholder"=>"Select Product", "required"=>"required"]) !!}
                          <span class="text-danger">{{ $errors->first("product_id") }}</span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                          {!! Form::text("quantity", old("quantity"), ["class"=>"form-control", "placeholder"=>"Enter Quantity", "required"=>"required"]) !!}
                          <span class="text-danger">{{ $errors->first("quantity") }}</span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                          {!! Form::text("price", old("price"), ["class"=>"form-control", "placeholder"=>"Enter Price", "required"=>"required"]) !!}
                          <span class="text-danger">{{ $errors->first("price") }}</span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <button class="btn btn-info" id="append">+</button>
                      </div>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="comboprice">Combo Price <span class="required">*</span></label>
                        {!! Form::text('comboprice', old('comboprice'), ['class'=>'form-control', 'placeholder'=>'Enter Combo Price', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('comboprice') }}</span>
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

@section('script')
    <script type="text/javascript">
      $(document).ready(function(){
        jQuery(document).on('click', '#append', function() {
          $(".inc").append('<tr id="mul_div">\
                            <td class="col-md-6 col-sm-6 col-xs-12 pd-5">\
                              {!! Form::select("product_id",$products, old("product_id"), ["class"=>"form-control", "placeholder"=>"Select Product", "required"=>"required"]) !!}\
                              <span class="text-danger">{{ $errors->first("product_id") }}</span>\
                            </td>\
                            <td class="col-md-2 col-sm-6 col-xs-12">\
                              {!! Form::text("quantity", old("quantity"), ["class"=>"form-control", "placeholder"=>"Enter Quantity", "required"=>"required"]) !!}\
                              <span class="text-danger">{{ $errors->first("quantity") }}</span>\
                            </td>\
                            <td class="col-md-2 col-sm-6 col-xs-12">\
                              {!! Form::text("price", old("price"), ["class"=>"form-control", "placeholder"=>"Enter Price", "required"=>"required"]) !!}\
                              <span class="text-danger">{{ $errors->first("price") }}</span>\
                            </td>\
                            <td class="col-md-2 col-sm-6 col-xs-12">\
                              <button class="btn-info" id="append">+</button><button class="btn-info remove_this">-</button>\
                            </td>\
                          </tr>');

            // '<div class="form-group" id="mul_div">\
            //         <div class="col-md-3 col-sm-3 col-xs-12">\
            //             {!! Form::select("product_id",$products, old("product_id"), ["class"=>"form-control", "placeholder"=>"Select Product", "required"=>"required"]) !!}\
            //             <span class="text-danger">{{ $errors->first("product_id") }}</span>\
            //         </div>\
            //         <div class="col-md-3 col-sm-3 col-xs-12">\
            //             {!! Form::text("quantity", old("quantity"), ["class"=>"form-control", "placeholder"=>"Enter Quantity", "required"=>"required"]) !!}\
            //             <span class="text-danger">{{ $errors->first("quantity") }}</span>\
            //         </div>\
            //         <div class="col-md-3 col-sm-3 col-xs-12">\
            //             {!! Form::text("price", old("price"), ["class"=>"form-control", "placeholder"=>"Enter Price", "required"=>"required"]) !!}\
            //             <span class="text-danger">{{ $errors->first("price") }}</span>\
            //         </div>\
            //         <div class="col-md-3 col-sm-3 col-xs-12">\
            //           <a href="#" class="btn btn-info" id="append">+</a><a href="#" class="btn btn-info remove_this">-</a>\
            //         </div>\
            //       </div>');
          return false;
        });

        jQuery(document).on('click', '.remove_this', function() {
          jQuery(this).parents('#mul_div').remove();
          cal_price();
          return false;
        });

        jQuery(document).on('change', 'input[name=price]', function() {
          cal_price();
          return false;
        });

        function cal_price(){
          var total = 0;
          $('input[name=price]').each(function() {
            total += parseInt($(this).val(),10);
          });
          $('input[name=comboprice]').val(total);
        }

        // $("button[type=submit]").click(function(e) {
        //   e.preventDefault();
        //   var total = 0;
        //   $('input[name=price]').each(function() {
        //     total += parseInt($(this).val(),10);
        //   });
        //   $('input[name=comboprice]').val(total);
        //   $("#product-form").submit();
        //   return true;
        // })
      });
    </script>
@endsection