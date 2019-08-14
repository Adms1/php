@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('admin.ca_tutor_login')</div>

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

                    <form method="POST" action="{{ route('tutor_login') }}" data-parsley-validate>
                        @csrf

                        <div class="form-group row">
                            <label for="TutorEmail" class="col-md-4 col-form-label text-md-right">@lang('admin.ca_email')</label>

                            <div class="col-md-6">
                                <input id="TutorEmail" type="email" class="form-control" name="TutorEmail" value="{{ old('TutorEmail') }}" required autocomplete="TutorEmail" autofocus>

                                @error('TutorEmail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="TutorPassword" class="col-md-4 col-form-label text-md-right">@lang('admin.ca_password')</label>

                            <div class="col-md-6">
                                <input id="TutorPassword" type="password" class="form-control" name="TutorPassword" required>

                                @error('TutorPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('admin.ca_login')
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="">
                                        @lang('admin.ca_forgot_password')
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection