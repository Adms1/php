<?php $__env->startSection('css'); ?>
  <!-- Datatables -->
  <link href="<?php echo e(asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>" rel="stylesheet">
  <!-- Select2 -->
  <link href="<?php echo e(asset('vendors/select2/dist/css/select2.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
      <div class="">
        <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Product List</h2>
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
                  <?php if(Auth::guard('admin')->check()): ?>
                  <?php echo Form::open(['route'=>'report_product_list', 'id'=>'product-form', 'method' => 'GET']); ?>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="search"></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo Form::select('vendor_id', $vendors, $vendor_id, ['class'=>'form-control col-md-7 col-xs-12', 'id' => 'vendor_id']); ?>

                        <span class="text-danger"><?php echo e($errors->first('vendor_id')); ?></span>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-12">
                      <button class="btn btn-info float-right" type="submit">Search</button>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-12">
                      <button type="button" class="btn btn-info float-right" onclick="window.location='<?php echo e(route("report_product_export", "5")); ?>'">Export</button>
                    </div>
                  </div>
                  <?php echo Form::close(); ?>

                  <?php endif; ?>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr class="headings">
                        <th class="no-sort width-10">Image</th>
                        <th>Product Name</th>
                        <?php if(Auth::guard('admin')->check()): ?>
                        <th>Vendor</th>
                        <?php endif; ?>
                        <th>Board</th>
                        <th>Standard</th>
                        <th>Subject</th>
                        <th>Price</th>
                        <th>ISBN</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr class="">
                        <td><img class="width-70" src="<?php echo e(URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').$product->book_image_path)); ?>"></td>
                        <td><?php echo e($product->book_name); ?></td>
                        <?php if(Auth::guard('admin')->check()): ?>
                        <td><?php echo e($product->vendor_name); ?></td>
                        <?php endif; ?>
                        <td><?php echo e($product->board_name); ?></td>
                        <td><?php echo e($product->standard_name); ?></td>
                        <td><?php echo e($product->subject_name); ?></td>
                        <td><?php echo e($product->sale_price); ?></td>
                        <td><?php echo e($product->isbn); ?></td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <!-- Select2 -->
  <script src="<?php echo e(asset('vendors/select2/dist/js/select2.full.min.js')); ?>"></script>
  <!-- Datatables -->
  <script src="<?php echo e(asset('vendors/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
  <script type="text/javascript">
    $('#vendor_id').select2({
      placeholder: 'Select Vendor',
      allowClear: true,
      closeOnSelect: false
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>