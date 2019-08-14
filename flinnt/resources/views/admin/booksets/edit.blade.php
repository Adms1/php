@extends('admin.layouts.app')

@section('css')
  <style type="text/css">
    .select_category_css .select2 { width: 100% !important; }
  </style>
  <!-- Switchery -->
  <link href="{{asset('vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
  <!-- Select2 -->
  <link href="{{asset('vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
  <!-- Datatables -->
  <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
  <!-- Fine Uploader Gallery CSS file-->
  <link href="{{asset('vendors/fine_upload/fine-uploader-gallery.min.css')}}" rel="stylesheet">
  <script type="text/template" id="qq-template">
        <div class="qq-uploader-selector qq-uploader qq-gallery" qq-drop-area-text="Drop files here">
        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
        </div>
        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
            <span class="qq-upload-drop-area-text-selector"></span>
        </div>
        <div class="qq-upload-button-selector qq-upload-button">
            <div>Upload a file</div>
        </div>
        <span class="qq-drop-processing-selector qq-drop-processing">
            <span>Processing dropped files...</span>
            <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
        </span>
        <ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite" aria-relevant="additions removals">
            <li>
                <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                <div class="qq-progress-bar-container-selector qq-progress-bar-container">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                </div>
                <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                <div class="qq-thumbnail-wrapper">
                    <img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>
                </div>
                <button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>
                <button type="button" class="qq-upload-retry-selector qq-upload-retry">
                    <span class="qq-btn qq-retry-icon" aria-label="Retry"></span>
                    Retry
                </button>

                <div class="qq-file-info">
                    <div class="qq-file-name">
                        <span class="qq-upload-file-selector qq-upload-file"></span>
                        <span class="qq-edit-filename-icon-selector qq-btn qq-edit-filename-icon" aria-label="Edit filename"></span>
                    </div>
                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">
                        <span class="qq-btn qq-delete-icon" aria-label="Delete"></span>
                    </button>
                    <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">
                        <span class="qq-btn qq-pause-icon" aria-label="Pause"></span>
                    </button>
                    <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">
                        <span class="qq-btn qq-continue-icon" aria-label="Continue"></span>
                    </button>
                </div>
            </li>
        </ul>
    </div>
    </script>
@endsection

@section('content')
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Update book set</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">

                  @if ($message = Session::get('response.message'))
                      <div class="alert alert-{{ session('response.status') }} alert-block">
                          <button type="button" class="close" data-dismiss="alert">X</button> 
                              <strong>{{ $message }}</strong>
                      </div>
                  @endif

                  {!! Form::open(['route'=>['bookset_update', $bookset->book_set_id], 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'bookset-form', 'enctype'=>'multipart/form-data']) !!}
                  <ul id="bookset_tabs" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class=""><a href="#bookset_info" id="bookset_info_tab" role="tab" data-toggle="tab" aria-expanded="true">Bookset Info</a>
                    </li>
                    <li role="presentation" class="active"><a href="#bookset_vendor_info" role="tab" id="bookset_vendor_info_tab" data-toggle="tab" aria-expanded="false">Select Books</a>
                    </li>
                    <li role="presentation" class=""><a href="#bookset_images" role="tab" id="bookset_images_tab" data-toggle="tab" aria-expanded="false">Images</a>
                    </li>
                  </ul>
                  <div id="bookset_tab_content" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade" id="bookset_info" aria-labelledby="bookset_info_tab">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="name">Bookset Name <span class="required">*</span></label>
                            {!! Form::text('book_set_name', $bookset->book_set_name, ['class'=>'form-control', 'placeholder'=>'Enter Bookset Name', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('book_set_name') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 select_category_css">
                            <label for="board_id">Board</label>
                            {!! Form::select('board_id', $boards, $bookset->board_id, ['class'=>'form-control', 'id' => 'board_id', 'required'=>'required', 'data-parsley-errors-container' => '#board_is_error']) !!}
                            <span id="board_is_error" class="text-danger">{{ $errors->first('board_id') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 select_category_css" id="std_list">
                            <label for="standard_id">Standard</label>
                            {!! Form::select('standard_id', $standards, $bookset->standard_id, ['class'=>'form-control', 'id' => 'standard_id', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('standard_id') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 select_category_css" id="sbj_list">
                            <label for="subject_id">Subject</label>
                            {!! Form::select('subject_id[]', $subjects, $bookset->subject_id, ['class'=>'form-control', 'id' => 'subject_id', 'multiple'=>'multiple', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('subject_id') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label for="description">Single Line Description <span class="required">*</span></label>
                          {!! Form::text('description[]', $bookset->description[0], ['class'=>'form-control', 'placeholder'=>'Enter Single Description', 'required'=>'required']) !!}
                          <span class="text-danger">{{ $errors->first('description') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label for="description">Detail Description</label>
                          {!! Form::textarea('description[]', $bookset->description[1], ['class'=>'form-control']) !!}
                          <span class="text-danger">{{ $errors->first('description') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label class="control-label">Is Active</label>
                          {!! Form::checkbox('is_active', old('is_active'), ($bookset->is_active == 1) ? true : false, ['class'=>'js-switch', 'id'=>'is_active']) !!}
                        </div>
                      </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade active in" id="bookset_vendor_info" aria-labelledby="bookset_vendor_info_tab">
                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="no-sort">Select</th>
                            <th class="no-sort width-10">Image</th>
                            <th class="width-15">Book Name</th>
                            <th class="width-10">Vendor Name</th>
                            <th class="width-10">Board Name</th>
                            <th class="width-10">Standard</th>
                            <th class="width-10">Subject Name</th>
                            <th class="width-20">Publisher Name</th>
                            <th class="width-10">Price</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($products as $product)
                            <tr class="text-center">
                              <td><input type="checkbox" name="book_ids[]" value="{{$product->institution_book_vendor_id}}" {{ in_array($product->institution_book_vendor_id, $bookset->book_ids) ? "checked" : "" }} id="check-all" class="flat"></td>
                              <td><img class="width-70" src="{{URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').$product->book_image_path)}}"></td>
                              <td><a target="_blank" href="{{route('product_detail', [$product->institution_book_vendor_id, $product->book->standard[0]->standard_id])}}" class="tabel_link">{{$product->book->book_name}}</a></td>
                              <td>{{$product->vendor->vendor_name}}</td>
                              <td>{{$product->book->board[0]->board_name}}</td>
                              <td>{{$product->book->standard[0]->standard_name}}</td>
                              <td>{{$product->book->subject->subject_name}}</td>
                              <td>{{$product->book->publisher->publisher_name}}</td>
                              <td>{{$product->sale_price}}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="bookset_images" aria-labelledby="bookset_images_tab">
                      <div class="form-group">
                        <label for="book_set_primary_image" class="control-label col-md-3 col-sm-3 col-xs-12">Front Image <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::file('book_set_primary_image', ['id'=>'book_set_primary_image', 'onchange' => 'handleFileSelect()']) !!}
                            <span class="text-danger">{{ $errors->first('book_set_primary_image') }}</span>
                            <!-- <div id="fine-uploader-gallery"></div> -->
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <output id="result">
                          <img class="col-md-2 col-sm-2 col-xs-12" src="
                          {{URL::asset('/'.Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH').$bookset->primary_image)}}">
                        <output/>
                      </div>
                      <div class="form-group">
                        <label for="photo" class="control-label col-md-3 col-sm-3 col-xs-12">Related Images</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- <label for="photo">Photo <span class="required">*</span></label> -->
                          <div id="fine-uploader-gallery"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br />
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-primary" type="button" onclick="window.location='{{route("bookset_list")}}'">Cancel</button>
                      <button type="submit" id="submit" class="btn btn-success">Update</button>
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
  <!-- iCheck -->
  <script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>
  <!-- Parsley -->
  <script src="{{asset('vendors/parsleyjs/dist/parsley.min.js')}}"></script>
  <!-- ckeditor -->
  <script src="{{asset('vendors/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
  <script src="{{asset('vendors/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
  <!-- Datatables -->
  <script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <!-- Fine Uploader jQuery JS file-->
  <script src="{{asset('vendors/fine_upload/jquery.fine-uploader.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      /**** Ckeditor ****/ 
      $('textarea').ckeditor();

      $('#standard_id').select2({
        placeholder: 'Select Standard',
        allowClear: true,
        closeOnSelect: true
      });

      $('#board_id').select2({
        placeholder: 'Select Board',
        allowClear: true,
        closeOnSelect: true
      });

      $('#subject_id').select2({
        placeholder: 'Select Subject',
        allowClear: false,
        closeOnSelect: false
      });

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      
      /**** Ajax call to get standards based on board ****/ 
      $('body').on('change', '#board_id', function(){
        var board_id = $("#board_id").val();
        $.ajax({
          url:"{{route('standard_ajaxget')}}",
          type:'POST',
          dataType:'json',
          data:{'board_id':board_id},
          success:function(data) {
            if(data.success) {
              $('select[name="standard_id"]').empty();
              $.each(data.data, function(key, value) {
                  $('select[name="standard_id"]').append('<option value="'+ key +'">'+ value +'</option>');
              });
            }
          },
        });
      });

      /**** Ajax call to get subjetcs based on board and standard ****/ 
      $('body').on('change', '#standard_id', function(){
        var board_id = $("#board_id").val();
        var standard_id = $("#standard_id").val();
        $.ajax({
          url:"{{route('subject_ajaxget')}}",
          type:'POST',
          dataType:'json',
          data:{'board_id':board_id, 'standard_id':standard_id},
          success:function(data) {
            if(data.success) {
              $('select[name="subject_id[]"]').empty();
              $.each(data.data, function(key, value) {
                  $('select[name="subject_id[]"]').append('<option value="'+ key +'">'+ value +'</option>');
              });
            }
          },
        });
      });
    });

    /**** Fine uploader js for images upload ****/ 
    var csrf_token = "{{ csrf_token() }}";
    var manualuploader = new qq.FineUploader({
        element: document.getElementById("fine-uploader-gallery"),
        debug: true,
        template: 'qq-template',
        interceptSubmit: true,
        autoUpload: false,
        messages: {
            typeError: 'Invalid extension detected in file, {file}.',
            emptyError: '{file} is empty, please select files again without it.'
        },
        request: {
          endpoint: '{{route("bookset_update", $bookset->book_set_id)}}',
          params: {'_token': csrf_token},
          inputName: 'listing'
        },
        deleteFile: {
          enabled: true,
          forceConfirm: true,
          params: {'_token': csrf_token},
          endpoint: '{{route("bookset_deleteImage", $bookset->book_set_id)}}'
        },
        session: {
          endpoint: '{{route("bookset_getImage", $bookset->book_set_id)}}',
          refreshOnRequest:true
        },
        thumbnails: {
          placeholders: {
              waitingPath: '{{asset("vendors/fine_upload/placeholders/waiting-generic.png")}}',
              notAvailablePath: '{{asset("vendors/fine_upload/placeholders/not_available-generic.png")}}'
          }
        },
        resume: {
          enabled: true
        },
        retry: {
           enableAuto: false,
           showButton: true
        },
        validation: {
            allowedExtensions: ['jpeg', 'jpg', 'gif', 'png'],
            allowEmpty: true
        }
    });

    $('#submit').click(function() {
        manualuploader.uploadStoredFiles();
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
        $('#book_set_primary_image').val("");
    });
  </script>
@endsection