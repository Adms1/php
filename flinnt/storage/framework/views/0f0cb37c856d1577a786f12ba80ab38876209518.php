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
                  <h2>Order List</h2>
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
                  <!-- <?php echo Form::open(['route'=>'report_order_list', 'id'=>'order-form', 'method' => 'GET']); ?>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="search"></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo Form::select('vendor_id', $vendors, $vendor_id, ['class'=>'form-control col-md-7 col-xs-12', 'id' => 'vendor_id']); ?>

                        <span class="text-danger"><?php echo e($errors->first('vendor_id')); ?></span>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-12">
                      <button class="btn btn-info" style="float: right" type="submit">Search</button>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-12">
                      <button type="button" class="btn btn-info" onclick="window.location='<?php echo e(route("report_product_export", "5")); ?>'" style="float: right">Export</button>
                    </div>
                  </div>
                  <?php echo Form::close(); ?> -->
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr class="headings">
                        <th>Sr.No</th>
                        <th>Order</th>
                        <th>User</th>
                        <?php if(!Auth::guard('institution')->check()): ?>
                        <th>Institution</th>
                        <?php endif; ?>
                        <?php if(!Auth::guard('vendor')->check()): ?>
                        <th>Vendor</th>
                        <?php endif; ?>
                        <th>Transaction</th>
                        <th>Payment Id</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Order Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($orders) && count($orders) > 0): ?>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="">
                          <td><?php echo e(++$key); ?></td>
                          <td>
                            <a target="_blank" href="<?php echo e(route('order_detail', $order->order_number)); ?>" class="tabel_link"><?php echo e($order->order_number); ?></a>
                          </td>
                          <td><?php echo e($order->useraddress->fullname); ?></td>
                          <?php if(!Auth::guard('institution')->check()): ?>
                          <td><?php echo e($order->institution->institution_name); ?></td>
                          <?php endif; ?>
                          <?php if(!Auth::guard('vendor')->check()): ?>
                          <td><?php echo e($order->orderline[0]->vendor->vendor_name); ?></td>
                          <?php endif; ?>
                          <td><?php echo e($order->transaction_id); ?></td>
                          <td><?php echo e($order->payment_id); ?></td>
                          <td class="text-right"><?php echo e($order->order_total_price); ?></td>
                          <td><?php if($order->order_status == 1): ?>
                                <?php echo e('Pending'); ?>

                              <?php elseif($order->order_status == 2): ?>
                                <?php echo e('Success'); ?>

                              <?php else: ?>
                                <?php echo e('Fail'); ?>

                              <?php endif; ?>
                          </td>
                          <td><?php echo e(date('d-m-Y g:i A', strtotime($order->order_date))); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
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