@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.questions.title')</h3>
    
    {!! Form::open(['method' => 'PUT', 'route' => ['questions.update', $question->QuestionID], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('admin.ca_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('IsCompetetive ', trans('admin.test_packages.fields.type').'*') !!}
                    <div class="form-group">
                        <label class="form-label" >
                            {!! Form::radio('IsCompetetive', '0', 
                            ($question->DifficultyLevelID != 4) ? true : false, 
                            ['class' => '', 'required' => 'required', 'disabled']) !!}
                            &nbsp; {{trans('admin.ca_academic')}} &nbsp;
                        </label>
                        
                        <label class="form-label" >
                            {!! Form::radio('IsCompetetive', '1',
                            ($question->DifficultyLevelID == 4) ? true : false, 
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
                <div class="col-xs-4 form-group academic">
                    {!! Form::label('BoardID', trans('admin.board_standard_subjects.fields.board-name').'', ['class' => 'control-label board']) !!}
                    {!! Form::select('BoardID', $boards, $board_id, ['id'=>'board_id', 'class' => 'form-control board', 'placeholder' => 'Please Select Board', 'required' => '', 'data-parsley-errors-container' => '#board_id_error']) !!}

                    <p id="board_id_error" class="help-block">
                    @if($errors->has('BoardID'))
                        {{ $errors->first('BoardID') }}
                    @endif
                    </p>
                </div>
                <div class="col-xs-4 form-group academic">
                    {!! Form::label('StandardID', trans('admin.board_standard_subjects.fields.standard-name').'', ['class' => 'control-label standard']) !!}
                    {!! Form::select('StandardID', $standards, $standard_id, ['id'=>'standard_id', 'class' => 'form-control standard', 'placeholder' => 'Please Select Standard', 'required' => '', 'data-parsley-errors-container' => '#standard_id_error']) !!}

                    <p id="standard_id_error" class="help-block">
                    @if($errors->has('StandardID'))
                        {{ $errors->first('StandardID') }}
                    @endif
                    </p>
                </div>
                <div class="col-xs-4 form-group competitive">
                    {!! Form::label('CourseID', trans('admin.course_subjects.fields.course-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('CourseID', $courses, $course_id,['id'=>'course_id', 'class' => 'form-control', 'placeholder' => 'Please Select Course', 'required' => '', 'data-parsley-errors-container' => '#course_id_error']) !!}

                    <p id="course_id_error" class="help-block">
                    @if($errors->has('CourseID'))
                        {{ $errors->first('CourseID') }}
                    @endif
                    </p>
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('SubjectID', trans('admin.board_standard_subjects.fields.subject-name').'', ['class' => 'control-label subject']) !!}
                    {!! Form::select('SubjectID', $subjects, $subject_id, ['id'=>'subject_id', 'class' => 'form-control subject', 'placeholder' => 'Please Select Subject', 'required' => '', 'data-parsley-errors-container' => '#subject_id_error']) !!}

                    <p id="subject_id_error" class="help-block">
                    @if($errors->has('SubjectID'))
                        {{ $errors->first('SubjectID') }}
                    @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group academic">
                    {!! Form::label('ChapterID', trans('admin.chapters.fields.name').'', ['class' => 'control-label chapter']) !!}
                    {!! Form::select('ChapterID', $chapters, $chapter_id, ['id'=>'chapter_id', 'class' => 'form-control chapter', 'placeholder' => 'Please Select Chapter', 'required' => '', 'data-parsley-errors-container' => '#chapter_id_error']) !!}

                    <p id="chapter_id_error" class="help-block">
                    @if($errors->has('ChapterID'))
                        {{ $errors->first('ChapterID') }}
                    @endif
                    </p>
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('TopicID', trans('admin.topics.fields.name').'', ['class' => 'control-label topic']) !!}
                    {!! Form::select('TopicID', $topics, $topic_id, ['id'=>'topic_id', 'class' => 'form-control topic', 'placeholder' => 'Please Select Topic', 'required' => '', 'data-parsley-errors-container' => '#topic_id_error']) !!}

                    <p id="topic_id_error" class="help-block">
                    @if($errors->has('TopicID'))
                        {{ $errors->first('TopicID') }}
                    @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('Marks', trans('admin.questions.fields.mark').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('Marks', $question->Marks, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                    @if($errors->has('Marks'))
                        <p class="help-block">
                            {{ $errors->first('Marks') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('DifficultyLevelID', trans('admin.questions.fields.difficulty-level').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('DifficultyLevelID', $dif_levels, $question->DifficultyLevelID,['class' => 'form-control', 'placeholder' => 'Please Select Difficulty Level', 'required' => '']) !!}

                    @if($errors->has('DifficultyLevelID'))
                        <p class="help-block">
                            {{ $errors->first('DifficultyLevelID') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('QuestionTypeID ', trans('admin.questions.fields.type').'*') !!}
                    <div class="form-group">
                        @foreach($question_types as $question_type)
                        <label class="form-label" >
                            {!! Form::radio('QuestionTypeID', $question_type->QuestionTypeID, ($question->QuestionTypeID == $question_type->QuestionTypeID) ? true : false, ['class' => '', 'required' => 'required', 'data-parsley-errors-container' => '#question_type_error']) !!}
                            &nbsp; {{ $question_type->QuestionTypeName }} &nbsp;
                        </label>
                        @endforeach
                    </div>
                    <p id="question_type_error" class="help-block">
                    @if($errors->has('QuestionTypeID'))
                        {{ $errors->first('QuestionTypeID') }}
                    @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('QuestionText', trans('admin.questions.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('QuestionText', $question->QuestionText, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                    @if($errors->has('QuestionText'))
                        <p class="help-block">
                            {{ $errors->first('QuestionText') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('Answer'.'*') !!}
                    <div class="form-group" id="options">
                        {!! $view !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                            <h4 class="panel-title">{{trans('admin.ca_hint')}}</h4></a>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                {!! Form::textarea('HintText', $question->hint->HintText, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                            <h4 class="panel-title">{{trans('admin.ca_explaination')}}</h4></a>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                {!! Form::textarea('ExplainationText', $question->explaination->ExplainationText, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('IsActive', trans('admin.questions.fields.is-active'), ['class' => 'control-label']) !!}
                    <div class="btn-group width-100" id="status" data-toggle="buttons">
                        <label class="btn btn-default btn-on {{ ($question->IsActive == 1) ? 'active' : '' }}" >
                        <input type="radio" value="1" name="IsActive" {{ ($question->IsActive == 1) ? 'checked' : '' }}>YES</label>
                        <label class="btn btn-default btn-off {{ ($question->IsActive == 0) ? 'active' : '' }}">
                        <input type="radio" value="0" name="IsActive" {{ ($question->IsActive == 0) ? 'checked' : '' }}>NO</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('TutorID', old('TutorID'), ['class' => 'form-control']) !!}
    {!! Form::submit(trans('admin.ca_submit'), ['class' => 'btn btn-success']) !!}
    <a href="{{ route('questions.index') }}" class="btn btn-info">@lang('admin.ca_cancel')</a>
    {!! Form::close() !!}
@stop


@section('javascript')
<!-- ckeditor -->
<script src="{{asset('adminlte/plugins/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('adminlte/plugins/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>

<script type="text/javascript">

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

    /***** Get Difficulty Level Dropdown *****/
    function changeDifficultyLevel(value) {
        $.ajax({
            url:"{{route('difficulty_ajaxget')}}",
            type:'POST',
            dataType:'json',
            data:{'IsCompetetive':value,
                '_token': "{{csrf_token()}}",
            },
            success:function(data) {
                $("#ajax_loader").css("display", "none");
                if (data.success) {
                    $('select[name="DifficultyLevelID"]').empty();
                    $('select[name="DifficultyLevelID"]').append('<option value=""> Please Select Difficulty Level </option>');
                    $.each(data.data, function(key, value) {
                        $('select[name="DifficultyLevelID"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            },
        });
    }

    $(document).ready(function() {
        /**** Select2 Dropdown ****/ 
        $('#board_id').select2({});
        $('#standard_id').select2();
        $('#subject_id').select2();
        $('#course_id').select2();
        $('#chapter_id').select2();
        $('#topic_id').select2();
        
        /**** Ckeditor ****/ 
        //$('textarea').ckeditor();
        CKEDITOR.replace('QuestionText', {
            height: 100,
        });

        CKEDITOR.replace('HintText', {
            height: 30,
        });

        CKEDITOR.replace('ExplainationText', {
            height: 30,
        });

        var textarea = document.getElementById("OptionText[]");
        if (textarea !== ''){
            $('textarea[name="OptionText[]"]').each(function () {
                CKEDITOR.replace(this, {
                    height: 30,
                });
            });
        }

        CKEDITOR.config.extraPlugins = 'autogrow';
        CKEDITOR.config.autoGrow_maxHeight = 500;
        CKEDITOR.config.autoGrow_minHeight = 30;
        CKEDITOR.config.toolbarCanCollapse = true;
        CKEDITOR.config.filebrowserUploadUrl = "{{ route('upload',['_token' => csrf_token() ]) }}";
        //CKEDITOR.config.toolbarStartupExpanded = false;

        /**** Hide/Show academic fields on load ****/ 
        if ($("input[name='IsCompetetive']:checked").val() == '0') {
            $('.competitive').css("display", "none");
            $('.academic').css("display", "block");
            $(".academic :input").prop("required", true);
            $(".competitive :input").prop("required", false);
            //$("#DifficultyLevelID").removeAttr('disabled');
        } else {
            $(".academic :input").prop("required", false);
            $('.competitive').css("display", "block");
            $('.academic').css("display", "none");
            $(".competitive :input").prop("required", true);
            //$("#DifficultyLevelID").attr('disabled','disabled');
            //$("#DifficultyLevelID").attr('selected','selected');
        }

        /**** On change of radio button hide/show fields ****/ 
        // $('input[name=IsCompetetive]').change(function(){
        //     //$('select').val('').trigger('change');
        //     if(this.value == '0') {
        //         $('.competitive').fadeOut('slow');
        //         $('.academic').fadeIn('slow');
        //         $(".academic :input").prop("required", true);
        //         $(".competitive :input").prop("required", false);
        //         $('select[name="DifficultyLevelID"]').val('1');
        //         $("#DifficultyLevelID").removeAttr('disabled');
        //     } else {
        //         $(".academic :input").prop("required", false);
        //         $('.competitive').fadeIn('slow');
        //         $('.academic').fadeOut('slow');
        //         $(".competitive :input").prop("required", true);
        //         $('select[name="DifficultyLevelID"] option[value="4"]').attr('selected', 'selected');
        //         //$("#DifficultyLevelID").attr('disabled','disabled');
        //     }
        // });

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                        sortingValue(data.data, $('select[name="StandardID"]'));
                        // $.each(data.data, function(key, value) {
                        //     $('select[name="StandardID"]').append('<option value="'+ key +'">'+ value +'</option>');
                        // });
                        //$('select[name="StandardID"]').val('').trigger('change');
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
                        sortingValue(data.data, $('select[name="SubjectID"]'));
                        // $.each(data.data, function(key, value) {
                        //     $('select[name="SubjectID"]').append('<option value="'+ key +'">'+ value +'</option>');
                        // });
                        //$('select[name="SubjectID"]').val('').trigger('change');
                    }
                },
            });
        });

        /**** Ajax call to get ChapterID based on board, standard and subject ****/ 
        $('body').on('change', '#subject_id', function(){
            var board_id = $("#board_id").val();
            var standard_id = $("#standard_id").val();
            var subject_id = $("#subject_id").val();
            var course_id = $("#course_id").val();
            $("#ajax_loader").css("display", "block");
            if (course_id) {
                $.ajax({
                    url:"{{route('topic_ajaxget')}}",
                    type:'POST',
                    dataType:'json',
                    data:{'course_id':course_id, 'subject_id':subject_id},
                    success:function(data) {
                        $("#ajax_loader").css("display", "none");
                        if (data.success) {
                            $('select[name="TopicID"]').empty();
                            $('select[name="TopicID"]').append('<option value=""> Please Select Topic </option>');
                            sortingValue(data.data, $('select[name="TopicID"]'));
                            // $.each(data.data, function(key, value) {
                            //     $('select[name="TopicID"]').append('<option value="'+ key +'">'+ value +'</option>');
                            // });
                        }
                    },
                });
            } else {
                $.ajax({
                    url:"{{route('chapter_ajaxget')}}",
                    type:'POST',
                    dataType:'json',
                    data:{'board_id':board_id, 'standard_id':standard_id, 'subject_id':subject_id},
                    success:function(data) {
                        $("#ajax_loader").css("display", "none");
                        if (data.success) {
                            $('select[name="ChapterID"]').empty();
                            $('select[name="ChapterID"]').append('<option value=""> Please Select Chapter </option>');
                            sortingValue(data.data, $('select[name="ChapterID"]'));
                            // $.each(data.data, function(key, value) {
                            //     $('select[name="ChapterID"]').append('<option value="'+ key +'">'+ value +'</option>');
                            // });
                            //$('select[name="ChapterID"]').val('').trigger('change');
                        }
                    },
                });
            }
        });

        /**** Ajax call to get TopicID based on board, standard subject and chapter ****/ 
        $('body').on('change', '#chapter_id', function(){
            var board_id = $("#board_id").val();
            var standard_id = $("#standard_id").val();
            var subject_id = $("#subject_id").val();
            var chapter_id = $("#chapter_id").val();
            $("#ajax_loader").css("display", "block");
            $.ajax({
                url:"{{route('topic_ajaxget')}}",
                type:'POST',
                dataType:'json',
                data:{'board_id':board_id, 'standard_id':standard_id, 'subject_id':subject_id, 'chapter_id':chapter_id},
                success:function(data) {
                    $("#ajax_loader").css("display", "none");
                    if (data.success) {
                        $('select[name="TopicID"]').empty();
                        $('select[name="TopicID"]').append('<option value=""> Please Select Topic </option>');
                        sortingValue(data.data, $('select[name="TopicID"]'));
                        // $.each(data.data, function(key, value) {
                        //     $('select[name="TopicID"]').append('<option value="'+ key +'">'+ value +'</option>');
                        // });
                        //$('select[name="TopicID"]').val('').trigger('change');
                    }
                },
            });
        });

        // Get question formate by ajax call
        $('input[name=QuestionTypeID]').change(function(){
            var type_id = $("input[name='QuestionTypeID']:checked").val();
            $("#ajax_loader").css("display", "block");

            $.ajax({
                url:"{{route('get_question_format')}}",
                type: "GET",
                data:{'QuestionTypeID':type_id},
                success: function(data) {
                    $("#ajax_loader").css("display", "none");
                    $('#options').html(data.list);
                    $('textarea[name="OptionText[]"]').each(function () {
                        CKEDITOR.replace(this, {
                            height: 30,
                            filebrowserUploadUrl: "{{ route('upload',['_token' => csrf_token() ]) }}"
                        });
                    });
                }
            });
        });
    });
</script>
@stop
