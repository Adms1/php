@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.user_types.title')</h3>
    
    {!! Form::open(['method' => 'POST', 'route' => ['userTypes.store'], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('admin.ca_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('UserTypeName', trans('admin.user_types.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('UserTypeName', old('UserTypeName'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('UserTypeName'))
                        <p class="help-block">
                            {{ $errors->first('UserTypeName') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('UserLevel', trans('admin.user_types.fields.level').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('UserLevel', old('UserLevel'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('UserLevel'))
                        <p class="help-block">
                            {{ $errors->first('UserLevel') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('IsActive', trans('admin.user_types.fields.is-active'), ['class' => 'control-label']) !!}
                    <div class="btn-group width-100" id="status" data-toggle="buttons">
                        <label class="btn btn-default btn-on active" >
                        <input type="radio" value="1" name="IsActive" checked="checked">YES</label>
                        <label class="btn btn-default btn-off">
                        <input type="radio" value="0" name="IsActive">NO</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('admin.ca_submit'), ['class' => 'btn btn-success']) !!}
    <a href="{{ route('userTypes.index') }}" class="btn btn-info">@lang('admin.ca_cancel')</a>
    {!! Form::close() !!}
@stop
