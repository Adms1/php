@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.users.title')</h3>
    <div class="col-md-12 m-b-10">
        <a href="{{ route('users.create') }}" class="btn btn-success f-right">@lang('admin.ca_add_new')</a>
    </div>

    <div class="col-md-12 panel panel-default p-0">
        <div class="panel-heading">
            @lang('admin.ca_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr class="thead-color">
                        <th>@lang('admin.users.fields.name')</th>
                        <th>@lang('admin.users.fields.email')</th>
                        <th>@lang('admin.users.fields.type')</th>
                        <th>@lang('admin.users.fields.is-active')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <tr data-entry-id="{{ $user->UserID }}">
                                <td field-key='UserFullName'>{{ $user->UserFullName }}</td>
                                <td field-key='UserEmail'>{{ $user->UserEmail }}</td>
                                <td field-key='UserType'>{{ $user->userType->UserTypeName }}</td>
                                <td field-key='IsActive'>
                                    <span class="badge btn-{{ ($user->IsActive == 1) ? 'success' : 'danger'}}">
                                        {{ ($user->IsActive == 1) ? 'Active' : 'In-Active'}}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('users.edit',[$user->UserID]) }}" class="btn btn-sm btn-info">@lang('admin.ca_edit')</a>
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
