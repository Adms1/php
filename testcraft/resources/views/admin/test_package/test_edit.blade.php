@extends('layouts.app')

@section('css')
<style type="text/css">
    .test2 {
        color: white !important;
        background-color: #222d32 !important;
        border-color: #ddd !important;
    }
    .box-shadow {
        box-shadow: none; border-radius: 0px;
    }
    .panel-head {
        padding-top: 8px; padding-bottom: 8px; border: 0px;
    }
    .p-t-16 {
        padding-top: 16px;
    }
    .color-white {
        color: white !important;
    }
    .float-right {
        float:right;
    }
    .p-3-15 {
        padding: 3px 15px;
    }
    .w-10 {
        width: 10px;
    }
    .w-20 {
        width:20px;
    }
    .w-90 {
        width: 90px;
    }
    .vertical-top {
        width: 25px; vertical-align: top;
    }
    .border-0 {
        border: 0px;
    }
    .checkbox input[type=checkbox] {
        margin-left: 0px !important;
    }
</style>
@stop

@section('content')
    <div class="col-md-12 m-b-10">
        <span class="col-md-6"><h3 class="page-title">{{ $test_package->TestPackageName }}</h3></span>
        <span class="col-md-6 p-t-16"><a href="{{ route('testPackages.edit', [$test_package->TestPackageID, 'tab' => 'test']) }}" class="btn btn-info f-right">Back</a></span>
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
                                            {!! Form::text('TestDuration', $test->TestDuration, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

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
                                        <div class="col-xs-6 form-group">
                                            {!! Form::label('NumberofQuestion', trans('admin.tests.fields.question').'*', ['class' => 'control-label']) !!}
                                            {!! Form::text('NumberofQuestion', $test->NumberofQuestion, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                                            @if($errors->has('NumberofQuestion'))
                                                <p class="help-block">
                                                    {{ $errors->first('NumberofQuestion') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-xs-6 form-group">
                                            {!! Form::label('TestMarks', trans('admin.tests.fields.marks').'*', ['class' => 'control-label']) !!}
                                            {!! Form::text('TestMarks', $test->TestMarks, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                                            @if($errors->has('TestMarks'))
                                                <p class="help-block">
                                                    {{ $errors->first('TestMarks') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    {!! Form::submit(trans('admin.ca_submit'), ['class' => 'btn btn-success float-right']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading test2">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    <h4 class="panel-title color-white">
                                        {{ trans('admin.ca_add_cp') }}
                                    </h4>
                                </a>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    {!! Form::open(['method' => 'POST', 'id' => 'assignForm', 'route' => ['assign_ct'], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                                    {!! Form::hidden('TestPackageTestID', $test->TestPackageTestID, ['class' => 'form-control', 'id' => 'test_id', 'placeholder' => '', 'required' => '']) !!}
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
                                            {!! Form::text('Weightage', old('Weightage'), ['class' => 'form-control', 'placeholder' => 'Weightage', 'required' => '']) !!}

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
                                        <span class="col-md-6"></span>
                                        <span class="col-md-6"><b style="float: right;">Total Marks :20 | Remain Marks:9</b></span>
                                    </div>
                                    {!! Form::open(['method' => 'POST',  'id' => 'sectionFrom', 'route' => ['assign_ct'], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
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
                                            {!! Form::number('QuestionMarks', old('QuestionMarks'), ['class' => 'form-control', 'placeholder' => 'Marks per question', 'required' => '']) !!}

                                            @if($errors->has('QuestionMarks'))
                                                <p class="help-block">
                                                    {{ $errors->first('QuestionMarks') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-xs-3 form-group">
                                            {!! Form::label('NumberofQuestion', trans('admin.ca_total_question').'*', ['class' => 'control-label']) !!}
                                            {!! Form::number('NumberofQuestion', old('NumberofQuestion'), ['class' => 'form-control', 'placeholder' => 'Total Question', 'required' => '']) !!}

                                            @if($errors->has('NumberofQuestion'))
                                                <p class="help-block">
                                                    {{ $errors->first('NumberofQuestion') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-xs-2 form-group p-t-25">
                                            {!! Form::label('', '', ['class' => 'control-label']) !!}
                                            {!! Form::submit(trans('admin.ca_add'), ['class' => 'btn btn-success']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
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
                            <h4 class="modal-title">Section 1 - MCQ [11/20]</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['method' => 'POST', 'name' => 'questionFrom', 'id' => 'questionFrom', 'data-parsley-validate']) !!}
                            <table class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action">
                                <tbody id="question-table">
                                    <!-- <tr>
                                        <td class="text-center pr-0 vertical-top">
                                            <span class="checkbox checkbox-primary checkbox-nolable" name="chkSelect"><input id="" type="checkbox" name="" onclick=""><label for=""> </label></span>
                                        </td>
                                        <td>
                                            In the experiment for verification of Law of conservation of mass with barium chloride and sodium sulphate the white precipitate is of:
                                            <div class="clearfix"></div>
                                            <div id="q468507"></div>
                                        </td>
                                        <td class="text-center pl-0 pr-5 vertical-top">
                                            <i class="fa fa-eye font-20 pointer-cursor" onclick=""></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center pr-0 vertical-top">
                                            <span class="checkbox checkbox-primary checkbox-nolable" name="chkSelect"><input id="" type="checkbox" name="" onclick=""><label for=""> </label></span>
                                            
                                        </td>
                                        <td>
                                            In the experiment for verification of Law of conservation of mass with barium chloride and sodium sulphate the white precipitate is of:
                                            <div class="clearfix"></div>
                                            <div id="q468507"></div>
                                        </td>
                                        <td class="text-center pl-0 pr-5 vertical-top">
                                            <i class="fa fa-eye font-20 pointer-cursor" onclick=""></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center pr-0 vertical-top">
                                            <span class="checkbox checkbox-primary checkbox-nolable" name="chkSelect"><input id="" type="checkbox" name="" onclick=""><label for=""> </label></span>
                                            
                                        </td>
                                        <td>
                                            In the experiment for verification of Law of conservation of mass with barium chloride and sodium sulphate the white precipitate is of:
                                            <div class="clearfix"></div>
                                            <div id="q468507"></div>
                                        </td>
                                        <td class="text-center pl-0 pr-5 vertical-top">
                                            <i class="fa fa-eye font-20 pointer-cursor" onclick=""></i>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit(trans('admin.ca_add_question'), ['class' => 'btn btn-success']) !!}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            {!! Form::close() !!}
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
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure ?</p>
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
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure ?</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" onclick="" class="btn btn-success yes-delete-section">Yes</a>
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

    /**** delete assigned chapter/topic then get updated list ****/
    function deleteAssignChapterTopic(testid, tctid) {
        $("#ajax_loader").css("display", "block");
        $.ajax({
            url:"{{route('delete_assign_ct')}}",
            type: "POST",
            data:{'TestPackageTestID':testid,
                    'TestChapterTopicID':tctid},
            success: function(data) {
                $("#ajax_loader").css("display", "none");
                $('#assign-table').html(data.list);
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
                $('#section-table').html(data.list);
                $('#deleteSection').modal('hide');
            }
        });
    }

    $(document).ready(function() {
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
        $('body').on('change', '#test_type_id', function(){
            var test_type_id = $("#test_type_id").val();
            var package_id = $("#package_id").val();
            $("#ajax_loader").css("display", "block");
            $.ajax({
                url:"{{route('testTypeData_ajaxget')}}",
                type:'POST',
                dataType:'json',
                data:{'test_type_id':test_type_id,
                    'id' : package_id },
                success:function(data) {
                    $("#ajax_loader").css("display", "none");
                    if(data.success) {
                        let lbl = document.getElementById('TypeID');
                        if (test_type_id == 1) {
                            lbl.innerText = 'Chapter Name';
                        }
                        
                        if (test_type_id == 2) {
                            lbl.innerText = 'Topic Name';
                        }

                        if (test_type_id == 3) {
                            lbl.innerText = 'Unit Name';
                        }

                        $('select[name="TypeID"]').empty();
                        $('select[name="TypeID"]').append('<option value=""> Please Select '+lbl.innerText+' </option>');
                        $.each(data.data, function(key, value) {
                            $('select[name="TypeID"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
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

            $.ajax({
                url:"{{route('assign_ct')}}",
                type: "POST",
                data:formData,
                success: function(data) {
                    $("#ajax_loader").css("display", "none");
                    $('#assign-table').html(data.list);
                    //$('#testModel').modal('hide');
                }
            });
        });

        // Submit section form to add section by ajax
        $("form#sectionFrom").submit(function(event) {
            event.preventDefault();
            var sectionFrom = $("#sectionFrom");
            var formData = sectionFrom.serialize();
            $("#ajax_loader").css("display", "block");

            $.ajax({
                url:"{{route('add_section')}}",
                type: "POST",
                data:formData,
                success: function(data) {
                    $("#ajax_loader").css("display", "none");
                    $('#section-table').html(data.list);
                    //$('#testModel').modal('hide');
                }
            });
        });

        // Submit section form to add section by ajax
        $("form#questionFrom").submit(function(event) {
            event.preventDefault();
            var questionFrom = $("#questionFrom");
            var formData = questionFrom.serialize();
            $("#ajax_loader").css("display", "block");

            $.ajax({
                url:"{{route('select_question')}}",
                type: "POST",
                data:formData,
                success: function(data) {
                    $("#ajax_loader").css("display", "none");
                    $('#section-table').html(data.list);
                    //$('#testModel').modal('hide');
                }
            });
        });

       // ON delete assigned click set value in confirmation box
        $('#deleteAssinged').on('show.bs.modal', function(e) {
            var testid = $(e.relatedTarget).data('testid');
            var tctid = $(e.relatedTarget).data('tctid');
            $(this).find('.yes-delete-assinged').attr('onclick', 'deleteAssignChapterTopic('+testid+','+tctid+')');
        });

        // ON section delete click set value in confirmation box
        $('#deleteSection').on('show.bs.modal', function(e) {
            var testid = $(e.relatedTarget).data('testid');
            var tsqtid = $(e.relatedTarget).data('tsqtid');
            $(this).find('.yes-delete-section').attr('onclick', 'deleteSection('+testid+','+tsqtid+')');
        });

        // ON ass question click get the question list
        $('#addQuestion').on('show.bs.modal', function(e) {
            var testid = $(e.relatedTarget).data('testid');
            var qtid = $(e.relatedTarget).data('qtid');
            $("#ajax_loader").css("display", "block");
            $.ajax({
                url:"{{route('get_sec_que_list')}}",
                type: "POST",
                data:{'question_type_id':qtid,
                    'test_id' : testid },
                success: function(data) {
                    $("#ajax_loader").css("display", "none");
                    //console.log(data);
                    $('#question-table').html(data.list);
                    //$('#testModel').modal('hide');
                }
            });
        });
    });
</script>
@stop
