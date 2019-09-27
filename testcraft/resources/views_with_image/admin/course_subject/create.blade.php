@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.course_subjects.title')</h3>
    
    {!! Form::open(['method' => 'POST', 'route' => ['courseSubjects.store'], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('admin.ca_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('CourseID', trans('admin.course_subjects.fields.course-name').'', ['class' => 'control-label']) !!}
                    {!! Form::select('CourseID', $courses, null, ['class' => 'form-control', 'required' => '']) !!}

                    @if($errors->has('CourseID'))
                        <p class="help-block">
                            {{ $errors->first('CourseID') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('SubjectID', trans('admin.course_subjects.fields.subject-name').'', ['class' => 'control-label']) !!}
                    {!! Form::select('SubjectID', $subjects, null, ['class' => 'form-control', 'required' => '']) !!}

                    @if($errors->has('SubjectID'))
                        <p class="help-block">
                            {{ $errors->first('SubjectID') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('admin.ca_submit'), ['class' => 'btn btn-success']) !!}
    <a href="{{ route('courseSubjects.index') }}" class="btn btn-info">@lang('admin.ca_cancel')</a>
    {!! Form::close() !!}
@stop