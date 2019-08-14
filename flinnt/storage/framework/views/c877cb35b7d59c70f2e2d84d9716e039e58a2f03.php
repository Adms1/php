<?php $__env->startSection('css'); ?>
  <style type="text/css">
    .bg-orange {
      background-color: orange !important;
    }
    .bg-success {
      background-color: #5cb85c !important;
    }
    .bg-danger {
      background-color: #d9534f !important;
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="">
    <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <?php if($message = Session::get('response.message')): ?>
          <div class="alert alert-<?php echo e(session('response.status')); ?> alert-block">
              <button type="button" class="close" data-dismiss="alert">X</button> 
                  <strong><?php echo e($message); ?></strong>
          </div>
      <?php endif; ?>
    </div>
    <div class="row top_tiles">
      <?php if(Auth::guard('admin')->check()): ?>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo e(route('vendor_list')); ?>" class="btn-app">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
              <div class="count"><?php echo e($total_active_vendors.'/'.$total_vendors); ?></div>
              <h3>Vendors</h3>
              <p>Registration</p>
            </div>
        </a>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo e(route('institution_list')); ?>" class="btn-app">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-comments-o"></i></div>
              <div class="count"><?php echo e($total_active_institutions.'/'.$total_institutions); ?></div>
              <h3>Institutions</h3>
              <p>Registration</p>
            </div>
        </a>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo e(route('report_order_list')); ?>" class="btn-app">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
              <div class="count"><?php echo e($total_success_count.'/'.$total_orders); ?></div>
              <h3>Orders</h3>
              <p>Order List</p>
            </div>
        </a>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo e(route('sell_order_list')); ?>" class="btn-app">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-check-square-o"></i></div>
              <div class="count"><i class="fa fa-rupee"> <?php echo e($total_revenue['total_price']); ?></i></div>
              <h3>Money</h3>
              <p>Sell List</p>
            </div>
        </a>
      </div>
      <?php endif; ?>
      <?php if(Auth::guard('vendor')->check()): ?>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo e(route('booksetlist_forvendor')); ?>" class="btn-app">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
              <div class="count"><?php echo e($total_bookset); ?></div>
              <h3>Bookset</h3>
              <p>List of Bookset</p>
            </div>
        </a>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo e(route('report_order_list')); ?>" class="btn-app">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
              <div class="count"><?php echo e($total_success_count.'/'.$total_orders); ?></div>
              <h3>Orders</h3>
              <p>Order List</p>
            </div>
        </a>
      </div>
      <?php endif; ?>
      <?php if(Auth::guard('institution')->check()): ?>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo e(route('bookset_list')); ?>" class="btn-app">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
              <div class="count"><?php echo e($total_bookset); ?></div>
              <h3>Bookset</h3>
              <p>List of Bookset</p>
            </div>
        </a>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo e(route('report_order_list')); ?>" class="btn-app">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
              <div class="count"><?php echo e($total_success_count.'/'.$total_orders); ?></div>
              <h3>Orders</h3>
              <p>Order List</p>
            </div>
        </a>
      </div>
      <?php endif; ?>
    </div>
</div>

<?php if(Auth::guard('admin')->check()): ?>
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Transaction Summary <small>Latest 5 Orders</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="filter">
          <!-- <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
          </div> -->
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="col-md-9 col-sm-12 col-xs-12">
          <table class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
            <thead>
              <tr class="headings">
                <th>Order Number</th>
                <th>Transaction Number</th>
                <th>Order Date</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Delivery Status</th>
                <th>School Name</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $last_transections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="">
                <td>
                  <a target="_blank" href="<?php echo e(route('order_detail', $order->order_number)); ?>" class="tabel_link"><?php echo e($order->order_number); ?></a>
                </td>
                <td><?php echo e($order->transaction_id); ?></td>
                <td><?php echo e(date('d-m-Y', strtotime($order->order_date))); ?></td>
                <td><?php echo e($order->order_total_price); ?></td>
                <td><?php if($order->order_status == 1): ?>
                      <?php echo e('Pending'); ?>

                    <?php elseif($order->order_status == 2): ?>
                      <?php echo e('Success'); ?>

                    <?php else: ?>
                      <?php echo e('Fail'); ?>

                    <?php endif; ?>
                </td>
                <td><?php if(isset($order->ordercourier->status_id) && $order->ordercourier->status_id == 1): ?>
                      <?php echo e('Processed'); ?>

                    <?php elseif(isset($order->ordercourier->status_id) && $order->ordercourier->status_id == 2): ?>
                      <?php echo e('Delivered'); ?>

                    <?php else: ?>
                      <?php echo e('Pending'); ?>

                    <?php endif; ?>
                </td>
                <td><?php echo e($order->institution->institution_name); ?></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
          <?php if($total_orders > 5 ): ?>
          <div style="float: right;"><a href="<?php echo e(route('sell_order_list')); ?>">See more</a></div>
          <?php endif; ?>
          <br>
          <div class="demo-container" style="height:280px">
            <div id="chart_plot_trans" class="demo-placeholder"></div>
          </div>
          <div class="tiles">
            <div class="col-md-4 hidden-small">
              <h2 class="line_30">Payment Status</h2>
              <table class="countries_list">
                <tbody>
                  <?php $__currentLoopData = $payment_status_count; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($status['order_status'] == 1): ?>
                      <tr>
                        <td>Total Pending Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-orange"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>
                    
                    <?php if($status['order_status'] == 2): ?>
                      <tr>
                        <td>Total Success Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-green"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>

                    <?php if($status['order_status'] == 3): ?>
                      <tr>
                        <td>Total Fail Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-red"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-4 hidden-small">
              <h2 class="line_30">Delivery Status</h2>
              <table class="countries_list">
                <tbody>
                  <?php $__currentLoopData = $delivery_status_count; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($status['status_id'] == 0): ?>
                      <tr>
                        <td>Total Pending Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-info"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>

                    <?php if($status['status_id'] == 1): ?>
                      <tr>
                        <td>Total Processed Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-orange"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>

                    <?php if($status['status_id'] == 2): ?>
                      <tr>
                        <td>Total Delivered Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-success"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-4 hidden-small">
              <h2 class="line_30">Total Revenue</h2>
              <table class="countries_list">
                <tbody>
                  <tr>
                    <td><h2><i class="fa fa-rupee"> <?php echo e($total_revenue['total_price']); ?></i></h2></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-12 col-xs-12">
          <div>
            <div class="x_title">
              <h2>Top Vendors</h2>
              <div class="clearfix"></div>
            </div>
            <ul class="list-unstyled top_profiles scroll-view">
              <?php $__currentLoopData = $top_vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="media event">
                <a class="pull-left border-aero profile_thumb">
                  <i class="fa fa-user aero"></i>
                </a>
                <div class="media-body">
                  <span class="title">Mr. <?php echo e($vendor['vendor_name']); ?></span>
                  <p><strong><i class="fa fa-rupee"> <?php echo e($vendor['total_price']); ?></i> </strong></p>
                  <p> <small><?php echo e($vendor['total_order']); ?> Total Sales</small>
                  </p>
                </div>
              </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if(Auth::guard('vendor')->check()): ?>
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Transaction Summary <small>Latest 5 Orders</small></h2>
        <div class="filter">
          <!-- <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
          </div> -->
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <div class="col-md-9 col-sm-12 col-xs-12">
          <table class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
            <thead>
              <tr class="headings">
                <th>Order Number</th>
                <th>Transaction Number</th>
                <th>Order Date</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Delivery Status</th>
                <th>School Name</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $last_transections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="">
                <td>
                  <a target="_blank" href="<?php echo e(route('order_detail', $order->order->order_number)); ?>" class=" tabel_link"><?php echo e($order->order->order_number); ?></a>
                </td>
                <td><?php echo e($order->order->transaction_id); ?></td>
                <td><?php echo e(date('d-m-Y', strtotime($order->order->order_date))); ?></td>
                <td><?php echo e($order->order_total_price); ?></td>
                <td><?php if($order->order->order_status == 1): ?>
                      <?php echo e('Pending'); ?>

                    <?php elseif($order->order->order_status == 2): ?>
                      <?php echo e('Success'); ?>

                    <?php else: ?>
                      <?php echo e('Fail'); ?>

                    <?php endif; ?>
                </td>
                <td><?php if(isset($order->order->ordercourier->status_id) && $order->order->ordercourier->status_id == 1): ?>
                      <?php echo e('Processed'); ?>

                    <?php elseif(isset($order->order->ordercourier->status_id) && $order->order->status_id == 2): ?>
                      <?php echo e('Delivered'); ?>

                    <?php else: ?>
                      <?php echo e('Pending'); ?>

                    <?php endif; ?>
                </td>
                <td><?php echo e($order->order->institution->institution_name); ?></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
          <div class="tiles">
            <div class="col-md-4 hidden-small">
              <h2 class="line_30">Payment Status</h2>
              <table class="countries_list">
                <tbody>
                  <?php $__currentLoopData = $payment_status_count; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($status['order_status'] == 1): ?>
                      <tr>
                        <td>Total Pending Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-orange"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>
                    
                    <?php if($status['order_status'] == 2): ?>
                      <tr>
                        <td>Total Success Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-green"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>

                    <?php if($status['order_status'] == 3): ?>
                      <tr>
                        <td>Total Fail Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-red"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-4 hidden-small">
              <h2 class="line_30">Delivery Status</h2>
              <table class="countries_list">
                <tbody>
                  <?php $__currentLoopData = $delivery_status_count; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($status['status_id'] == 0): ?>
                      <tr>
                        <td>Total Pending Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-info"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>
                    
                    <?php if($status['status_id'] == 1): ?>
                      <tr>
                        <td>Total Processed Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-orange"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>

                    <?php if($status['status_id'] == 2): ?>
                      <tr>
                        <td>Total Delivered Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-success"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-4 hidden-small">
              <h2 class="line_30">Total Revenue</h2>
              <table class="countries_list">
                <tbody>
                  <tr>
                    <td><h2><i class="fa fa-rupee"> <?php echo e($total_revenue['total_price']); ?></i></h2></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-12 col-xs-12">
          <div>
            <div class="x_title">
              <h2>Top Institutions</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <ul class="list-unstyled top_profiles scroll-view">
              <?php $__currentLoopData = $top_institutions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="media event">
                <a class="pull-left border-aero profile_thumb">
                  <i class="fa fa-user aero"></i>
                </a>
                <div class="media-body">
                  <span class="title"><?php echo e($institution['institution_name']); ?></span>
                  <p><strong><i class="fa fa-rupee"> <?php echo e($institution['total_price']); ?></i> </strong></p>
                  <p> <small><?php echo e($institution['total_order']); ?> Total Sales</small>
                  </p>
                </div>
              </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<?php endif; ?>


<?php if(Auth::guard('institution')->check()): ?>
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Transaction Summary <small>Latest 5 Orders</small></h2>
        <div class="filter">
          <!-- <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
          </div> -->
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <div class="col-md-9 col-sm-12 col-xs-12">
          <table class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
            <thead>
              <tr class="headings">
                <th>Order Number</th>
                <th>Transaction Number</th>
                <th>Order Date</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Delivery Status</th>
                <th>Vendor Name</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $last_transections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="">
                <td>
                  <a target="_blank" href="<?php echo e(route('order_detail', $order->order->order_number)); ?>" class="tabel_link"><?php echo e($order->order->order_number); ?></a>
                </td>
                <td><?php echo e($order->order->transaction_id); ?></td>
                <td><?php echo e(date('d-m-Y', strtotime($order->order->order_date))); ?></td>
                <td><?php echo e($order->order_total_price); ?></td>
                <td><?php if($order->order->order_status == 1): ?>
                      <?php echo e('Pending'); ?>

                    <?php elseif($order->order->order_status == 2): ?>
                      <?php echo e('Success'); ?>

                    <?php else: ?>
                      <?php echo e('Fail'); ?>

                    <?php endif; ?>
                </td>
                <td><?php if((isset($order->order->ordercourier->status_id)) && $order->order->ordercourier->status_id == 1): ?>
                      <?php echo e('Processed'); ?>

                    <?php elseif((isset($order->order->ordercourier->status_id)) && $order->order->ordercourier->status_id == 2): ?>
                      <?php echo e('Delivered'); ?>

                    <?php else: ?>
                      <?php echo e('Pending'); ?>

                    <?php endif; ?>
                </td>
                <td><?php echo e($order->vendor->vendor_name); ?></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
          <div class="tiles">
            <div class="col-md-4 hidden-small">
              <h2 class="line_30">Payment Status</h2>
              <table class="countries_list">
                <tbody>
                  <?php $__currentLoopData = $payment_status_count; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($status['order_status'] == 1): ?>
                      <tr>
                        <td>Total Pending Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-orange"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>
                    
                    <?php if($status['order_status'] == 2): ?>
                      <tr>
                        <td>Total Success Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-green"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>

                    <?php if($status['order_status'] == 3): ?>
                      <tr>
                        <td>Total Fail Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-red"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-4 hidden-small">
              <h2 class="line_30">Delivery Status</h2>
              <table class="countries_list">
                <tbody>
                  <?php $__currentLoopData = $delivery_status_count; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($status['status_id'] == 0): ?>
                      <tr>
                        <td>Total Pending Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-info"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>

                    <?php if($status['status_id'] == 1): ?>
                      <tr>
                        <td>Total Processed Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-orange"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>

                    <?php if($status['status_id'] == 2): ?>
                      <tr>
                        <td>Total Delivered Orders</td>
                        <td class="fs15 fw700 text-right"><span class="badge bg-success"><?php echo e($status['status_count']); ?></span></td>
                      </tr>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-4 hidden-small">
              <h2 class="line_30">Total Revenue</h2>
              <table class="countries_list">
                <tbody>
                  <tr>
                    <td><h2><i class="fa fa-rupee"> <?php echo e($total_revenue['total_price']); ?></i></h2></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-12 col-xs-12">
          <div>
            <div class="x_title">
              <h2>Top Vendors</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <ul class="list-unstyled top_profiles scroll-view">
              <?php $__currentLoopData = $top_vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="media event">
                <a class="pull-left border-aero profile_thumb">
                  <i class="fa fa-user aero"></i>
                </a>
                <div class="media-body">
                  <span class="title">Mr. <?php echo e($vendor['vendor_name']); ?></span>
                  <p><strong><i class="fa fa-rupee"> <?php echo e($vendor['total_price']); ?></i> </strong></p>
                  <p> <small><?php echo e($vendor['total_order']); ?> Total Sales</small>
                  </p>
                </div>
              </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<!-- <div class="row">
  <div class="col-md-4">
    <div class="x_panel">
      <div class="x_title">
        <h2>Top Profiles <small>Sessions</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <article class="media event">
          <a class="pull-left date">
            <p class="month">April</p>
            <p class="day">23</p>
          </a>
          <div class="media-body">
            <a class="title" href="#">Item One Title</a>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </article>
        <article class="media event">
          <a class="pull-left date">
            <p class="month">April</p>
            <p class="day">23</p>
          </a>
          <div class="media-body">
            <a class="title" href="#">Item Two Title</a>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </article>
        <article class="media event">
          <a class="pull-left date">
            <p class="month">April</p>
            <p class="day">23</p>
          </a>
          <div class="media-body">
            <a class="title" href="#">Item Two Title</a>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </article>
        <article class="media event">
          <a class="pull-left date">
            <p class="month">April</p>
            <p class="day">23</p>
          </a>
          <div class="media-body">
            <a class="title" href="#">Item Two Title</a>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </article>
        <article class="media event">
          <a class="pull-left date">
            <p class="month">April</p>
            <p class="day">23</p>
          </a>
          <div class="media-body">
            <a class="title" href="#">Item Three Title</a>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </article>
      </div>
    </div>
  </div>
</div> -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- Highcharts JS -->
    <script src="../vendors/highcharts/code/highcharts.js"></script>
    <script type="text/javascript">
      $.ajax({
        url:"<?php echo e(route('transaction_ajaxget')); ?>",
        type:'GET',
        success:function(data) {
          if(data.success) {
            var chart_date = [];
            var chart_total = [];
            var date = data.data.date;
            var total = data.data.total;
            
            $.each(date , function(index, val) { 
              chart_date.push(parseInt(val));
            });

            $.each(total , function(index, val) { 
              chart_total.push(parseInt(val));
            });

            $('#chart_plot_trans').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Date wise total sales'
                },
                xAxis: {
                    categories: date
                },
                yAxis: {
                    title: {
                        text: 'Total Sale'
                    }
                },
                legend: {
                    enabled: true
                },
                credits:{
                  enabled:false,
                },
                tooltip: {
                    pointFormat: 'Total sale: Rs <b>{point.y:.1f}</b>'
                },
                series: [{
                    name: 'Sale',
                    data: chart_total
                }]
            });

          }
        },
      });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>