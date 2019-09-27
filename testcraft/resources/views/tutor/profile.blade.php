@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.ca_profile')</h3>
    
    {!! Form::model($tutor, ['method' => 'PUT', 'route' => ['tutor_profile'], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}

    <div class="panel panel-default">

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    <div>
                        {!! Form::label('TutorName', trans('admin.tutors.fields.name').'*', ['class' => 'control-label']) !!}
                        {!! Form::text('TutorName', $tutor->TutorName, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('TutorName'))
                            <p class="help-block">
                                {{ $errors->first('TutorName') }}
                            </p>
                        @endif
                    </div>
                    <div>
                        {!! Form::label('InstituteName', trans('admin.institutes.fields.name').'*', ['class' => 'control-label']) !!}
                        {!! Form::text('InstituteName', (count($tutor->institutes) > 0 ) ? $tutor->institutes[0]->InstituteName : '', ['class' => 'form-control', 'placeholder' => '', 'id'=>'InstituteName']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('InstituteName'))
                            <p class="help-block">
                                {{ $errors->first('InstituteName') }}
                            </p>
                        @endif
                    </div>
                    <div>
                        {!! Form::label('TutorEmail', trans('admin.tutors.fields.email').'*', ['class' => 'control-label']) !!}
                        {!! Form::email('TutorEmail', $tutor->TutorEmail, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('TutorEmail'))
                            <p class="help-block">
                                {{ $errors->first('TutorEmail') }}
                            </p>
                        @endif
                    </div>
                    <div>
                        {!! Form::label('TutorPhoneNumber', trans('admin.tutors.fields.phone').'*', ['class' => 'control-label']) !!}
                        {!! Form::text('TutorPhoneNumber', $tutor->TutorPhoneNumber, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('TutorPhoneNumber'))
                            <p class="help-block">
                                {{ $errors->first('TutorPhoneNumber') }}
                            </p>
                        @endif
                    </div>
                    <div>
                        {!! Form::label('photo', trans('admin.tutors.fields.photo'), ['class' => 'control-label']) !!}
                        {!! Form::file('photo', ['id'=>'photo', 'onchange' => 'handleFileSelect()']) !!}
                        @if ($tutor->Photo)
                    </div>
                </div>
                <div class="col-xs-6 form-group">
                    <output id="result">
                        <img class="col-md-6 col-sm-6 col-xs-12 f-right" src="{{URL::asset('/'.$tutor->Photo)}}">
                    </output>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('admin.ca_update'), ['class' => 'btn btn-success']) !!}
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
                    div.innerHTML = ["<img class='col-md-6 col-sm-6 col-xs-12 f-right' src='" + picFile.result + "'" + "title='" + picFile.name + "'/><span class='remove_img_preview f-right'></span>"].join('');
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

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /**** Get list of institutes for autocomplete ****/ 
        $( function() {
            $.ajax({
                url:"{{route('institute_ajaxget')}}",
                type:'POST',
                dataType:'json',
                success:function(data) {
                    if (data.success) {
                        var availableNames = data.data;

                        $( "#InstituteName" ).autocomplete({
                            source: availableNames
                        });
                    }
                },
            });
        });
    });
</script>
@stop
