@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.questions.title')</h3>
    <div class="col-md-12 m-b-10">
        <a href="{{ route('questions.create') }}" class="btn btn-success f-right">@lang('admin.ca_add_new')</a>
    </div>

    <div class="col-md-12 panel panel-default p-0">
        <div class="panel-heading">
            @lang('admin.ca_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($questions) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr class="thead-color">
                        <th>@lang('admin.questions.fields.name')</th>
                        <th>@lang('admin.questions.fields.is-active')</th>
                        <th class="no-sort">@lang('admin.ca_action')</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($questions) > 0)
                        @foreach ($questions as $question)
                            <tr data-entry-id="{{ $question->QuestionID }}">
                                <td field-key='QuestionText'>
                                @if ($question->QuestionImage)
                                <img src="{{ Config::get('settings.QUESTION_IMAGE_URL').$question->QuestionImage }}"/>
                                @else
                                {!! $question->QuestionText !!}
                                @endif
                                </td>
                                <td field-key='IsActive'>
                                    <span class="badge btn-{{ ($question->IsActive == 1) ? 'success' : 'danger'}}">
                                        {{ ($question->IsActive == 1) ? 'Active' : 'In-Active'}}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('questions.edit',[$question->QuestionID]) }}" class="btn btn-sm btn-info">@lang('admin.ca_edit')</a>
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
