<table class="width-100">
    @php
        $a = 1; 
    @endphp

    @if (isset($answer)) 
        @foreach ($answer as $ans) 

            <tr>
                <td>
                    <label class="form-label" >
                    {!! Form::radio('OptionValue[]', $a++, ($ans->IsCorrectAnswer == 1) ? true : false, ['class' => '', 'required' => 'required']) !!}
                    </label>
                </td>
                <td>&nbsp; {!! Form::textarea('OptionText[]', $ans->MCQAText, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!} &nbsp;</td>
            </tr>

        @endforeach
    @else 
        @for ($a=1;$a<=4;$a++)

            <tr>
                <td>
                    <label class="form-label" >
                    {!! Form::radio('OptionValue[]', $a, false, ['class' => '', 'required' => 'required']) !!}
                    </label>
                </td>
                <td>&nbsp; {!! Form::textarea('OptionText[]', old('OptionText[]'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!} &nbsp;</td>
            </tr>

        @endfor 
    @endif
</table>