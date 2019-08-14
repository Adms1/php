@extends('admin.layouts.app')

@section('content')
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Specification Attribute List</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">X</button> 
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <br />
                <div class="col-md-6 col-sm-6 col-xs-12"></div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <button class="btn btn-info" onclick="window.location='{{ route("spe_create") }}'" style="float: right">Add New Specification</button>
                </div>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th style="width: 50%">Name</th>
                  <th style="width: 30%">Action</th>
                </tr>
              </thead>
              <tbody class="row_position">
                <tr>
                  <td>Model Number</td>
                  <td>
                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-check"></i> Edit </a>
                  </td>
                </tr>
                <tr>
                  <td>Brand</td>
                  <td>
                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-check"></i> Edit </a>
                  </td>
                </tr>
                <tr>
                  <td>Memory</td>
                  <td>
                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-check"></i> Edit </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection