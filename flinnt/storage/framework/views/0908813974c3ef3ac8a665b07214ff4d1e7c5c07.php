<?php $__env->startSection('css'); ?>
  <!-- Datatables -->
  <link href="<?php echo e(asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('vendors/jquery-ui/css/jquery-ui-autocomplete.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Search a product</h2>
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

                <?php if($message = Session::get('response.message')): ?>
                    <div class="alert alert-<?php echo e(session('response.status')); ?> alert-block">
                        <button type="button" class="close" data-dismiss="alert">X</button> 
                            <strong><?php echo e($message); ?></strong>
                    </div>
                <?php endif; ?>

                <?php echo Form::open(['route'=>'product_search', 'method'=>'get','class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'product-search-form']); ?>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attribute_type">Product Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo Form::text('product_name', (isset($data) && isset($data['product_name']) ? $data['product_name'] : old('product_name')), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter product name', 'id' => 'product_name', 'required'=>'required']); ?>

                        <span class="text-danger"><?php echo e($errors->first('product_name')); ?></span>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <button type="submit" class="btn btn-success submit">Search</button>
                    </div>
                  </div>
                  <?php if(isset($data) && isset($data['product_name'])): ?>
                  <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <button class="btn btn-primary" onclick="location.href='<?php echo e(route('products')); ?>'" style="float: right" type="button">Add new product</button>
                    </div>
                  </div>
                  <?php endif; ?>
                <?php echo Form::close(); ?>

              </div>
              <div class="x_content">
                <br />
                <?php if(isset($data) && isset($data['product_name'])): ?>
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap bulk_action" cellspacing="0" width="100%">
                  <thead>
                    <tr class="headings">
                      <th>Search catalogue list</th>
                    </tr>
                  </thead>
                  <tbody>
                    <div class="clearfix"></div>
                      <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($product->standard_id): ?>
                        <tr>
                          <td>
                            <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 profile_details">
                              <div class="col-sm-12">
                                <!-- <h4 class="brief"><i>Digital Strategist</i></h4> -->
                                <div class="col-md-2 col-xs-2 col-sm-12 text-center">
                                  <img style="width: 60%" src="<?php echo e(URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').$product->image)); ?>" alt="" class="">
                                </div>
                                <div class="col-md-7 col-xs-7 col-sm-12">
                                  <h2><?php echo e($product->book_name); ?></h2>
                                  <p><strong>Publisher: </strong> <?php echo e($product->publisher_name); ?> </p>
                                  <ul class="list-unstyled">
                                    <li><i class="fa fa-bookmark"></i> ISBN: <?php echo e($product->isbn); ?></li>
                                    <li><i class="fa fa-bookmark"></i> Series: <?php echo e($product->series); ?></li>
                                    <li><i class="fa fa-bookmark"></i> HS Code: <?php echo e($product->hs_code); ?></li>
                                    <li>
                                      <p class="ratings">
                                        <a>4.0</a>
                                        <a href="#"><span class="fa fa-star"></span></a>
                                        <a href="#"><span class="fa fa-star"></span></a>
                                        <a href="#"><span class="fa fa-star"></span></a>
                                        <a href="#"><span class="fa fa-star"></span></a>
                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                      </p>
                                    </li>
                                    <li><a target="_blank" href="<?php echo e(route('product_detail', [$product->institution_book_vendor_id, $product->standard_id])); ?>" class="tabel_link">See all product details</a></li>
                                  </ul>
                                </div>
                                <div class="col-md-3 col-xs-3 col-sm-12 text-center">
                                  <a href='<?php echo e(route("product_offer", "$product->book_id")); ?>' class="btn btn-warning"> Sell Yours </a>
                                </div>
                              </div>
                            </div>
                            </div>
                          </td>
                        </tr>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
                <?php endif; ?>
                <!-- <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                  <thead>
                    <tr class="headings">
                      <th>Image</th>
                      <th>Product Name</th>
                      <th>Publisher Name</th>
                      <th>ISBN</th>
                      <th>Series</th>
                      <th>HS Code</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><img style="width: 50%" src="<?php echo e(URL::asset($product->image)); ?>"></td>
                      <td><a href='<?php echo e(route("product_search", "$product->book_id")); ?>' class="tabel_link"><?php echo e($product->book_name); ?></a></td>
                      <td><?php echo e($product->publisher_name); ?></td>
                      <td><?php echo e($product->isbn); ?></td>
                      <td><?php echo e($product->series); ?></td>
                      <td><?php echo e($product->hs_code); ?></td>
                      <td>
                        <a href='<?php echo e(route("product_offer", "$product->book_id")); ?>' class="btn btn-warning btn-xs"> Sell Yours </a>
                      </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table> -->
              </div>
            </div>
          </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <!-- Datatables -->
    <script src="<?php echo e(asset('vendors/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
    <!-- Parsley -->
    <script src="<?php echo e(asset('vendors/parsleyjs/dist/parsley.min.js')); ?>"></script>
    <!-- Auto Complete with ajax -->
    <script src="<?php echo e(asset('vendors/jquery-ui/js/jquery-ui.min.js')); ?>"></script>

    <script>
      $(document).ready(function() {
        var src = "<?php echo e(route('product_searchAjax')); ?>";
        $("#product_name").autocomplete({
          source: function(request, response) {
            $.ajax({
              url: src,
              type:'GET',
              dataType: 'json',
              data: {
                product_name : request.term
              },
              success: function(data) {
                var array = $.map(data, function (item) {
                  return {
                    label: item,
                    value: item,
                    product: item
                  }
                });
                response(array)
              }
            });
          },
          minLength: 1,
          select: function( event, ui ) {
            var data = ui.item.product;
            $('#product_name').val(data);
          }
        });
      });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>