@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.board_standard_subjects.title')</h3>
    
    {!! Form::open(['method' => 'POST', 'route' => ['boardStandardSubjects.store'], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('admin.ca_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('BoardID', trans('admin.board_standard_subjects.fields.board-name').'', ['class' => 'control-label']) !!}
                    {!! Form::select('BoardID', $boards, null, ['class' => 'form-control', 'required' => '']) !!}

                    @if($errors->has('BoardID'))
                        <p class="help-block">
                            {{ $errors->first('BoardID') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('StandardID', trans('admin.board_standard_subjects.fields.standard-name').'', ['class' => 'control-label']) !!}
                    {!! Form::select('StandardID', $standards, null, ['class' => 'form-control', 'required' => '']) !!}

                    @if($errors->has('StandardID'))
                        <p class="help-block">
                            {{ $errors->first('StandardID') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('SubjectID', trans('admin.board_standard_subjects.fields.subject-name').'', ['class' => 'control-label']) !!}
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
    <a href="{{ route('boardStandardSubjects.index') }}" class="btn btn-info">@lang('admin.ca_cancel')</a>
    {!! Form::close() !!}
@stop