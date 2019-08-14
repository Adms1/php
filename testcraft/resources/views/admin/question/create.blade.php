@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.questions.title')</h3>
    
    {!! Form::open(['method' => 'POST', 'route' => ['questions.store'], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('admin.ca_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('BoardID', trans('admin.board_standard_subjects.fields.board-name').'', ['class' => 'control-label board']) !!}
                    {!! Form::select('BoardID', $boards, null,['id'=>'board_id', 'class' => 'form-control board', 'placeholder' => 'Please Select Board', 'required' => '']) !!}

                    @if($errors->has('BoardID'))
                        <p class="help-block">
                            {{ $errors->first('BoardID') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('StandardID', trans('admin.board_standard_subjects.fields.standard-name').'', ['class' => 'control-label standard']) !!}
                    {!! Form::select('StandardID', [], null,['id'=>'standard_id', 'class' => 'form-control standard', 'placeholder' => 'Please Select Standard', 'required' => '']) !!}

                    @if($errors->has('StandardID'))
                        <p class="help-block">
                            {{ $errors->first('StandardID') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('SubjectID', trans('admin.board_standard_subjects.fields.subject-name').'', ['class' => 'control-label subject']) !!}
                    {!! Form::select('SubjectID', [], null,['id'=>'subject_id', 'class' => 'form-control subject', 'placeholder' => 'Please Select Subject', 'required' => '']) !!}

                    @if($errors->has('SubjectID'))
                        <p class="help-block">`
                            {{ $errors->first('SubjectID') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('ChapterID', trans('admin.chapters.fields.name').'', ['class' => 'control-label chapter']) !!}
                    {!! Form::select('ChapterID', [], null,['id'=>'chapter_id', 'class' => 'form-control chapter', 'placeholder' => 'Please Select Chapter', 'required' => '']) !!}

                    @if($errors->has('ChapterID'))
                        <p class="help-block">
                            {{ $errors->first('ChapterID') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('TopicID', trans('admin.topics.fields.name').'', ['class' => 'control-label topic']) !!}
                    {!! Form::select('TopicID', [], null,['id'=>'topic_id', 'class' => 'form-control topic', 'placeholder' => 'Please Select Topic', 'required' => '']) !!}

                    @if($errors->has('TopicID'))
                        <p class="help-block">
                            {{ $errors->first('TopicID') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('Marks', trans('admin.questions.fields.mark').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('Marks', old('Marks'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                    @if($errors->has('Marks'))
                        <p class="help-block">
                            {{ $errors->first('Marks') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('DifficultyLevelID', trans('admin.questions.fields.difficulty-level').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('DifficultyLevelID', $dif_levels, null,['class' => 'form-control', 'placeholder' => 'Please Select Difficulty Level', 'required' => '']) !!}

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
                            {!! Form::radio('QuestionTypeID', $question_type->QuestionTypeID, false, ['class' => '', 'required' => 'required']) !!}
                            &nbsp; {{ $question_type->QuestionTypeName }} &nbsp;
                        </label>
                        @endforeach

                        @if($errors->has('QuestionTypeID'))
                            <p class="help-block">
                                {{ $errors->first('QuestionTypeID') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('QuestionText', trans('admin.questions.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('QuestionText', old('QuestionText'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

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
                        <table class="width-100">
                            @php
                                $a = 1; 
                            @endphp

                            @for ($a=1;$a<=4;$a++)

                            <tr>
                                <td>
                                    <label class="form-label" >
                                    {!! Form::radio('OptionValue[]', $a, false, ['class' => '', 'required' => 'required']) !!}
                                    </label>
                                </td>
                                <td>&nbsp; {!! Form::textarea('OptionText[]', old('OptionText[]'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!} &nbsp;</td>
                            </tr>

                            @endfor 
                        </table>
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
                                {!! Form::textarea('HintText', old('HintText'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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
                                {!! Form::textarea('ExplainationText', old('ExplainationText'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('IsActive', trans('admin.questions.fields.is-active'), ['class' => 'control-label']) !!}
                    <div class="btn-group width-100" id="status" data-toggle="buttons">
                        <label class="btn btn-default btn-on active" >
                        <input type="radio" value="1" name="IsActive" checked="checked">YES</label>
                        <label class="btn btn-default btn-off">
                        <input type="radio" value="0" name="IsActive">NO</label>
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
    $(document).ready(function() {

        /**** Ckeditor ****/ 
        //$('textarea').ckeditor();
        CKEDITOR.replace('QuestionText', {
            height: 100
        });

        $('textarea[name="OptionText[]"]').each(function () {
            CKEDITOR.replace(this, {
                height: 30,
            });
        });

        CKEDITOR.replace('HintText', {
            height: 30,
        });

        CKEDITOR.replace('ExplainationText', {
            height: 30,
        });

        CKEDITOR.config.extraPlugins = 'autogrow';
        CKEDITOR.config.autoGrow_maxHeight = 500;
        CKEDITOR.config.autoGrow_minHeight = 30;
        CKEDITOR.config.toolbarCanCollapse = true;
        //CKEDITOR.config.toolbarStartupExpanded = false;

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
                        $('select[name="SubjectID"]').val('').trigger('change');
                    }
                },
            });
        });

        /**** Ajax call to get ChapterID based on board, standard and subject ****/ 
        $('body').on('change', '#subject_id', function(){
            var board_id = $("#board_id").val();
            var standard_id = $("#standard_id").val();
            var subject_id = $("#subject_id").val();
            $("#ajax_loader").css("display", "block");
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
                        $.each(data.data, function(key, value) {
                            $('select[name="ChapterID"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        $('select[name="ChapterID"]').val('').trigger('change');
                    }
                },
            });
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
                        $.each(data.data, function(key, value) {
                            $('select[name="TopicID"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        $('select[name="TopicID"]').val('').trigger('change');
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
                        });
                    });
                }
            });
        });
    });
</script>
@stop