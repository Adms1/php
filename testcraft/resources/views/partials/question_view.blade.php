<div class="row">
    <div class="col-xs-6">
        <!-- <p>
            {!! Form::label('TestName', trans('admin.tests.fields.name').':', ['class' => 'control-label']) !!}
            {!! $test->TestName!!}
        </p> -->
        <p>
            {!! Form::label('TestDuration', trans('admin.tests.fields.duration').':', ['class' => 'control-label']) !!}
            {!! $test->TestDuration !!}
        </p>
        <p>
            {!! Form::label('DifficultyLevelID', trans('admin.tests.fields.difficulty-level').':', ['class' => 'control-label']) !!}
            {!! $test->difficultyLevel->DLName !!}
        </p>
        <p>
            {!! Form::label('NumberofQuestion', trans('admin.tests.fields.question').':', ['class' => 'control-label']) !!}
            {!! $test->NumberofQuestion !!}
        </p>
        <p>
            {!! Form::label('TestMarks', trans('admin.tests.fields.marks').':', ['class' => 'control-label']) !!}
            {!! $test->TestMarks !!}
        </p>
    </div>
    <div class="col-xs-12">
        @if (count($assigned) > 0 )
            @if (isset($assign->subject))
                <p><h4>{{trans('admin.ca_cp')}}</h4></p>
            @else
                <p><h4>{{trans('admin.ca_st')}}</h4></p>
            @endif
            
        <table id="tabel_tp_detail" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
            <thead>
                <tr class="thead-color">
                    <th class="">{{trans('admin.ca_name')}}</th>
                    <th class="width-25">{{trans('admin.test_chapter_topic.fields.weightage')}}</th>
                </tr>
            </thead>
            <tbody class="tp_detail row_position" id="assign-table">
                @foreach ($assigned as $assign)
                <tr class="mul_div">
                    <td>
                        @if (isset($assign->chapter))
                            {{$assign->chapter->ChapterName}}
                        @endif
                        &nbsp;
                        @if (isset($assign->subject))
                            {{$assign->subject->SubjectName}}
                        @endif
                        &nbsp;
                        @if (isset($assign->topic))
                            {{$assign->topic->TopicName}}
                        @endif
                    </td>
                    <td>
                        {{$assign->Weightage}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    <div class="col-xs-12">
        @if (count($sections) > 0 )
        <p><h4>{{trans('admin.ca_section')}}</h4></p>
        @foreach ($sections as $section)
        <div class="panel panel-default border-panel mb-0 box-shadow">
            <div id="" class="panel-heading panel-head">
                <div class="">
                    <label class="control-label">{{ $section->SectionName }}</label>
                </div>
                @if (isset($section->questionTypes))
                @foreach($section->questionTypes as $questionType)
                <div class="col-lg-6 col-md-6 col-sm-12 pa-0">
                    {{$questionType->questionType->QuestionTypeName}}
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-right float-right">
                    Total Marks  :<span id="">{{$questionType->NumberofQuestion * $questionType->QuestionMarks}}</span>
                </div>
                <div class="clearfix"></div>
                @endforeach
                @endif
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>