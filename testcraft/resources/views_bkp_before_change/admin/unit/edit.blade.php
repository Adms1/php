@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.units.title')</h3>
    
    {!! Form::model($unit, ['method' => 'PUT', 'route' => ['units.update', $unit->UnitID], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('admin.ca_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('UnitName', trans('admin.units.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('UnitName', $unit->unit->UnitName, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                    @if($errors->has('UnitName'))
                        <p class="help-block">
                            {{ $errors->first('UnitName') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('IsActive', trans('admin.units.fields.is-active'), ['class' => 'control-label']) !!}
                    <div class="btn-group width-100" id="status" data-toggle="buttons">
                        <label class="btn btn-default btn-on {{($unit->IsActive == 1) ? 'active' : ''}}" >
                        <input type="radio" value="1" name="IsActive" {{($unit->IsActive == 1) ? "checked='checked'" : ""}}>YES</label>
                        <label class="btn btn-default btn-off {{(!$unit->IsActive == 1) ? 'active' : ''}}">
                        <input type="radio" value="0" name="IsActive" {{(!$unit->IsActive == 1) ? "checked='checked'" : ""}}>NO</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('BoardID', trans('admin.board_standard_subjects.fields.board-name').'', ['class' => 'control-label board']) !!}
                    {!! Form::select('BoardID', $boards, $unit->BoardID,['id'=>'board_id', 'class' => 'form-control board', 'placeholder' => 'Please Select Board', 'required' => '']) !!}

                    @if($errors->has('BoardID'))
                        <p class="help-block">
                            {{ $errors->first('BoardID') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('StandardID', trans('admin.board_standard_subjects.fields.standard-name').'', ['class' => 'control-label standard']) !!}
                    {!! Form::select('StandardID', $standards, $unit->StandardID,['id'=>'standard_id', 'class' => 'form-control standard', 'placeholder' => 'Please Select Standard', 'required' => '']) !!}

                    @if($errors->has('StandardID'))
                        <p class="help-block">
                            {{ $errors->first('StandardID') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('SubjectID', trans('admin.board_standard_subjects.fields.subject-name').'', ['class' => 'control-label subject']) !!}
                    {!! Form::select('SubjectID', $subjects, $unit->SubjectID,['id'=>'subject_id', 'class' => 'form-control subject', 'placeholder' => 'Please Select Subject', 'required' => '']) !!}

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
                    {!! Form::select('ChapterID[]', $chapters, $unit->pluck('ChapterID'),['id'=>'chapter_id', 'class' => 'form-control chapter', 'required' => '', 'multiple']) !!}

                    @if($errors->has('ChapterID'))
                        <p class="help-block">
                            {{ $errors->first('ChapterID') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('admin.ca_update'), ['class' => 'btn btn-success']) !!}
    <a href="{{ route('units.index') }}" class="btn btn-info">@lang('admin.ca_cancel')</a>
    {!! Form::close() !!}
@stop

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $('#chapter_id').select2({
            placeholder: 'Select Chapter',
            allowClear: true,
            closeOnSelect: false
        });

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
                        $('select[name="ChapterID[]"]').empty();
                        $.each(data.data, function(key, value) {
                            $('select[name="ChapterID[]"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        $('select[name="ChapterID[]"]').val('').trigger('change');
                    }
                },
            });
        });

        /**** Get list of unites for autocomplete ****/ 
        $( function() {
            $.ajax({
                url:"{{route('unit_ajaxget')}}",
                type:'POST',
                dataType:'json',
                success:function(data) {
                    if (data.success) {
                        var availableNames = data.data;

                        $( "#UnitName" ).autocomplete({
                            source: availableNames
                        });
                    }
                },
            });
        });
    });
</script>
@stop
