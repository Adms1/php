@extends('admin.layouts.app')

@section('content')
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Edit Subject</h2>
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

                {!! Form::open(['route'=> ["subject_update", $subject->subject_id], 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'subject-form']) !!}
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attribute_type">Subject Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('subject_name', $subject->subject_name, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter subject name', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('subject_name') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-primary" type="button" onclick="window.location='{{ route("subject_list") }}'">Cancel</button>
                      <button type="submit" class="btn btn-success submit">Update</button>
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

@endsection