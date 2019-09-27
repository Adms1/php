@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.test_types.title')</h3>

    <div class="col-md-12 panel panel-default p-0">
        <div class="panel-heading">
            @lang('admin.ca_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($test_types) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr class="thead-color">
                        <th>@lang('admin.test_types.fields.name')</th>
                        <th>@lang('admin.test_types.fields.is-active')</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($test_types) > 0)
                        @foreach ($test_types as $test_type)
                            <tr data-entry-id="{{ $test_type->TestTypeID }}">
                                <td field-key='TestTypeName'>{{ $test_type->TestTypeName }}</td>
                                <td field-key='IsActive'>
                                    <span class="badge btn-{{ ($test_type->IsActive == 1) ? 'success' : 'danger'}}">
                                        {{ ($test_type->IsActive == 1) ? 'Active' : 'In-Active'}}
                                    </span>
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
