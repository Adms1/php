@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.users.title')</h3>
    
    {!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update', $user->UserID], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('admin.ca_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('UserFullName', trans('admin.users.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('UserFullName', $user->UserFullName, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('UserFullName'))
                        <p class="help-block">
                            {{ $errors->first('UserFullName') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('UserEmail', trans('admin.users.fields.email').'*', ['class' => 'control-label']) !!}
                    {!! Form::email('UserEmail', $user->UserEmail, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('UserEmail'))
                        <p class="help-block">
                            {{ $errors->first('UserEmail') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('UserTypeID', trans('admin.users.fields.type').'', ['class' => 'control-label']) !!}

                    <select name="UserTypeID" class="form-control" required>
                        <option value="">{{ trans('admin.user_types.fields.select') }}</option>
                        @foreach ($user_types as $user_type)
                        <option value="{{$user_type->UserTypeID}}" 
                            {{($user->UserTypeID == $user_type->UserTypeID) ? 'selected' : ''}}>
                            {{$user_type->UserTypeName}}</option>
                        @endforeach
                    </select>

                    <p class="help-block"></p>
                    @if($errors->has('UserTypeID'))
                        <p class="help-block">
                            {{ $errors->first('UserTypeID') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('photo', trans('admin.users.fields.photo'), ['class' => 'control-label']) !!}
                    {!! Form::file('photo', ['id'=>'photo', 'onchange' => 'handleFileSelect()']) !!}
                    <output id="result">
                        <img class="col-md-3 col-sm-3 col-xs-12" src="{{URL::asset('/'.$user->Icon)}}">
                    <output/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('IsActive', trans('admin.users.fields.is-active'), ['class' => 'control-label']) !!}
                    <div class="btn-group width-100" id="status" data-toggle="buttons">
                        <label class="btn btn-default btn-on {{($user->IsActive == 1) ? 'active' : ''}}" >
                        <input type="radio" value="1" name="IsActive" {{($user->IsActive == 1) ? "checked='checked'" : ""}}>YES</label>
                        <label class="btn btn-default btn-off {{(!$user->IsActive == 1) ? 'active' : ''}}">
                        <input type="radio" value="0" name="IsActive" {{(!$user->IsActive == 1) ? "checked='checked'" : ""}}>NO</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('admin.ca_update'), ['class' => 'btn btn-success']) !!}
    <a href="{{ route('users.index') }}" class="btn btn-info">@lang('admin.ca_cancel')</a>
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
