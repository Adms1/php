@extends('admin.layouts.app')

@section('css')
  <style type="text/css">
    #select_category_css .select2 { width: 100% !important; }
  </style>
  <!-- Switchery -->
  <link href="{{asset('vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
  <!-- Select2 -->
  <link href="{{asset('vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Create book set</h2>
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

                  {!! Form::open(['route'=>'bookset_store', 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'bookset-form']) !!}
                  <ul id="bookset_tabs" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#bookset_info" id="bookset_info_tab" role="tab" data-toggle="tab" aria-expanded="true">Bookset Info</a>
                    </li>
                  </ul>
                  <div id="bookset_tab_content" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="bookset_info" aria-labelledby="bookset_info_tab">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="name">Bookset Name <span class="required">*</span></label>
                            {!! Form::text('book_set_name', old('book_set_name'), ['class'=>'form-control', 'placeholder'=>'Enter Bookset Name', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('book_set_name') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="board_id">Board</label>
                            {!! Form::select('board_id', $boards, null, ['class'=>'form-control', 'id' => 'board_id', 'required'=>'required', 'data-parsley-errors-container' => '#board_id_error']) !!}
                            <span id="board_id_error" class="text-danger">{{ $errors->first('board_id') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12" id="std_list">
                            <label for="standard_id">Standard</label>
                            {!! Form::select('standard_id', [], null, ['class'=>'form-control', 'id' => 'standard_id', 'required'=>'required', 'data-parsley-errors-container' => '#standard_id_error']) !!}
                            <span id="standard_id_error" class="text-danger">{{ $errors->first('standard_id') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12" id="sbj_list">
                            <label for="subject_id">Subject</label>
                            {!! Form::select('subject_id[]', [], null, ['class'=>'form-control', 'id' => 'subject_id', 'multiple'=>'multiple', 'data-parsley-errors-container' => '#subject_id_error']) !!}
                            <span id="subject_id_error" class="text-danger">{{ $errors->first('subject_id') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label for="description">Single Line Description <span class="required">*</span></label>
                          {!! Form::text('description[]', old('description'), ['class'=>'form-control', 'placeholder'=>'Enter Single Description', 'required'=>'required']) !!}
                          <span class="text-danger">{{ $errors->first('description') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label for="description">Detail Description</label>
                          {!! Form::textarea('description[]', old('description'), ['class'=>'form-control']) !!}
                          <span class="text-danger">{{ $errors->first('description') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label class="control-label">Is Active</label>
                          {!! Form::checkbox('is_active', old('is_active'), null, ['class'=>'js-switch', 'id'=>'is_active', 'checked']) !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br />
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-primary" type="button" onclick="window.location='{{ route("bookset_list")}}'">Cancel</button>
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <button type="submit" id="submit" class="btn btn-success">Save & Continue</button>
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

      $('#std_list').hide();
      $('#sbj_list').hide();
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
              $('select[name="standard_id"]').val('').trigger('change');
              $('#std_list').show();
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
              $('select[name="subject_id[]"]').attr("required", true);
              $('#sbj_list').show();

            }
          },
        });
      });

      /**** On reset button click clear selected values by select2 js  ****/
      $("button[type='reset']").on("click", function(event){
          $('select').val('').trigger('change');
          $('.remove_img_preview').trigger('click');
          $('#std_list').hide();
          $('#sbj_list').hide();

          $(this).closest('form').find("input").attr('value', '');
          $('#bookset-form').parsley().reset();
          $('.text-danger').hide();
      });

    });

  </script>
@endsection