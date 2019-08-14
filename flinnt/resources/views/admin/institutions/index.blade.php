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
                  <h2>Institution List</h2>
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
                      <button class="btn btn-info float-right" onclick="window.location='{{ route("institutions") }}'">Add Institution</button>
                    </div>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="width-10">Serial No</th>
                        <th class="width-20">Institution name</th>
                        <th class="width-20">Contact Name</th>
                        <th class="width-10">Phone Number</th>
                        <th class="width-10">City</th>
                        <th class="width-10">State</th>
                        <th class="width-10">Status</th>
                        <th class="no-sort">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach($institutions as $key => $institution)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td><a href='{{ route("institution_edit", [$institution->institution_id])}}' class="tabel_link">{{$institution->institution_name}}</a></td>
                        <td>{{ $institution->contact_name }}</td>
                        <td>{{ $institution->phone }}</td>
                        <td>{{ $institution->city }}</td>
                        <td>{{ $institution->state->name }}</td>
                        <td>{{ $institution->status->status_name }}</td>
                        <td>
                          <a href='{{ route("institution_destroy", [$institution->institution_id])}}' class="btn btn-danger btn-xs institution-delete"><i class="fa fa-close"></i> Delete </a>
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

@section('script')
  <!-- Datatables -->
  <script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

  <script type="text/javascript">
    /*** Confirmation to delete ***/
    $('.institution-delete').on('click',function(e){
      var answer=confirm('Do you want to delete?');
      if(!answer){
        e.preventDefault();
      }
    });
  </script>
@endsection