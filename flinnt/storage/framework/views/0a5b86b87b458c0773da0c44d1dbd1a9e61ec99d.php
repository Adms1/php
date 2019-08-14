<?php $__env->startSection('css'); ?>
  <!-- Datatables -->
  <link href="<?php echo e(asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>" rel="stylesheet">
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
                  <?php if($message = Session::get('response.message')): ?>
                    <div class="alert alert-<?php echo e(session('response.status')); ?> alert-block">
                      <button type="button" class="close" data-dismiss="alert">X</button> 
                      <strong><?php echo e($message); ?></strong>
                    </div>
                  <?php endif; ?>
                  
                  <?php if(Auth::guard('vendor')->check()): ?>
                  <div class="col-md-6 col-sm-6 col-xs-12"></div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <button class="btn btn-info float-right" onclick="window.location='<?php echo e(route("products")); ?>'">Add Product</button>
                  </div>
                  <?php endif; ?>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr class="headings">
                        <th class="no-sort width-10">Image</th>
                        <th>Product Name</th>
                        <th>Publisher Name</th>
                        <th>ISBN</th>
                        <th>Series</th>
                        <th>HS Code</th>
                        <?php if(Auth::guard('vendor')->check()): ?>
                        <th class="no-sort">Action</th>
                        <?php endif; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr class="">
                        <td><img class="width-70" src="<?php echo e(URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').$product->image)); ?>"></td>
                        <td>
                          <?php if(Auth::guard("vendor")->check()): ?>
                          <a href='<?php echo e(route("product_edit", "$product->book_id")); ?>' class="tabel_link"><?php echo e($product->book->book_name); ?></a>
                          <?php else: ?>
                          <a target="_blank" href='<?php echo e(route("product_view", "$product->book_vendor_id")); ?>' class="tabel_link"><?php echo e($product->book->book_name); ?></a>
                          <?php endif; ?>
                        </td>
                        <td><?php echo e($product->book->publisher->publisher_name); ?></td>
                        <td><?php echo e($product->book->isbn); ?></td>
                        <td><?php echo e($product->book->series); ?></td>
                        <td><?php echo e($product->book->hs_code); ?></td>
                        <?php if(Auth::guard('vendor')->check()): ?>
                        <td>
                          <a href='<?php echo e(route("product_destroy", "$product->book_id")); ?>' class="btn btn-danger btn-xs product-delete"><i class="fa fa-trash"></i> Delete </a>
                        </td>
                        <?php endif; ?>
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
  <!-- Datatables -->
  <script src="<?php echo e(asset('vendors/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
  <script type="text/javascript">
    /*** Confirmation to delete ***/
    $('.product-delete').on('click',function(e){
      var answer=confirm('Do you want to delete?');
      if(!answer){
        e.preventDefault();
      }
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>