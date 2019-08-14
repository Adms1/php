<div class="width-100">
    <div class="form-group">
        <label class="form-label" >
            {!! Form::radio('IsTrue', '1', (isset($question->IsTrue) && $question->IsTrue == 1) ? true : false, ['class' => '', 'required' => 'required']) !!}
            &nbsp; {{trans('admin.ca_true')}} &nbsp;
        </label>
        
        <label class="form-label" >
            {!! Form::radio('IsTrue', '0', (isset($question->IsTrue) && $question->IsTrue == 0) ? false : true, ['class' => '', 'required' => 'required']) !!}
            &nbsp; {{trans('admin.ca_false')}} &nbsp;
        </label>

        @if($errors->has('IsTrue'))
            <p class="help-block">
                {{ $errors->first('IsTrue') }}
            </p>
        @endif
    </div>
</div>
