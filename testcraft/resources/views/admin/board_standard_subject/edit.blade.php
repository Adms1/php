@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.board_standard_subjects.title')</h3>
    
    {!! Form::model($board_standard_subject, ['method' => 'PUT', 'route' => ['boardStandardSubjects.update', $board_standard_subject->BoardStandardSubjectID], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('admin.ca_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('BoardID', trans('admin.board_standard_subjects.fields.board-name').'', ['class' => 'control-label']) !!}
                    {!! Form::select('BoardID', $boards, $board_standard_subject->BoardID, ['class' => 'form-control', 'required' => '']) !!}

                    @if($errors->has('BoardID'))
                        <p class="help-block">
                            {{ $errors->first('BoardID') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('StandardID', trans('admin.board_standard_subjects.fields.standard-name').'', ['class' => 'control-label']) !!}
                    {!! Form::select('StandardID', $standards, $board_standard_subject->StandardID, ['class' => 'form-control', 'required' => '']) !!}

                    @if($errors->has('StandardID'))
                        <p class="help-block">
                            {{ $errors->first('StandardID') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('SubjectID', trans('admin.board_standard_subjects.fields.subject-name').'', ['class' => 'control-label']) !!}
                    {!! Form::select('SubjectID', $subjects, $board_standard_subject->SubjectID, ['class' => 'form-control', 'required' => '']) !!}

                    @if($errors->has('SubjectID'))
                        <p class="help-block">
                            {{ $errors->first('SubjectID') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('admin.ca_update'), ['class' => 'btn btn-success']) !!}
    <a href="{{ route('boardStandardSubjects.index') }}" class="btn btn-info">@lang('admin.ca_cancel')</a>
    {!! Form::close() !!}
@stop