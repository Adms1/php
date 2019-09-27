@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="https://kybarg.github.io/bootstrap-dropdown-hover/assets/bootstrap-dropdownhover/css/bootstrap-dropdownhover.min.css">
<link rel="stylesheet" type="text/css" href="https://kybarg.github.io/bootstrap-dropdown-hover/assets/bootstrap-dropdownhover/css/animate.min.css">
<style type="text/css">
    .test:after {
    content: '\2807';
    font-size: 1.2em;
    color: #000000;
}
</style>
@stop
@section('content')
    <h3 class="page-title">@lang('admin.test_packages.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('admin.ca_create')
        </div>
        
        <div class="panel-body">
            <h2></h2>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#package">Create a Package</a></li>
                <li class=""><a data-toggle="tab" href="#test">Create a Test</a></li>
            </ul>

            <div class="tab-content">
                <div id="package" class="tab-pane fade in active p-t-10">
                    {!! Form::open(['method' => 'POST', 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            {!! Form::label('CourseTypeID ', trans('admin.test_packages.fields.type').'*') !!}
                            <div class="form-group">
                                <label class="form-label" >
                                    {!! Form::radio('CourseTypeID', '1', true, ['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{trans('admin.ca_academic')}} &nbsp;
                                </label>
                                
                                <label class="form-label" >
                                    {!! Form::radio('CourseTypeID', '2', false,['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{trans('admin.ca_competitive')}} &nbsp;
                                </label>

                                @if($errors->has('CourseTypeID'))
                                    <p class="help-block">
                                        {{ $errors->first('CourseTypeID') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            {!! Form::label('QuestionTypeID ', trans('admin.ca_que_from').'*') !!}
                            <div class="form-group">
                                <label class="form-label" >
                                    {!! Form::radio('QuestionTypeID', '2', false,['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{trans('admin.ca_tc_bank')}} &nbsp;
                                </label>

                                <label class="form-label" >
                                    {!! Form::radio('QuestionTypeID', '1', true, ['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{trans('admin.ca_your_bank')}} &nbsp;
                                </label>

                                @if($errors->has('QuestionTypeID'))
                                    <p class="help-block">
                                        {{ $errors->first('QuestionTypeID') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            {!! Form::label('QuestionSelectionType ', trans('admin.ca_que_selection').'*') !!}
                            <div class="form-group">
                                <label class="form-label" >
                                    {!! Form::radio('QuestionSelectionType', '1', false,['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{trans('admin.ca_auto')}} &nbsp;
                                </label>

                                <label class="form-label" >
                                    {!! Form::radio('QuestionSelectionType', '2', true, ['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{trans('admin.ca_manual')}} &nbsp;
                                </label>

                                @if($errors->has('QuestionSelectionType'))
                                    <p class="help-block">
                                        {{ $errors->first('QuestionTypeID') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 form-group">
                            {!! Form::label('TestPackageName', trans('admin.test_packages.fields.name').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('TestPackageName', old('TestPackageName'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                            @if($errors->has('TestPackageName'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageName') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-3 form-group">
                            {!! Form::label('IsActive', trans('admin.test_packages.fields.is-active'), ['class' => 'control-label']) !!}
                            <div class="btn-group width-100" id="status" data-toggle="buttons">
                                <label class="btn btn-default btn-on active" >
                                <input type="radio" value="1" name="IsActive" checked="checked">YES</label>
                                <label class="btn btn-default btn-off">
                                <input type="radio" value="0" name="IsActive">NO</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 form-group">
                            {!! Form::label('TestPackageSalePrice', trans('admin.test_packages.fields.sale-price').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('TestPackageSalePrice', old('TestPackageSalePrice'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

                            @if($errors->has('TestPackageSalePrice'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageSalePrice') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('TestPackageListPrice', trans('admin.test_packages.fields.list-price').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('TestPackageListPrice', old('TestPackageListPrice'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

                            @if($errors->has('TestPackageListPrice'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageListPrice') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('NumberOfTest', trans('admin.test_packages.fields.number').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('NumberOfTest', old('NumberOfTest'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-pattern' => '^[0-9]$']) !!}

                            @if($errors->has('NumberOfTest'))
                                <p class="help-block">
                                    {{ $errors->first('NumberOfTest') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 form-group">
                            {!! Form::label('TestPackageSalePriceTCD', trans('admin.test_packages.fields.sale-price-tcd'), ['class' => 'control-label']) !!}
                            {!! Form::text('TestPackageSalePriceTCD', old('TestPackageSalePriceTCD'), ['class' => 'form-control', 'placeholder' => '', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

                            @if($errors->has('TestPackageSalePriceTCD'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageSalePriceTCD') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('TestPackageListPriceTCD', trans('admin.test_packages.fields.list-price-tcd'), ['class' => 'control-label']) !!}
                            {!! Form::text('TestPackageListPriceTCD', old('TestPackageListPriceTCD'), ['class' => 'form-control', 'placeholder' => '', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

                            @if($errors->has('TestPackageListPriceTCD'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageListPriceTCD') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 form-group academic">
                            {!! Form::label('BoardID', trans('admin.board_standard_subjects.fields.board-name').'', ['class' => 'control-label']) !!}
                            {!! Form::select('BoardID', $boards, null,['id'=>'board_id', 'class' => 'form-control', 'placeholder' => 'Please Select Board', 'required' => '']) !!}

                            @if($errors->has('BoardID'))
                                <p class="help-block">
                                    {{ $errors->first('BoardID') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group academic">
                            {!! Form::label('StandardID', trans('admin.board_standard_subjects.fields.standard-name').'', ['class' => 'control-label']) !!}
                            {!! Form::select('StandardID', $standards, null,['id'=>'standard_id', 'class' => 'form-control', 'placeholder' => 'Please Select Standard', 'required' => '']) !!}

                            @if($errors->has('StandardID'))
                                <p class="help-block">
                                    {{ $errors->first('StandardID') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group competitive">
                            {!! Form::label('CourseID', trans('admin.course_subjects.fields.course-name').'', ['class' => 'control-label']) !!}
                            {!! Form::select('CourseID', $courses, null,['id'=>'course_id', 'class' => 'form-control', 'placeholder' => 'Please Select Course', 'required' => '']) !!}

                            @if($errors->has('CourseID'))
                                <p class="help-block">
                                    {{ $errors->first('CourseID') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group academic">
                            {!! Form::label('SubjectID', trans('admin.board_standard_subjects.fields.subject-name').'', ['class' => 'control-label']) !!}
                            {!! Form::select('SubjectID', $subjects, null,['id'=>'subject_id', 'class' => 'form-control', 'placeholder' => 'Please Select Subject', 'required' => '']) !!}

                            @if($errors->has('SubjectID'))
                                <p class="help-block">`
                                    {{ $errors->first('SubjectID') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group competitive">
                            {!! Form::label('NumberofQuestion', trans('admin.test_packages.fields.no-question').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('NumberofQuestion', old('NumberofQuestion'), ['class' => 'form-control', 'placeholder' => 'Number of Question', 'required' => '', 'data-parsley-pattern' => '^[0-9]$']) !!}

                            @if($errors->has('NumberofQuestion'))
                                <p class="help-block">
                                    {{ $errors->first('NumberofQuestion') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            {!! Form::label('TestPackageDescription', trans('admin.test_packages.fields.description').'*', ['class' => 'control-label']) !!}
                            {!! Form::textarea('TestPackageDescription', old('TestPackageDescription'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                            @if($errors->has('TestPackageDescription'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageDescription') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            {!! Form::label('photo', trans('admin.test_packages.fields.photo'), ['class' => 'control-label']) !!}
                            {!! Form::file('photo', ['id'=>'photo', 'onchange' => 'handleFileSelect()']) !!}
                            <output id="result" />
                        </div>
                    </div>
                    {!! Form::hidden('TutorID', old('TutorID'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::submit('NEXT', ['class' => 'btn btn-info', 'style' => 'float:right']) !!}
                    <!-- <a href="{{ route('testPackages.index') }}" class="btn btn-info">@lang('admin.ca_cancel')</a> -->
                    {!! Form::close() !!}
                </div>
                <div id="test" class="tab-pane fade p-t-10">
                    <div style="width: 100%; float: left;">
                        <span style="float: left;"><p><b>CBSE > Standard 9> Maths</b></p></span>
                        <span style="float: right;">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Add Test</button>
                        </span>
                    </div>
                    <div style="width: 100%; float: left; margin-top: 5px;">
                        <table id="tabel_tp_detail" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="width-25">{{'Test Name'}}</th>
                                    <th class="width-25">{{trans('admin.ca_action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="tp_detail row_position">
                                <tr class="mul_div">
                                    <td>
                                        Test of chapters (2-3-4)
                                    </td>
                                    <td width="10%">
                                        <!-- <div class="dropdown">
                                            <div class="test dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"></div>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Edit</a></li>
                                                <li><a href="#">Delete</a></li>
                                                <li><a href="#">Add Chapter/Topic</a></li>
                                                <li><a href="#">Add Section</a></li>
                                                <li><a href="#">Add Question</a></li>
                                            </ul>
                                        </div> -->
                                        <div class="dropdown">
                                            <!-- <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> -->
                                            <div class="test dropdown-toggle" data-toggle="dropdown"></div>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="#" data-toggle="modal" data-target="#addTopic">Add Chapter/Topic</a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#addSection">Add Section</a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#addQuestion">Add Question</a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#myModal">Edit</a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#delete">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
            <!--Test  Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['method' => 'POST', 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}

                            <div class="row">
                                <div class="col-xs-8 form-group">
                                    {!! Form::label('TestName', 'Test Name'.'*', ['class' => 'control-label']) !!}
                                    {!! Form::text('TestName', old('TestName'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                                    @if($errors->has('TestName'))
                                        <p class="help-block">
                                            {{ $errors->first('TestName') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('TestDuration', 'Duration (In Min.)'.'*', ['class' => 'control-label']) !!}
                                    {!! Form::text('TestDuration', old('TestDuration'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                                    @if($errors->has('TestDuration'))
                                        <p class="help-block">
                                            {{ $errors->first('TestDuration') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('DifficultyLevelID', trans('admin.test_packages.fields.difficulty-level').'*', ['class' => 'control-label']) !!}
                                    {!! Form::select('DifficultyLevelID', $dif_levels, null,['class' => 'form-control', 'placeholder' => 'Please Select Difficulty Level', 'required' => '']) !!}

                                    @if($errors->has('DifficultyLevelID'))
                                        <p class="help-block">
                                            {{ $errors->first('DifficultyLevelID') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('NumberofQuestion', 'Total Question'.'*', ['class' => 'control-label']) !!}
                                    {!! Form::text('NumberofQuestion', old('NumberofQuestion'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                                    @if($errors->has('NumberofQuestion'))
                                        <p class="help-block">
                                            {{ $errors->first('NumberofQuestion') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('TestMarks', 'Total Marks'.'*', ['class' => 'control-label']) !!}
                                    {!! Form::text('TestMarks', old('TestMarks'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                                    @if($errors->has('TestMarks'))
                                        <p class="help-block">
                                            {{ $errors->first('TestMarks') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit(trans('admin.ca_submit'), ['class' => 'btn btn-success']) !!}
                            <a href="{{ route('testPackages.index') }}" class="btn btn-info">@lang('admin.ca_cancel')</a>
                            {!! Form::close() !!}
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Add Topic/Chapter Modal -->
            <div class="modal fade" id="addTopic" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['method' => 'POST', 'route' => ['package_detail'], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
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
                                    {!! Form::label('Weightage', 'Weightage'.'*', ['class' => 'control-label']) !!}
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
                                        <th class="width-25">{{'Weightage'}}</th>
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
            </div>
            <!--Add section Modal -->
            <div class="modal fade" id="addSection" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
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
            </div>
            <!--Add Question Modal -->
            <div class="modal fade" id="addQuestion" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
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
            </div>
            <!--delete Modal -->
            <div class="modal fade" id="delete" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">Yes</button>
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
    CKEDITOR.replace('TestPackageDescription', {
        height: 100
    });

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

        /**** Ajax call to get subject based on course ****/ 
        // $('body').on('change', '#course_id', function(){
        //     var course_id = $("#course_id").val();
        //     $.ajax({
        //         url:"{{route('subject_ajaxget')}}",
        //         type:'POST',
        //         dataType:'json',
        //         data:{'course_id':course_id},
        //         success:function(data) {
        //             if (data.success) {
        //                 $('select[name="SubjectID"]').empty();
        //                 $('input[name="CourseSubjectID"]').val('');
        //                 $('select[name="SubjectID"]').append('<option value=""> Please Select Subject </option>');
        //                 $.each(data.data, function(key, value) {
        //                     $('select[name="SubjectID"]').append('<option value="'+ key +'">'+ value +'</option>');
        //                 });
        //                 $('select[name="SubjectID"]').attr("required", true);
        //             }
        //         },
        //     });
        // });

        /**** Ajax call to get BoardStandardSubjectID based on board, standard and subject ****/ 
        // $('body').on('change', '#subject_id', function(){
        //     var board_id = $("#board_id").val();
        //     var standard_id = $("#standard_id").val();
        //     var subject_id = $("#subject_id").val();
        //     var course_id = $("#course_id").val();
        //     if (course_id == "") {
        //         $.ajax({
        //             url:"{{route('boardStandardSubject_ajaxget')}}",
        //             type:'POST',
        //             dataType:'json',
        //             data:{'board_id':board_id, 'standard_id':standard_id, 'subject_id':subject_id},
        //             success:function(data) {
        //                 if (data.success) {
        //                     //console.log(data.data);
        //                     if (data.data != null) {
        //                         $('input[name="BoardStandardSubjectID"]').val(data.data);
        //                     } else {
        //                         $('input[name="BoardStandardSubjectID"]').val('')
        //                     }
        //                 }
        //             },
        //         });
        //     } else {
        //         $('input[name="CourseSubjectID"]').val(subject_id);
        //     }
        // });
    });
</script>
@stop
