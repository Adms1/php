@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.tutors.title')</h3>
    
    {!! Form::model($tutor, ['method' => 'PUT', 'route' => ['tutors.update', $tutor->TutorID], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('admin.ca_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('TutorName', trans('admin.tutors.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('TutorName', $tutor->TutorName, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('TutorName'))
                        <p class="help-block">
                            {{ $errors->first('TutorName') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('TutorEmail', trans('admin.tutors.fields.email').'*', ['class' => 'control-label']) !!}
                    {!! Form::email('TutorEmail', $tutor->TutorEmail, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('TutorEmail'))
                        <p class="help-block">
                            {{ $errors->first('TutorEmail') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('TutorPhoneNumber', trans('admin.tutors.fields.phone').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('TutorPhoneNumber', $tutor->TutorPhoneNumber, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('TutorPhoneNumber'))
                        <p class="help-block">
                            {{ $errors->first('TutorPhoneNumber') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('photo', trans('admin.tutors.fields.photo'), ['class' => 'control-label']) !!}
                    {!! Form::file('photo', ['id'=>'photo', 'onchange' => 'handleFileSelect()']) !!}
                    <output id="result">
                        <img class="col-md-3 col-sm-3 col-xs-12" src="{{URL::asset('/'.$tutor->Icon)}}">
                    <output/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('IsActive', trans('admin.tutors.fields.is-active'), ['class' => 'control-label']) !!}
                    <div class="btn-group width-100" id="status" data-toggle="buttons">
                        <label class="btn btn-default btn-on {{($tutor->IsActive == 1) ? 'active' : ''}}" >
                        <input type="radio" value="1" name="IsActive" {{($tutor->IsActive == 1) ? "checked='checked'" : ""}}>YES</label>
                        <label class="btn btn-default btn-off {{(!$tutor->IsActive == 1) ? 'active' : ''}}">
                        <input type="radio" value="0" name="IsActive" {{(!$tutor->IsActive == 1) ? "checked='checked'" : ""}}>NO</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('admin.ca_update'), ['class' => 'btn btn-success']) !!}
    <a href="{{ route('tutors.index') }}" class="btn btn-info">@lang('admin.ca_cancel')</a>
    {!! Form::close() !!}
@stop

@section('javascript')
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

    /**** Remove image on click ****/
    $('#result').on('click', '.remove_img_preview',function () {
        $(this).parent('div').remove();
        $('#photo').val("");
    });

</script>
@stop
