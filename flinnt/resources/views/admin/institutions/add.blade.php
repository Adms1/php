@extends('admin.layouts.app')

@section('css')
    <!-- Select2 -->
    <link href="{{asset('vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <!-- Switchery -->
    <link href="{{asset('vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
@endsection

@section('content')
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add Institution</h2>
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

                {!! Form::open(['route'=>'institution_store', 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'institution-form', 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="name">Institution Name <span class="required">*</span></label>
                        {!! Form::text('institution_name', old('institution_name'), ['class'=>'form-control', 'placeholder'=>'Enter Name', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('institution_name') }}</span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="contact_name">Contact Person Name <span class="required">*</span></label>
                        {!! Form::text('contact_name', old('contact_name'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter contact name', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('contact_name') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="address1">Address1 <span class="required">*</span></label>
                        {!! Form::text('address1', old('address1'), ['class'=>'form-control', 'placeholder'=>'Enter Address1', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('address1') }}</span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="address2">Address2 <span class="required">*</span></label>
                        {!! Form::text('address2', old('address2'), ['class'=>'form-control', 'placeholder'=>'Enter Address2']) !!}
                        <span class="text-danger">{{ $errors->first('address2') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="city">City <span class="required">*</span></label>
                        {!! Form::text('city', old('city'), ['class'=>'form-control', 'placeholder'=>'Enter City', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('city') }}</span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <label for="state_id">State <span class="required">*</span></label>
                      {!! Form::select('state_id',$states, old('state_id'), ['class'=>'form-control', 'placeholder'=>'Select State', 'id'=>'state_id', 'required'=>'required']) !!}
                      <span class="text-danger">{{ $errors->first('state_id') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="pin">Pin Code <span class="required">*</span></label>
                        {!! Form::text('pin', old('pin'), ['class'=>'form-control', 'placeholder'=>'Enter Pin', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('pin') }}</span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="country_id">Country <span class="required">*</span></label>
                        {!! Form::select('country_id',$countries, old('country_id'), ['class'=>'form-control', 'placeholder'=>'Select Country', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('country_id') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="email">Email <span class="required">*</span></label>
                        {!! Form::email('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Enter Email', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="phone">Phone Number<span class="required">*</span></label>
                        {!! Form::text('phone', old('phone'), ['class'=>'form-control', 'placeholder'=>'Enter Phone', 'required'=>'required', 'data-parsley-pattern' => '^[\d\+\-\.\(\)\/\s]*$']) !!}
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="institution_image">Photo <span class="required">*</span></label>
                        {!! Form::file('institution_image', ['id'=>'photo', 'onchange' => 'handleFileSelect()', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('institution_image') }}</span>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                          <output id="result" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="status_id">Status <span class="required">*</span></label>
                        {!! Form::select('status_id',$status, old('status_id'), ['class'=>'form-control', 'placeholder'=>'Select status', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('status_id') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-primary" type="button" onclick="window.location='{{route("institution_list")}}'">Cancel</button>
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
    <!-- Select2 -->
    <script src="{{asset('vendors/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- Switchery -->
    <script src="{{asset('vendors/switchery/dist/switchery.min.js')}}"></script>
    <!-- Parsley -->
    <script src="{{asset('vendors/parsleyjs/dist/parsley.min.js')}}"></script>

    <script type="text/javascript">
        /**** Show image preview ****/
        function handleFileSelect() {
            //Check File API support
            if (window.File && window.FileList && window.FileReader) {

                var files = event.target.files; //FileList object
                var output = document.getElementById("result");
                output.innerHTML = "";
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    //Only pics
                    if (!file.type.match('image')) continue;

                    var picReader = new FileReader();
                    picReader.addEventListener("load", function (event) {
                        var picFile = event.target;
                        var div = document.createElement("div");
                        div.innerHTML = ["<img class='col-md-4 col-sm-4 col-xs-12' src='" + picFile.result + "'" + "title='" + picFile.name + "'/><span class='remove_img_preview'></span>"].join('');
                        output.insertBefore(div, null);
                    });
                    //Read the image
                    picReader.readAsDataURL(file);
                }
            } else {
                console.log("Your browser does not support File API");
            }
        }

        /**** Remove image on click ****/
        $('#result').on('click', '.remove_img_preview',function () {
            $(this).parent('div').remove();
            $('#photo').val("");
        });

        /**** On reset button click clear selected values by select2 js  ****/
        $("button[type='reset']").on("click", function(event){
            $(this).closest('form').find("input").attr('value', '');
            $('#institution-form').parsley().reset();
            $('.text-danger').hide();
        });
    </script>
@endsection