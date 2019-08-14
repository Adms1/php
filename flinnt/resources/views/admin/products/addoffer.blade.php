@extends('admin.layouts.app')

@section('css')
  <!-- Datatables -->
  <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendors/jquery-ui/css/jquery-ui-autocomplete.css')}}" rel="stylesheet">
@endsection

@section('content')
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add your price</h2>
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

                @if ($message = Session::get('response.message'))
                    <div class="alert alert-{{ session('response.status') }} alert-block">
                        <button type="button" class="close" data-dismiss="alert">X</button> 
                            <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-12">
                      <img class="col-md-12 col-sm-12 col-xs-12 float-initial" src="{{$product->image}}">
                    </div>
                    <div class="col-md-7 col-sm-6 col-xs-12">
                      <p><b>Name of Book: </b>{{$product->book_name}}</p>
                      <p><b>ISBN: </b>{{$product->isbn}}</p>
                      <p><b>Series: </b>{{$product->series}}</p>
                      <p><b>HS Code: </b>{{$product->hs_code}}</p>
                      <p><b>Publisher: </b>{{$product->publisher_name}}</p>
                    </div>
                  </div>
                </div>

                {!! Form::open(['route'=>['product_storeOffer', $product->book_id], 'method'=>'get','class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'product-offer-form']) !!}
                  <div class="form-group m-t-20">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Seller SKU
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('seller_sku', old('seller_sku'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Seller SKU']) !!}
                        <span class="text-danger">{{ $errors->first('seller_sku') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Conditions <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('condition_id',$conditions, old('condition_id'), ['class'=>'form-control', 'required'=>'required', 'id' => 'condition_id']) !!}
                        <span class="text-danger">{{ $errors->first('condition_id') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">List Price <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('list_price', old('list_price'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter List Price', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('list_price') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Display Price <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('display_price', old('display_price'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Display Price', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('display_price') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button class="btn btn-primary" type="button" onclick="window.location='{{ URL::previous() }}'">Cancel</button>
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <button type="submit" class="btn btn-success submit">Save and Finish</button>
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

    <!-- Datatables -->
    <script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- Parsley -->
    <script src="{{asset('vendors/parsleyjs/dist/parsley.min.js')}}"></script>
    <!-- Auto Complete with ajax -->
    <script src="{{asset('vendors/jquery-ui/js/jquery-ui.min.js')}}"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        var src = "{{ route('product_searchAjax') }}";
        $("#product_name").autocomplete({
          source: function(request, response) {
            $.ajax({
              url: src,
              type:'GET',
              dataType: 'json',
              data: {
                product_name : request.term
              },
              success: function(data) {
                var array = $.map(data, function (item) {
                  return {
                    label: item,
                    value: item,
                    product: item
                  }
                });
                response(array)
              }
            });
          },
          minLength: 1,
          select: function( event, ui ) {
            var data = ui.item.product;
            $('#product_name').val(data);
          }
        });

        /**** On reset button click clear values ****/
        $("button[type='reset']").on("click", function(event){
            $(this).closest('form').find("input").attr('value', '');
            $('#product-offer-form').parsley().reset();
            $('.text-danger').hide();
        });

      });
    </script>
@endsection