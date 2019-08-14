<?php $__env->startSection('title'); ?>
    <title><?php echo e(config('app.name', 'Flinnt')); ?></title>
<?php $__env->stopSection(); ?>

<!--===============================================================================================-->

<?php $__env->startSection('content'); ?>
    <!-- Title Page -->
    <section class="place-order">
        <div class="container width-95">
            <div class="row ">
                <div class="col-lg-12 s-text7 m-b-15 m-t-15">
                    <h4>Order List</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Content page -->
    <section class="bgwhite p-b-65 p-t-20">
        <div class="container width-95">
            <div class="row">
                <div class="col-md-2 col-lg-2 p-b-50">
                    <div class="leftbar p-r-0-sm">
                        <ul>
                            <li class="m-text14 profile-head">PROFILE
                            </li>
                            <li class="m-text14 profile-tab"><a href="<?php echo e(route('user_profile')); ?>"><i class="fa fa fa-user pd-5"></i>Profile</a>
                            </li>
                            <li class="m-text14 selected profile-tab">
                                <a href="<?php echo e(route('user_order')); ?>"><i class="fa fa fa-wpforms pd-5"></i>Order List</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-10 p-b-50">
                    <div class="row m-b-10 wrap-table-shopping-cart">
                        <div class="col-lg-12 profile-block">
                            <table>
                                <tr class="s-text15 heading">
                                    <th>No</th>
                                    <th>Order Number</th>
                                    <th>Name</th>
                                    <th>Transaction Number</th>
                                    <th>Payment Id</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Docket Number</th>
                                    <th>Track URL</th>
                                    <th>Order Date</th>
                                </tr>
                                
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="details">
                                    <td><?php echo e(++$key); ?></td>
                                    <td>
                                        <a target="_blank" href="<?php echo e(route('order_detail', $order->order_number)); ?>" class="tabel_link"><?php echo e($order->order_number); ?></a>
                                    </td>
                                    <td><?php echo e($order->useraddress->fullname); ?></td>
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
                                    <?php if($order->order_status != 2): ?>
                                    <td><a target="_blank" href="<?php echo e(route('try_again_order', $order->order_id)); ?>" class="btn btn-info btn-sm flinnt-btn"><?php echo e('Try Again'); ?></a></td>
                                    <?php else: ?>
                                    <td><?php echo e('-'); ?></td>
                                    <?php endif; ?>
                                    <?php if(!empty($order->ordercourier) && isset($order->ordercourier->docket_number) ): ?>
                                    <td><?php echo e($order->ordercourier->docket_number); ?></td>
                                    <td><a target="_blank" href="<?php echo e($order->ordercourier->courier->tracking_url); ?>" class="tabel_link"><?php echo e('Track your order'); ?></a></td>
                                    <?php else: ?> 
                                    <td><?php echo e('-'); ?></td>
                                    <td><?php echo e('-'); ?></td>
                                    <?php endif; ?> 
                                    <td width="12%"><?php echo e(date('d-m-Y', strtotime($order->order_date))); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('vendors/parsleyjs/dist/parsley.min.js')); ?>"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#institution_id').select2({
                placeholder: 'Select Institution'
            });
            $('#board_id').select2({
                placeholder: 'Select Board'
            });
            $('#standard_id').select2({
                placeholder: 'Select Standard'
            });
            $('#state_id').select2({
                placeholder: 'Select State'
            });
            $('#address_type').select2({
                placeholder: 'Select Address Type'
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>