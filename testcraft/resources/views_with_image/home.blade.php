@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('admin.ca_dashboard')</div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="demo-container" style="">
                            <div id="chart_plot_trans" class="demo-placeholder"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('admin.ca_transaction_history')
                    <span class="f-right"><a href="{{ route('purchasePackages.index') }}">@lang('admin.ca_see_more')</a></span>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="thead-color">
                                <th>@lang('admin.purchase_packages.fields.invoice-number')</th>
                                <th>@lang('admin.purchase_packages.fields.student-name')</th>
                                <th>@lang('admin.purchase_packages.fields.amount')</th>
                                <th>@lang('admin.purchase_packages.fields.payment-number')</th>
                                <th>@lang('admin.purchase_packages.fields.transaction-number')</th>
                                <th>@lang('admin.purchase_packages.fields.status')</th>
                                <th>@lang('admin.purchase_packages.fields.payment-date')</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @if (count($purchase_packages) > 0)
                                @foreach ($purchase_packages as $test_package)
                                    <tr data-entry-id="{{ $test_package->TestPackageID }}">
                                        <td field-key='InvoiceNumber'>{{ $test_package->InvoiceNumber }}</td>
                                        <td field-key='StudentName'>
                                        @if (!empty($test_package->student))
                                            {{ $test_package->student->full_name }}
                                        @endif
                                        </td>
                                        <td field-key='Amount'>{{ array_sum($test_package->invoiceDetail->pluck('Amount')->toArray()) }}</td>
                                        <td field-key='PaymentNumber'>{{ $test_package->paymentTransaction->PaymentOrderID }}</td>
                                        <td field-key='TransactionNumber'>{{ $test_package->paymentTransaction->ExternalTransactionID }}</td>
                                        <td field-key='Status'> {{ $test_package->paymentTransaction->status->StatusName }}
                                        </td>
                                        <td field-key='PaymentDate'>{{date('Y-m-d h:i:s a', strtotime($test_package->paymentTransaction->PaymentDate))}}</td>
                                        <td>
                                            <a href="{{ route('invoice_detail',[$test_package->InvoiceID]) }}" class="btn btn-sm btn-info" target="_blank">@lang('admin.ca_view')</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">@lang('admin.ca_no_entries_in_table')</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('javascript')
    <!-- Highcharts JS -->
    <script src="{{asset('adminlte/plugins/highcharts/code/highcharts.js')}}"></script>
    <script type="text/javascript">
        $.ajax({
            url:"{{route('transaction_ajaxget')}}",
            type:'GET',
            success:function(data) {
                if(data.success) {
                    var chart_date = [];
                    var chart_total = [];
                    var date = data.data.date;
                    var total = data.data.total;

                    $.each(date , function(index, val) { 
                      chart_date.push(parseInt(val));
                    });

                    $.each(total , function(index, val) { 
                      chart_total.push(parseInt(val));
                    });

                    $('#chart_plot_trans').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Date wise total sales'
                        },
                        xAxis: {
                            categories: date
                        },
                        yAxis: {
                            title: {
                                text: 'Total Sale'
                            }
                        },
                        legend: {
                            enabled: true
                        },
                        credits:{
                          enabled:false,
                        },
                        tooltip: {
                            pointFormat: 'Total sale: Rs <b>{point.y:.1f}</b>'
                        },
                        series: [{
                            name: 'Sale',
                            data: chart_total
                        }]
                    })
                }
            },
        });
    </script>
@endsection