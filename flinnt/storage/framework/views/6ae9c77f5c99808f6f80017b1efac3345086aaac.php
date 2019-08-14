<?php $__env->startSection('content'); ?>
      <div class="">
        <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Publisher List</h2>
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
                      <button class="btn btn-info float-right" onclick="window.location='<?php echo e(route("publishers")); ?>'">Add Publilsher</button>
                    </div>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr class="headings">
                        <th class="width-10">Serial No</th>
                        <th>Publisher name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                          $i = 1;
                      ?>
                      <?php $__currentLoopData = $publishers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $publisher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><a href='<?php echo e(route("publisher_edit", [$publisher->publisher_id])); ?>' class="tabel_link"><?php echo e($publisher->publisher_name); ?></a></td>
                        <td>
                          <a href='<?php echo e(route("publisher_destroy", [$publisher->publisher_id])); ?>' class="btn btn-danger btn-xs publisher-delete"><i class="fa fa-close"></i> Delete </a>
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
  <script type="text/javascript">
    /*** Confirmation to delete ***/
    $('.publisher-delete').on('click',function(e){
      var answer=confirm('Do you want to delete?');
      if(!answer){
        e.preventDefault();
      }
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>