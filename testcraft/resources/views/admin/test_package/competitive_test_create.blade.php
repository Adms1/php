@extends('layouts.app')

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
                                            {!! Form::text('TestDuration', old('TestDuration'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-type'=>'digits', 'min'=>'1']) !!}

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
                                        <!-- <div class="col-xs-6 form-group">
                                            {!! Form::label('NumberofQuestion', trans('admin.tests.fields.question').'*', ['class' => 'control-label']) !!}
                                            {!! Form::text('NumberofQuestion', old('NumberofQuestion'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                                            @if($errors->has('NumberofQuestion'))
                                                <p class="help-block">
                                                    {{ $errors->first('NumberofQuestion') }}
                                                </p>
                                            @endif
                                        </div> -->
                                        <div class="col-xs-6 form-group">
                                            {!! Form::label('TestMarks', trans('admin.tests.fields.marks').'*', ['class' => 'control-label']) !!}
                                            {!! Form::text('TestMarks', old('TestMarks'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-type'=>'digits', 'min'=>'1']) !!}

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
                                        {{ trans('admin.ca_add_st') }}
                                    </h4>
                                </a>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    {!! Form::open(['method' => 'POST', 'id' => 'assignForm', 'data-parsley-validate']) !!}
                                    {!! Form::hidden('TestPackageTestID', null, ['class' => 'form-control', 'id' => 'test_id', 'placeholder' => '', 'required' => '']) !!}
                                    <div class="row">
                                        <div class="col-xs-3 form-group">
                                            {!! Form::label('SubjectID', trans('admin.subjects.title').'*', ['class' => 'control-label']) !!}
                                            {!! Form::select('SubjectID', $subjects, null,['class' => 'form-control', 'id'=>'test_type_id', 'placeholder' => 'Please Select Subject', 'required' => '']) !!}

                                            @if($errors->has('SubjectID'))
                                                <p class="help-block">
                                                    {{ $errors->first('SubjectID') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-xs-3 form-group">
                                            {!! Form::label('TopicID', trans('admin.topics.title').'*', ['class' => 'control-label', 'id' => 'TopicID']) !!}
                                            {!! Form::select('TopicID', [], null,['class' => 'form-control', 'id' => 'type_id','placeholder' => 'Please Select Topic', 'required' => '']) !!}

                                            @if($errors->has('TopicID'))
                                                <p class="help-block">
                                                    {{ $errors->first('TopicID') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-xs-3 form-group">
                                            {!! Form::label('Weightage', trans('admin.test_chapter_topic.fields.weightage').'*', ['class' => 'control-label']) !!}
                                            {!! Form::text('Weightage', old('Weightage'), ['class' => 'form-control', 'placeholder' => 'Weightage', 'required' => '', 'max'=>'100', 'min'=> '1', 'data-parsley-type'=>'digits']) !!}

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
                                        <span class="col-md-6 text-right"><b></b></span>
                                    </div>
                                    {!! Form::open(['method' => 'POST',  'id' => 'sectionFrom', 'data-parsley-validate']) !!}
                                    {!! Form::hidden('TestPackageTestID', null, ['class' => 'form-control', 'id' => 'test_id', 'placeholder' => '', 'required' => '']) !!}
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
                                            {!! Form::button(trans('admin.ca_add'), ['class' => 'btn btn-success']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                </div>
                            </div>
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
    });
</script>
@stop
