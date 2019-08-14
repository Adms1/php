@extends('admin.layouts.app')

@section('css')
    <!-- Datatables -->
    <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
@endsection

@section('content')
      <div class="">
        <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Vendor Sell</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  {!! Form::open(['route'=>'sell_order_list', 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'vendor-form']) !!}
                  <div class="form-group">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <label for="order_date_range">Date Range <span class="required">*</span></label>
                      <div class="input-prepend input-group">
                        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                        {!! Form::text('order_date_range', (isset($request_data['order_date_range'])) ? $request_data['order_date_range'] : '', ['class'=>'form-control', 'placeholder'=>'Select Date Range', 'id'=>'order_date_range']) !!}
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label for="order_status">Order Status <span class="required">*</span></label>
                        {!! Form::select('order_status',$order_status, (isset($request_data['order_status'])) ? $request_data['order_status'] : '', ['class'=>'form-control', 'placeholder'=>'Select Status']) !!}
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label for="institution_id">Institution <span class="required">*</span></label>
                        {!! Form::select('institution_id',$institutions, (isset($request_data['institution_id'])) ? $request_data['institution_id'] : '', ['class'=>'form-control', 'placeholder'=>'Select School']) !!}
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label for="vendor_id">Vendor <span class="required">*</span></label>
                        {!! Form::select('vendor_id',$vendors, (isset($request_data['vendor_id'])) ? $request_data['vendor_id'] : '', ['class'=>'form-control', 'placeholder'=>'Select Vendor']) !!}
                    </div>
                  </div>
                  <br />
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button type="submit" class="btn btn-success">Search</button>
                    </div>
                    {!! Form::close() !!}
                  </div>
                  <br />
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr class="headings">
                        <th>Sr.No</th>
                        <th>Order</th>
                        <th>Transaction</th>
                        <th>Order Date</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Delivery</th>
                        <th>School</th>
                        <th>Vendor</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($orders as $key => $order)
                      <tr class="">
                        <td>{{++$key}}</td>
                        <td>
                          <a target="_blank" href="{{route('order_detail', $order->order_number)}}" class="tabel_link">{{$order->order_number}}</a>
                        </td>
                        <td>{{$order->transaction_id}}</td>
                        <td>{{date('d-m-Y g:i A', strtotime($order->order_date))}}</td>
                        <td>{{$order->useraddress->fullname}}</td>
                        <td>{{$order->final_price}}</td>
                        <td>@if ($order->order_status == 1)
                              {{'Pending'}}
                            @elseif ($order->order_status == 2)
                              {{'Success'}}
                            @else
                              {{'Fail'}}
                            @endif
                        </td>
                        <td>@if (isset($order->ordercourier) && $order->ordercourier->status_id == 1)
                              {{'Processed'}}
                            @elseif (isset($order->ordercourier) && $order->ordercourier->status_id == 2)
                              {{'Delivered'}}
                            @else
                              {{'Pending'}}
                            @endif
                        </td>
                        <td>{{$order->institution->institution_name}}</td>
                        <td>{{$order->orderline[0]->vendor->vendor_name}}</td>
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
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script type="text/javascript">
      $('#order_date_range').daterangepicker({
        // startDate: moment().startOf('month'),
        // maxDate: moment(),
      });
      
    </script>
@endsection