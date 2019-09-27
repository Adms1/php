@foreach ($assigned_st as $assign)
<tr class="mul_div">
    <td>
        @if (isset($assign->subject))
            {{$assign->subject->SubjectName}}
        @endif
        @if (isset($assign->topic))
            {{$assign->topic->TopicName}}
        @endif
    </td>
    <td>
        {{$assign->Weightage}}
    </td>
    <td>
        <a href="#" data-toggle="modal" data-tstID="{{$assign->TestSubjectTopicID}}" data-testID="{{$assign->TestPackageTestID}}" data-target="#deleteAssinged" class="btn btn-danger btn-xs deleteAssinged"><i class="fa fa-close"></i>{{trans('admin.ca_delete')}}</a>
    </td>
</tr>
@endforeach