@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('admin.ca_admin_login')</div>

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

                    <form method="POST" action="{{ route('admin_login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="UserEmail" class="col-md-4 col-form-label text-md-right">@lang('admin.ca_email')</label>

                            <div class="col-md-6">
                                <input id="UserEmail" type="email" class="form-control @error('UserEmail') is-invalid @enderror" name="UserEmail" value="{{ old('UserEmail') }}" required autocomplete="UserEmail" autofocus>

                                @error('UserEmail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="UserPassword" class="col-md-4 col-form-label text-md-right">@lang('admin.ca_password')</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('UserPassword') is-invalid @enderror" name="UserPassword" required autocomplete="current-password">

                                @error('UserPassword')
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

                                <a class="btn btn-link" href="">
                                    @lang('admin.ca_forgot_password')
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection