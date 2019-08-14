@extends('admin.layouts.app')

@section('css')
  <!-- Datatables -->
  <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('content')
      <div class="">
        <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Product List</h2>
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
                  
                  @if(Auth::guard('vendor')->check())
                  <div class="col-md-6 col-sm-6 col-xs-12"></div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <button class="btn btn-info float-right" onclick="window.location='{{ route("products") }}'">Add Product</button>
                  </div>
                  @endif
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr class="headings">
                        <th class="no-sort width-10">Image</th>
                        <th>Product Name</th>
                        <th>Publisher Name</th>
                        <th>ISBN</th>
                        <th>Series</th>
                        <th>HS Code</th>
                        @if(Auth::guard('vendor')->check())
                        <th class="no-sort">Action</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($products as $product)
                      <tr class="">
                        <td><img class="width-70" src="{{URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').$product->image)}}"></td>
                        <td>
                          @if (Auth::guard("vendor")->check())
                          <a href='{{ route("product_edit", "$product->book_id") }}' class="tabel_link">{{$product->book->book_name}}</a>
                          @else
                          <a target="_blank" href='{{ route("product_view", "$product->book_vendor_id") }}' class="tabel_link">{{$product->book->book_name}}</a>
                          @endif
                        </td>
                        <td>{{$product->book->publisher->publisher_name}}</td>
                        <td>{{$product->book->isbn}}</td>
                        <td>{{$product->book->series}}</td>
                        <td>{{$product->book->hs_code}}</td>
                        @if(Auth::guard('vendor')->check())
                        <td>
                          <a href='{{ route("product_destroy", "$product->book_id") }}' class="btn btn-danger btn-xs product-delete"><i class="fa fa-trash"></i> Delete </a>
                        </td>
                        @endif
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
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
  <script type="text/javascript">
    /*** Confirmation to delete ***/
    $('.product-delete').on('click',function(e){
      var answer=confirm('Do you want to delete?');
      if(!answer){
        e.preventDefault();
      }
    });
  </script>
@endsection('script')
