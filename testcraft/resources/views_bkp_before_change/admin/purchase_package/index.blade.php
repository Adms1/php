@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.purchase_packages.title')</h3>

    <div class="col-md-12 panel panel-default p-0">
        <div class="panel-heading">
            @lang('admin.ca_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($purchase_packages) > 0 ? 'datatable' : '' }}">
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
                                <td field-key='PaymentDate'>{{ $test_package->paymentTransaction->PaymentDate }}</td>
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
@stop
