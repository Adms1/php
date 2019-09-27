@extends('layouts.app')

@section('content')
    <div class="col-md-12 m-b-10">
        <span class="col-md-10"><h3 class="page-title">{{ $test_package->TestPackageName }}</h3></span>
        <span class="col-md-2 p-t-16">
            @if ($test->StatusID == 9)
                <button class="btn btn-success ">Published</button>
            @else
                <a href="{{ route('test_publish', [$test_package->TestPackageID, $test->TestPackageTestID]) }}" class="btn btn-info ">Publish</a>
            @endif
            <a href="{{ route('testPackages.edit', [$test_package->TestPackageID, 'tab' => 'test']) }}" class="btn btn-info float-right">Back</a>
        </span>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12 panel panel-default p-0">
                <div class="row">
                    <div class="col-xs-12 panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading test2">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse0">
                                    <h4 class="panel-title color-white">
                                        {{ trans('admin.ca_add_test') }}
                                    </h4>
                                </a>
                            </div>
                            <div id="collapse0" class="panel-collapse collapse in">
                                <div class="panel-body" id="test-panel">
                                    {!! Form::open(['method' => 'PUT', 'id' => 'testForm', 'route' => ['test_update', $test->TestPackageTestID], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                                    {!! Form::hidden('TestPackageID', $test->TestPackageID, ['class' => 'form-control', 'id' => 'package_id', 'placeholder' => '', 'required' => '']) !!}
                                    <div class="row">
                                        <div class="col-xs-12 form-group">
                                            {!! Form::label('TestName', trans('admin.tests.fields.name').'*', ['class' => 'control-label']) !!}
                                            {!! Form::text('TestName', $test->TestName, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                                            @if($errors->has('TestName'))
                                                <p class="help-block">
                                                    {{ $errors->first('TestName') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 form-group">
                                            {!! Form::label('TestDuration', trans('admin.tests.fields.duration').'*', ['class' => 'control-label']) !!}
                                            {!! Form::text('TestDuration', $test->TestDuration, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-type'=>'digits', 'min'=>'1']) !!}

                                            @if($errors->has('TestDuration'))
                                                <p class="help-block">
                                                    {{ $errors->first('TestDuration') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-xs-6 form-group">
                                            {!! Form::label('DifficultyLevelID', trans('admin.tests.fields.difficulty-level').'*', ['class' => 'control-label']) !!}
                                            {!! Form::select('DifficultyLevelID', $dif_levels, $test->DifficultyLevelID,['class' => 'form-control', 'placeholder' => 'Please Select Difficulty Level', 'required' => '']) !!}

                                            @if($errors->has('DifficultyLevelID'))
                                                <p class="help-block">
                                                    {{ $errors->first('DifficultyLevelID') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-xs-6 form-group">
                                            {!! Form::label('NumberofQuestion', trans('admin.tests.fields.question').'*', ['class' => 'control-label']) !!}
                                            {!! Form::text('NumberofQuestion', $test->NumberofQuestion, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                                            @if($errors->has('NumberofQuestion'))
                                                <p class="help-block">
                                                    {{ $errors->first('NumberofQuestion') }}
                                                </p>
                                            @endif
                                        </div> -->
                                        <div class="col-xs-6 form-group">
                                            {!! Form::label('TestMarks', trans('admin.tests.fields.marks').'*', ['class' => 'control-label']) !!}
                                            {!! Form::text('TestMarks', $test->TestMarks, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-type'=>'digits', 'min'=>'1']) !!}

                                            @if($errors->has('TestMarks'))
                                                <p class="help-block">
                                                    {{ $errors->first('TestMarks') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    @if ($test->StatusID != 9)
                                        {!! Form::submit(trans('admin.ca_submit'), ['class' => 'btn btn-success float-right']) !!}
                                    @endif
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading test2">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    <h4 class="panel-title color-white">
                                        {{ trans('admin.ca_add_st') }}
                                    </h4>
                                </a>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    @if ($test->StatusID != 9)
                                    {!! Form::open(['method' => 'POST', 'id' => 'assignForm', 'route' => ['assign_st'], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                                    {!! Form::hidden('TestPackageTestID', $test->TestPackageTestID, ['class' => 'form-control', 'id' => 'test_id', 'placeholder' => '', 'required' => '']) !!}
                                    {!! Form::hidden('TestPackageID', $test->TestPackageID, ['class' => 'form-control', 'id' => 'package_id', 'placeholder' => '', 'required' => '']) !!}
                                    <div class="row">
                                        <div class="col-xs-3 form-group">
                                            {!! Form::label('SubjectID', trans('admin.subjects.title').'*', ['class' => 'control-label']) !!}
                                            {!! Form::select('SubjectID', $subjects, null,['class' => 'form-control', 'id'=>'subject_id', 'placeholder' => 'Please Select Subject', 'required' => '']) !!}

                                            @if($errors->has('SubjectID'))
                                                <p class="help-block">
                                                    {{ $errors->first('SubjectID') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-xs-3 form-group test-type">
                                            {!! Form::label('TopicID', trans('admin.topics.title').'*', ['class' => 'control-label', 'id' => 'TopicID']) !!}
                                            {!! Form::select('TopicID', [], null,['class' => 'form-control', 'id' => 'type_id','placeholder' => 'Please Select Topic', 'required' => '', 'data-parsley-errors-container' => '#type_id_error']) !!}

                                            <p id="type_id_error" class="help-block">
                                            @if($errors->has('TopicID'))
                                                {{ $errors->first('TopicID') }}
                                            @endif
                                            </p>
                                        </div>
                                        <div class="col-xs-3 form-group">
                                            {!! Form::label('Weightage', trans('admin.test_subject_topic.fields.weightage').'*', ['class' => 'control-label']) !!}
                                            {!! Form::text('Weightage', old('Weightage'), ['class' => 'form-control', 'placeholder' => 'Weightage', 'required' => '',  'max'=>'100', 'min'=> '1', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

                                            @if($errors->has('Weightage'))
                                                <p class="help-block">
                                                    {{ $errors->first('Weightage') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-xs-3 form-group p-t-25">
                                            {!! Form::label('', '', ['class' => 'control-label']) !!}
                                            {!! Form::submit(trans('admin.ca_add'), ['class' => 'btn btn-success']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    @endif
                                    <div class="ln_solid"></div>
                                    <div class="help-block weightage-error"></div>
                                    <table id="tabel_tp_detail" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="thead-color">
                                                <th class="">{{trans('admin.ca_name')}}</th>
                                                <th class="width-25">{{trans('admin.test_chapter_topic.fields.weightage')}}</th>
                                                <th class="width-25">{{trans('admin.ca_action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tp_detail row_position" id="assign-table">
                                            {!! $assigned_view !!}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading test2">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                    <h4 class="panel-title color-white">
                                    {{ trans('admin.ca_add_section') }}
                                    </h4>
                                </a>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="col-md-12 m-b-10">
                                        <span class="col-md-6" id="remain_que_view">
                                            {!! $remain_que_view !!}
                                        </span>
                                        <span class="col-md-6"><b class="float-right">
                                            Total Marks : {{ $test->TestMarks }} | Remain Marks : <span class="remain_mark"> {{ $remain_marks }} </span></b>
                                        </span>
                                    </div>
                                    {!! Form::open(['method' => 'POST',  'id' => 'sectionFrom', 'route' => ['assign_ct'], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                                    {!! Form::hidden('TestPackageID', $test->TestPackageID, ['class' => 'form-control', 'id' => 'package_id', 'placeholder' => '', 'required' => '']) !!}
                                    {!! Form::hidden('TestPackageTestID', $test->TestPackageTestID, ['class' => 'form-control', 'id' => 'test_id', 'placeholder' => '', 'required' => '']) !!}
                                    <div class="row">
                                        <div class="col-xs-12 form-group">
                                            {!! Form::label('SectionName', trans('admin.ca_heading').'*', ['class' => 'control-label']) !!}
                                            {!! Form::text('SectionName', null, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                                            @if($errors->has('SectionName'))
                                                <p class="help-block">
                                                    {{ $errors->first('SectionName') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 form-group">
                                            {!! Form::label('SectionDescription', trans('admin.ca_section_description').'*', ['class' => 'control-label']) !!}
                                            {!! Form::textarea('SectionDescription', '', ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-3 form-group">
                                            {!! Form::label('QuestionTypeID', trans('admin.ca_question_type').'*', ['class' => 'control-label']) !!}
                                            {!! Form::select('QuestionTypeID', $question_types, null,['class' => 'form-control', 'placeholder' => 'Please Select Question Type', 'required' => '']) !!}

                                            @if($errors->has('QuestionTypeID'))
                                                <p class="help-block">
                                                    {{ $errors->first('QuestionTypeID') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-xs-4 form-group">
                                            {!! Form::label('QuestionMarks', trans('admin.ca_question_per_mark').'*', ['class' => 'control-label']) !!}
                                            {!! Form::text('QuestionMarks', old('QuestionMarks'), ['class' => 'form-control', 'placeholder' => 'Marks per question', 'required' => '', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

                                            @if($errors->has('QuestionMarks'))
                                                <p class="help-block">
                                                    {{ $errors->first('QuestionMarks') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-xs-3 form-group">
                                            {!! Form::label('NumberofQuestion', trans('admin.ca_total_question').'*', ['class' => 'control-label']) !!}
                                            {!! Form::text('NumberofQuestion', old('NumberofQuestion'), ['class' => 'form-control', 'placeholder' => 'Total Question', 'required' => '', 'data-parsley-type'=>'digits', 'min'=>'1']) !!}

                                            @if($errors->has('NumberofQuestion'))
                                                <p class="help-block">
                                                    {{ $errors->first('NumberofQuestion') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-xs-2 form-group p-t-25">
                                            {!! Form::label('', '', ['class' => 'control-label']) !!}
                                            @if ($test->StatusID != 9)
                                            {!! Form::submit(trans('admin.ca_add'), ['class' => 'btn btn-success']) !!}
                                            @endif
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="help-block mark-error"></div>
                                    <div id="section-table">
                                        {!! $sections_view !!}
                                    </div>
                                    <!-- <table id="tabel_tp_detail" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="thead-color">
                                                <th class="width-25">{{trans('admin.ca_heading')}}</th>
                                                <th class="width-25">{{trans('admin.ca_question_type')}}</th>
                                                <th class="width-25">{{trans('admin.ca_question_per_mark')}}</th>
                                                <th class="width-25">{{trans('admin.ca_total_mark')}}</th>
                                                <th class="width-25">{{trans('admin.ca_total_question')}}</th>
                                                <th class="width-25">{{trans('admin.ca_action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tp_detail row_position" id="section-table">
                                            {!! $sections_view !!}
                                        </tbody>
                                    </table> -->
                                </div>
                            </div>
                        </div>
                        <!-- <div class="panel panel-default">
                            <div class="panel-heading test2">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                    <h4 class="panel-title color-white">
                                        Questions
                                    </h4>
                                </a>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-15">
                                        <div class="panel panel-default border-panel mb-0 box-shadow">
                                            <div id="" class="panel-heading panel-head">
                                                <input type="hidden" name="" id="" value="30277">
                                                <div class="col-lg-6 col-md-6 col-sm-12 pa-0">
                                                    <label class="control-label">Section 1</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                                                    Total Marks  :<span id="">20</span>
                                                    | Remain Marks:<span id="">10</span>
                                                </div>
                                                <div class="clearfix"></div>
                                                <input type="button" name="" value="MCQ  [10/20]" id="" class="btn btn-tc btn-rounded btn-sm mr-10 mt-10 pull-left p-3-15" data-toggle="modal" data-target="#delete">
                                                <input type="button" name="" value="Clear" onclick="" id="" class="btn-link pull-right">
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="panel-wrapper collapse in">
                                            <table class="table  table-responsive border-none test">
                                                <tbody>
                                                    <tr>
                                                        <td id="" class="vt bordertest byellow w-10">
                                                            <input type="hidden" name="" id="" value="12368">
                                                            <input type="hidden" name="" id="" value="999">
                                                            <input type="hidden" name="" id="" value="1">
                                                            <input type="hidden" name="" id="" value="479184">
                                                            1
                                                        </td>
                                                        <td class="vt">
                                                            <div id="">
                                                                A mixture of sodium chloride and ammonium chloride both are of white colour. They can be separated by:
                                                                <div class="clearfix"></div>
                                                                <span id="" class="label label-info"></span>
                                                                <div class="clearfix"></div>
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="vt w-10">
                                                            <input name="" type="text" value="1" readonly="readonly" onchange="" id="" class="form-group text-center pa-0 mb-0 border-none w-20">
                                                        </td>
                                                        <td class="vt w-90">
                                                            <i class="fa fa-eye font-20 pointer-cursor txt-dark pull-right mr-5 ml-5" onclick=""></i>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="panel panel-default border-panel mb-0 box-shadow">
                                            <div id="" class="panel-heading panel-head">
                                                <input type="hidden" name="" id="" value="30278">
                                                <div class="col-lg-6 col-md-6 col-sm-12 pa-0">
                                                    <label class="control-label">Section 2</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 pa-0 text-right">
                                                    Total Marks  :<span id="">20</span>
                                                    | Remain Marks:<span id="">19</span>
                                                </div>
                                                <div class="clearfix"></div>
                                                <input type="button" name="" value="Fill In The Blank  [1/20]" onclick="" id="" class="btn btn-tc btn-rounded btn-sm mr-10 mt-10 pull-left p-3-15" data-toggle="modal" data-target="#delete">
                                                <input type="button" name="" value="Clear" onclick="" id="" class="btn-link pull-right">
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="panel-wrapper collapse in">
                                            <table class="table  table-responsive border-none test">
                                                <tbody>
                                                    <tr>
                                                        <td id="" class="vt bordertest bred w-10">
                                                            <input type="hidden" name="" id="" value="12367">
                                                            <input type="hidden" name="" id="" value="999">
                                                            <input type="hidden" name="" id="" value="2">
                                                            <input type="hidden" name="" id="" value="4451">
                                                            1
                                                        </td>
                                                        <td class="vt">
                                                            <div id="">
                                                                One nm is equal to _________ .
                                                                <div class="clearfix"></div>
                                                                <span id="" class="label label-info"></span>
                                                                <div class="clearfix"></div>
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="vt w-10">
                                                            <input name="" type="text" value="1" readonly="readonly" id="" class="form-group text-center pa-0 mb-0 border-none w-20">
                                                        </td>
                                                        <td class="vt w-90">
                                                            <i class="fa fa-eye font-20 pointer-cursor txt-dark pull-right mr-5 ml-5" onclick=""></i>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="panel panel-default border-panel mb-0 box-shadow">
                                            <div id="" class="panel-heading panel-head">
                                                <input type="hidden" name="" id="" value="30279">
                                                <div class="col-lg-6 col-md-6 col-sm-12 pa-0">
                                                    <label class="control-label">Section 3</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 pa-0 text-right">
                                                    Total Marks  :<span id="">10</span>
                                                    | Remain Marks:<span id="">10</span>
                                                </div>
                                                <div class="clearfix"></div>
                                                <input type="button" name="" value="True and False  [0/10]" id="" class="btn btn-tc btn-rounded btn-sm mr-10 mt-10 pull-left p-3-15" data-toggle="modal" data-target="#delete">
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="panel-wrapper collapse in">
                                            <table class="table  table-responsive border-none test">
                                                <tbody>
                                                    <tr>
                                                        <td id="ContentPlaceHolder1_rptSection_trque_2 border-0">No Record Found
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div> 
                </div>
            </div>
            <!--Test  Modal -->
            <!-- <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">

                    <div class="modal-content">
                        <div class="modal-header thead-color">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">{{trans('admin.ca_create_test')}}</h4>
                        </div>
                        <div class="modal-body">  
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> -->
            <!--Add Topic/Chapter Modal -->
            <!-- <div class="modal fade" id="addTopic" role="dialog">
                <div class="modal-dialog">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['method' => 'POST', 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                            {!! Form::hidden('PackageID', null, ['class' => 'form-control', 'id' => 'package_id', 'placeholder' => '', 'required' => '']) !!}
                            <div class="row">
                                <div class="col-xs-3 form-group">
                                    {!! Form::label('TestTypeID', trans('admin.test_types.title').'*', ['class' => 'control-label']) !!}
                                    {!! Form::select('TestTypeID', $test_types, null,['class' => 'form-control', 'id'=>'test_type_id', 'placeholder' => 'Please Select Test Type', 'required' => '']) !!}

                                    @if($errors->has('TestTypeID'))
                                        <p class="help-block">
                                            {{ $errors->first('TestTypeID') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-3 form-group">
                                    {!! Form::label('TypeID', trans('admin.test_types.title').'*', ['class' => 'control-label', 'id' => 'TypeID']) !!}
                                    {!! Form::select('TypeID', [], null,['class' => 'form-control', 'id' => 'type_id','placeholder' => 'Please Select Test Type', 'required' => '']) !!}

                                    @if($errors->has('TypeID'))
                                        <p class="help-block">
                                            {{ $errors->first('TypeID') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-3 form-group">
                                    {!! Form::label('Weightage', trans('admin.test_chapter_topic.fields.weightage').'*', ['class' => 'control-label']) !!}
                                    {!! Form::text('Weightage', old('Weightage'), ['class' => 'form-control', 'placeholder' => 'Weightage', 'required' => '', 'data-parsley-pattern' => '^[0-9]$']) !!}

                                    @if($errors->has('Weightage'))
                                        <p class="help-block">
                                            {{ $errors->first('Weightage') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-3 form-group p-t-25">
                                    {!! Form::label('', '', ['class' => 'control-label']) !!}
                                    {!! Form::submit(trans('admin.ca_add'), ['class' => 'btn btn-success']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <table id="tabel_tp_detail" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="width-25">{{trans('admin.test_types.title')}}</th>
                                        <th class="width-25">{{trans('admin.ca_name')}}</th>
                                        <th class="width-25">{{trans('admin.test_chapter_topic.fields.weightage')}}</th>
                                        <th class="width-25">{{trans('admin.ca_action')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="tp_detail row_position">
                                    <tr class="mul_div">
                                        <td>
                                            Topic
                                        </td>
                                        <td>
                                            Introduction
                                        </td>
                                        <td>
                                            80
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-xs delete">
                                                <i class="fa fa-check"></i> Edit 
                                            </a>
                                            <a class="btn btn-danger btn-xs delete">
                                                <i class="fa fa-close"></i> Delete 
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="mul_div">
                                        <td>
                                            Chapter
                                        </td>
                                        <td>
                                            Fundamental Mathematics
                                        </td>
                                        <td>
                                            20
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-xs delete">
                                                <i class="fa fa-check"></i> Edit 
                                            </a>
                                            <a class="btn btn-danger btn-xs delete">
                                                <i class="fa fa-close"></i> Delete 
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> -->
            <!--Add section Modal -->
            <!-- <div class="modal fade" id="addSection" role="dialog">
                <div class="modal-dialog">
                    
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::model(['method' => 'PUT', 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                            <div class="row">
                                <div class="col-xs-8 form-group">
                                    {!! Form::label('Heading', 'Heading'.'*', ['class' => 'control-label']) !!}
                                    {!! Form::text('Heading', null, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                                    @if($errors->has('Heading'))
                                        <p class="help-block">
                                            {{ $errors->first('Heading') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3 form-group">
                                    {!! Form::label('QuestionType', 'Question Type'.'*', ['class' => 'control-label']) !!}
                                    <select name="QuestionType" class="form-control">
                                        <option>MCQ</option>
                                        <option>MCQ2</option>
                                        <option>True/False</option>
                                    </select>

                                    @if($errors->has('QuestionType'))
                                        <p class="help-block">
                                            {{ $errors->first('QuestionType') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-3 form-group">
                                    {!! Form::label('Mark', 'Mark'.'*', ['class' => 'control-label']) !!}
                                    {!! Form::number('Mark', old('Mark'), ['class' => 'form-control', 'placeholder' => 'Marks per question', 'required' => '']) !!}

                                    @if($errors->has('Mark'))
                                        <p class="help-block">
                                            {{ $errors->first('Mark') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-3 form-group">
                                    {!! Form::label('TotalQuestion', 'TotalQuestion'.'*', ['class' => 'control-label']) !!}
                                    {!! Form::number('TotalQuestion', old('NumberofQuestion'), ['class' => 'form-control', 'placeholder' => 'Total Question', 'required' => '']) !!}

                                    @if($errors->has('TotalQuestion'))
                                        <p class="help-block">
                                            {{ $errors->first('TotalQuestion') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-3 form-group p-t-25">
                                    {!! Form::label('', '', ['class' => 'control-label']) !!}
                                    {!! Form::submit(trans('admin.ca_add'), ['class' => 'btn btn-success']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <table id="tabel_tp_detail" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="width-25">Heading Name</th>
                                        <th class="width-25">Question Type Name</th>
                                        <th class="width-25">Marks Per Question</th>
                                        <th class="width-25">Total Marks</th>
                                        <th class="width-25">Total Question</th>
                                        <th class="width-25">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="tp_detail row_position">
                                    <tr class="mul_div">
                                        <td>
                                            {{'Section 1'}}
                                        </td>
                                        <td>
                                            {{'MCQ'}}
                                        </td>
                                        <td>
                                            {{'1'}}
                                        </td>
                                        <td>
                                            {{'20'}}
                                        </td>
                                        <td>
                                            {{'20'}}
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-xs delete">
                                                <i class="fa fa-check"></i> Edit 
                                            </a>
                                            <a class="btn btn-danger btn-xs delete">
                                                <i class="fa fa-close"></i> Delete 
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> -->
            <!--Add Question Modal -->
<!--             <div class="modal fade" id="addQuestion" role="dialog">
                <div class="modal-dialog modal-lg">
                    
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <p>Some text in the modal.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> -->
            <!--add Question Modal -->
            <div class="modal fade" id="addQuestion" role="dialog">
                <div class="modal-dialog modal-lg">
                    
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="add-que-title"></h4>
                        </div>
                        <div class="modal-body table-scroll">
                            <div class="help-block question-error"></div>
                            {!! Form::open(['method' => 'POST', 'name' => 'questionFrom', 'id' => 'questionFrom', 'data-parsley-validate']) !!}
                            <div id="question-table"></div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit(trans('admin.ca_add_question'), ['class' => 'btn btn-success']) !!}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!--view question Modal -->
            <div class="modal fade" id="viewQuestion" role="dialog">
                <div class="modal-dialog">
                    
                    <div class="modal-content">
                        <div class="modal-header thead-color">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="que_header"></h4>
                        </div>
                        <div class="modal-body">
                            <b>Question</b>
                            <p id="que_name"></p>
                            <b>Hint</b>
                            <p id="que_hint"></p>
                            <b>Explaination</b>
                            <p id="que_explaination"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--delete assigned chapter/topic Modal -->
            <div class="modal fade" id="deleteAssinged" role="dialog">
                <div class="modal-dialog">
                    
                    <div class="modal-content">
                        <div class="modal-header thead-color">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">{{trans('admin.ca_delete_assign_st')}}</h4>
                        </div>
                        <div class="modal-body">
                            <p>{{trans('admin.ca_delete_confirmation')}}</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" onclick="" class="btn btn-success yes-delete-assinged">Yes</a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--delete section Modal -->
            <div class="modal fade" id="deleteSection" role="dialog">
                <div class="modal-dialog">
                    
                    <div class="modal-content">
                        <div class="modal-header thead-color">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">{{trans('admin.ca_delete_section')}}</h4>
                        </div>
                        <div class="modal-body">
                            <p>{{trans('admin.ca_delete_confirmation')}}</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" onclick="" class="btn btn-success yes-delete-section">Yes</a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--delete question Modal -->
            <div class="modal fade" id="deleteQuestion" role="dialog">
                <div class="modal-dialog">
                    
                    <div class="modal-content">
                        <div class="modal-header thead-color">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">{{trans('admin.ca_delete_question')}}</h4>
                        </div>
                        <div class="modal-body">
                            <p>{{trans('admin.ca_delete_confirmation')}}</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" onclick="" class="btn btn-success yes-delete-question">Yes</a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
<!-- ckeditor -->
<script type="text/javascript" src="https://kybarg.github.io/bootstrap-dropdown-hover/assets/bootstrap-dropdownhover/js/bootstrap-dropdownhover.js"></script>
<script src="{{asset('adminlte/plugins/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('adminlte/plugins/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
<script type="text/javascript">

    /**** Ckeditor ****/ 
    /*CKEDITOR.replace('TestPackageDescription', {
        height: 100
    });*/
    /***** Sorting for selection field *****/
    function sortingValue(data, textObj) {
        var temp = [];

        $.each(data, function(key, value) {
            temp.push({v:value, k: key});
        });

        temp.sort(function(a,b){
            if(a.v > b.v){ return 1}
            if(a.v < b.v){ return -1}
            return 0;
        });

        $.each(temp, function(key, obj) {
            textObj.append($("<option></option>").attr("value", obj.k).text(obj.v));
        });
    }


    /**** Show image preview ****/
    function handleFileSelect() {
        //Check File API support
        if (window.File && window.FileList && window.FileReader) {

            var files = event.target.files; //FileList object
            var output = document.getElementById("result");
            output.innerHTML = "";
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                //Only pics
                if (!file.type.match('image')) continue;

                var picReader = new FileReader();
                picReader.addEventListener("load", function (event) {
                    var picFile = event.target;
                    var div = document.createElement("div");
                    div.innerHTML = ["<img class='col-md-3 col-sm-3 col-xs-12' src='" + picFile.result + "'" + "title='" + picFile.name + "'/><span class='remove_img_preview'></span>"].join('');
                    output.insertBefore(div, null);
                });
                //Read the image
                picReader.readAsDataURL(file);
            }
        } else {
            console.log("Your browser does not support File API");
        }
    }

    /**** delete assigned subject /topic then get updated list ****/
    function deleteAssignSubjectTopic(testid, tstid) {
        $("#ajax_loader").css("display", "block");
        $.ajax({
            url:"{{route('delete_assign_st')}}",
            type: "POST",
            data:{'TestPackageTestID':testid,
                    'TestSubjectTopicID':tstid},
            success: function(data) {
                $("#ajax_loader").css("display", "none");
                if (data.success) {
                    $('#assign-table').html(data.list);
                    $('#remain_que_view').html(data.remain_que_view);
                    $('select[name="QuestionTypeID"]').empty();
                    $.each(data.question_types, function(key, value) {
                        $('select[name="QuestionTypeID"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
                $('#deleteAssinged').modal('hide');
            }
        });
    }

    /**** delete section then get updated list ****/
    function deleteSection(testid, tsqtid) {
        $("#ajax_loader").css("display", "block");
        $.ajax({
            url:"{{route('delete_section')}}",
            type: "POST",
            data:{'TestPackageTestID':testid,
                    'TestSectionQuestionTypeID':tsqtid},
            success: function(data) {
                $("#ajax_loader").css("display", "none");
                if (data.success) {
                    $('#section-table').html(data.list);
                    $('.remain_mark').html(data.remain_marks);
                    $('#remain_que_view').html(data.remain_que_view);
                    $('select[name="QuestionTypeID"]').empty();
                    $.each(data.question_types, function(key, value) {
                        $('select[name="QuestionTypeID"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
                $('#deleteSection').modal('hide');
            }
        });
    }

    /**** delete selected question ****/
    function deleteQuestion(testid, tqid) {
        $("#ajax_loader").css("display", "block");
        $.ajax({
            url:"{{route('delete_question')}}",
            type: "POST",
            data:{'TestPackageTestID':testid,
                    'TestQuestionManualID':tqid},
            success: function(data) {
                $("#ajax_loader").css("display", "none");
                if (data.success) {
                    $('#section-table').html(data.list);
                }
                $('#deleteQuestion').modal('hide');
            }
        });
    }

    $(document).ready(function() {
        /**** Ckeditor ****/ 
        CKEDITOR.replace('SectionDescription', {
            height: 100,
        });
        CKEDITOR.config.extraPlugins = 'autogrow';
        CKEDITOR.config.autoGrow_maxHeight = 500;
        CKEDITOR.config.autoGrow_minHeight = 30;
        CKEDITOR.config.toolbarCanCollapse = true;
        CKEDITOR.config.filebrowserUploadUrl = "{{ route('upload',['_token' => csrf_token() ]) }}";

        /**** Select2 Dropdown ****/ 
        $('#type_id').select2({
            placeholder: 'Please Select Topic',
        });

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /**** Remove image on click ****/
        $('#result').on('click', '.remove_img_preview',function () {
            $(this).parent('div').remove();
            $('#photo').val("");
        });

        /**** Hide/Show academic fields on load ****/ 
        if ($("select[name='SubjectID']").val() == '') {
            $('.test-type').css("display", "none");
        } else {
            $('.test-type').css("display", "block");
        }

        /**** Hide/Show academic fields on load ****/ 
        if ($("input[name='CourseTypeID']:checked").val() == '1') {
            $('.competitive').css("display", "none");
            $('.academic').css("display", "block");
            $(".academic :input").prop("required", true);
            $(".competitive :input").prop("required", false);
        } else {
            $(".academic :input").prop("required", false);
            $('.competitive').css("display", "block");
            $('.academic').css("display", "none");
            $(".competitive :input").prop("required", true);
        }

        /**** On change of radio button hide/show fields ****/ 
        $('input[name=CourseTypeID]').change(function(){
            $('select').val('').trigger('change');
            /*$('input[name="BoardStandardSubjectID"]').val('');
            $('input[name="CourseSubjectID"]').val(''); */
            if(this.value == '1') {
                $('.competitive').fadeOut('slow');
                $('.academic').fadeIn('slow');
                $(".academic :input").prop("required", true);
                $(".competitive :input").prop("required", false);
            } else {
                $(".academic :input").prop("required", false);
                $('.competitive').fadeIn('slow');
                $('.academic').fadeOut('slow');
                $(".competitive :input").prop("required", true);
            }
        });

        /**** Ajax call to get standards based on board ****/ 
        $('body').on('change', '#board_id', function(){
            var board_id = $("#board_id").val();
            $("#ajax_loader").css("display", "block");
            $.ajax({
                url:"{{route('standard_ajaxget')}}",
                type:'POST',
                dataType:'json',
                data:{'board_id':board_id},
                success:function(data) {
                    $("#ajax_loader").css("display", "none");
                    if (data.success) {
                        $('select[name="StandardID"]').empty();
                        $('select[name="StandardID"]').append('<option value=""> Please Select Standard </option>');
                        $.each(data.data, function(key, value) {
                            $('select[name="StandardID"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        $('select[name="StandardID"]').val('').trigger('change');
                        //$('#std_list').show();
                    }
                },
            });
        });

        /**** Ajax call to get subjetcs based on board and standard ****/ 
        $('body').on('change', '#standard_id', function(){
            var board_id = $("#board_id").val();
            var standard_id = $("#standard_id").val();
            $("#ajax_loader").css("display", "block");
            $.ajax({
                url:"{{route('subject_ajaxget')}}",
                type:'POST',
                dataType:'json',
                data:{'board_id':board_id, 'standard_id':standard_id},
                success:function(data) {
                    $("#ajax_loader").css("display", "none");
                    if (data.success) {
                        $('select[name="SubjectID"]').empty();
                        $('select[name="SubjectID"]').append('<option value=""> Please Select Subject </option>');
                        $.each(data.data, function(key, value) {
                            $('select[name="SubjectID"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        $('select[name="SubjectID"]').attr("required", true);
                    }
                },
            });
        });

        // Submit test from by ajax call
        // $("form#testForm").submit(function(event) {
        //     event.preventDefault();
        //     var testForm = $("#testForm");
        //     var formData = testForm.serialize();

        //     $("#ajax_loader").css("display", "block");

        //     $.ajax({
        //         url:"{{route('test_store')}}",
        //         type: "POST",
        //         data:formData,
        //         success: function(data) {
        //             console.log(data);
        //             $("#ajax_loader").css("display", "none");
        //             $('#test-panel').html(data.view);
        //             $('input[name="TestPackageTestID"]').val(data.test_id);
        //         }
        //     });
        // });

        /**** Ajax call to get chapters and topics based on test type ****/ 
        // $('body').on('change', '#test_type_id', function(){
        //     var test_type_id = $("#test_type_id").val();
        //     var package_id = $("#package_id").val();
        //     $("#ajax_loader").css("display", "block");
        //     $.ajax({
        //         url:"{{route('testTypeData_ajaxget')}}",
        //         type:'POST',
        //         dataType:'json',
        //         data:{'test_type_id':test_type_id,
        //             'id' : package_id },
        //         success:function(data) {
        //             $("#ajax_loader").css("display", "none");
        //             if(data.success) {
        //                 let lbl = document.getElementById('TypeID');
        //                 if (test_type_id == 1) {
        //                     lbl.innerText = 'Chapter Name';
        //                 }
                        
        //                 if (test_type_id == 2) {
        //                     lbl.innerText = 'Topic Name';
        //                 }

        //                 if (test_type_id == 3) {
        //                     lbl.innerText = 'Unit Name';
        //                 }

        //                 $('select[name="TypeID"]').empty();
        //                 $('select[name="TypeID"]').append('<option value=""> Please Select '+lbl.innerText+' </option>');
        //                 $.each(data.data, function(key, value) {
        //                     $('select[name="TypeID"]').append('<option value="'+ key +'">'+ value +'</option>');
        //                 });
        //             }
        //         },
        //     });
        // });

        /**** Ajax call to get topics based on subject ****/ 
        $('body').on('change', '#subject_id', function(){
            var subject_id = $("#subject_id").val();
            var package_id = $("#package_id").val();
            $("#ajax_loader").css("display", "block");
            $.ajax({
                url:"{{route('courseTopic_ajaxget')}}",
                type:'POST',
                dataType:'json',
                data:{'subject_id':subject_id,
                    'id' : package_id },
                success:function(data) {
                    $("#ajax_loader").css("display", "none");
                    if(data.success) {
                        $('.test-type').css("display", "block");
                        $('select[name="TopicID"]').empty();
                        sortingValue(data.data, $('select[name="TopicID"]'));
                        // $('select[name="TopicID"]').append('<option value=""> Please Select Topic </option>');
                        // $.each(data.data, function(key, value) {
                        //     $('select[name="TopicID"]').append('<option value="'+ key +'">'+ value +'</option>');
                        // });
                    }
                },
            });
        });

        // Submit test assignment form to add chapter/topic by ajax
        $("form#assignForm").submit(function(event) {
            event.preventDefault();
            var assignForm = $("#assignForm");
            var formData = assignForm.serialize();
            $("#ajax_loader").css("display", "block");
            $('.weightage-error').html('');

            $.ajax({
                url:"{{route('assign_st')}}",
                type: "POST",
                data:formData,
                success: function(data) {
                    $("#ajax_loader").css("display", "none");
                    if (data.success) {
                        $('#assign-table').html(data.list);
                        $('#remain_que_view').html(data.remain_que_view);
                        //$('#remain_que_view').html(data.question_types);
                        $('select[name="QuestionTypeID"]').empty();
                        $.each(data.question_types, function(key, value) {
                            $('select[name="QuestionTypeID"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        document.getElementById("assignForm").reset();
                    } else {
                        $('.weightage-error').html(data.message);
                    }
                }
            });
        });

        // Submit section form to add section by ajax
        $("form#sectionFrom").submit(function(event) {
            event.preventDefault();
            var sectionFrom = $("#sectionFrom");
            var formData = sectionFrom.serialize();
            $("#ajax_loader").css("display", "block");
            $('.mark-error').html('');
            //$('.remain_mark').html('');

            $.ajax({
                url:"{{route('add_section')}}",
                type: "POST",
                data:formData,
                success: function(data) {
                    $("#ajax_loader").css("display", "none");
                    if (data.success) {
                        $('#section-table').html(data.list);
                        $('.remain_mark').html(data.remain_marks);
                        $('#remain_que_view').html(data.remain_que_view);
                        $('select[name="QuestionTypeID"]').empty();
                        $.each(data.question_types, function(key, value) {
                            $('select[name="QuestionTypeID"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        document.getElementById("sectionFrom").reset();
                    } else {
                        if (data.view) {
                            $("#collapse1").collapse('show');
                            $("#collapse2").collapse('hide');
                            $('.weightage-error').html(data.message);    
                        } else {
                            $('.mark-error').html(data.message);
                        }
                    }
                    //$('#testModel').modal('hide');
                }
            });
        });

        // Submit section form to add section by ajax
        $("form#questionFrom").submit(function(event) {
            event.preventDefault();
            var questionFrom = $("#questionFrom");
            var formData = questionFrom.serialize();
            $('.question-error').html('');
            $("#ajax_loader").css("display", "block");

            $.ajax({
                url:"{{route('select_question')}}",
                type: "POST",
                data:formData,
                success: function(data) {
                    $("#ajax_loader").css("display", "none");
                    if (data.success) {
                        var title = data.section_info.section.SectionName +" - "+ data.section_info.question_type.QuestionTypeName +" ["+ data.selected_que_count +"/"+ data.section_info.NumberofQuestion +"]";
                        $('#add-que-title').html(title);
                        $('#question-table').html(data.question_view);
                        $('#section-table').html(data.section_view);

                        $('#casino-table').DataTable({
                            serverSide: true,
                            processing: true,
                            responsive: true,
                            ajax: {
                                'type': 'POST',
                                'url': "{{ route('datatable_question_data') }}",
                                'data':{
                                    'QuestionTypeID':data.request.QuestionTypeID,
                                    'TestSectionQuestionTypeID': data.request.TestSectionQuestionTypeID,
                                    'TestPackageTestID' : data.request.TestPackageTestID 
                                },
                            },
                            columns: [
                                { name: 'QuestionID' },
                                { name: 'action', orderable: false, searchable: false },
                                { name: 'QuestionText'},
                                { name: 'Marks'},
                                { name: 'view', orderable: false, searchable: false }
                            ],
                            "rowCallback": function (nRow, aData, iDisplayIndex) {
                                 var oSettings = this.fnSettings ();
                                 $("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                                 return nRow;
                            },
                        });
                    } else {
                        $('.question-error').html(data.message);
                    }
                    //$('#testModel').modal('hide');
                }
            });
        });

       // ON delete assigned click set value in confirmation box
        $('#deleteAssinged').on('show.bs.modal', function(e) {
            var testid = $(e.relatedTarget).data('testid');
            var tstid = $(e.relatedTarget).data('tstid');
            $(this).find('.yes-delete-assinged').attr('onclick', 'deleteAssignSubjectTopic('+testid+','+tstid+')');
        });

        // ON section delete click set value in confirmation box
        $('#deleteSection').on('show.bs.modal', function(e) {
            var testid = $(e.relatedTarget).data('testid');
            var tsqtid = $(e.relatedTarget).data('tsqtid');
            $(this).find('.yes-delete-section').attr('onclick', 'deleteSection('+testid+','+tsqtid+')');
        });

        // ON question click get the question list
        $('#addQuestion').on('show.bs.modal', function(e) {
            var testid = $(e.relatedTarget).data('testid');
            var tsqtid = $(e.relatedTarget).data('tsqtid');
            var qtid = $(e.relatedTarget).data('qtid');

            $("#ajax_loader").css("display", "block");
            $.ajax({
                url:"{{route('get_sec_que_list')}}",
                type: "POST",
                data:{'QuestionTypeID':qtid,
                    'TestSectionQuestionTypeID': tsqtid,
                    'TestPackageTestID' : testid },
                success: function(data) {
                    $("#ajax_loader").css("display", "none");
                    //console.log(data);
                    if (data.success) {
                        var title = data.section_info.section.SectionName +" - "+ data.section_info.question_type.QuestionTypeName +" ["+ data.selected_que_count +"/"+ data.section_info.NumberofQuestion +"]";
                        $('#add-que-title').html(title);
                        $('#question-table').html();
                        $('#question-table').html(data.list);

                        $(document).ready(function() {
                            $('#casino-table').DataTable({
                                serverSide: true,
                                processing: true,
                                responsive: true,
                                ajax: {
                                    'type': 'POST',
                                    'url': "{{ route('datatable_question_data') }}",
                                    'data':{
                                        'QuestionTypeID':qtid,
                                        'TestSectionQuestionTypeID': tsqtid,
                                        'TestPackageTestID' : testid 
                                    },
                                },
                                columns: [
                                    { name: 'QuestionID' },
                                    { name: 'action', orderable: false, searchable: false },
                                    { name: 'QuestionText'},
                                    { name: 'Marks'},
                                    { name: 'view', orderable: false, searchable: false }
                                ],
                                "rowCallback": function (nRow, aData, iDisplayIndex) {
                                    // console.log(nRow);
                                    // console.log(aData);
                                    // alert();
                                     var oSettings = this.fnSettings ();
                                     $("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                                     return nRow;
                                },
                            });
                            /*$('#casino-table').DataTable().destroy();*/
                        });
                    }

                    //$('#testModel').modal('hide');
                }
            });
        });

        // ON question delete click set value in confirmation box
        $('#deleteQuestion').on('show.bs.modal', function(e) {
            var testid = $(e.relatedTarget).data('testid');
            var tqid = $(e.relatedTarget).data('tqid');
            $(this).find('.yes-delete-question').attr('onclick', 'deleteQuestion('+testid+','+tqid+')');
        });

        // show question detail
        $('#viewQuestion').on('show.bs.modal', function(e) {
            var qid = $(e.relatedTarget).data('qid');
            //var tqid = $(e.relatedTarget).data('tqid');
            // $(this).find('.yes-delete-question').attr('onclick', 'deleteQuestion('+testid+','+tqid+')');

            $("#ajax_loader").css("display", "block");
            $.ajax({
                url:"{{route('question_ajaxget')}}",
                type: "POST",
                data:{'QuestionID':qid},
                success: function(data) {
                    $("#ajax_loader").css("display", "none");
                    //console.log(data);
                    if (data.success) {
                        // console.log(data.question.question_type);
                        // console.log(data.question.questionType.QuestionTypeName);
                        // console.log(data.question.hint.HintText);
                        $('#que_header').html(data.question.question_type.QuestionTypeName);
                        $('#que_name').html(data.question.QuestionText);
                        if (typeof(data.question.hint) != "undefined" && data.question.hint !== null) {
                            $('#que_hint').html(data.question.hint.HintText);
                        }
                        if (typeof(data.question.explaination) != "undefined" && data.question.explaination !== null) {
                            $('#que_explaination').html(data.question.explaination.ExplainationText);
                        }
                    }
                    //$('#testModel').modal('hide');
                }
            });
        });

    });
</script>
@stop
