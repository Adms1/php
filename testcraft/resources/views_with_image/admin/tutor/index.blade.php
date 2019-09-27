@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.tutors.title')</h3>
    <div class="col-md-12 m-b-10">
        <a href="{{ route('tutors.create') }}" class="btn btn-success f-right">@lang('admin.ca_add_new')</a>
    </div>

    <div class="col-md-12 panel panel-default p-0">
        <div class="panel-heading">
            @lang('admin.ca_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($tutors) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr class="thead-color">
                        <th>@lang('admin.tutors.fields.name')</th>
                        <th>@lang('admin.tutors.fields.email')</th>
                        <th>@lang('admin.tutors.fields.phone')</th>
                        <th>@lang('admin.tutors.fields.is-active')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($tutors) > 0)
                        @foreach ($tutors as $tutor)
                            <tr data-entry-id="{{ $tutor->TutorID }}">
                                <td field-key='TutorName'>{{ $tutor->TutorFullName }}</td>
                                <td field-key='TutorEmail'>{{ $tutor->TutorEmail }}</td>
                                <td field-key='TutorType'>{{ $tutor->TutorPhoneNumber }}</td>
                                <td field-key='IsActive'>
                                    <span class="badge btn-{{ ($tutor->IsActive == 1) ? 'success' : 'danger'}}">
                                        {{ ($tutor->IsActive == 1) ? 'Active' : 'In-Active'}}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('tutors.edit',[$tutor->TutorID]) }}" class="btn btn-sm btn-info">@lang('admin.ca_edit')</a>
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
