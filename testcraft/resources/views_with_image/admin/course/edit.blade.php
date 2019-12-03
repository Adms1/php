@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.courses.title')</h3>
    
    {!! Form::model($course, ['method' => 'PUT', 'route' => ['courses.update', $course->CourseID], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('admin.ca_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('CourseName', trans('admin.courses.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('CourseName', $course->CourseName, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                    @if($errors->has('CourseName'))
                        <p class="help-block">
                            {{ $errors->first('CourseName') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('IsActive', trans('admin.courses.fields.is-active'), ['class' => 'control-label']) !!}
                    <div class="btn-group width-100" id="status" data-toggle="buttons">
                        <label class="btn btn-default btn-on {{($course->IsActive == 1) ? 'active' : ''}}" >
                        <input type="radio" value="1" name="IsActive" {{($course->IsActive == 1) ? "checked='checked'" : ""}}>YES</label>
                        <label class="btn btn-default btn-off {{(!$course->IsActive == 1) ? 'active' : ''}}">
                        <input type="radio" value="0" name="IsActive" {{(!$course->IsActive == 1) ? "checked='checked'" : ""}}>NO</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('CourseTypeID', trans('admin.courses.fields.type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('CourseTypeID', $course_types, $course->CourseTypeID, ['class' => 'form-control', 'required' => '']) !!}

                    @if($errors->has('CourseTypeID'))
                        <p class="help-block">
                            {{ $errors->first('CourseTypeID') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('photo', trans('admin.courses.fields.photo'), ['class' => 'control-label']) !!}
                    {!! Form::file('photo', ['id'=>'photo', 'onchange' => 'handleFileSelect()']) !!}
                    <output id="result">
                        <img class="col-md-3 col-sm-3 col-xs-12" src="{{URL::asset('/'.$course->Icon)}}">
                    <output/>
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('admin.ca_update'), ['class' => 'btn btn-success']) !!}
    <a href="{{ route('courses.index') }}" class="btn btn-info">@lang('admin.ca_cancel')</a>
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