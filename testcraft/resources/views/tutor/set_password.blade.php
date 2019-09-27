@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-10">
                <h3 class="text-center">{{ Str::upper(trans('admin.ca_reset_password')) }}</h3>
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

                    <form method="POST" action="{{ route('set_password') }}" data-parsley-validate>
                        @csrf

                        <div class="form-group row">
                            <label for="TutorPassword" class="col-md-4 col-form-label">{{trans('admin.tutors.fields.password') }}</label>

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
                            <label for="TutorPassword_confirmation" class="col-md-4 col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="TutorPassword_confirmation" type="password" class="form-control" name="TutorPassword_confirmation" required data-parsley-trigger = "change focusout" data-parsley-equalto = "#TutorPassword" data-parsley-equalto-message="Password not match">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit"
                                    class="btn btn-primary"
                                    style="margin-right: 15px;">
                                    {{ __('Reset Password') }}
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
