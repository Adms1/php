@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('admin.ca_dashboard')</div>

                <div class="panel-body">
                    @lang('admin.ca_dashboard_text')
                </div>
            </div>
        </div>
    </div>
@endsection
