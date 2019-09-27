@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.board_standard_subjects.title')</h3>
    <div class="col-md-12 m-b-10">
        <a href="{{ route('boardStandardSubjects.create') }}" class="btn btn-success f-right">@lang('admin.ca_add_new')</a>
    </div>

    <div class="col-md-12 panel panel-default p-0">
        <div class="panel-heading">
            @lang('admin.ca_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($board_standard_subjects) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr class="thead-color">
                        <th>@lang('admin.board_standard_subjects.fields.board-name')</th>
                        <th>@lang('admin.board_standard_subjects.fields.standard-name')</th>
                        <th>@lang('admin.board_standard_subjects.fields.subject-name')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($board_standard_subjects) > 0)
                        @foreach ($board_standard_subjects as $board_standard_subject)
                            <tr data-entry-id="{{ $board_standard_subject->BoardStandardSubjectID }}">
                                <td field-key='BoardName'>{{ $board_standard_subject->board->BoardName }}</td>
                                <td field-key='StandardName'>{{ $board_standard_subject->standard->StandardName }}</td>
                                <td field-key='SubjectName'>{{ $board_standard_subject->subject->SubjectName }}</td>
                                <td>
                                    <a href="{{ route('boardStandardSubjects.edit',[$board_standard_subject->BoardStandardSubjectID]) }}" class="btn btn-sm btn-info">@lang('admin.ca_edit')</a>
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
