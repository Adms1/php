@php
    $a = 0;
@endphp
@foreach ($tests as $test)
<tr class="mul_div">
    <td>
        {{++$a}}
    </td>
    <td>
        {{$test->TestName}}
    </td>
    <td>
        {{$test->TestMarks}}
    </td>
    <td>
        {{$test->TestDuration}}
    </td>
    <td>
        {{$test->NumberofQuestion}}
    </td>
    <td>
        {{$test->difficultyLevel->DLName}}
    </td>
    <td width="10%">
        <div class="dropdown">
            <div class="more-action dropdown-toggle" data-toggle="dropdown"></div>
            <ul class="dropdown-menu dropdown-menu-right">
                <!-- <li><a href="#" data-toggle="modal" data-testID="{{$test->TestPackageTestID}}" data-target="#addTopic" class="testid addTopic">{{trans('admin.ca_add_cp')}}</a></li>
                <li><a href="#" data-toggle="modal" data-testID="{{$test->TestPackageTestID}}" data-target="#addSection" class="testid addSection">{{trans('admin.ca_add_section')}}</a></li> -->
                <!-- <li><a href="#" data-toggle="modal" data-testID="{{$test->TestPackageTestID}}" data-target="#addQuestion" class="testid">{{trans('admin.ca_add_question')}}</a></li> -->
                <li><a href="{{route('test_edit', [$test->TestPackageID, $test->TestPackageTestID])}}" class="testid" id="testEdit">{{trans('admin.ca_edit')}}</a></li>
                <li><a href="#" data-toggle="modal" data-testID="{{$test->TestPackageTestID}}" data-packageID="{{$test->TestPackageID}}" data-target="#testDelete" class="testid">{{trans('admin.ca_delete')}}</a></li>
            </ul>
        </div>
    </td>
</tr>
@endforeach