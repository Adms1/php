@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-10">
                <h3 class="text-center">{{ Str::upper(trans('admin.ca_forgot_pass')) }}</h3>
                <div class="card-body">

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
                    <span class="row justify-content-center"><b>{{ trans('passwords.mobile') }}</b></span>
                    <form method="POST" action="{{ route('check_mobile') }}" data-parsley-validate>
                        @csrf
                        <div class="form-group row">
                            <label for="TutorPhoneNumber" class="col-md-4 col-form-label">{{ trans('admin.tutors.fields.phone') }}</label>

                            <div class="col-md-6">
                                <input id="TutorPhoneNumber" type="text" class="form-control" name="TutorPhoneNumber" value="" required data-parsley-pattern="^[\d\+\-\(\)\/\s]*$" data-parsley-minlength = "10">

                                @if($errors->has('TutorPhoneNumber'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('TutorPhoneNumber') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('admin.ca_reset_password')
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
