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
                    <h2>Select Vendor List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </li>
                        <li>
                            <a class="close-link">
                                <i class="fa fa-close"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php if($message = Session::get('response.message')): ?>
                    <div class="alert alert-<?php echo e(session('response.status')); ?> alert-block">
                        <button type="button" class="close" data-dismiss="alert">X</button>
                        <strong><?php echo e($message); ?></strong>
                    </div>
                    <?php endif; ?>
                    <br />
                    <?php echo Form::open(['route'=>'select_vendor_list', 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'select-vendor-form']); ?>

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="no-sort width-5">Select</th>
                                <th class="width-20">Vendor name</th>
                                <th class="width-20">Email</th>
                                <th class="width-10">Phone Number</th>
                                <th class="width-10">City</th>
                                <th class="width-10">State</th>
                                <th>GST Number</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="vendor_ids[]" value="<?php echo e($vendor->vendor_id); ?>" <?php echo e(in_array($vendor->vendor_id, $selected_vendors) ? "checked" : ""); ?> id="check-all" class="flat">
                                </td>
                                <td>
                                    <a href='<?php echo e(route("vendor_view", $vendor->vendor_id)); ?>' class="tabel_link"><?php echo e($vendor->vendor_name); ?></a>
                                </td>
                                <td><?php echo e($vendor->email); ?></td>
                                <td><?php echo e($vendor->vendor_phone); ?></td>
                                <td><?php echo e($vendor->vendor_city); ?></td>
                                <td><?php echo e($vendor->state->name); ?></td>
                                <td><?php echo e($vendor->vendor_gst_number); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <button class="btn btn-info" type="submit" >Submit</button>
                    </div>
                    <?php echo Form::close(); ?>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>