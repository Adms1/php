@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('admin.ca_tutor_registration')</div>

                <div class="card-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>@lang('admin.ca_whoops')</strong> @lang('admin.ca_there_were_problems_with_input'):
                            <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <ul class="list-unstyled">
                                <li>{{ Session::get('success') }}</li>
                            </ul>
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            <strong>@lang('admin.ca_whoops')</strong> 
                            <ul class="list-unstyled">
                                <li>
                                    <p>{{ Session::get('error') }}</p>
                                </li>
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tutors.store') }}" data-parsley-validate>
                        @csrf

                        <div class="form-group row">
                            <label for="InstituteName" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                                <label class="form-label" >
                                    {!! Form::radio('TypeID', '1', true, ['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{ trans('admin.ca_tutor') }} &nbsp;
                                </label>
                                
                                <label class="form-label" >
                                    {!! Form::radio('TypeID', '2', false,['class' => '', 'required' => 'required']) !!}
                                    &nbsp; {{ trans('admin.ca_institute') }} &nbsp;
                                </label>

                                @if($errors->has('TypeID'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('TypeID') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row institute">
                            <label for="InstituteName" class="col-md-4 col-form-label text-md-right">{{ trans('admin.institutes.fields.name') }}</label>

                            <div class="col-md-6">
                                {!! Form::text('InstituteName', old('InstituteName'), ['id'=>'InstituteName', 'class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                                @if($errors->has('InstituteName'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('InstituteName') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="TutorName" class="col-md-4 col-form-label text-md-right">{{ trans('admin.tutors.fields.name') }}</label>

                            <div class="col-md-6">
                                <input id="TutorName" type="text" class="form-control" name="TutorName" value="{{ old('TutorName') }}" required autofocus>

                                @if($errors->has('TutorName'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('TutorName') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="TutorEmail" class="col-md-4 col-form-label text-md-right">{{ trans('admin.tutors.fields.email') }}</label>

                            <div class="col-md-6">
                                <input id="TutorEmail" type="email" class="form-control" name="TutorEmail" value="{{ old('TutorEmail') }}" required>

                                @if($errors->has('TutorEmail'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('TutorEmail') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="TutorPhoneNumber" class="col-md-4 col-form-label text-md-right">{{ trans('admin.tutors.fields.phone') }}</label>

                            <div class="col-md-6">
                                <input id="TutorPhoneNumber" type="text" class="form-control" name="TutorPhoneNumber" value="{{ old('TutorPhoneNumber') }}" required data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$">

                                @if($errors->has('TutorPhoneNumber'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('TutorPhoneNumber') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="TutorPassword" class="col-md-4 col-form-label text-md-right">{{trans('admin.tutors.fields.password') }}</label>

                            <div class="col-md-6">
                                <input id="TutorPassword" type="password" class="form-control" name="TutorPassword" required data-parsley-trigger='change focusout'data-parsley-minlength = "6" data-parsley-maxlength = "20">

                                @if($errors->has('TutorPassword'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('TutorPassword') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="TutorPassword_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="TutorPassword_confirmation" type="password" class="form-control" name="TutorPassword_confirmation" required data-parsley-trigger = "change focusout" data-parsley-equalto = "#TutorPassword" data-parsley-equalto-message="Not same as Password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit"
                                    class="btn btn-primary"
                                    style="margin-right: 15px;">
                                    @lang('admin.ca_register')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /**** Hide/Show tutor fields on load ****/ 
        $(".institute").css("display", "none");
        $(".tutor").css("display", "block");
        $(".tutor :input").prop("required", true);
        $(".institute :input").prop("required", false);

        /**** On change of radio button hide/show fields ****/ 
        $("input[name=TypeID]").change(function(){
            $('input[name="InstituteName"]').val('');
            if(this.value == "1") {
                $(".institute").fadeOut("slow");
                $(".tutor").fadeIn("slow");
                $(".tutor :input").prop("required", true);
                $(".institute :input").prop("required", false);
            } else {
                $(".tutor :input").prop("required", false);
                $(".institute").fadeIn("slow");
                $(".tutor").fadeOut("slow");
                $(".institute :input").prop("required", true);
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
