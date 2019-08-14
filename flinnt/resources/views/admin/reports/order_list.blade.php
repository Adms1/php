@extends('admin.layouts.app')

@section('css')
  <!-- Datatables -->
  <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
  <!-- Select2 -->
  <link href="{{asset('vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')
      <div class="">
        <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Order List</h2>
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
                  <!-- {!! Form::open(['route'=>'report_order_list', 'id'=>'order-form', 'method' => 'GET']) !!}
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="search"></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('vendor_id', $vendors, $vendor_id, ['class'=>'form-control col-md-7 col-xs-12', 'id' => 'vendor_id']) !!}
                        <span class="text-danger">{{ $errors->first('vendor_id') }}</span>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-12">
                      <button class="btn btn-info" style="float: right" type="submit">Search</button>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-12">
                      <button type="button" class="btn btn-info" onclick="window.location='{{ route("report_product_export", "5") }}'" style="float: right">Export</button>
                    </div>
                  </div>
                  {!! Form::close() !!} -->
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr class="headings">
                        <th>Sr.No</th>
                        <th>Order</th>
                        <th>User</th>
                        @if (!Auth::guard('institution')->check())
                        <th>Institution</th>
                        @endif
                        @if (!Auth::guard('vendor')->check())
                        <th>Vendor</th>
                        @endif
                        <th>Transaction</th>
                        <th>Payment Id</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Order Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if (!empty($orders) && count($orders) > 0)
                        @foreach($orders as $key => $order)
                        <tr class="">
                          <td>{{++$key}}</td>
                          <td>
                            <a target="_blank" href="{{route('order_detail', $order->order_number)}}" class="tabel_link">{{$order->order_number}}</a>
                          </td>
                          <td>{{$order->useraddress->fullname}}</td>
                          @if (!Auth::guard('institution')->check())
                          <td>{{$order->institution->institution_name}}</td>
                          @endif
                          @if (!Auth::guard('vendor')->check())
                          <td>{{$order->orderline[0]->vendor->vendor_name}}</td>
                          @endif
                          <td>{{$order->transaction_id}}</td>
                          <td>{{$order->payment_id}}</td>
                          <td class="text-right">{{$order->order_total_price}}</td>
                          <td>@if ($order->order_status == 1)
                                {{'Pending'}}
                              @elseif ($order->order_status == 2)
                                {{'Success'}}
                              @else
                                {{'Fail'}}
                              @endif
                          </td>
                          <td>{{date('d-m-Y g:i A', strtotime($order->order_date))}}</td>
                        </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
  <!-- Select2 -->
  <script src="{{asset('vendors/select2/dist/js/select2.full.min.js')}}"></script>
  <!-- Datatables -->
  <script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <script type="text/javascript">
    $('#vendor_id').select2({
      placeholder: 'Select Vendor',
      allowClear: true,
      closeOnSelect: false
    });
  </script>
@endsection('script')
