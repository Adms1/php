@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.test_packages.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('admin.ca_create')
        </div>
        <div class="panel-body">
            <h2></h2>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#package">Create a Package</a></li>
            </ul>

            <div class="tab-content">
                <div id="package" class="tab-pane fade in active p-t-10">
                    {!! Form::open(['method' => 'POST', 'route' => ['testPackages.store'], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            {!! Form::label('IsCompetetive ', trans('admin.test_packages.fields.type').'*') !!}
                            <div class="form-group">
                                <label class="form-label" >
                                    {!! Form::radio('IsCompetetive', '0', true, ['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{trans('admin.ca_academic')}} &nbsp;
                                </label>
                                
                                <label class="form-label" >
                                    {!! Form::radio('IsCompetetive', '1', false,['class' => '', 'required' => 'required']) !!}
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
                                    {!! Form::radio('QuestionFrom', '1', true,['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{trans('admin.ca_tc_bank')}} &nbsp;
                                </label>

                                <label class="form-label" >
                                    {!! Form::radio('QuestionFrom', '2', false, ['class' => '', 'required' => 'required']) !!}
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
                                    {!! Form::radio('IsAutoTestCreation', '1', true,['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{trans('admin.ca_auto')}} &nbsp;
                                </label>

                                <label class="form-label" >
                                    {!! Form::radio('IsAutoTestCreation', '0', false, ['class' => '', 'required' => 'required']) !!}
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
                            {!! Form::text('TestPackageName', old('TestPackageName'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                            @if($errors->has('TestPackageName'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageName') }}
                                </p>
                            @endif
                        </div>
                        <!-- <div class="col-xs-3 form-group">
                            {!! Form::label('StatusID', trans('admin.test_packages.fields.is-active'), ['class' => 'control-label']) !!}
                            <div class="btn-group width-100" id="status" data-toggle="buttons">
                                <label class="btn btn-default btn-on" >
                                <input type="radio" value="9" name="StatusID">YES</label>
                                <label class="btn btn-default btn-off active">
                                <input type="radio" value="10" name="StatusID" checked="checked">NO</label>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-xs-4 form-group">
                            {!! Form::label('TestPackageSalePrice', trans('admin.test_packages.fields.sale-price').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('TestPackageSalePrice', old('TestPackageSalePrice'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

                            @if($errors->has('TestPackageSalePrice'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageSalePrice') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('TestPackageListPrice', trans('admin.test_packages.fields.list-price').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('TestPackageListPrice', old('TestPackageListPrice'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

                            @if($errors->has('TestPackageListPrice'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageListPrice') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('NumberOfTest', trans('admin.test_packages.fields.number').'*', ['class' => 'control-label']) !!}
                            {!! Form::number('NumberOfTest', old('NumberOfTest'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'max'=>'9', 'min'=>'1']) !!}

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
                            {!! Form::text('TestPackageSalePriceTCD', old('TestPackageSalePriceTCD'), ['class' => 'form-control', 'placeholder' => '', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

                            @if($errors->has('TestPackageSalePriceTCD'))
                                <p class="help-block">
                                    {{ $errors->first('TestPackageSalePriceTCD') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('TestPackageListPriceTCD', trans('admin.test_packages.fields.list-price-tcd').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('TestPackageListPriceTCD', old('TestPackageListPriceTCD'), ['class' => 'form-control', 'placeholder' => '', 'data-parsley-pattern' => '^[0-9]\d*(\.\d+)?$']) !!}

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
                            {!! Form::select('BoardID', $boards, null,['id'=>'board_id', 'class' => 'form-control', 'placeholder' => 'Please Select Board', 'required' => '']) !!}

                            @if($errors->has('BoardID'))
                                <p class="help-block">
                                    {{ $errors->first('BoardID') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group academic">
                            {!! Form::label('StandardID', trans('admin.board_standard_subjects.fields.standard-name').'*', ['class' => 'control-label']) !!}
                            {!! Form::select('StandardID', [], null,['id'=>'standard_id', 'class' => 'form-control', 'placeholder' => 'Please Select Standard', 'required' => '']) !!}

                            @if($errors->has('StandardID'))
                                <p class="help-block">
                                    {{ $errors->first('StandardID') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group competitive">
                            {!! Form::label('CourseID', trans('admin.course_subjects.fields.course-name').'*', ['class' => 'control-label']) !!}
                            {!! Form::select('CourseID', $courses, null,['id'=>'course_id', 'class' => 'form-control', 'placeholder' => 'Please Select Course', 'required' => '']) !!}

                            @if($errors->has('CourseID'))
                                <p class="help-block">
                                    {{ $errors->first('CourseID') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group academic">
                            {!! Form::label('SubjectID', trans('admin.board_standard_subjects.fields.subject-name').'*', ['class' => 'control-label']) !!}
                            {!! Form::select('SubjectID', [], null,['id'=>'subject_id', 'class' => 'form-control', 'placeholder' => 'Please Select Subject', 'required' => '']) !!}

                            @if($errors->has('SubjectID'))
                                <p class="help-block">`
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
                            <output id="result"></output>
                        </div>
                    </div>
                    {!! Form::hidden('TutorID', old('TutorID'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::hidden('StatusID', 10, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::submit(trans('admin.ca_submit'), ['class' => 'btn btn-success']) !!}
                    <a href="{{ route('testPackages.index') }}" class="btn btn-info">@lang('admin.ca_cancel')</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
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
        /**** Select2 Dropdown ****/ 
        $('#board_id').select2({
            placeholder: 'Please Select Board',
        });
        $('#standard_id').select2({
            placeholder: 'Please Select Standard',
        });
        $('#subject_id').select2({
            placeholder: 'Please Select Subject',
        });
        $('#course_id').select2({
            placeholder: 'Please Select Course',
        });

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
                $('select[name="StandardID"]').empty();
                $('select[name="SubjectID"]').empty();
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
                        $('select[name="SubjectID"]').empty();
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
                        sortingValue(data.data, $('select[name="SubjectID"]'));
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

    });
</script>
@stop
