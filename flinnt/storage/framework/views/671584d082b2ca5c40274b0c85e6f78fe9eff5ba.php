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
                  <h2>List of boards and related standards</h2>
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
                      <button class="btn btn-info float-right" onclick="window.location='<?php echo e(route("institution_board_standard")); ?>'">Assign Board Standard</button>
                    </div>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="width-10">Serial No</th>
                        <th class="width-20">Board name</th>
                        <th class="width-20">Standard Name</th>
                        <th class="width-50">Subject Name</th>
                        <th class="no-sort">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                          $i = 1;
                      ?>
                      <?php $__currentLoopData = $assign_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $institution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($institution->board->board_name); ?></td>
                        <td><a href='<?php echo e(route("institution_boardstandard_edit", [$institution->board_id, $institution->standard_id])); ?>' class="tabel_link"><?php echo e($institution->standard->standard_name); ?></a></td>
                        <td><?php echo e($institution->subject_name); ?></td>
                        <td>
                          <?php if($institution->is_active == 1): ?> 
                            <a href='<?php echo e(route("institution_boardstandard_changestatus", [$institution->institution_board_standard_id, 0])); ?>' class="btn btn-warning btn-xs"><i class="fa fa-close"></i> Inactive </a></td>
                          <?php else: ?> 
                            <a href='<?php echo e(route("institution_boardstandard_changestatus", [$institution->institution_board_standard_id, 1])); ?>' class="btn btn-success btn-xs"><i class="fa fa-check"></i> Active </a></td>
                          <?php endif; ?>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>