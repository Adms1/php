<div class="width-100">
    {!! Form::textarea('OptionText[]', isset($answer->FIBText) ? $answer->FIBText : old('OptionText'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
</div>
