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

            @if ($test_package->CourseID == 1)
                <h3>{{$test_package->board->BoardName ." >> ". $test_package->standard->StandardName ." >> ". $test_package->subject->SubjectName}}</h3>
            @else
                <h3>{{$test_package->course->CourseName}}</h3>
            @endif
            
            <ul class="nav nav-tabs">
                <li class="{{ empty(\Request::get('tab')) ? 'active' : '' }}"><a data-toggle="tab" href="#package">Test Package</a></li>

                @if ($test_package->CourseID == 1)
                <li class="{{ (!empty(\Request::get('tab')) && \Request::get('tab') == 'detail') ? 'active' : '' }}"><a data-toggle="tab" href="#detail">Detail</a></li>
                @endif

                <!-- <li class=""><a data-toggle="tab" href="#section">Section</a></li>
                <li class=""><a data-toggle="tab" href="#questions">Questions</a></li> -->
            </ul>

            <div class="tab-content">
                <div id="package" class="tab-pane fade {{ empty(\Request::get('tab')) ? 'active in' : '' }} p-t-10">
                    {!! Form::model($test_package, ['method' => 'PUT', 'route' => ['testPackages.update', $test_package->TestPackageID], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            {!! Form::label('CourseTypeID ', trans('admin.test_packages.fields.type').'*') !!}
                            <div class="form-group">
                                <label class="form-label" >
                                    {!! Form::radio('CourseTypeID', '1', 
                                    ($test_package->CourseID == 1) ? true : false, 
                                    ['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{trans('admin.ca_academic')}} &nbsp;
                                </label>
                                
                                <label class="form-label" >
                                    {!! Form::radio('CourseTypeID', '2',
                                    ($test_package->CourseID != 1) ? true : false, 
                                    ['class' => '', 'required' => 'required']) !!}
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
                            {!! Form::text('NumberOfTest', $test_package->NumberOfTest, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-pattern' => '^[0-9]$']) !!}

                            @if($errors->has('NumberOfTest'))
                                <p class="help-block">
                                    {{ $errors->first('NumberOfTest') }}
                                </p>
                            @endif
                        </div>
                    </div>
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
                            {!! Form::label('TestPackageListPriceTCD', trans('admin.test_packages.fields.list-price-tcd'), ['class' => 'control-label']) !!}
                            {!! Form::text('TestPackageListPriceTCD', $test_package->TestPackageListPriceTCD, ['class' => 'form-control', 'placeholder' => '', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

                            @if($errors->has('TestPackageListPriceTCD'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageListPriceTCD') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('DifficultyLevelID', trans('admin.test_packages.fields.difficulty-level').'*', ['class' => 'control-label']) !!}
                            {!! Form::select('DifficultyLevelID', $dif_levels, $test_package->DifficultyLevelID, ['class' => 'form-control', 'placeholder' => 'Please Select Difficulty Level', 'required' => '']) !!}

                            @if($errors->has('DifficultyLevelID'))
                                <p class="help-block">
                                    {{ $errors->first('DifficultyLevelID') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 form-group academic">
                            {!! Form::label('BoardID', trans('admin.board_standard_subjects.fields.board-name').'', ['class' => 'control-label']) !!}
                            {!! Form::select('BoardID', $boards, $test_package->BoardID,['id'=>'board_id', 'class' => 'form-control', 'placeholder' => 'Please Select Board', 'required' => '']) !!}

                            @if($errors->has('BoardID'))
                                <p class="help-block">
                                    {{ $errors->first('BoardID') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group academic">
                            {!! Form::label('StandardID', trans('admin.board_standard_subjects.fields.standard-name').'', ['class' => 'control-label']) !!}
                            {!! Form::select('StandardID', $standards, $test_package->StandardID, ['id'=>'standard_id', 'class' => 'form-control', 'placeholder' => 'Please Select Standard', 'required' => '']) !!}

                            @if($errors->has('StandardID'))
                                <p class="help-block">
                                    {{ $errors->first('StandardID') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group competitive">
                            {!! Form::label('CourseID', trans('admin.course_subjects.fields.course-name').'', ['class' => 'control-label']) !!}
                            {!! Form::select('CourseID', $courses, $test_package->CourseID, ['id'=>'course_id', 'class' => 'form-control', 'placeholder' => 'Please Select Course', 'required' => '']) !!}

                            @if($errors->has('CourseID'))
                                <p class="help-block">
                                    {{ $errors->first('CourseID') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group academic">
                            {!! Form::label('SubjectID', trans('admin.board_standard_subjects.fields.subject-name').'', ['class' => 'control-label']) !!}
                            {!! Form::select('SubjectID', $subjects, $test_package->SubjectID, ['id'=>'subject_id', 'class' => 'form-control', 'placeholder' => 'Please Select Subject', 'required' => '']) !!}

                            @if($errors->has('SubjectID'))
                                <p class="help-block">
                                    {{ $errors->first('SubjectID') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-3 form-group competitive">
                            {!! Form::label('NumberofQuestion', trans('admin.test_packages.fields.no-question').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('NumberofQuestion', (count($package_details) > 0) ? $package_details[0]->NumberofTest : old('NumberofQuestion'), ['class' => 'form-control', 'placeholder' => 'Number of Question', 'required' => '', 'data-parsley-pattern' => '^[0-9]$']) !!}

                            @if($errors->has('NumberofQuestion'))
                                <p class="help-block">
                                    {{ $errors->first('NumberofQuestion') }}
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
                    <!-- {!! Form::hidden('BoardStandardSubjectID', old('BoardStandardSubjectID'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::hidden('CourseSubjectID', old('CourseSubjectID'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!} -->
                    <!-- {!! Form::hidden('TutorID', old('TutorID'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!} -->
                    {!! Form::submit(trans('admin.ca_update'), ['class' => 'btn btn-success']) !!}
                    <a href="{{ route('testPackages.index') }}" class="btn btn-info">@lang('admin.ca_cancel')</a>
                    {!! Form::close() !!}
                </div>
                <div id="detail" class="tab-pane fade {{ (!empty(\Request::get('tab')) && \Request::get('tab') == 'detail') ? 'active in' : '' }} p-t-10">
                    {!! Form::open(['method' => 'POST', 'route' => ['package_detail'], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                    {!! Form::hidden('PackageID', $test_package->TestPackageID, ['class' => 'form-control', 'id' => 'package_id', 'placeholder' => '', 'required' => '']) !!}
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
                            {!! Form::label('NumberofQuestion', trans('admin.test_packages.fields.number').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('NumberofQuestion', old('NumberofQuestion'), ['class' => 'form-control', 'placeholder' => 'Number of Question', 'required' => '', 'data-parsley-pattern' => '^[0-9]$']) !!}

                            @if($errors->has('NumberofQuestion'))
                                <p class="help-block">
                                    {{ $errors->first('NumberofQuestion') }}
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
                                <th class="width-25">{{trans('admin.test_packages.fields.number')}}</th>
                                <th class="width-25">{{trans('admin.ca_action')}}</th>
                            </tr>
                        </thead>
                        <tbody class="tp_detail row_position">
                            @foreach($package_details as $key => $package_detail)
                            <tr class="mul_div">
                                <td>
                                    <input name="TestPackageDetailID" type="hidden" value="{{$package_detail->TestPackageDetailID}}">
                                    {{$package_detail->testType->TestTypeName}}
                                </td>
                                <td>@if (!empty($package_detail->chapter)) 
                                        {{$package_detail->chapter->ChapterName}}
                                    @endif

                                    @if (!empty($package_detail->topic)) 
                                        {{$package_detail->topic->TopicName}}
                                    @endif

                                    @if (!empty($package_detail->unit)) 
                                        {{$package_detail->unit->UnitName}}
                                    @endif
                                </td>
                                <td>
                                    {{$package_detail->NumberofTest}}
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-xs delete">
                                        <i class="fa fa-close"></i> Delete 
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- <button type="button" class="btn btn-info">Next</button> -->
                </div>
                <!-- <div id="section" class="tab-pane fade p-t-10">
                    {!! Form::model($test_package, ['method' => 'PUT', 'route' => ['testPackages.update', $test_package->TestPackageID], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                    <div class="row">
                        <div class="col-xs-8 form-group">
                            {!! Form::label('Heading', 'Heading'.'*', ['class' => 'control-label']) !!}
                            {!! Form::text('Heading', $test_package->Heading, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

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
                            {!! Form::select('QuestionType', $test_types, null, ['class' => 'form-control', 'id'=>'test_type_id', 'placeholder' => 'Please Select Test Type', 'required' => '']) !!}

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
                            @foreach($package_details as $key => $package_detail)
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
                            @endforeach
                        </tbody>
                    </table>
                    <a href="" class="btn btn-info">Next</a>
                </div>
                <div id="questions" class="tab-pane fade p-t-10">
                    {!! Form::model($test_package, ['method' => 'PUT', 'route' => ['testPackages.update', $test_package->TestPackageID], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                    <div class="row">
                        <div class="col-xs-8 form-group">
                            {{'Section 1'}}
                        </div>
                    </div>
                    <a href="" class="btn btn-info">Publish</a>
                </div> -->
            </div>
        </div>
    </div>
@stop

@section('javascript')
<!-- ckeditor -->
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

        /**** Ajax call to get standards based on board ****/ 
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

        // Delete row on delete button click
        $(document).on("click", ".delete", function() {
            var csrf_token = "{{ csrf_token() }}";
            var package_detail_ids = $(this).parents("tr").find('input[type="hidden"]');
            package_detail_ids.each(function() {
                package_detail_id = $(this).val();
            });
            $("#ajax_loader").css("display", "block");
            $.ajax({
                url: "{{route('packageDetail_ajaxdelete')}}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'package_detail_id': package_detail_id,
                    '_token': csrf_token
                },
                success: function(data) {
                    $("#ajax_loader").css("display", "none");
                    if (data.error) {
                        if (data.message.book_attribute_id) {
                            $('.alert-error').html(data.message.book_attribute_id[0]);
                        }
                    }
                },
            });

            $(this).parents("tr").remove();
        });
    });
</script>
@stop
