@extends('admin.layouts.app')

@section('css')
  <style type="text/css">
    #select_category_css .select2 { width: 100% !important; }
    .product_book .select2 {width: 100% !important}
  </style>
  <!-- Switchery -->
  <link href="{{asset('vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
  <!-- Select2 -->
  <link href="{{asset('vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">

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
                <h2>Edit Product</h2>
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

                  {!! Form::open(['route'=>['product_update', $id], 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'product-form', 'enctype'=>'multipart/form-data']) !!}
                  <ul id="product_tabs" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="{{ empty($product->tab) ? 'active' : '' }}"><a href="#product_info" id="product_info_tab" role="tab" data-toggle="tab" aria-expanded="true">Basic Info</a>
                    </li>
                    <li role="presentation" class=""><a href="#product_categories_info" role="tab" id="product_categories_info_tab" data-toggle="tab" aria-expanded="false">Categories</a>
                    </li>
                    @if ($product->product_type == 'book')
                      <li role="presentation" class="product_book  {{$product->tab}} {{ !empty($product->tab) && $product->tab == 'product_images' ? 'active' : 'sdasdasdasdasdasdasdasdasd' }}"><a href="#product_images" role="tab" id="product_images_tab" data-toggle="tab" aria-expanded="false">Images</a>
                      </li>
                      <li role="presentation" class=""><a href="#product_attribute_info" role="tab" id="product_attribute_info_tab" data-toggle="tab" aria-expanded="false">Attributes</a>
                      </li>
                    @else
                      <li role="presentation" class="product_other"><a href="#specification_attributes" role="tab" id="specification_attributes_tab" data-toggle="tab" aria-expanded="false">Price Specification</a>
                      </li>
                    @endif
                    <!-- <li role="presentation" class=""><a href="#product_tag" role="tab" id="product_tag_tab" data-toggle="tab" aria-expanded="false">Tags</a>
                    </li> -->
                    <!-- <li role="presentation" class=""><a href="#product_shipping" role="tab" id="product_shipping_tab" data-toggle="tab" aria-expanded="false">Shipping</a>
                    </li> -->
                  </ul>
                  <div id="product_tab_content" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade {{ empty($product->tab) ? 'active in' : '' }}" id="product_info" aria-labelledby="product_info_tab">
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label for="product_type">Product Type <span class="required">*</span></label>
                          <div class="form-group">
                            {!! Form::radio('product_type','book', $product->product_type == 'book', ['class' => 'flat']) !!}
                            <label class="form-label" >&nbsp; Book &nbsp;</label>
                            <!-- <label class="form-label">&nbsp; Other &nbsp;</label>
                            {!! Form::radio('product_type','other', $product->product_type == 'other') !!} -->
                          </div>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="product_type">Product Type<span class="required">*</span></label>
                            {!! Form::select('',$product_types, old('product_type'), ['class'=>'form-control', 'id' => 'product_type', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('product_type') }}</span>
                        </div> -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="name">Product Name <span class="required">*</span></label>
                            {!! Form::text('name', $product->book_name, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Product Name', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 product_book">
                              <label for="publisher_id">Publisher <span class="required">*</span> <i class="btn-success fa fa-plus-square" data-toggle="modal" data-target=".add-publisher"></i></label>
                              {!! Form::select('publisher_id',$publishers, $product->publisher_id, ['class'=>'form-control', 'required'=>'required', 'id' => 'publisher_id', 'data-parsley-errors-container' => '#publisher_id_error']) !!}
                              <span id="publisher_id_error" class="text-danger">{{ $errors->first('publisher_id') }}</span>
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 product_book">
                            <label for="author_id">Author <span class="required">*</span> <i class="btn-success fa fa-plus-square" data-toggle="modal" data-target=".add-author"></i></label>
                            {!! Form::select('author_id[]',$authors, $product->author, ['class'=>'form-control', 'required'=>'required', 'id' => 'author_id', 'multiple', 'data-parsley-errors-container' => '#author_id_error']) !!}
                            <span id="author_id_error" class="text-danger">{{ $errors->first('author_id') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 product_book">
                            <label for="name">Year <span class="required">*</span></label>
                            {!! Form::text('year', $product->series, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Edition year', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('year') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 product_book">
                            <label for="isbn">ISBN Number <span class="required">*</span></label>
                            {!! Form::text('isbn', $product->isbn, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter ISBN Number', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('isbn') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 product_book">
                            <label for="name">Paper Back <span class="required">*</span></label>
                            {!! Form::select('format',$formats, $product->format, ['class'=>'form-control', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('format') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 product_book">
                            <label for="language_id">Language <span class="required">*</span></label>
                            {!! Form::select('language_id',$languages, $product->language_id, ['class'=>'form-control', 'placeholder'=>'Select Language', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('language_id') }}</span>
                          </div>
                        </div>
                      <div class="form-group product_book">
                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label class="control-label">Is Academic</label>
                          {!! Form::checkbox('is_academic', old('is_academic'), ($product->is_academic == 1) ? true : false, ['class'=>'js-switch', 'id'=>'is_academic']) !!}
                        </div>
                      </div>
                      <div class="form-group product_book academic">
                        <div class="form-group">
                          <div class="col-md-4 col-sm-4 col-xs-12 product_book">
                              <label for="board_id">Board</label>
                              {!! Form::select('board_id[]', $board, $product->board, ['class'=>'form-control academic_book col-md-7 col-xs-12', 'multiple'=>'multiple', 'id' => 'board_id', 'required'=>'required', 'data-parsley-errors-container' => '#board_id_error']) !!}
                              <span id="board_id_error" class="text-danger">{{ $errors->first('board_id') }}</span>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12 product_book">
                              <label for="standard_id">Standard</label>
                              {!! Form::select('standard_id[]',$class, $product->standard, ['class'=>'form-control academic_book', 'multiple'=>'multiple', 'id' => 'standard_id', 'required'=>'required', 'data-parsley-errors-container' => '#standard_id_error']) !!}
                              <span id="standard_id_error" class="text-danger">{{ $errors->first('standard_id') }}</span>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12 product_book">
                              <label for="subject_id">Subject</label>
                              {!! Form::select('subject_id',$subject, $product->subject_id, ['class'=>'form-control academic_book', 'required'=>'required']) !!}
                              <span class="text-danger">{{ $errors->first('subject_id') }}</span>
                          </div>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md4 col-sm-4 col-xs-12">
                            <label for="list_price">List price <span class="required">*</span></label>
                            {!! Form::number('list_price', $product->list_price, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter List Price', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('list_price') }}</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label for="display_price">Display Price <span class="required">*</span></label>
                            {!! Form::number('display_price', $product->display_price, ['class'=>'form-control', 'placeholder'=>'Enter Display Price', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('language_id') }}</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label for="flinnt_charge">flinnt Charge</label>
                            {!! Form::number('flinnt_charge', old('flinnt_charge'), ['class'=>'form-control', 'placeholder'=>'Enter flinnt Charge']) !!}
                            <span class="text-danger">{{ $errors->first('flinnt_charge') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label for="hs_code">HS Code <span class="required">*</span></label>
                          {!! Form::text('hs_code', $product->hs_code, ['class'=>'form-control', 'required'=>'required', 'placeholder' => 'Enter Code']) !!}
                          <span class="text-danger">{{ $errors->first('hs_code') }}</span>
                        </div>
                      </div>
<!--                       <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="category_id">Category <span class="required">*</span></label>
                            {!! Form::select('category_id',$categories, old('category_id'), ['class'=>'form-control',  'multiple'=>'multiple', 'id' => 'category_id', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
                        </div>
                      </div> -->
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label for="description">Single Line Description <span class="required">*</span></label>
                          {!! Form::text('description[]', (isset($product->description[0]) ? $product->description[0] : null), ['class'=>'form-control', 'placeholder'=>'Enter Single Description', 'required'=>'required']) !!}
                          <span class="text-danger">{{ $errors->first('description') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label for="description">Detail Description</label>
                          {!! Form::textarea('description[]', (isset($product->description[1]) ? $product->description[1] : null), ['class'=>'form-control']) !!}
                          <span class="text-danger">{{ $errors->first('description') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label class="control-label">Is Active</label>
                          {!! Form::checkbox('is_active', old('is_active'), ($product->is_active == 1) ? true : false, ['class'=>'js-switch', 'id'=>'is_active']) !!}
                        </div>
                      </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in" id="product_categories_info" aria-labelledby="product_categories_info_tab">
                      <!-- <p>Product attributes are quantifiable or descriptive aspects of a product (such as, color). For example, if you were to create an attribute for color, with the values of blue, green, yellow, and so on, you may want to apply this attribute to shirts, which you sell in various colors (you can adjust a price or weight for any of existing attribute values). You can add attribute for your product using existing list of attributes, or if you need to create a new one go to Attributes > Product attributes.</p>
                      <div class="ln_solid"></div> -->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">Category<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" id="select_category_css">
                            {!! Form::select('category_id[]', $categories, $product->category_tree, ['class'=>'form-control col-md-7 col-xs-12', 'required'=>'required', 'id'=>'category_id', 'multiple'=>'multiple', 'data-parsley-errors-container' => '#category_id_error']) !!}
                            <span id="category_id_error" class="text-danger">{{ $errors->first('category_id') }}</span>
                        </div>
                      </div>
                      <!-- <div id="product_book"> -->
                        <!-- <div class="ln_solid"></div> -->
<!--                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <label for="language_id">Language <span class="required">*</span></label>
                              {!! Form::select('language_id',$languages, old('language_id'), ['class'=>'form-control', 'placeholder'=>'Select Language', 'required'=>'required']) !!}
                              <span class="text-danger">{{ $errors->first('language_id') }}</span>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <label for="series">Series <span class="required">*</span></label>
                              {!! Form::text('series', old('series'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Series', 'required'=>'required']) !!}
                              <span class="text-danger">{{ $errors->first('series') }}</span>
                          </div>
                        </div> -->
<!--                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <label for="cover_type_id">Cover Type <span class="required">*</span></label>
                              {!! Form::select('cover_type_id',$cover_types, old('cover_type_id'), ['class'=>'form-control', 'placeholder'=>'Select Cover Type', 'required'=>'required']) !!}
                              <span class="text-danger">{{ $errors->first('cover_type_id') }}</span>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          </div>
                        </div>    -->                     
                      <!-- </div> -->
                      <!-- <div class="ln_solid"></div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Attribute <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          {!! Form::select('pr_attribute_id', $pr_attributes, null, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Select Attribute', 'required'=>'required', 'id'=>'pr_attribute_id']) !!}
                          <span class="text-danger">{{ $errors->first('pr_attribute_id') }}</span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button type="button" id="add_pr_attr" class="btn btn-primary">Add Attribute</button>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <table id="tabel_pr_atr" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th style="width: 30%">Attribute Name</th>
                            <th style="width: 30%">Action</th>
                          </tr>
                        </thead>
                        <tbody class="pr_atr row_position">
                          <tr class="mul_div">
                            <td>Color</td>
                            <td>
                              <a href="{{asset(route("product_store"))}}" class="btn btn-warning">Edit</a><a class="btn btn-danger remove_this">Delete</a>
                            </td>
                          </tr>
                          <tr class="mul_div">
                            <td>Style</td>
                            <td>
                              <a href="{{asset(route("product_store"))}}" class="btn btn-warning">Edit</a><a class="btn btn-danger remove_this">Delete</a>
                            </td>
                          </tr>
                          <tr class="mul_div">
                            <td>Size</td>
                            <td>
                              <a href="{{asset(route("product_store"))}}" class="btn btn-warning">Edit</a><a class="btn btn-danger remove_this">Delete</a>
                            </td>
                          </tr>
                        </tbody>
                      </table> -->
                      <!-- <div id="product_other" style="display: none;">
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <label for="publisher_id">Brand Name <span class="required">*</span></label>
                              {!! Form::select('brand_id',$brands, old('brand_id'), ['class'=>'form-control', 'placeholder'=>'Select Brand', 'required'=>'required']) !!}
                              <span class="text-danger">{{ $errors->first('brand_id') }}</span>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <label for="model_id">Model Number <span class="required">*</span></label>
                              {!! Form::text('model_id', old('model_id'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Model Number', 'required'=>'required']) !!}
                              <span class="text-danger">{{ $errors->first('model_id') }}</span>
                          </div>
                        </div>
                      </div> -->
                        <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <label for="size">Has Size</label>
                            {!! Form::checkbox('size', old('size'), null, ['style'=>'float:right', 'id'=>'size']) !!}
                            <span class="text-danger">{{ $errors->first('size') }}</span>
                          </div>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            {!! Form::select('has_size', $sizes, old('has_size'), ['class'=>'form-control','id'=>'has_size', 'placeholder'=>'Select Size', 'style'=>'display:none']) !!}
                            <span class="text-danger">{{ $errors->first('has_size') }}</span>
                          </div>
                        </div> -->
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="product_attribute_info" aria-labelledby="product_attribute_info_tab">
                      <p>Specification attributes are product features i.e, screen size, number of USB-ports, visible on product details page. Specification attributes can be used for information purposes only on details page.</p>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Attribute
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          {!! Form::select('attribute_id', $attributes, null, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Select Attribute', 'id'=>'attribute_id']) !!}
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          {!! Form::text('attribute_val', old('attribute_val'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter attribute value', 'id'=>'attribute_val']) !!}
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button type="button" id="add_sp_attr" class="btn btn-primary">Add Attribute</button>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <table id="tabel_sp_atr" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="width-30">Attribute Name</th>
                            <th class="width-30">Attribute Value</th>
                            <th class="width-30">Action</th>
                          </tr>
                        </thead>
                        <tbody class="sp_atr row_position">
                          @foreach($product->attribute as $key => $attribute)
                          <tr class="mul_div">
                            <td>
                              <input name="book_attribute_id" type="hidden" value="{{$attribute->book_attribute_id}}">
                              {{$attribute->attribute_name}}</td>
                            <td>{{$attribute->attribute_value}}</td>
                            <td>
                              <a class="btn btn-success btn-xs add" style="display: none;"><i class="fa fa-save"></i> Save </a>
                              <a class="btn btn-info btn-xs edit"><i class="fa fa-check"></i> Edit </a>
                              <a class="btn btn-danger btn-xs delete"><i class="fa fa-close"></i> Delete </a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <!-- <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <label for="color">Has Color</label>
                            {!! Form::checkbox('color', old('color'), null, ['style'=>'float:right', 'id'=>'color']) !!}
                            <span class="text-danger">{{ $errors->first('color') }}</span>
                          </div>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            {!! Form::select('has_size', $colors, old('has_color'), ['class'=>'form-control', 'placeholder'=>'Select Color', 'id'=>'has_color', 'style'=>'display:none']) !!}
                            <span class="text-danger">{{ $errors->first('has_color') }}</span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <label for="style">Has Style</label>
                            {!! Form::checkbox('style', old('style'), null, ['style'=>'float:right', 'id'=>'style']) !!}
                            <span class="text-danger">{{ $errors->first('style') }}</span>
                          </div>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            {!! Form::select('has_style', $styles, old('has_style'), ['class'=>'form-control', 'placeholder'=>'Select Style', 'id'=>'has_style',  'style'=>'display:none']) !!}
                            <span class="text-danger">{{ $errors->first('has_style') }}</span>
                          </div>
                        </div>
                      </div> -->
                    </div>
                    <!-- <div role="tabpanel" class="tab-pane fade" id="product_tag" aria-labelledby="product_tag_tab">
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>Tags</label>
                          {!! Form::text('tag', 'social, adverts', ['id' => 'tags', 'class'=>'tags form-control']) !!}
                          <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                        </div>
                      </div>
                    </div> -->
                    <div role="tabpanel" class="tab-pane fade in" id="specification_attributes" aria-labelledby="specification_attributes_tab">
                      <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <label for="publisher_id">Styles <span class="required">*</span> <i class="btn-success fa fa-plus-square" data-toggle="modal" data-target=".add-attribute"></i></label>
                          {!! Form::select('has_style', $styles, old('has_style'), ['class'=>'form-control', 'id'=>'has_style']) !!}
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <label for="publisher_id">Colors <span class="required">*</span> <i class="btn-success fa fa-plus-square" data-toggle="modal" data-target=".add-attribute"></i></label>
                          {!! Form::select('has_color', $colors, old('has_color'), ['class'=>'form-control', 'id'=>'has_color']) !!}
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <label for="publisher_id">Sizes <span class="required">*</span> <i class="btn-success fa fa-plus-square" data-toggle="modal" data-target=".add-attribute"></i></label>
                          {!! Form::select('has_size', $sizes, old('has_size'), ['class'=>'form-control', 'id'=>'has_size']) !!}
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <label>Price</label>
                          {!! Form::text('price', old('price'), ['id' => 'price', 'class'=>'form-control', 'placeholder'=>'Enter Price', ]) !!}
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <button class="btn btn-primary m-t-25" data-toggle="modal" data-target=".show-image"><i class="fa fa-plus-square" ></i> Primary Image</button>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <button class="btn btn-primary m-t-25" data-toggle="modal" data-target=".show-images"><i class="fa fa-plus-square" ></i> Product Images</button>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12"></div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <button type="button" class="btn btn-primary float-right">Add</button>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <table id="tabel_sp_atr" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="width-10">Product Name</th>
                            <th class="width-10">Style Name</th>
                            <th class="width-10">Color Name</th>
                            <th class="width-10">Size Name</th>
                            <th class="width-10">Price</th>
                            <th class="width-20">Primary Image</th>
                            <th class="width-30">Action</th>
                          </tr>
                        </thead>
                        <tbody class="sp_atr row_position">
                          <tr class="mul_div">
                            <td>IndoPrimo Men's Cotton Casual T-Shirt for Men </td>
                            <td>Half Sleeves</td>
                            <td>Black, White, Grey</td>
                            <td>M, S</td>
                            <td>659</td>
                            <td><img class="width-20" src="{{URL::asset('/images/tshirt.jpg')}}"></td>
                            <td>
                              <a class="btn btn-danger remove_this">Delete</a>
                            </td>
                          </tr>
                          <tr class="mul_div">
                            <td>IndoPrimo Men's Cotton Casual T-Shirt for Men </td>
                            <td>Half Sleeves</td>
                            <td>Black, White, Grey</td>
                            <td>L, XL</td>
                            <td>749</td>
                            <td><img class="width-20" src="{{URL::asset('/images/tshirt.jpg')}}"></td>
                            <td>
                              <a class="btn btn-danger remove_this">Delete</a>
                            </td>
                          </tr>
                          <tr class="mul_div">
                            <td>Discover Brilliance Smart TV</td>
                            <td>HD</td>
                            <td>Black</td>
                            <td>32 inches</td>
                            <td>11999</td>
                            <td><img class="width-20" src="{{URL::asset('/images/tt.jpg')}}"></td>
                            <td>
                              <a class="btn btn-danger remove_this">Delete</a>
                            </td>
                          </tr>
                          <tr class="mul_div">
                            <td>Discover Brilliance Smart TV</td>
                            <td>HD</td>
                            <td>Black</td>
                            <td>40 inches</td>
                            <td>25000</td>
                            <td><img class="width-20" src="{{URL::asset('/images/tt.jpg')}}"></td>
                            <td>
                              <a class="btn btn-danger remove_this">Delete</a>
                            </td>
                          </tr>
                          <tr class="mul_div">
                            <td>IndoPrimo Men's Cotton Casual Shirt for Men </td>
                            <td>Full Sleeves, Half Sleeves</td>
                            <td>Black, White, Grey</td>
                            <td>M, S</td>
                            <td>659</td>
                            <td><img class="width-20" src="{{URL::asset('/images/shirt.jpg')}}"></td>
                            <td>
                              <a class="btn btn-danger remove_this">Delete</a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div role="tabpanel" class="tab-pane fade {{ !empty($product->tab) && $product->tab == 'product_images' ? 'active in' : '' }}" id="product_images" aria-labelledby="product_images_tab">
                      <div class="form-group">
                        <label for="primary_image" class="control-label col-md-3 col-sm-3 col-xs-12">Front Image <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::file('primary_image', ['id'=>'pr_primary_image', 'onchange' => 'handleFileSelect()']) !!}
                            <span class="text-danger">{{ $errors->first('primary_image') }}</span>
                            <!-- <div id="fine-uploader-gallery"></div> -->
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <output id="result">
                          <img class="col-md-2 col-sm-2 col-xs-12" src="
                          {{URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').$product->primary_image)}}">
                        <output/>
                      </div>
                      <div class="form-group">
                        <label for="photo" class="control-label col-md-3 col-sm-3 col-xs-12">Related Images</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- <label for="photo">Photo <span class="required">*</span></label> -->
                          <div id="fine-uploader-gallery"></div>
                        </div>
                      </div>
                      <!-- <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="tax">Tax <span class="required">*</span></label>
                            {!! Form::text('tax', old('tax'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Tax', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('tax') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="qty_in_stock">Quantity in stock<span class="required">*</span></label>
                            {!! Form::text('qty_in_stock', old('qty_in_stock'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Quantity', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('qty_in_stock') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="price">Price <span class="required">*</span></label>
                            {!! Form::text('price', old('price'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Price', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                            <label for="arrival_date">Arrival date *</label>
                            {!! Form::text('arrival_date', old('arrival_date'), ['class'=>'form-control col-md-7 col-xs-12 has-feedback-left', 'id'=>'single_cal3', 'placeholder'=>'Enter Arrival Date', 'required'=>'required']) !!}
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span class="text-danger">{{ $errors->first('arrival_date') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="min_order_qty">Min Order Qty<span class="required">*</span></label>
                            {!! Form::text('min_order_qty', old('min_order_qty'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Min Quantity', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('min_order_qty') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="max_order_qty">Max Order Qty<span class="required">*</span></label>
                            {!! Form::text('max_order_qty', old('max_order_qty'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Max Quantity', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('max_order_qty') }}</span>
                        </div>
                      </div> -->
                    </div>
                    <!-- <div role="tabpanel" class="tab-pane fade" id="product_shipping" aria-labelledby="product_shipping_tab">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="weight">Weight (lbs) <span class="required">*</span></label>
                            {!! Form::text('weight', old('weight'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Weight (lbs)', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('weight') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="items">Items in a box <span class="required">*</span></label>
                            {!! Form::text('items', old('items'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter number of items', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('items') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="shipping_charge">Shipping freight<span class="required">*</span></label>
                            {!! Form::text('shipping_charge', old('shipping_charge'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Shipping freight', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('shipping_charge') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="delivery_date">Delivery date<span class="required">*</span></label>
                            {!! Form::select('delivery_date', $dlry_day, null,  ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Select Days', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('delivery_date') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="length">Box Dimensions<span class="required">*</span></label>
                            {!! Form::text('length', old('length'), ['class'=>'form-control col-md-2 col-xs-12', 'placeholder'=>'Enter Length', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('length') }}</span>

                            {!! Form::text('width', old('width'), ['class'=>'form-control col-md-2 col-xs-12', 'placeholder'=>'Enter Width', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('width') }}</span>

                            {!! Form::text('height', old('height'), ['class'=>'form-control col-md-2 col-xs-12', 'placeholder'=>'Enter Height', 'required'=>'required']) !!}
                            <span class="text-danger">{{ $errors->first('height') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 checkbox">
                            <label for="is_free">Free Shipping</label>
                            {!! Form::checkbox('is_free', old('is_free'), null, ['class'=>'flat']) !!}
                            <span class="text-danger">{{ $errors->first('is_free') }}</span>
                        </div>
                      </div>
                    </div> -->
                  </div>
                </div>
                <br />
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-primary" type="button" onclick="window.location='{{ route("product_list") }}'">Cancel</button>
                      <button type="submit" id="submit" class="btn btn-success">Update</button>
                    </div>
                  </div>
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
    </div>

    <!-- Add Author modal -->
    <div class="modal fade add-author" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="author">Add Author</h4>
          </div>
          {!! Form::open(['class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'author-form']) !!}
          <div class="modal-body">
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="author_name">Author Name <span class="required">*</span></label>
                {!! Form::text('author_name', old('author_name'), ['id' => 'author_name', 'class'=>'form-control', 'placeholder'=>'Enter author name', ]) !!}
                <span class="text-danger" id="author-error"></span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="authorForm_ajax_close" data-dismiss="modal">Close</button>
            <button type="button" id="authorForm_ajax_submit" class="btn btn-primary">Save</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>

    <!-- Add Publisher modal -->
    <div class="modal fade add-publisher" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="publisher">Add Publisher</h4>
          </div>
          {!! Form::open(['class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'publisher-form']) !!}
          <div class="modal-body">
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="publisher_name">Publisher Name <span class="required">*</span></label>
                {!! Form::text('publisher_name', old('publisher_name'), ['id' => 'publisher_name', 'class'=>'form-control', 'placeholder'=>'Enter publisher name', ]) !!}
                <span class="text-danger" id="publisher-error"></span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="publisherForm_ajax_close" data-dismiss="modal">Close</button>
            <button type="button" id="publisherForm_ajax_submit" class="btn btn-primary">Save</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>

    <!-- Add Attribute modal -->
    <div class="modal fade add-attribute" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="attribute">Add Attribute</h4>
          </div>
          {!! Form::open(['class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'attribute-form']) !!}
          <div class="modal-body">
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="attribute_name">Attribute Name <span class="required">*</span></label>
                {!! Form::text('attribute_name', old('attribute_name'), ['id' => 'attribute_name', 'class'=>'form-control', 'placeholder'=>'Enter attribute name', ]) !!}
                <span class="text-danger" id="attribute-error"></span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="attributeForm_ajax_close" data-dismiss="modal">Close</button>
            <button type="button" id="attributeForm_ajax_submit" class="btn btn-primary">Save</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>

    <!-- show iamge modal -->
    <div class="modal fade show-image" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Image</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <output id="primary_image" />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="showImage_close" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- show iamges modal -->
    <div class="modal fade show-images" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Images</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <output id="combo_images" />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="showImages_close" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /modals -->
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
  <!-- jQuery Tags Input -->
  <script src="{{asset('vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>
  <!-- Fine Uploader jQuery JS file-->
  <script src="{{asset('vendors/fine_upload/jquery.fine-uploader.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      /**** Hide/Show academic fields on load ****/ 
      if ($('#is_academic').is(':checked')) {
        $('.academic').fadeIn('slow');
      }else{
        $('.academic').fadeOut('slow');
      }

      /**** Ckeditor ****/ 
      $('textarea').ckeditor();

      /**** Select2 Js for search with autoselect Dropdown ****/ 
      $('#category_id').select2({
        placeholder: 'Select Category',
        allowClear: true,
        closeOnSelect: false
      });

      $('#has_size').select2({
        placeholder: 'Select Size',
        allowClear: true,
        closeOnSelect: false
      });

      $('#has_color').select2({
        placeholder: 'Select Color',
        allowClear: true,
        closeOnSelect: false
      });

      $('#has_style').select2({
        placeholder: 'Select Style',
        allowClear: true,
        closeOnSelect: false
      });
      
      $('#standard_id').select2({
        placeholder: 'Select Standard',
        allowClear: true,
        closeOnSelect: false
      });

      $('#board_id').select2({
        placeholder: 'Select Board',
        allowClear: true,
        closeOnSelect: false
      });
      
      // $('#size').change(function(){
      //   if(this.checked)
      //       $('#has_size').fadeIn('slow');
      //   else
      //       $('#has_size').fadeOut('slow'); 
      // });

      // $('#color').change(function(){
      //   if(this.checked)
      //       $('#has_color').fadeIn('slow');
      //   else
      //       $('#has_color').fadeOut('slow'); 
      // });

      // $('#style').change(function(){
      //   if(this.checked)
      //       $('#has_style').fadeIn('slow');
      //   else
      //       $('#has_style').fadeOut('slow'); 
      // });

      /**** Fine uploader js for images upload ****/ 
      var csrf_token = "{{ csrf_token() }}";
      var manualuploader = new qq.FineUploader({
            element: document.getElementById("fine-uploader-gallery"),
            //var manualuploader = $('#fine-uploader-gallery').fineUploader({
            debug: true,
            template: 'qq-template',
            interceptSubmit: true,
            autoUpload: false,
            messages: {
                typeError: 'Invalid extension detected in file, {file}.',
                emptyError: '{file} is empty, please select files again without it.'
            },
            request: {
              endpoint: '{{route("product_update", $id)}}',
              params: {'_token': csrf_token},
              inputName: 'listing'
                //endpoint: '{{asset("vendors/fine_upload/endpoint.php")}}'
            },
            deleteFile: {
              enabled: true,
              forceConfirm: true,
              params: {'_token': csrf_token},
              endpoint: '{{route("product_deleteImage", $id)}}'
              //endpoint: '{{asset("vendors/fine_upload/endpoint.php")}}'
            },
            session: {
              endpoint: '{{route("product_getImage", $id)}}',
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
            },
            // callbacks: {
            //   // onSubmit: function (id, fileName) {
            //   //     alert('<div id="file-' + id + '" class="alert" style="margin: 20px 0 0">'+fileName+'</div>');
            //   // },
            //   onError: function(fileId, filename, reason, maybeXhr) {
            //       alert(reason);
            //   },
            //   // showMessage: function(message) {
            //   //   alert(message);
            //   //     //either include an empty body, or some other code to display (error) messages
            //   // }
            // }
            
        });
        $('#submit').click(function() {
            manualuploader.uploadStoredFiles();
        });


        new qq.FineUploader({
            element: document.getElementById("primary_image"),
            //var manualuploader = $('#fine-uploader-gallery').fineUploader({
            debug: true,
            template: 'qq-template',
            interceptSubmit: true,
            autoUpload: true,
            multiple: false,
            messages: {
                typeError: 'Invalid extension detected in file, {file}.',
                emptyError: '{file} is empty, please select files again without it.'
            },
            request: {
              endpoint: '{{route("product_store")}}',
              params: {'_token': csrf_token},
              inputName: 'listing'
                //endpoint: '{{asset("vendors/fine_upload/endpoint.php")}}'
            },
            deleteFile: {
              enabled: true,
              forceConfirm: true,
              params: {'_token': csrf_token},
              endpoint: '{{route("product_deleteImage", $id)}}'
              //endpoint: '{{asset("vendors/fine_upload/endpoint.php")}}'
            },
            session: {
              endpoint: '{{route("product_getImage", $id)}}',
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
               enableAuto: true,
               showButton: true
            },
            validation: {
                allowedExtensions: ['jpeg', 'jpg', 'gif', 'png']
            }
        });

        new qq.FineUploader({
            element: document.getElementById("combo_images"),
            //var manualuploader = $('#fine-uploader-gallery').fineUploader({
            debug: true,
            template: 'qq-template',
            interceptSubmit: true,
            autoUpload: true,
            messages: {
                typeError: 'Invalid extension detected in file, {file}.',
                emptyError: '{file} is empty, please select files again without it.'
            },
            request: {
              endpoint: '{{route("product_store")}}',
              params: {'_token': csrf_token},
              inputName: 'listing'
                //endpoint: '{{asset("vendors/fine_upload/endpoint.php")}}'
            },
            deleteFile: {
              enabled: true,
              forceConfirm: true,
              params: {'_token': csrf_token},
              endpoint: '{{route("product_deleteImage", $id)}}'
              //endpoint: '{{asset("vendors/fine_upload/endpoint.php")}}'
            },
            session: {
              endpoint: '{{route("product_getImage", $id)}}',
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
               enableAuto: true,
               showButton: true
            },
            validation: {
                allowedExtensions: ['jpeg', 'jpg', 'gif', 'png']
            }
        });

        /**** On change of radio button hide/show fields ****/ 
        // $('input[name=product_type]').change(function(){
        //   if(this.value == 'book') {
        //     $('.product_other').fadeOut('slow');
        //     $('.product_book').fadeIn('slow');
        //     $(".product_book :input").prop("required", true);
        //   } else {
        //     $(".product_book :input").prop("required", false);
        //     $('.product_other').fadeIn('slow');
        //     $('.product_book').fadeOut('slow');
        //   }
        // });

        $('#is_academic').change(function(){
          if(this.checked){
            $('.academic').fadeIn('slow');
            $(".academic_book :input").attr("required", true);
          } else {
            $('.academic').fadeOut('slow');
            $(".academic :input").prop("required", false);
          }
        });

        /**** On click of add button add new row ****/ 
        jQuery(document).on('click', '#add_sp_attr', function() {
          var attributeForm = $("#product-form");
          var formData = attributeForm.serialize();

          $.ajax({
            url:"{{route('attribute_ajaxstore', $id)}}",
            type:'POST',
            data:formData,
            success:function(data) {
              if(data.error) {
                if(data.message.attribute_id){
                  $( '.alert-block"' ).html( data.message.attribute_id[0] );
                }
              }

              if(data.success) {
                var sp_attr_text = $('#attribute_id').find(":selected").text();
                $(".sp_atr").append('<tr class="mul_div">\
                                  <td>\
                                    <input name="book_attribute_id" type="hidden" value="'+data.data.book_attribute_id+'">\
                                    '+sp_attr_text+'\
                                  </td>\
                                  <td>\
                                    '+data.data.attribute_value+'\
                                  </td>\
                                  <td>\
                                    <a class="btn btn-success btn-xs add" style="display: none;"><i class="fa fa-save"></i> Save </a>\
                                    <a class="btn btn-info btn-xs edit"><i class="fa fa-check"></i> Edit </a>\
                                    <a class="btn btn-danger btn-xs delete"><i class="fa fa-close"></i> Delete </a>\
                                  </td>\
                                </tr>');
                $('#attribute_id').val('');
                $('#attribute_val').val('');
              }
            },
          });

          return false;
        });

        jQuery(document).on('click', '#add_pr_attr', function() {
          var pr_attr_key = $('#pr_attribute_id').find(":selected").val();
          if (pr_attr_key != 0) {
            var pr_attr_text = $('#pr_attribute_id').find(":selected").text();
            $(".pr_atr").append('<tr class="mul_div">\
                              <td>\
                                {!! Form::hidden("pr_attr_id", '+pr_attr_key+') !!}\
                                '+pr_attr_text+'\
                              </td>\
                              <td>\
                                <a href="{{asset(route("product_store"))}}" class="btn btn-warning">Edit</a><a class="btn btn-danger remove_this">Delete</a>\
                              </td>\
                            </tr>');
          }
          return false;
        });

        /**** On click of button remove row ****/ 
        jQuery(document).on('click', '.remove_this', function() {
          jQuery(this).parents('.mul_div').remove();
          //cal_price();
          return false;
        });

        /**** Ajax call to add new author and autoselect new created author ****/ 
        $('body').on('click', '#authorForm_ajax_submit', function(){
          var authorForm = $("#author-form");
          var formData = authorForm.serialize();

          $.ajax({
            url:"{{route('author_ajaxstore')}}",
            type:'POST',
            data:formData,
            success:function(data) {
              if(data.error) {
                if(data.message.author_name){
                    $( '#author-error' ).html( data.message.author_name[0] );
                }
              }

              if(data.success) {
                $('#author_id').append('<option value="'+data.data.author_id+'" selected="selected">'+data.data.author_name+'</option>');
                $('#author_name').val('');
                $( '#author-error' ).html('');
                $('.add-author').modal('hide');
              }
            },
          });
        });

        $('#author_id').select2({
          placeholder: 'Select Author',
          allowClear: true,
          closeOnSelect: false
        });

        $('#authorForm_ajax_close').click(function(){
          $('#author_name').val('');
          $('#author-error').html('');
        });

        /**** Ajax call to add new publisher and autoselect new created publisher ****/ 
        $('body').on('click', '#publisherForm_ajax_submit', function(){
          var publisherForm = $("#publisher-form");
          var formData = publisherForm.serialize();

          $.ajax({
            url:"{{route('publisher_ajaxstore')}}",
            type:'POST',
            data:formData,
            success:function(data) {
              if(data.error) {
                if(data.message.publisher_name){
                    $( '#publisher-error' ).html( data.message.publisher_name[0] );
                }
              }

              if(data.success) {
                $('#publisher_id').append('<option value="'+data.data.publisher_id+'" selected="selected">'+data.data.publisher_name+'</option>');
                $('#publisher_name').val('');
                $( '#publisher-error' ).html('');
                $('.add-publisher').modal('hide');
              }
            },
          });
        });

        $('#publisher_id').select2({
          placeholder: 'Select Publisher',
          allowClear: true
        });

        $('#publisherForm_ajax_close').click(function(){
          $('#publisher_name').val('');
          $('#publisher-error').html('');
        });
    });

    // Update, Remove attributes
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
          var actions = $("table td:last-child").html();
          // Append table with add row form on add new button click
          $(".add-new").click(function(){
          $(this).attr("disabled", "disabled");
            var index = $("table tbody tr:last-child").index();
            var row = '<tr>' +
                  '<td><input type="text" class="form-control" name="name" id="name"></td>' +
                  '<td>' + actions + '</td>' +
              '</tr>';
            $("table").append(row);   
            $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
            $('[data-toggle="tooltip"]').tooltip();
          });

        // save row on add button click
        $(document).on("click", ".add", function(){
          var csrf_token = "{{ csrf_token() }}";
          var empty = false;
          var input = $(this).parents("tr").find('input[type="text"]');
              input.each(function(){
                if(!$(this).val()){
                  $(this).addClass("parsley-error");
                  empty = true;
                } else{
                  $(this).removeClass("parsley-error");
                }
              });
              $(this).parents("tr").find(".parsley-error").first().focus();
              if(!empty){
                input.each(function(){
                  var book_attr_ids = $(this).parents("tr").find('input[type="hidden"]');
                  book_attr_ids.each(function(){
                    book_attr_id = $(this).val();
                  }); 
                  book_attr_value = $(this).val();

                  $.ajax({
                    url:"{{route('attribute_ajaxupdate')}}",
                    type:'POST',
                    dataType: 'json',
                    data: { 'book_attribute_id': book_attr_id, 'attribute_value': book_attr_value, '_token': csrf_token },
                    success:function(data) {
                      if(data.error) {
                        if(data.message.book_attribute_id){
                            $( '.alert-error' ).html( data.message.book_attribute_id[0] );
                        }
                      }
                    },
                  });
                  $(this).parent("td").html($(this).val());
                });
                $(this).parents("tr").find(".add, .edit").toggle();
                $(".add-new").removeAttr("disabled");
              }
        });

        // Edit row on edit button click
        $(document).on("click", ".edit", function(){    
            $(this).parents("tr").find("td:not(:even)").each(function(){
              $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
            });   
            $(this).parents("tr").find(".add, .edit").toggle();
            $(".add-new").attr("disabled", "disabled");
        });
        
        // Delete row on delete button click
        $(document).on("click", ".delete", function(){
            var csrf_token = "{{ csrf_token() }}";
            var book_attr_ids = $(this).parents("tr").find('input[type="hidden"]');
              book_attr_ids.each(function(){
              book_attr_id = $(this).val();
            });

            $.ajax({
              url:"{{route('attribute_ajaxdelete')}}",
              type:'POST',
              dataType: 'json',
              data: { 'book_attribute_id': book_attr_id, '_token': csrf_token },
              success:function(data) {
                if(data.error) {
                  if(data.message.book_attribute_id){
                      $( '.alert-error' ).html( data.message.book_attribute_id[0] );
                  }
                }
              },
            });

            $(this).parents("tr").remove();
            $(".add-new").removeAttr("disabled");
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
        $('#pr_primary_image').val("");
    });

  </script>
@endsection