@foreach ($sections as $section)
<div class="panel panel-default border-panel mb-0 box-shadow">
    <div id="" class="panel-heading panel-head">
        <div class="col-lg-6 col-md-6 col-sm-12 pa-0">
            <label class="control-label">{{ $section->SectionName }}</label>
        </div>
        @if (isset($section->questionTypes))
        @foreach($section->questionTypes as $questionType)
            @php
                $count = 0;
            @endphp
        <div class="col-lg-6 col-md-6 col-sm-12 text-right float-right">
            Total Marks  :<span id="">{{$questionType->NumberofQuestion * $questionType->QuestionMarks}}</span>
        </div>
        <div class="clearfix"></div>
        <input type="button" name="" value="{{$questionType->questionType->QuestionTypeName}}  [{{$questionType->testQuestion->count()}}/{{$questionType->NumberofQuestion}}]" id="" class="btn btn-tc btn-rounded btn-sm mr-10 mt-10 pull-left p-3-15" data-toggle="modal" {{($questionType->testQuestion->count() < $questionType->NumberofQuestion) ? 'data-target=#addQuestion' : ""}} data-qtID="{{$questionType->questionType->QuestionTypeID}}" data-tsqtID="{{$questionType->TestSectionQuestionTypeID}}" data-testID="{{$section->TestPackageTestID}}">
        <a href="#" data-toggle="modal" data-tsqtID="{{$questionType->TestSectionQuestionTypeID}}" data-testID="{{$section->TestPackageTestID}}" data-target="#deleteSection" class="btn-link pull-right"><i class="fa fa-close"></i>{{trans('admin.ca_delete')}}</a>
        <div class="clearfix"></div>
        <div>
            <table class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action">
            @foreach($questionType->testQuestion as $question)
                <tr>
                    <td style="width: 70%">
                    @if ($question->question->QuestionImage)
                    <img src="{{ Config::get('settings.QUESTION_IMAGE_URL').$question->question->QuestionImage }}"/>
                    @else
                    {!! $question->question->QuestionText !!} 
                    @endif
                    </td>
                    <td style="width: 10%"> {!! $question->question->Marks !!} </td>
                    <td style="width: 10%"> <i data-toggle="modal" data-qID="{{$question->QuestionID}}" data-target="#viewQuestion" class="fa fa-eye pointer-cursor"></i> </td>
                    <td style="width: 10%"> <a href="#" data-toggle="modal" data-tqID="{{$question->TestQuestionManualID}}" data-target="#deleteQuestion" class="btn-link pull-right" data-testID="{{$section->TestPackageTestID}}"><i class="fa fa-close"></i></a> </td>
                </tr>
            @endforeach
            </table>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endforeach