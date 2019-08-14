@extends('admin.layouts.app')

@section('content')
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add Board</h2>
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

                {!! Form::open(['route'=>'board_store', 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'board-form']) !!}
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attribute_type">Board Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('board_name', old('board_name'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter board name', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('board_name') }}</span>
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="about_board">About Board 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::textarea('about_board', old('about_board'), ['class'=>'form-control', 'placeholder'=>'About Board', 'required'=>'required']) !!}
                      <span class="text-danger">{{ $errors->first('about_board') }}</span>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-primary" type="button" onclick="window.location='{{route("board_list")}}'">Cancel</button>
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <button type="submit" class="btn btn-success submit">Submit</button>
                    </div>
                  </div>
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('script')

    <!-- Parsley -->
    <script src="{{asset('vendors/parsleyjs/dist/parsley.min.js')}}"></script>

    <script type="text/javascript">
      /**** On reset button click clear values ****/
      $("button[type='reset']").on("click", function(event){
          $(this).closest('form').find("input").attr('value', '');
          $('#board-form').parsley().reset();
          $('.text-danger').hide();
      });
    </script>

@endsection