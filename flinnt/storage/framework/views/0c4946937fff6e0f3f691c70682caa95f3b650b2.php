<?php $__env->startSection('css'); ?>
    <!-- Switchery -->
    <link href="<?php echo e(asset('vendors/switchery/dist/switchery.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>View Vendor</h2>
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
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="name">Vendor Name</label>
                        <?php echo Form::text('vendor_name', $vendor->vendor_name, ['class'=>'form-control', 'disabled']); ?>

                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="vendor_gst_number">GST Number</label>
                        <?php echo Form::text('vendor_gst_number', $vendor->vendor_gst_number, ['class'=>'form-control col-md-7 col-xs-12', 'disabled']); ?>

                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="vendor_address">Address1</label>
                        <?php echo Form::text('vendor_address1', $vendor->vendor_address1, ['class'=>'form-control', 'disabled']); ?>

                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="vendor_address">Address2</label>
                        <?php echo Form::text('vendor_address2', $vendor->vendor_address2, ['class'=>'form-control', 'disabled']); ?>

                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="vendor_city">City</label>
                        <?php echo Form::text('vendor_city', $vendor->vendor_city, ['class'=>'form-control', 'disabled']); ?>

                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <label for="vendor_state_id">State</label>
                      <?php echo Form::text('vendor_state_id', $vendor->state->state_name, ['class'=>'form-control', 'id'=>'vendor_state_id', 'disabled']); ?>

                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="vendor_pin">Pin Code</label>
                        <?php echo Form::text('vendor_pin', $vendor->vendor_pin, ['class'=>'form-control', 'disabled']); ?>

                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="vendor_country_id">Country</label>
                        <?php echo Form::text('vendor_country_id', $vendor->country->name, ['class'=>'form-control', 'disabled']); ?>

                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="email">Email</label>
                        <?php echo Form::text('email', $vendor->email, ['class'=>'form-control', 'disabled']); ?>

                    </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="vendor_phone">Phone Number</label>
                        <?php echo Form::text('vendor_phone', $vendor->vendor_phone, ['class'=>'form-control', 'disabled']); ?>

                      </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12" style="float: none;">
                        <label for="vendor_status_id">Vendor Status</label>
                        <?php echo Form::text('vendor_status_id', $vendor->status->status_name, ['class'=>'form-control', 'disabled']); ?>

                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-primary" type="button" onclick="window.location='<?php echo e(URL::previous()); ?>'">Back</button>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- Switchery -->
    <script src="<?php echo e(asset('vendors/switchery/dist/switchery.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>