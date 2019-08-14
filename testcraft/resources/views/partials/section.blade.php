@foreach ($sections as $section)
<div class="panel panel-default border-panel mb-0 box-shadow">
    <div id="" class="panel-heading panel-head">
        <input type="hidden" name="" id="" value="30277">
        <div class="col-lg-6 col-md-6 col-sm-12 pa-0">
            <label class="control-label">{{ $section->SectionName }}</label>
        </div>
        @if (isset($section->questionTypes) && count(isset($section->questionTypes)) > 0)
        @foreach($section->questionTypes as $questionType)
        <div class="col-lg-6 col-md-6 col-sm-12 text-right float-right">
            Total Marks  :<span id="">{{$questionType->NumberofQuestion * $questionType->QuestionMarks}}</span>
            | Remain Marks:<span id="">10</span>
        </div>
        <div class="clearfix"></div>
        <input type="button" name="" value="{{$questionType->questionType->QuestionTypeName}}  [10/{{$questionType->NumberofQuestion}}]" id="" class="btn btn-tc btn-rounded btn-sm mr-10 mt-10 pull-left p-3-15" data-toggle="modal" data-target="#addQuestion" data-qtID="{{$questionType->questionType->QuestionTypeID}}" data-testID="{{$section->TestPackageTestID}}">
        <a href="#" data-toggle="modal" data-tsqtID="{{$questionType->TestSectionQuestionTypeID}}" data-testID="{{$section->TestPackageTestID}}" data-target="#deleteSection" class="btn-link pull-right"><i class="fa fa-close"></i>{{trans('admin.ca_delete')}}</a>
        <div class="clearfix"></div>
        @endforeach
        @endif
    </div>
</div>
@endforeach