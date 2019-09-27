@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('admin.ca_admin_registration')</div>

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

                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="UserFullName" class="col-md-4 col-form-label text-md-right">{{ trans('admin.users.fields.name') }}</label>

                            <div class="col-md-6">
                                <input id="UserFullName" type="text" class="form-control @error('UserFullName') is-invalid @enderror" name="UserFullName" value="{{ old('UserFullName') }}" required autocomplete="UserFullName" autofocus>

                                @if($errors->has('UserFullName'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('UserFullName') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="UserEmail" class="col-md-4 col-form-label text-md-right">{{ trans('admin.users.fields.email') }}</label>

                            <div class="col-md-6">
                                <input id="UserEmail" type="email" class="form-control @error('UserEmail') is-invalid @enderror" name="UserEmail" value="{{ old('UserEmail') }}" required autocomplete="UserEmail">

                                @if($errors->has('UserEmail'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('UserEmail') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="UserPassword" class="col-md-4 col-form-label text-md-right">{{trans('admin.users.fields.password') }}</label>

                            <div class="col-md-6">
                                <input id="UserPassword" type="password" class="form-control @error('UserPassword') is-invalid @enderror" name="UserPassword" required autocomplete="new-UserPassword">

                                @if($errors->has('UserPassword'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('UserPassword') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="UserPassword-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="UserPassword-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-UserPassword">
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