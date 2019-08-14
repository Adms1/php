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
                <h2>Search a product</h2>
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

                {!! Form::open(['route'=>'product_search', 'method'=>'get','class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'product-search-form']) !!}
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attribute_type">Product Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('product_name', (isset($data) && isset($data['product_name']) ? $data['product_name'] : old('product_name')), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter product name', 'id' => 'product_name', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('product_name') }}</span>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <button type="submit" class="btn btn-success submit">Search</button>
                    </div>
                  </div>
                  @if (isset($data) && isset($data['product_name']))
                  <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <button class="btn btn-primary" onclick="location.href='{{ route('products') }}'" style="float: right" type="button">Add new product</button>
                    </div>
                  </div>
                  @endif
                {!! Form::close() !!}
              </div>
              <div class="x_content">
                <br />
                @if (isset($data) && isset($data['product_name']))
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap bulk_action" cellspacing="0" width="100%">
                  <thead>
                    <tr class="headings">
                      <th>Search catalogue list</th>
                    </tr>
                  </thead>
                  <tbody>
                    <div class="clearfix"></div>
                      @foreach($products as $product)
                        @if($product->standard_id)
                        <tr>
                          <td>
                            <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 profile_details">
                              <div class="col-sm-12">
                                <!-- <h4 class="brief"><i>Digital Strategist</i></h4> -->
                                <div class="col-md-2 col-xs-2 col-sm-12 text-center">
                                  <img style="width: 60%" src="{{URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').$product->image)}}" alt="" class="">
                                </div>
                                <div class="col-md-7 col-xs-7 col-sm-12">
                                  <h2>{{$product->book_name}}</h2>
                                  <p><strong>Publisher: </strong> {{$product->publisher_name}} </p>
                                  <ul class="list-unstyled">
                                    <li><i class="fa fa-bookmark"></i> ISBN: {{$product->isbn}}</li>
                                    <li><i class="fa fa-bookmark"></i> Series: {{$product->series}}</li>
                                    <li><i class="fa fa-bookmark"></i> HS Code: {{$product->hs_code}}</li>
                                    <li>
                                      <p class="ratings">
                                        <a>4.0</a>
                                        <a href="#"><span class="fa fa-star"></span></a>
                                        <a href="#"><span class="fa fa-star"></span></a>
                                        <a href="#"><span class="fa fa-star"></span></a>
                                        <a href="#"><span class="fa fa-star"></span></a>
                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                      </p>
                                    </li>
                                    <li><a target="_blank" href="{{route('product_detail', [$product->institution_book_vendor_id, $product->standard_id])}}" class="tabel_link">See all product details</a></li>
                                  </ul>
                                </div>
                                <div class="col-md-3 col-xs-3 col-sm-12 text-center">
                                  <a href='{{ route("product_offer", "$product->book_id") }}' class="btn btn-warning"> Sell Yours </a>
                                </div>
                              </div>
                            </div>
                            </div>
                          </td>
                        </tr>
                        @endif
                      @endforeach
                  </tbody>
                </table>
                @endif
                <!-- <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                  <thead>
                    <tr class="headings">
                      <th>Image</th>
                      <th>Product Name</th>
                      <th>Publisher Name</th>
                      <th>ISBN</th>
                      <th>Series</th>
                      <th>HS Code</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $product)
                    <tr>
                      <td><img style="width: 50%" src="{{URL::asset($product->image)}}"></td>
                      <td><a href='{{ route("product_search", "$product->book_id") }}' class="tabel_link">{{$product->book_name}}</a></td>
                      <td>{{$product->publisher_name}}</td>
                      <td>{{$product->isbn}}</td>
                      <td>{{$product->series}}</td>
                      <td>{{$product->hs_code}}</td>
                      <td>
                        <a href='{{ route("product_offer", "$product->book_id") }}' class="btn btn-warning btn-xs"> Sell Yours </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table> -->
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

    <script>
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
      });
    </script>
@endsection