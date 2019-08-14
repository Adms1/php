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
                <h2>Edit Category</h2>
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

                {!! Form::open(['route' => ["category_update", $category->category_tree_id], 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'category-form', 'enctype' => 'multipart/form-data']) !!}
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Category Name <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('category_name', $category->category_name, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Category Name', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('category_name') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="photo" class="control-label col-md-3 col-sm-3 col-xs-12">Photo <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::file('photo', ['id'=>'photo', 'onchange' => 'handleFileSelect()']) !!}
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                        <!-- <div id="fine-uploader-gallery"></div> -->
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                    <output id="result">
                      <img class="col-md-2 col-sm-2 col-xs-12" src="{{URL::asset('/'.Config::get('settings.THUMBNAIL_CATEGORY_IMG_PATH').$category->child_category_id.'/'.$category->category_image)}}">
                    <output/>
                  </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Is Active</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::checkbox('is_active', old('is_active'), ($category->is_active == 1) ? true : false, ['class'=>'js-switch', 'id'=>'is_active']) !!}
                        </div>
                    </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button class="btn btn-primary" type="button" onclick="window.location='{{ route("category_list") }}'">Cancel</button>
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
    <!-- Select2 -->
    <script src="{{asset('vendors/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- Switchery -->
    <script src="{{asset('vendors/switchery/dist/switchery.min.js')}}"></script>
    <!-- Parsley -->
    <script src="{{asset('vendors/parsleyjs/dist/parsley.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#par_cat_id').select2({
                placeholder: 'Select Category',
                allowClear: true,
                closeOnSelect: false,
            });
        });
        
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
                        div.innerHTML = "<img class='col-md-2 col-sm-2 col-xs-12' src='" + picFile.result + "'" + "title='" + picFile.name + "'/>";
                        output.insertBefore(div, null);
                    });
                    //Read the image
                    picReader.readAsDataURL(file);
                }
            } else {
                console.log("Your browser does not support File API");
            }
        }
    </script>
@endsection