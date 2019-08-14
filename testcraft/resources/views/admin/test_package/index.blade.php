@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.test_packages.title')</h3>
    <div class="col-md-12 m-b-10">
        <a href="{{ route('testPackages.create') }}" class="btn btn-success f-right">@lang('admin.ca_add_new')</a>
    </div>

    <div class="col-md-12 panel panel-default p-0">
        <div class="panel-heading">
            @lang('admin.ca_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($test_packages) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr class="thead-color">
                        <th>@lang('admin.test_packages.fields.name')</th>
                        <th>@lang('admin.test_packages.fields.is-active')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($test_packages) > 0)
                        @foreach ($test_packages as $test_package)
                            <tr data-entry-id="{{ $test_package->TestPackageID }}">
                                <td field-key='TestPackageName'>{{ $test_package->TestPackageName }}</td>
                                <td field-key='IsActive'>
                                    <span class="badge btn-{{ ($test_package->IsActive == 1) ? 'success' : 'danger'}}">
                                        {{ ($test_package->IsActive == 1) ? 'Active' : 'In-Active'}}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('testPackages.edit',[$test_package->TestPackageID]) }}" class="btn btn-sm btn-info">@lang('admin.ca_edit')</a>
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
