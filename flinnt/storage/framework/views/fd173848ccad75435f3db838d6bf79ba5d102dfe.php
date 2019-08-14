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
                  <h2>Institution List</h2>
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
                    <div class="col-md-6 col-sm-6 col-xs-12"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-info float-right" onclick="window.location='<?php echo e(route("institutions")); ?>'">Add Institution</button>
                    </div>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="width-10">Serial No</th>
                        <th class="width-20">Institution name</th>
                        <th class="width-20">Contact Name</th>
                        <th class="width-10">Phone Number</th>
                        <th class="width-10">City</th>
                        <th class="width-10">State</th>
                        <th class="width-10">Status</th>
                        <th class="no-sort">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                          $i = 1;
                      ?>
                      <?php $__currentLoopData = $institutions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $institution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><a href='<?php echo e(route("institution_edit", [$institution->institution_id])); ?>' class="tabel_link"><?php echo e($institution->institution_name); ?></a></td>
                        <td><?php echo e($institution->contact_name); ?></td>
                        <td><?php echo e($institution->phone); ?></td>
                        <td><?php echo e($institution->city); ?></td>
                        <td><?php echo e($institution->state->name); ?></td>
                        <td><?php echo e($institution->status->status_name); ?></td>
                        <td>
                          <a href='<?php echo e(route("institution_destroy", [$institution->institution_id])); ?>' class="btn btn-danger btn-xs institution-delete"><i class="fa fa-close"></i> Delete </a>
                        </td>
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
    $('.institution-delete').on('click',function(e){
      var answer=confirm('Do you want to delete?');
      if(!answer){
        e.preventDefault();
      }
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>