@extends('admin.layouts.app')

@section('content')
      <div class="">
        <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Author List</h2>
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
                      <button class="btn btn-info float-right" onclick="window.location='{{ route("authors") }}'">Add Author</button>
                    </div>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr class="headings">
                        <th class="width-10">Serial No</th>
                        <th>Author name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach($authors as $key => $author)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td><a href='{{ route("author_edit", [$author->author_id])}}' class="tabel_link">{{$author->author_name}}</a></td>
                        <td>
                          <a href='{{ route("author_destroy", [$author->author_id])}}' class="btn btn-danger btn-xs author-delete"><i class="fa fa-close"></i> Delete </a>
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
  <script type="text/javascript">
    /*** Confirmation to delete ***/
    $('.author-delete').on('click',function(e){
      var answer=confirm('Do you want to delete?');
      if(!answer){
        e.preventDefault();
      }
    });
  </script>
@endsection