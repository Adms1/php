@foreach ($questions as $question)
<tr>
    <td class="text-center vertical-top">
        <span><input id="{!! $question->QuestionID !!}" value="{!! $question->QuestionID !!}" type="checkbox" name="queSelect[]"></span>
    </td>
    <td>
        {!! $question->QuestionText !!}
    </td>
    <td class="text-center vertical-top">
        <i class="fa fa-eye font-20 pointer-cursor" onclick=""></i>
    </td>
</tr>
@endforeach