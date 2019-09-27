<div class="width-100">
    <!-- {!! Form::textarea('OptionText[]', isset($answer->INTText) ? $answer->INTText : old('OptionText'), ['class' => 'form-control', 'placeholder' => '']) !!} -->
    @if (isset($answer)) 
    	<div class="col-xs-6 form-group">
	        {!! Form::label('MinValue', trans('admin.questions.fields.min').'*', ['class' => 'control-label']) !!}
	        {!! Form::text('MinValue', $answer->MinValue, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-le'=>'#MaxValue', 'data-parsley-pattern' => '^-?[0-9]\d*(\.\d+)?$']) !!}
	        @if($errors->has('MinValue'))
	            <p class="help-block">
	                {{ $errors->first('MinValue') }}
	            </p>
	        @endif
	    </div>
	    <div class="col-xs-6 form-group">
	        {!! Form::label('MaxValue', trans('admin.questions.fields.max').'*', ['class' => 'control-label']) !!}
	        {!! Form::text('MaxValue', $answer->MaxValue, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-ge'=>'#MinValue', 'data-parsley-pattern' => '^-?[0-9]\d*(\.\d+)?$']) !!}

	        @if($errors->has('MaxValue'))
	            <p class="help-block">
	                {{ $errors->first('MaxValue') }}
	            </p>
	        @endif
	    </div>
    @else 
    	<div class="col-xs-6 form-group">
	        {!! Form::label('MinValue', trans('admin.questions.fields.min').'*', ['class' => 'control-label']) !!}
	        {!! Form::text('MinValue', old('MinValue'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-le'=>'#MaxValue', 'data-parsley-pattern' => '^-?[0-9]\d*(\.\d+)?$']) !!}

	        @if($errors->has('MinValue'))
	            <p class="help-block">
	                {{ $errors->first('MinValue') }}
	            </p>
	        @endif
	    </div>
	    <div class="col-xs-6 form-group">
	        {!! Form::label('MaxValue', trans('admin.questions.fields.max').'*', ['class' => 'control-label']) !!}
	        {!! Form::text('MaxValue', old('MaxValue'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-ge'=>'#MinValue', 'data-parsley-pattern' => '^-?[0-9]\d*(\.\d+)?$']) !!}

	        @if($errors->has('MaxValue'))
	            <p class="help-block">
	                {{ $errors->first('MaxValue') }}
	            </p>
	        @endif
	    </div>
    @endif
</div>
