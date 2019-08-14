@extends('admin.layouts.app')

@section('css')
  <!-- Datatables -->
  <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('content')
      <div class="">
        <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>List of boards and related standards</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                    @if ($message = Session::get('response.message'))
                        <div class="alert alert-{{ session('response.status') }} alert-block">
                            <button type="button" class="close" data-dismiss="alert">X</button> 
                                <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="col-md-6 col-sm-6 col-xs-12"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-info float-right" onclick="window.location='{{ route("institution_board_standard") }}'">Assign Board Standard</button>
                    </div>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="width-10">Serial No</th>
                        <th class="width-20">Board name</th>
                        <th class="width-20">Standard Name</th>
                        <th class="width-50">Subject Name</th>
                        <th class="no-sort">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach($assign_list as $key => $institution)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$institution->board->board_name}}</td>
                        <td><a href='{{ route("institution_boardstandard_edit", [$institution->board_id, $institution->standard_id])}}' class="tabel_link">{{ $institution->standard->standard_name }}</a></td>
                        <td>{{ $institution->subject_name }}</td>
                        <td>
                          @if ($institution->is_active == 1) 
                            <a href='{{ route("institution_boardstandard_changestatus", [$institution->institution_board_standard_id, 0])}}' class="btn btn-warning btn-xs"><i class="fa fa-close"></i> Inactive </a></td>
                          @else 
                            <a href='{{ route("institution_boardstandard_changestatus", [$institution->institution_board_standard_id, 1])}}' class="btn btn-success btn-xs"><i class="fa fa-check"></i> Active </a></td>
                          @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection
