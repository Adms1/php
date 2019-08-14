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
                <h2>Add Category</h2>
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

                {!! Form::open(['route'=>'category_store', 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'category-form', 'enctype' => 'multipart/form-data']) !!}
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Category Name <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('category_name', old('category_name'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Category Name', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('category_name') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="par_cat_id">Parent Category Name <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('par_cat_id[]', $categories, null, ['class'=>'form-control col-md-7 col-xs-12', 'required'=>'required', 'id'=>'par_cat_id', 'multiple'=>'multiple', 'data-parsley-errors-container' => '#par_cat_id_error']) !!}
                        <span id="par_cat_id_error" class="text-danger">{{ $errors->first('par_cat_id') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="photo" class="control-label col-md-3 col-sm-3 col-xs-12">Photo <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::file('photo', ['id'=>'photo', 'onchange' => 'handleFileSelect()', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                    <output id="result" />
                  </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Is Active</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::checkbox('is_active', old('is_active'), null, ['class'=>'js-switch', 'id'=>'is_active', 'checked']) !!}
                        </div>
                    </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button class="btn btn-primary" type="button" onclick="window.location='{{ route("category_list") }}'">Cancel</button>
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
                        div.innerHTML = ["<img class='col-md-2 col-sm-2 col-xs-12' src='" + picFile.result + "'" + "title='" + picFile.name + "'/><span class='remove_img_preview'></span>"].join('');
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

        /**** On select root category make other option unselectable ****/
        $('#par_cat_id').on('change', function() {
            var countries = [];
            $.each($("#par_cat_id option:selected"), function(){
                if ($(this).val() == 0) {
                    $("#par_cat_id").val('');
                    $("#par_cat_id").val('0');
                }
            });
        });

        /**** On reset button click clear selected values by select2 js  ****/
        $("button[type='reset']").on("click", function(event){
            $('select').val('').trigger('change');
            $('.remove_img_preview').trigger('click');

            $(this).closest('form').find("input[type='text']").attr('value', '');
            $('#category-form').parsley().reset();
            $('.text-danger').hide();
        });
    </script>
@endsection