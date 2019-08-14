@extends('layouts.app')

@section('content')
	<h3 class="page-title">@lang('admin.ca_change_password')</h3>

	@if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>@lang('admin.ca_whoops')</strong> @lang('admin.ca_there_were_problems_with_input'):
            <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            <strong>@lang('admin.ca_whoops')</strong> 
            <ul class="list-unstyled">
                <li>
                    <p>{{ Session::get('error') }}</p>
                </li>
            </ul>
        </div>
    @endif

	{!! Form::open(['method' => 'PATCH', 'route' => ['change_password']]) !!}
	<!-- If no success message in flash session show change password form  -->
	<div class="panel panel-default">
		<div class="panel-heading">
			@lang('admin.ca_edit')
		</div>

		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12 form-group">
					{!! Form::label('current_password', trans('admin.ca_current_password'), ['class' => 'control-label']) !!}
					{!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('current_password'))
						<p class="help-block">
							{{ $errors->first('current_password') }}
						</p>
					@endif
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 form-group">
					{!! Form::label('new_password', trans('admin.ca_new_password'), ['class' => 'control-label']) !!}
					{!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('new_password'))
						<p class="help-block">
							{{ $errors->first('new_password') }}
						</p>
					@endif
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 form-group">
					{!! Form::label('new_password_confirmation', trans('admin.ca_password_confirm'), ['class' => 'control-label']) !!}
					{!! Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('new_password_confirmation'))
						<p class="help-block">
							{{ $errors->first('new_password_confirmation') }}
						</p>
					@endif
				</div>
			</div>
		</div>
	</div>

	{!! Form::submit(trans('admin.ca_submit'), ['class' => 'btn btn-success']) !!}
	{!! Form::close() !!}
@stop

