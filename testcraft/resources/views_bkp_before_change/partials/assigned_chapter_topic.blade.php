@foreach ($assigned_ct as $assign)
<tr class="mul_div">
    <td>
        @if (isset($assign->chapter))
            {{$assign->chapter->ChapterName}}
        @endif
        @if (isset($assign->topic))
            {{$assign->topic->TopicName}}
        @endif
    </td>
    <td>
        {{$assign->Weightage}}
    </td>
    <td>
        @if (isset($assigned_ct->test) && $assigned_ct->test->StatusID != 9)
            <a href="#" data-toggle="modal" data-tctID="{{$assign->TestChapterTopicID}}" data-testID="{{$assign->TestPackageTestID}}" data-target="#deleteAssinged" class="btn btn-danger btn-xs deleteAssinged"><i class="fa fa-close"></i>{{trans('admin.ca_delete')}}</a>
        @endif
    </td>
</tr>
@endforeach