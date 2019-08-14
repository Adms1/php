@extends('admin.layouts.app')

@section('content')
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Edit Language</h2>
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

                {!! Form::open(['route'=> ["language_update", $language->language_id], 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'language-form']) !!}
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attribute_type">Language Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('language_name', $language->language_name, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter language name', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('language_name') }}</span>
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="about_language">About Language 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::textarea('about_language', $language->about_language, ['class'=>'form-control', 'placeholder'=>'About Language', 'required'=>'required']) !!}
                      <span class="text-danger">{{ $errors->first('about_language') }}</span>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-primary" type="button" onclick="window.location='{{route("language_list")}}'">Cancel</button>
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