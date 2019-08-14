<?php $__env->startSection('css'); ?>
  <style type="text/css">
    #select_category_css .select2 { width: 100% !important; }
    .product_book .select2 {width: 100% !important}
  </style>
  <!-- Switchery -->
  <link href="<?php echo e(asset('vendors/switchery/dist/switchery.min.css')); ?>" rel="stylesheet">
  <!-- iCheck -->
  <link href="<?php echo e(asset('vendors/iCheck/skins/flat/green.css')); ?>" rel="stylesheet">
  <!-- Select2 -->
  <link href="<?php echo e(asset('vendors/select2/dist/css/select2.min.css')); ?>" rel="stylesheet">

  <!-- Fine Uploader Gallery CSS file-->
  <link href="<?php echo e(asset('vendors/fine_upload/fine-uploader-gallery.min.css')); ?>" rel="stylesheet">
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add Product</h2>
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

                  <?php if($message = Session::get('response.message')): ?>
                      <div class="alert alert-<?php echo e(session('response.status')); ?> alert-block">
                          <button type="button" class="close" data-dismiss="alert">X</button> 
                              <strong><?php echo e($message); ?></strong>
                      </div>
                  <?php endif; ?>

                  <?php echo Form::open(['route'=>'product_store', 'class' =>'demo-form form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'product-form', 'enctype'=>'multipart/form-data']); ?>

                  <ul id="product_tabs" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class=""><a href="#product_info" id="product_info_tab" role="tab" data-toggle="tab" aria-expanded="true">Basic Info</a>
                    </li>
                    <li role="presentation" class=""><a href="#product_categories_info" role="tab" id="product_categories_info_tab" data-toggle="tab" aria-expanded="false">Categories</a>
                    </li>
                    <!-- 
                    <li role="presentation" class="product_book"><a href="#product_images" role="tab" id="product_images_tab" data-toggle="tab" aria-expanded="false">Images</a>
                    </li>
                    <li role="presentation" class="product_other" style="display: none;"><a href="#specification_attributes" role="tab" id="specification_attributes_tab" data-toggle="tab" aria-expanded="false">Price Specification</a>
                    </li> -->
                    <!-- <li role="presentation" class=""><a href="#product_attribute_info" role="tab" id="product_attribute_info_tab" data-toggle="tab" aria-expanded="false">Attributes</a>
                    </li>
                    <li role="presentation" class=""><a href="#product_tag" role="tab" id="product_tag_tab" data-toggle="tab" aria-expanded="false">Tags</a>
                    </li> -->
                    <!-- <li role="presentation" class=""><a href="#product_shipping" role="tab" id="product_shipping_tab" data-toggle="tab" aria-expanded="false">Shipping</a>
                    </li> -->
                  </ul>
                  <div id="product_tab_content" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in form-section" id="product_info" aria-labelledby="product_info_tab">
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label for="product_type">Product Type <span class="required">*</span></label>
                          <div class="form-group">
                            <?php echo Form::radio('product_type','book', true, ['class' => 'flat']); ?>

                            <label class="form-label" >&nbsp; Book &nbsp;</label>
                            <!-- <label class="form-label">&nbsp; Other &nbsp;</label>
                            <?php echo Form::radio('product_type','other', null); ?> -->
                          </div>
                        </div>
                      </div>  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="product_type">Product Type<span class="required">*</span></label>
                            <?php echo Form::select('',$product_types, old('product_type'), ['class'=>'form-control', 'id' => 'product_type', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('product_type')); ?></span>
                        </div> -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="name">Product Name <span class="required">*</span></label>
                            <?php echo Form::text('name', old('name'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Product Name', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 product_book">
                              <label for="publisher_id">Publisher <span class="required">*</span> <i class="btn-success fa fa-plus-square" data-toggle="modal" data-target=".add-publisher"></i></label>
                              <?php echo Form::select('publisher_id', $publishers, null, ['class'=>'form-control', 'required'=>'required', 'id' =>'publisher_id','data-parsley-errors-container' => '#publisher_id_error']); ?>

                              <span id="publisher_id_error" class="text-danger"><?php echo e($errors->first('publisher_id')); ?></span>
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 product_book">
                            <label for="author_id">Author <span class="required">*</span> <i class="btn-success fa fa-plus-square" data-toggle="modal" data-target=".add-author"></i></label>
                            <?php echo Form::select('author_id[]', $authors, null, ['class'=>'form-control', 'required'=>'required', 'id' => 'author_id', 'multiple', 'data-parsley-errors-container' => '#author_id_error']); ?>

                            <span id="author_id_error" class="text-danger"><?php echo e($errors->first('author_id')); ?></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 product_book">
                            <label for="name">Year <span class="required">*</span></label>
                            <?php echo Form::text('year', old('year'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Edition year', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('year')); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 product_book">
                            <label for="isbn">ISBN Number <span class="required">*</span></label>
                            <?php echo Form::text('isbn', old('isbn'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter ISBN Number', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('isbn')); ?></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 product_book">
                            <label for="name">Paper Back <span class="required">*</span></label>
                            <?php echo Form::select('format',$formats, null, ['class'=>'form-control', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('format')); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 product_book">
                            <label for="language_id">Language <span class="required">*</span></label>
                            <?php echo Form::select('language_id',$languages, null, ['class'=>'form-control', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('language_id')); ?></span>
                        </div>
                      </div>
                      <div class="form-group product_book">
                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label class="control-label">Is Academic</label>
                          <?php echo Form::checkbox('is_academic', old('is_academic'), true, ['class'=>'js-switch', 'id'=>'is_academic', 'checked']); ?>

                        </div>
                      </div>
                      <div class="form-group product_book academic">
                        <div class="form-group">
                          <div class="col-md-4 col-sm-4 col-xs-12 product_book">
                              <label for="board_id">Board</label>
                              <?php echo Form::select('board_id[]', $board, null, ['class'=>'form-control academic_book col-md-7 col-xs-12', 'multiple'=>'multiple', 'id' => 'board_id', 'required'=>'required', 'data-parsley-errors-container' => '#board_id_error']); ?>

                              <span id="board_id_error" class="text-danger"><?php echo e($errors->first('board_id')); ?></span>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12 product_book">
                              <label for="standard_id">Standard</label>
                              <?php echo Form::select('standard_id[]',$class, null, ['class'=>'form-control academic_book', 'multiple'=>'multiple', 'id' => 'standard_id', 'required'=>'required', 'data-parsley-errors-container' => '#standard_id_error']); ?>

                              <span id="standard_id_error" class="text-danger"><?php echo e($errors->first('standard_id')); ?></span>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12 product_book">
                              <label for="subject_id">Subject</label>
                              <?php echo Form::select('subject_id', $subject, null, ['class'=>'form-control academic_book col-md-7 col-xs-12', 'id' => 'subject_id', 'required'=>'required']); ?>

                              <span class="text-danger"><?php echo e($errors->first('subject_id')); ?></span>
                          </div>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md4 col-sm-4 col-xs-12">
                            <label for="list_price">List price <span class="required">*</span></label>
                            <?php echo Form::number('list_price', old('list_price'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter List Price', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('list_price')); ?></span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label for="display_price">Display Price <span class="required">*</span></label>
                            <?php echo Form::number('display_price', old('display_price'), ['class'=>'form-control', 'placeholder'=>'Enter Display Price', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('language_id')); ?></span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label for="flinnt_charge">flinnt Charge</label>
                            <?php echo Form::number('flinnt_charge', old('flinnt_charge'), ['class'=>'form-control', 'placeholder'=>'Enter flinnt Charge']); ?>

                            <span class="text-danger"><?php echo e($errors->first('flinnt_charge')); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label for="hs_code">HS Code <span class="required">*</span></label>
                          <?php echo Form::text('hs_code', old('for="hs_code'), ['class'=>'form-control', 'required'=>'required', 'placeholder' => 'Enter Code']); ?>

                          <span class="text-danger"><?php echo e($errors->first('hs_code')); ?></span>
                        </div>
                      </div>
<!--                       <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="category_id">Category <span class="required">*</span></label>
                            <?php echo Form::select('category_id',$categories, old('category_id'), ['class'=>'form-control',  'multiple'=>'multiple', 'id' => 'category_id', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('category_id')); ?></span>
                        </div>
                      </div> -->
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label for="description">Single Line Description <span class="required">*</span></label>
                          <?php echo Form::text('description[]', old('description'), ['class'=>'form-control', 'placeholder'=>'Enter Single Description', 'required'=>'required']); ?>

                          <span class="text-danger"><?php echo e($errors->first('description')); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label for="description">Detail Description</label>
                          <?php echo Form::textarea('description[]', old('description'), ['class'=>'form-control']); ?>

                          <span class="text-danger"><?php echo e($errors->first('description')); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label class="control-label">Is Active</label>
                          <?php echo Form::checkbox('is_active', old('is_active'), null, ['class'=>'js-switch', 'id'=>'is_active', 'checked']); ?>

                        </div>
                      </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in form-section" id="product_categories_info" aria-labelledby="product_categories_info_tab">
                      <!-- <p>Product attributes are quantifiable or descriptive aspects of a product (such as, color). For example, if you were to create an attribute for color, with the values of blue, green, yellow, and so on, you may want to apply this attribute to shirts, which you sell in various colors (you can adjust a price or weight for any of existing attribute values). You can add attribute for your product using existing list of attributes, or if you need to create a new one go to Attributes > Product attributes.</p>
                      <div class="ln_solid"></div> -->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">Category<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" id="select_category_css">
                            <?php echo Form::select('category_id[]', $categories, null, ['class'=>'form-control col-md-7 col-xs-12', 'required'=>'required', 'id'=>'category_id', 'multiple'=>'multiple','data-parsley-errors-container' => '#category_id_error']); ?>

                            <span id="category_id_error" class="text-danger"><?php echo e($errors->first('category_id')); ?></span>
                        </div>
                      </div>
                      <!-- <div id="product_book"> -->
                        <!-- <div class="ln_solid"></div> -->
<!--                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <label for="language_id">Language <span class="required">*</span></label>
                              <?php echo Form::select('language_id',$languages, old('language_id'), ['class'=>'form-control', 'placeholder'=>'Select Language', 'required'=>'required']); ?>

                              <span class="text-danger"><?php echo e($errors->first('language_id')); ?></span>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <label for="series">Series <span class="required">*</span></label>
                              <?php echo Form::text('series', old('series'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Series', 'required'=>'required']); ?>

                              <span class="text-danger"><?php echo e($errors->first('series')); ?></span>
                          </div>
                        </div> -->
<!--                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <label for="cover_type_id">Cover Type <span class="required">*</span></label>
                              <?php echo Form::select('cover_type_id',$cover_types, old('cover_type_id'), ['class'=>'form-control', 'placeholder'=>'Select Cover Type', 'required'=>'required']); ?>

                              <span class="text-danger"><?php echo e($errors->first('cover_type_id')); ?></span>
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
                          <?php echo Form::select('pr_attribute_id', $pr_attributes, null, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Select Attribute', 'required'=>'required', 'id'=>'pr_attribute_id']); ?>

                          <span class="text-danger"><?php echo e($errors->first('pr_attribute_id')); ?></span>
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
                              <a href="<?php echo e(asset(route("product_store"))); ?>" class="btn btn-warning">Edit</a><a class="btn btn-danger remove_this">Delete</a>
                            </td>
                          </tr>
                          <tr class="mul_div">
                            <td>Style</td>
                            <td>
                              <a href="<?php echo e(asset(route("product_store"))); ?>" class="btn btn-warning">Edit</a><a class="btn btn-danger remove_this">Delete</a>
                            </td>
                          </tr>
                          <tr class="mul_div">
                            <td>Size</td>
                            <td>
                              <a href="<?php echo e(asset(route("product_store"))); ?>" class="btn btn-warning">Edit</a><a class="btn btn-danger remove_this">Delete</a>
                            </td>
                          </tr>
                        </tbody>
                      </table> -->
                      <!-- <div id="product_other" style="display: none;">
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <label for="publisher_id">Brand Name <span class="required">*</span></label>
                              <?php echo Form::select('brand_id',$brands, old('brand_id'), ['class'=>'form-control', 'placeholder'=>'Select Brand', 'required'=>'required']); ?>

                              <span class="text-danger"><?php echo e($errors->first('brand_id')); ?></span>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <label for="model_id">Model Number <span class="required">*</span></label>
                              <?php echo Form::text('model_id', old('model_id'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Model Number', 'required'=>'required']); ?>

                              <span class="text-danger"><?php echo e($errors->first('model_id')); ?></span>
                          </div>
                        </div>
                      </div> -->
                        <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <label for="size">Has Size</label>
                            <?php echo Form::checkbox('size', old('size'), null, ['style'=>'float:right', 'id'=>'size']); ?>

                            <span class="text-danger"><?php echo e($errors->first('size')); ?></span>
                          </div>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <?php echo Form::select('has_size', $sizes, old('has_size'), ['class'=>'form-control','id'=>'has_size', 'placeholder'=>'Select Size', 'style'=>'display:none']); ?>

                            <span class="text-danger"><?php echo e($errors->first('has_size')); ?></span>
                          </div>
                        </div> -->
                    </div>
                    <!-- <div role="tabpanel" class="tab-pane fade" id="product_attribute_info" aria-labelledby="product_attribute_info_tab">
                      <p>Specification attributes are product features i.e, screen size, number of USB-ports, visible on product details page. Specification attributes can be used for information purposes only on details page.</p>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Attribute <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <?php echo Form::select('sp_attribute_id', $sp_attributes, null, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Select Attribute', 'id'=>'sp_attribute_id']); ?>

                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <?php echo Form::text('sp_attribute_val', old('sp_attribute_val'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter attribute value', 'id'=>'sp_attribute_val']); ?>

                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button type="button" id="add_sp_attr" class="btn btn-primary">Add Attribute</button>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <table id="tabel_sp_atr" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th style="width: 30%">Attribute Name</th>
                            <th style="width: 30%">Attribute Value</th>
                            <th style="width: 30%">Action</th>
                          </tr>
                        </thead>
                        <tbody class="sp_atr row_position">
                          <tr class="mul_div">
                            <td>Model Name</td>
                            <td>WKOD9899</td>
                            <td>
                              <a class="btn btn-danger remove_this">Delete</a>
                            </td>
                          </tr>
                          <tr class="mul_div">
                            <td>Brand</td>
                            <td>Apple</td>
                            <td>
                              <a class="btn btn-danger remove_this">Delete</a>
                            </td>
                          </tr>
                        </tbody>
                      </table> -->
                      <!-- <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <label for="color">Has Color</label>
                            <?php echo Form::checkbox('color', old('color'), null, ['style'=>'float:right', 'id'=>'color']); ?>

                            <span class="text-danger"><?php echo e($errors->first('color')); ?></span>
                          </div>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <?php echo Form::select('has_size', $colors, old('has_color'), ['class'=>'form-control', 'placeholder'=>'Select Color', 'id'=>'has_color', 'style'=>'display:none']); ?>

                            <span class="text-danger"><?php echo e($errors->first('has_color')); ?></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <label for="style">Has Style</label>
                            <?php echo Form::checkbox('style', old('style'), null, ['style'=>'float:right', 'id'=>'style']); ?>

                            <span class="text-danger"><?php echo e($errors->first('style')); ?></span>
                          </div>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <?php echo Form::select('has_style', $styles, old('has_style'), ['class'=>'form-control', 'placeholder'=>'Select Style', 'id'=>'has_style',  'style'=>'display:none']); ?>

                            <span class="text-danger"><?php echo e($errors->first('has_style')); ?></span>
                          </div>
                        </div>
                      </div> -->
                    <!-- </div> -->
                    <!-- <div role="tabpanel" class="tab-pane fade" id="product_tag" aria-labelledby="product_tag_tab">
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>Tags</label>
                          <?php echo Form::text('tag', 'social, adverts', ['id' => 'tags', 'class'=>'tags form-control', 'placeholder'=>'Enter Tag Name']); ?>

                          <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                        </div>
                      </div>
                    </div> -->
                    <!-- <div role="tabpanel" class="tab-pane fade in" id="specification_attributes" aria-labelledby="specification_attributes_tab">
                      <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <label for="publisher_id">Styles <span class="required">*</span> <i class="btn-success fa fa-plus-square" data-toggle="modal" data-target=".add-attribute"></i></label>
                          <?php echo Form::select('has_style', $styles, old('has_style'), ['class'=>'form-control', 'id'=>'has_style']); ?>

                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <label for="publisher_id">Colors <span class="required">*</span> <i class="btn-success fa fa-plus-square" data-toggle="modal" data-target=".add-attribute"></i></label>
                          <?php echo Form::select('has_color', $colors, old('has_color'), ['class'=>'form-control', 'id'=>'has_color']); ?>

                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <label for="publisher_id">Sizes <span class="required">*</span> <i class="btn-success fa fa-plus-square" data-toggle="modal" data-target=".add-attribute"></i></label>
                          <?php echo Form::select('has_size', $sizes, old('has_size'), ['class'=>'form-control', 'id'=>'has_size']); ?>

                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <label>Price</label>
                          <?php echo Form::text('price', old('price'), ['id' => 'price', 'class'=>'form-control', 'placeholder'=>'Enter Price', ]); ?>

                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <button class="btn btn-primary" style="margin-top: 25px;" data-toggle="modal" data-target=".show-image"><i class="fa fa-plus-square" ></i> Primary Image</button>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <button class="btn btn-primary" style="margin-top: 25px;" data-toggle="modal" data-target=".show-images"><i class="fa fa-plus-square" ></i> Product Images</button>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12"></div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <button type="button" class="btn btn-primary" style="float: right;">Add</button>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <table id="tabel_sp_atr" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th style="width: 10%">Product Name</th>
                            <th style="width: 10%">Style Name</th>
                            <th style="width: 10%">Color Name</th>
                            <th style="width: 10%">Size Name</th>
                            <th style="width: 10%">Price</th>
                            <th style="width: 20%">Primary Image</th>
                            <th style="width: 30%">Action</th>
                          </tr>
                        </thead>
                        <tbody class="sp_atr row_position">
                          <tr class="mul_div">
                            <td>IndoPrimo Men's Cotton Casual T-Shirt for Men </td>
                            <td>Half Sleeves</td>
                            <td>Black, White, Grey</td>
                            <td>M, S</td>
                            <td>659</td>
                            <td><img style="width: 20%" src="<?php echo e(URL::asset('/images/tshirt.jpg')); ?>"></td>
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
                            <td><img style="width: 20%" src="<?php echo e(URL::asset('/images/tshirt.jpg')); ?>"></td>
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
                            <td><img style="width: 20%" src="<?php echo e(URL::asset('/images/tt.jpg')); ?>"></td>
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
                            <td><img style="width: 20%" src="<?php echo e(URL::asset('/images/tt.jpg')); ?>"></td>
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
                            <td><img style="width: 20%" src="<?php echo e(URL::asset('/images/shirt.jpg')); ?>"></td>
                            <td>
                              <a class="btn btn-danger remove_this">Delete</a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div> -->
                    <!-- <div role="tabpanel" class="tab-pane fade" id="product_images" aria-labelledby="product_images_tab">
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label for="photo">Photo <span class="required">*</span></label>
                          <div id="fine-uploader-gallery"></div>
                        </div>
                      </div> -->
                      <!-- <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="tax">Tax <span class="required">*</span></label>
                            <?php echo Form::text('tax', old('tax'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Tax', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('tax')); ?></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="qty_in_stock">Quantity in stock<span class="required">*</span></label>
                            <?php echo Form::text('qty_in_stock', old('qty_in_stock'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Quantity', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('qty_in_stock')); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="price">Price <span class="required">*</span></label>
                            <?php echo Form::text('price', old('price'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Price', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('price')); ?></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                            <label for="arrival_date">Arrival date *</label>
                            <?php echo Form::text('arrival_date', old('arrival_date'), ['class'=>'form-control col-md-7 col-xs-12 has-feedback-left', 'id'=>'single_cal3', 'placeholder'=>'Enter Arrival Date', 'required'=>'required']); ?>

                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span class="text-danger"><?php echo e($errors->first('arrival_date')); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="min_order_qty">Min Order Qty<span class="required">*</span></label>
                            <?php echo Form::text('min_order_qty', old('min_order_qty'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Min Quantity', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('min_order_qty')); ?></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="max_order_qty">Max Order Qty<span class="required">*</span></label>
                            <?php echo Form::text('max_order_qty', old('max_order_qty'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Max Quantity', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('max_order_qty')); ?></span>
                        </div>
                      </div> -->
                    <!-- </div> -->
                    <!-- <div role="tabpanel" class="tab-pane fade" id="product_shipping" aria-labelledby="product_shipping_tab">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="weight">Weight (lbs) <span class="required">*</span></label>
                            <?php echo Form::text('weight', old('weight'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Weight (lbs)', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('weight')); ?></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="items">Items in a box <span class="required">*</span></label>
                            <?php echo Form::text('items', old('items'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter number of items', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('items')); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="shipping_charge">Shipping freight<span class="required">*</span></label>
                            <?php echo Form::text('shipping_charge', old('shipping_charge'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Shipping freight', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('shipping_charge')); ?></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="delivery_date">Delivery date<span class="required">*</span></label>
                            <?php echo Form::select('delivery_date', $dlry_day, null,  ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Select Days', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('delivery_date')); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="length">Box Dimensions<span class="required">*</span></label>
                            <?php echo Form::text('length', old('length'), ['class'=>'form-control col-md-2 col-xs-12', 'placeholder'=>'Enter Length', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('length')); ?></span>

                            <?php echo Form::text('width', old('width'), ['class'=>'form-control col-md-2 col-xs-12', 'placeholder'=>'Enter Width', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('width')); ?></span>

                            <?php echo Form::text('height', old('height'), ['class'=>'form-control col-md-2 col-xs-12', 'placeholder'=>'Enter Height', 'required'=>'required']); ?>

                            <span class="text-danger"><?php echo e($errors->first('height')); ?></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 checkbox">
                            <label for="is_free">Free Shipping</label>
                            <?php echo Form::checkbox('is_free', old('is_free'), null, ['class'=>'flat']); ?>

                            <span class="text-danger"><?php echo e($errors->first('is_free')); ?></span>
                        </div>
                      </div>
                    </div> -->
                  </div>
                </div>
                <br />
                  <!-- <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-primary" type="button" onclick="window.location='<?php echo e(URL::previous()); ?>'">Cancel</button>
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <button type="submit" id="submit" class="btn btn-success">Save & Continue</button>
                    </div>
                  </div> -->
                  <div class="form-navigation">
                      <button class="btn btn-primary" type="button" onclick="window.location='<?php echo e(route("product_list")); ?>'">Cancel</button>
                      <button type="button" class="previous btn btn-info pull-left">&lt; Previous</button>
                      <button type="button" class="next btn btn-info pull-right">Next &gt;</button>
                      <input type="submit" class="btn btn-default pull-right">
                      <span class="clearfix"></span>
                  </div>
                <?php echo Form::close(); ?>

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
          <?php echo Form::open(['class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'author-form']); ?>

          <div class="modal-body">
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="author_name">Author Name <span class="required">*</span></label>
                <?php echo Form::text('author_name', old('author_name'), ['id' => 'author_name', 'class'=>'form-control', 'placeholder'=>'Enter author name', ]); ?>

                <span class="text-danger" id="author-error"></span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="authorForm_ajax_close" data-dismiss="modal">Close</button>
            <button type="button" id="authorForm_ajax_submit" class="btn btn-primary">Save & Continue</button>
          </div>
          <?php echo Form::close(); ?>

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
          <?php echo Form::open(['class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'publisher-form']); ?>

          <div class="modal-body">
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="publisher_name">Publisher Name <span class="required">*</span></label>
                <?php echo Form::text('publisher_name', old('publisher_name'), ['id' => 'publisher_name', 'class'=>'form-control', 'placeholder'=>'Enter publisher name', ]); ?>

                <span class="text-danger" id="publisher-error"></span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="publisherForm_ajax_close" data-dismiss="modal">Close</button>
            <button type="button" id="publisherForm_ajax_submit" class="btn btn-primary">Save</button>
          </div>
          <?php echo Form::close(); ?>

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
          <?php echo Form::open(['class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'attribute-form']); ?>

          <div class="modal-body">
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="attribute_name">Attribute Name <span class="required">*</span></label>
                <?php echo Form::text('attribute_name', old('attribute_name'), ['id' => 'attribute_name', 'class'=>'form-control', 'placeholder'=>'Enter attribute name', ]); ?>

                <span class="text-danger" id="attribute-error"></span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="attributeForm_ajax_close" data-dismiss="modal">Close</button>
            <button type="button" id="attributeForm_ajax_submit" class="btn btn-primary">Save</button>
          </div>
          <?php echo Form::close(); ?>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <!-- Select2 -->
  <script src="<?php echo e(asset('vendors/select2/dist/js/select2.full.min.js')); ?>"></script>
  <!-- Switchery -->
  <script src="<?php echo e(asset('vendors/switchery/dist/switchery.min.js')); ?>"></script>
  <!-- iCheck -->
  <script src="<?php echo e(asset('vendors/iCheck/icheck.min.js')); ?>"></script>
  <!-- Parsley -->
  <script src="<?php echo e(asset('vendors/parsleyjs/dist/parsley.min.js')); ?>"></script>
  <!-- ckeditor -->
  <script src="<?php echo e(asset('vendors/unisharp/laravel-ckeditor/ckeditor.js')); ?>"></script>
  <script src="<?php echo e(asset('vendors/unisharp/laravel-ckeditor/adapters/jquery.js')); ?>"></script>
  <!-- jQuery Tags Input -->
  <script src="<?php echo e(asset('vendors/jquery.tagsinput/src/jquery.tagsinput.js')); ?>"></script>
  <!-- Fine Uploader jQuery JS file-->
  <script src="<?php echo e(asset('vendors/fine_upload/jquery.fine-uploader.js')); ?>"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      /**** Ckeditor ****/ 
      $('textarea').ckeditor();

      /**** Select2 Js for search with autoselect Dropdown ****/ 
      $('#category_id').select2({
        placeholder: 'Select Category',
        allowClear: true,
        closeOnSelect: false
      });

      // $('#has_size').select2({
      //   placeholder: 'Select Size',
      //   allowClear: true,
      //   closeOnSelect: false
      // });

      // $('#has_color').select2({
      //   placeholder: 'Select Color',
      //   allowClear: true,
      //   closeOnSelect: false
      // });

      // $('#has_style').select2({
      //   placeholder: 'Select Style',
      //   allowClear: true,
      //   closeOnSelect: false
      // });
      
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
      
      /*$('#author_id').select2({
        placeholder: 'Select Author',
        allowClear: true,
        closeOnSelect: false
      });*/


        /**** On change of radio button hide/show fields ****/ 
        $('input[name=product_type]').change(function(){
          if(this.value == 'book') {
            $('.product_other').fadeOut('slow');
            $('.product_book').fadeIn('slow');
            $(".product_book :input").prop("required", true);
          } else {
            $(".product_book :input").prop("required", false);
            $('.product_other').fadeIn('slow');
            $('.product_book').fadeOut('slow');
          }
        });

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
        // jQuery(document).on('click', '#add_sp_attr', function() {
        //   var sp_attr_key = $('#sp_attribute_id').find(":selected").val();
        //   var sp_attr_val = $('#sp_attribute_val').val();
          
        //   if (sp_attr_key != 0) {
        //     var sp_attr_text = $('#sp_attribute_id').find(":selected").text();
        //     $(".sp_atr").append('<tr class="mul_div">\
        //                       <td>\
        //                         <?php echo Form::hidden("sp_attr_id", '+sp_attr_key+'); ?>\
        //                         '+sp_attr_text+'\
        //                       </td>\
        //                       <td>\
        //                         '+sp_attr_val+'\
        //                       </td>\
        //                       <td>\
        //                         <button type="button" class="btn btn-danger remove_this">Delete</button>\
        //                       </td>\
        //                     </tr>');
        //   }
        //   return false;
        // });

        // jQuery(document).on('click', '#add_pr_attr', function() {
        //   var pr_attr_key = $('#pr_attribute_id').find(":selected").val();
        //   if (pr_attr_key != 0) {
        //     var pr_attr_text = $('#pr_attribute_id').find(":selected").text();
        //     $(".pr_atr").append('<tr class="mul_div">\
        //                       <td>\
        //                         <?php echo Form::hidden("pr_attr_id", '+pr_attr_key+'); ?>\
        //                         '+pr_attr_text+'\
        //                       </td>\
        //                       <td>\
        //                         <a href="<?php echo e(asset(route("product_store"))); ?>" class="btn btn-warning">Edit</a><a class="btn btn-danger remove_this">Delete</a>\
        //                       </td>\
        //                     </tr>');
        //   }
        //   return false;
        // });

        /**** On click of button remove row ****/ 
        // jQuery(document).on('click', '.remove_this', function() {
        //   jQuery(this).parents('.mul_div').remove();
        //   //cal_price();
        //   return false;
        // });

        /**** Ajax call to add new author and autoselect new created author ****/ 
        $('body').on('click', '#authorForm_ajax_submit', function(){
          var authorForm = $("#author-form");
          var formData = authorForm.serialize();

          $.ajax({
            url:"<?php echo e(route('author_ajaxstore')); ?>",
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
            url:"<?php echo e(route('publisher_ajaxstore')); ?>",
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

      /**** On reset button click clear selected values by select2 js  ****/
      $("button[type='reset']").on("click", function(event){
          $('select').val('').trigger('change');
          $('.remove_img_preview').trigger('click');
      });

    });

  </script>
  <script type="text/javascript">
    $(function() {
      var $sections = $('.form-section');
      var $form_li = $('.demo-form ul li');

      $('#product_info_tab').click(function(e) {
          var index = -1;
          setButton(index)
      });

      $('#product_categories_info_tab').click(function(e) {
          var index = 1;
          $('.demo-form').parsley().whenValidate({
              group: 'block-' + curIndex()
          }).then(function (e) {
            $("#product_categories_info_tab").prop('disabled', false);
            setButton(index);
            return true;
          },function () {
            $("#product_categories_info_tab").prop('disabled', true);
            return false;
          });
      });

      function navigateTo(index) {
          // Mark the current section with the class 'current'
          $form_li
              .removeClass('active');

          $sections
              .removeClass('active in')
              .eq(index)
              .addClass('active in');

          var active_section_id = $sections.filter('.active').attr('id');
          var active_li_id = $('#' + active_section_id + '_tab').closest('li').addClass('active');
          setButton(index);
      }

      function setButton(index) {
          // Show only the navigation buttons that make sense for the current section:
          $('.form-navigation .previous').toggle(index > 0);
          var atTheEnd = index >= $sections.length - 1;
          $('.form-navigation .next').toggle(!atTheEnd);
          $('.form-navigation [type=submit]').toggle(atTheEnd);
      }

      function curIndex() {
          // Return the current index by looking at which section has the class 'current'
          return $sections.index($sections.filter('.active'));
      }

      // Previous button is easy, just go back
      $('.form-navigation .previous').click(function() {
          navigateTo(curIndex() - 1);
      });

      // Next button goes forward if current block validates
      $('.form-navigation .next').click(function() {
          $('.demo-form').parsley().whenValidate({
              group: 'block-' + curIndex()
          }).done(function() {
              navigateTo(curIndex() + 1);
          });
      });

      // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
      $sections.each(function(index, section) {
          $(section).find(':input').attr('data-parsley-group', 'block-' + index);
      });
      navigateTo(0); // Start at the beginning
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>