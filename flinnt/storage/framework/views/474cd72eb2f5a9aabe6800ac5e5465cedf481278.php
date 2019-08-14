<?php $__env->startSection('content'); ?>
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Product Attribute List</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
                <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">X</button> 
                        <strong><?php echo e($message); ?></strong>
                    </div>
                <?php endif; ?>
                <?php if(session('status')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>
                <br />
                <div class="col-md-6 col-sm-6 col-xs-12"></div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <button class="btn btn-info float-right" onclick="window.location='<?php echo e(route("atr_create")); ?>'">Add New Attribute</button>
                </div>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="width-50">Name</th>
                  <th class="width-30">Action</th>
                </tr>
              </thead>
              <tbody class="row_position">
                <tr>
                  <td>Color</td>
                  <td>
                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-check"></i> Edit </a>
                  </td>
                </tr>
                <tr>
                  <td>Size</td>
                  <td>
                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-check"></i> Edit </a>
                  </td>
                </tr>
                <tr>
                  <td>Style</td>
                  <td>
                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-check"></i> Edit </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>