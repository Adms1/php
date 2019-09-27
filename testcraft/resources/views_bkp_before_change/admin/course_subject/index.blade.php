@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.course_subjects.title')</h3>
    <div class="col-md-12 m-b-10">
        <a href="{{ route('courseSubjects.create') }}" class="btn btn-success f-right">@lang('admin.ca_add_new')</a>
    </div>

    <div class="col-md-12 panel panel-default p-0">
        <div class="panel-heading">
            @lang('admin.ca_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($course_subjects) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr class="thead-color">
                        <th>@lang('admin.course_subjects.fields.course-name')</th>
                        <th>@lang('admin.course_subjects.fields.subject-name')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($course_subjects) > 0)
                        @foreach ($course_subjects as $course_subject)
                            <tr data-entry-id="{{ $course_subject->CourseSubjectID }}">
                                <td field-key='CourseName'>{{ $course_subject->course->CourseName }}</td>
                                <td field-key='SubjectName'>{{ $course_subject->subject->SubjectName }}</td>
                                <td>
                                    <a href="{{ route('courseSubjects.edit',[$course_subject->CourseSubjectID]) }}" class="btn btn-sm btn-info">@lang('admin.ca_edit')</a>
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
