@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.test_packages.title')</h3>
    <div class="col-md-12 m-b-10">
        <a href="{{ route('testPackages.index') }}" class="btn btn-info f-right">@lang('admin.test_packages.title')</a>
    </div>
    <div class="col-md-12 panel panel-default p-0">
        <div class="panel-heading">
            @lang('admin.ca_edit')
        </div>

        <div class="panel-body">

            @if ($test_package->IsCompetetive == 0)
                <h3>{{$test_package->board->BoardName ." > ". $test_package->standard->StandardName ." > ". $test_package->subject->SubjectName}}</h3>
            @else
                <h3>{{$test_package->course->CourseName}}</h3>
            @endif
            
            <ul class="nav nav-tabs">
                <li class="{{ empty(\Request::get('tab')) ? 'active' : '' }}"><a data-toggle="tab" href="#package">Create a Package</a></li>
                <li class="{{ (!empty(\Request::get('tab')) && \Request::get('tab') == 'test') ? 'active' : '' }}"><a data-toggle="tab" href="#test">Create a Test</a></li>
            </ul>

            <div class="tab-content">
                <div id="package" class="tab-pane fade {{ empty(\Request::get('tab')) ? 'active in' : '' }} p-t-10">
                    {!! Form::model($test_package, ['method' => 'PUT', 'route' => ['testPackages.update', $test_package->TestPackageID], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            {!! Form::label('IsCompetetive ', trans('admin.test_packages.fields.type').'*') !!}
                            <div class="form-group">
                                <label class="form-label" >
                                    {!! Form::radio('IsCompetetive', '0', 
                                    ($test_package->IsCompetetive == 0) ? true : false, 
                                    ['class' => '', 'required' => 'required', 'disabled']) !!}
                                    &nbsp; {{trans('admin.ca_academic')}} &nbsp;
                                </label>
                                
                                <label class="form-label" >
                                    {!! Form::radio('IsCompetetive', '1',
                                    ($test_package->IsCompetetive == 1) ? true : false, 
                                    ['class' => '', 'required' => 'required', 'disabled']) !!}
                                    &nbsp; {{trans('admin.ca_competitive')}} &nbsp;
                                </label>

                                @if($errors->has('IsCompetetive'))
                                    <p class="help-block">
                                        {{ $errors->first('IsCompetetive') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            {!! Form::label('QuestionFrom ', trans('admin.ca_que_from').'*') !!}
                            <div class="form-group">
                                <label class="form-label" >
                                    {!! Form::radio('QuestionFrom', '1', false,['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{trans('admin.ca_tc_bank')}} &nbsp;
                                </label>

                                <label class="form-label" >
                                    {!! Form::radio('QuestionFrom', '2', true, ['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{trans('admin.ca_your_bank')}} &nbsp;
                                </label>

                                @if($errors->has('QuestionFrom'))
                                    <p class="help-block">
                                        {{ $errors->first('QuestionFrom') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            {!! Form::label('IsAutoTestCreation ', trans('admin.ca_que_selection').'*') !!}
                            <div class="form-group">
                                <label class="form-label" >
                                    {!! Form::radio('IsAutoTestCreation', '1', false,['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{trans('admin.ca_auto')}} &nbsp;
                                </label>

                                <label class="form-label" >
                                    {!! Form::radio('IsAutoTestCreation', '0', true, ['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{trans('admin.ca_manual')}} &nbsp;
                                </label>

                                @if($errors->has('IsAutoTestCreation'))
                                    <p class="help-block">
                                        {{ $errors->first('IsAutoTestCreation') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 form-group">
                            {!! Form::label('TestPackageName', trans('admin.test_packages.fields.name').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('TestPackageName', $test_package->TestPackageName, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                            @if($errors->has('TestPackageName'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageName') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-3 form-group">
                            {!! Form::label('IsActive', trans('admin.test_packages.fields.is-active'), ['class' => 'control-label']) !!}
                            <div class="btn-group width-100" id="status" data-toggle="buttons">
                                <label class="btn btn-default btn-on {{ ($test_package->IsActive == 1) ? 'active' : '' }}" >
                                <input type="radio" value="1" name="IsActive" {{ ($test_package->IsActive == 1) ? 'checked' : '' }}>YES</label>
                                <label class="btn btn-default btn-off {{ ($test_package->IsActive == 0) ? 'active' : '' }}">
                                <input type="radio" value="0" name="IsActive" {{ ($test_package->IsActive == 0) ? 'checked' : '' }}>NO</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 form-group">
                            {!! Form::label('TestPackageSalePrice', trans('admin.test_packages.fields.sale-price').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('TestPackageSalePrice', $test_package->TestPackageSalePrice, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

                            @if($errors->has('TestPackageSalePrice'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageSalePrice') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('TestPackageListPrice', trans('admin.test_packages.fields.list-price').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('TestPackageListPrice', $test_package->TestPackageListPrice, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

                            @if($errors->has('TestPackageListPrice'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageListPrice') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('NumberOfTest', trans('admin.test_packages.fields.number').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('NumberOfTest', $test_package->NumberOfTest, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-pattern' => '^[1-9]$']) !!}

                            @if($errors->has('NumberOfTest'))
                                <p class="help-block">
                                    {{ $errors->first('NumberOfTest') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    @if (Auth::guard('admin')->check())
                    <div class="row">
                        <div class="col-xs-4 form-group">
                            {!! Form::label('TestPackageSalePriceTCD', trans('admin.test_packages.fields.sale-price-tcd').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('TestPackageSalePriceTCD', $test_package->TestPackageSalePriceTCD, ['class' => 'form-control', 'placeholder' => '', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

                            @if($errors->has('TestPackageSalePriceTCD'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageSalePriceTCD') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('TestPackageListPriceTCD', trans('admin.test_packages.fields.list-price-tcd').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('TestPackageListPriceTCD', $test_package->TestPackageListPriceTCD, ['class' => 'form-control', 'placeholder' => '', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

                            @if($errors->has('TestPackageListPriceTCD'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageListPriceTCD') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-xs-4 form-group academic">
                            {!! Form::label('BoardID', trans('admin.board_standard_subjects.fields.board-name').'*', ['class' => 'control-label']) !!}
                            {!! Form::select('BoardID', $boards, $test_package->BoardID,['id'=>'board_id', 'class' => 'form-control', 'placeholder' => 'Please Select Board', 'required' => '']) !!}

                            @if($errors->has('BoardID'))
                                <p class="help-block">
                                    {{ $errors->first('BoardID') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group academic">
                            {!! Form::label('StandardID', trans('admin.board_standard_subjects.fields.standard-name').'*', ['class' => 'control-label']) !!}
                            {!! Form::select('StandardID', $standards, $test_package->StandardID, ['id'=>'standard_id', 'class' => 'form-control', 'placeholder' => 'Please Select Standard', 'required' => '']) !!}

                            @if($errors->has('StandardID'))
                                <p class="help-block">
                                    {{ $errors->first('StandardID') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group competitive">
                            {!! Form::label('CourseID', trans('admin.course_subjects.fields.course-name').'*', ['class' => 'control-label']) !!}
                            {!! Form::select('CourseID', $courses, $test_package->CourseID, ['id'=>'course_id', 'class' => 'form-control', 'placeholder' => 'Please Select Course', 'required' => '']) !!}

                            @if($errors->has('CourseID'))
                                <p class="help-block">
                                    {{ $errors->first('CourseID') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group academic">
                            {!! Form::label('SubjectID', trans('admin.board_standard_subjects.fields.subject-name').'*', ['class' => 'control-label']) !!}
                            {!! Form::select('SubjectID', $subjects, $test_package->SubjectID, ['id'=>'subject_id', 'class' => 'form-control', 'placeholder' => 'Please Select Subject', 'required' => '']) !!}

                            @if($errors->has('SubjectID'))
                                <p class="help-block">
                                    {{ $errors->first('SubjectID') }}
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
                            @if ($test_package->Icon)
                            <output id="result">
                                @if ($test_package->Icon)
                                <img class="col-md-3 col-sm-3 col-xs-12" src="{{URL::asset('/'.$test_package->Icon)}}">
                                @endif
                            <output/>
                            @endif
                        </div>
                    </div>
                    {!! Form::submit(trans('admin.ca_update'), ['class' => 'btn btn-success']) !!}
                    <a href="{{ route('testPackages.index') }}" class="btn btn-info">@lang('admin.ca_cancel')</a>
                    {!! Form::close() !!}
                </div>
                <div id="test" class="tab-pane fade {{ (!empty(\Request::get('tab')) && \Request::get('tab') == 'test') ? 'active in' : '' }} p-t-10">
                    <div class="width-100 f-left">
                        <span class="f-right">
                            <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#testModel">{{trans('admin.ca_add_test')}}</button> -->
                            @if ($remain > 0)
                            <a href="{{ route('test_create', $test_package->TestPackageID) }}" class="btn btn-info btn-sm">{{trans('admin.ca_add_test')}}</a>
                            @endif
                        </span>
                    </div>
                    <div class="width-100 f-left m-t-5">
                        <table id="tabel_tp_detail" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                            <thead>
                                <tr class="thead-color">
                                    <th class="width-5">{{trans('admin.ca_serial_number')}}</th>
                                    <th class="width-25">{{trans('admin.tests.fields.name')}}</th>
                                    <th class="width-10">{{trans('admin.tests.fields.marks')}}</th>
                                    <th class="width-10">{{trans('admin.tests.fields.duration')}}</th>
                                    <th class="width-10">{{trans('admin.tests.fields.question')}}</th>
                                    <th class="width-15">{{trans('admin.tests.fields.difficulty-level')}}</th>
                                    <th class="width-25">{{trans('admin.ca_action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="tp_detail row_position" id="test-table">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--Test  Modal -->
            <!-- <div class="modal fade" id="testModel" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header thead-color">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">{{trans('admin.ca_create_test')}}</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['method' => 'POST', 'id' => 'testForm', 'route' => 'test_store', 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                            {!! Form::hidden('TestPackageID', $test_package->TestPackageID, ['class' => 'form-control', 'id' => 'package_id', 'placeholder' => '', 'required' => '']) !!}

                            <div class="row">
                                <div class="col-xs-12 form-group">
                                    {!! Form::label('TestName', trans('admin.tests.fields.name').'*', ['class' => 'control-label']) !!}
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
                                    {!! Form::label('TestDuration', trans('admin.tests.fields.duration').'*', ['class' => 'control-label']) !!}
                                    {!! Form::text('TestDuration', old('TestDuration'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                                    @if($errors->has('TestDuration'))
                                        <p class="help-block">
                                            {{ $errors->first('TestDuration') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('DifficultyLevelID', trans('admin.tests.fields.difficulty-level').'*', ['class' => 'control-label']) !!}
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
                                    {!! Form::label('NumberofQuestion', trans('admin.tests.fields.question').'*', ['class' => 'control-label']) !!}
                                    {!! Form::text('NumberofQuestion', old('NumberofQuestion'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                                    @if($errors->has('NumberofQuestion'))
                                        <p class="help-block">
                                            {{ $errors->first('NumberofQuestion') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('TestMarks', trans('admin.tests.fields.marks').'*', ['class' => 'control-label']) !!}
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
                            
                            {!! Form::close() !!}
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> -->
            <!--Add Topic/Chapter Modal -->
            <!-- <div class="modal fade" id="addTopic" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header thead-color">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title test_name"></h4>
                            <h5 class="modal-title">{{trans('admin.ca_assign_ct')}}</h5>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['method' => 'POST', 'id' => 'assignForm', 'route' => ['assign_ct'], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                            {!! Form::hidden('TestPackageTestID', null, ['class' => 'form-control', 'id' => 'test_id', 'placeholder' => '', 'required' => '']) !!}
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
                                    <tr>
                                        <th class="">{{trans('admin.ca_name')}}</th>
                                        <th class="width-25">{{'Weightage'}}</th>
                                        <th class="width-25">{{trans('admin.ca_action')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="tp_detail row_position" id="assign-table">
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
                        <div class="modal-header thead-color">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">{{trans('admin.ca_add_section')}}</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['method' => 'POST',  'id' => 'sectionFrom', 'route' => ['assign_ct'], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                            {!! Form::hidden('TestPackageTestID', null, ['class' => 'form-control', 'id' => 'test_id', 'placeholder' => '', 'required' => '']) !!}
                            <div class="row">
                                <div class="col-xs-8 form-group">
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
                                    <select name="QuestionTypeID" class="form-control">
                                        <option value="1">MCQ</option>
                                        <option value="2">MCQ2</option>
                                        <option value="3">True/False</option>
                                    </select>

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
                            <table id="tabel_tp_detail" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="width-25">{{trans('admin.ca_heading')}}</th>
                                        <th class="width-25">{{trans('admin.ca_question_type')}}</th>
                                        <th class="width-25">{{trans('admin.ca_question_per_mark')}}</th>
                                        <th class="width-25">{{trans('admin.ca_total_mark')}}</th>
                                        <th class="width-25">{{trans('admin.ca_total_question')}}</th>
                                        <th class="width-25">{{trans('admin.ca_action')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="tp_detail row_position" id="section-table">
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
            <!-- <div class="modal fade" id="addQuestion" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header thead-color">
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
            <!--delete test Modal -->
            <div class="modal fade" id="testDelete" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header thead-color">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">{{trans('admin.ca_delete_test')}}</h4>
                        </div>
                        <div class="modal-body">
                            <p>{{trans('admin.ca_delete_confirmation')}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success delete-test" data-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--delete assigned chapter/topic Modal -->
            <!-- <div class="modal fade" id="deleteAssinged" role="dialog">
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
            </div> -->
            <!--delete section Modal -->
            <!-- <div class="modal fade" id="deleteSection" role="dialog">
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
            </div> -->
        </div>
    </div>
@stop

@section('javascript')
<!-- ckeditor -->
<script src="{{asset('adminlte/plugins/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('adminlte/plugins/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
<script type="text/javascript">

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

    /**** delete test then get updated list ****/
    function deleteTest(testid, packageid) {
        $("#ajax_loader").css("display", "block");
        $.ajax({
            url:"{{route('test_ajaxdelete')}}",
            type: "POST",
            data:{'TestPackageTestID':testid,
                    'TestPackageID':packageid},
            success: function(data) {
                $("#ajax_loader").css("display", "none");
                $('#test-table').html(data.list);
                $('#testDelete').modal('hide');
            }
        });
    }

    /**** delete assigned chapter/topic then get updated list ****/
    // function deleteAssignChapterTopic(testid, tctid) {
    //     $("#ajax_loader").css("display", "block");
    //     $.ajax({
    //         url:"{{route('delete_assign_ct')}}",
    //         type: "POST",
    //         data:{'TestPackageTestID':testid,
    //                 'TestChapterTopicID':tctid},
    //         success: function(data) {
    //             $("#ajax_loader").css("display", "none");
    //             $('#assign-table').html(data.list);
    //             $('#deleteAssinged').modal('hide');
    //         }
    //     });
    // }

    /**** delete section then get updated list ****/
    // function deleteSection(testid, tsqtid) {
    //     $("#ajax_loader").css("display", "block");
    //     $.ajax({
    //         url:"{{route('delete_section')}}",
    //         type: "POST",
    //         data:{'TestPackageTestID':testid,
    //                 'TestSectionQuestionTypeID':tsqtid},
    //         success: function(data) {
    //             $("#ajax_loader").css("display", "none");
    //             $('#section-table').html(data.list);
    //             $('#deleteSection').modal('hide');
    //         }
    //     });
    // }

    $(document).ready(function() {
        /**** ajax setup ****/
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
        if ($("input[name='IsCompetetive']:checked").val() == '0') {
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
        $('input[name=IsCompetetive]').change(function(){
            $('select').val('').trigger('change');
            if(this.value == '0') {
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

        // Delete row on delete button click
        // $(document).on("click", ".delete", function() {
        //     var csrf_token = "{{ csrf_token() }}";
        //     var package_detail_ids = $(this).parents("tr").find('input[type="hidden"]');
        //     package_detail_ids.each(function() {
        //         package_detail_id = $(this).val();
        //     });
        //     $("#ajax_loader").css("display", "block");
        //     $.ajax({
        //         url: "{{route('packageDetail_ajaxdelete')}}",
        //         type: 'POST',
        //         dataType: 'json',
        //         data: {
        //             'package_detail_id': package_detail_id,
        //             '_token': csrf_token
        //         },
        //         success: function(data) {
        //             $("#ajax_loader").css("display", "none");
        //             if (data.error) {
        //                 if (data.message.book_attribute_id) {
        //                     $('.alert-error').html(data.message.book_attribute_id[0]);
        //                 }
        //             }
        //         },
        //     });

        //     $(this).parents("tr").remove();
        // });

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
        //             $("#ajax_loader").css("display", "none");
        //             $('#test-table').html(data.list);
        //             $('#testModel').modal('hide');
        //         }
        //     });
        // });

        // Set test id to each modal
        $(document).on("click", ".testid", function() {
            var id = $(this).data('testid');
            $('input[name="TestPackageTestID"]').val(id);
        });

        // Submit test assignment form to add chapter/topic by ajax
        // $("form#assignForm").submit(function(event) {
        //     event.preventDefault();
        //     var assignForm = $("#assignForm");
        //     var formData = assignForm.serialize();
        //     $("#ajax_loader").css("display", "block");

        //     $.ajax({
        //         url:"{{route('assign_ct')}}",
        //         type: "POST",
        //         data:formData,
        //         success: function(data) {
        //             $("#ajax_loader").css("display", "none");
        //             $('#assign-table').html(data.list);
        //             //$('#testModel').modal('hide');
        //         }
        //     });
        // });

        // Get list of assigned topic/chapter
        // $(document).on("click", ".addTopic", function() {
        //     var id = $(this).data('testid');
        //     $("#ajax_loader").css("display", "block");

        //     $.ajax({
        //         url:"{{route('get_assign_list')}}",
        //         type: "GET",
        //         data:{'TestPackageTestID':id},
        //         success: function(data) {
        //             $("#ajax_loader").css("display", "none");
        //             $('#assign-table').html(data.list);
        //             //$('#testModel').modal('hide');
        //         }
        //     });
        // });

        // ON delete assigned click set value in confirmation box
        // $('#deleteAssinged').on('show.bs.modal', function(e) {
        //     var testid = $(e.relatedTarget).data('testid');
        //     var tctid = $(e.relatedTarget).data('tctid');
        //     $(this).find('.yes-delete-assinged').attr('onclick', 'deleteAssignChapterTopic('+testid+','+tctid+')');
        // });

        // ON delete assigned click set value in confirmation box
        $('#testDelete').on('show.bs.modal', function(e) {
            var testid = $(e.relatedTarget).data('testid');
            var packageid = $(e.relatedTarget).data('packageid');
            $(this).find('.delete-test').attr('onclick', 'deleteTest('+testid+','+packageid+')');
        });

        // Submit section form to add section by ajax
        // $("form#sectionFrom").submit(function(event) {
        //     event.preventDefault();
        //     var sectionFrom = $("#sectionFrom");
        //     var formData = sectionFrom.serialize();
        //     $("#ajax_loader").css("display", "block");

        //     $.ajax({
        //         url:"{{route('add_section')}}",
        //         type: "POST",
        //         data:formData,
        //         success: function(data) {
        //             $("#ajax_loader").css("display", "none");
        //             $('#section-table').html(data.list);
        //             //$('#testModel').modal('hide');
        //         }
        //     });
        // });

        // Get list of sections
        // $(document).on("click", ".addSection", function() {
        //     var id = $(this).data('testid');
        //     $("#ajax_loader").css("display", "block");

        //     $.ajax({
        //         url:"{{route('get_section_list')}}",
        //         type: "GET",
        //         data:{'TestPackageTestID':id},
        //         success: function(data) {
        //             $("#ajax_loader").css("display", "none");
        //             $('#section-table').html(data.list);
        //             //$('#testModel').modal('hide');
        //         }
        //     });
        // });

        // ON section delete click set value in confirmation box
        // $('#deleteSection').on('show.bs.modal', function(e) {
        //     var testid = $(e.relatedTarget).data('testid');
        //     var tsqtid = $(e.relatedTarget).data('tsqtid');
        //     $(this).find('.yes-delete-section').attr('onclick', 'deleteSection('+testid+','+tsqtid+')');
        // });

        // ON edit click set value of test in model
        // $('#testModel').on('show.bs.modal', function(e) {
        //     var testid = $(e.relatedTarget).data('testid');
        //     if (Number.isInteger(testid)) {
        //         var url = '{{ route("test_update", ":slug") }}';
        //         var action = url.replace(':slug', testid);
        //     } else {
        //         var action = '{{ route("test_store") }}';
        //     }
        //     $(this).find('#testForm').attr('action', action);
        // });
    });
</script>
@stop
