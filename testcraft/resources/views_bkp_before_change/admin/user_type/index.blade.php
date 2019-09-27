@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.user_types.title')</h3>
    <div class="col-md-12 m-b-10">
        <a href="{{ route('userTypes.create') }}" class="btn btn-success f-right">@lang('admin.ca_add_new')</a>
    </div>

    <div class="col-md-12 panel panel-default p-0">
        <div class="panel-heading">
            @lang('admin.ca_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($user_types) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr class="thead-color">
                        <th>@lang('admin.user_types.fields.name')</th>
                        <th>@lang('admin.user_types.fields.is-active')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($user_types) > 0)
                        @foreach ($user_types as $user_type)
                            <tr data-entry-id="{{ $user_type->UserTypeID }}">
                                <td field-key='UserTypeName'>{{ $user_type->UserTypeName }}</td>
                                <td field-key='IsActive'>
                                    <span class="badge btn-{{ ($user_type->IsActive == 1) ? 'success' : 'danger'}}">
                                        {{ ($user_type->IsActive == 1) ? 'Active' : 'In-Active'}}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('userTypes.edit',[$user_type->UserTypeID]) }}" class="btn btn-sm btn-info">@lang('admin.ca_edit')</a>
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
