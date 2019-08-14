<?php $__env->startSection('css'); ?>
  <style type="text/css">
    .select2 {width: 100% !important}
  </style>
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
                  <h2>Shipping Order List</h2>
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
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr class="headings">
                        <th>Sr. No</th>
                        <th>Order Number</th>
                        <?php if(Auth::guard('admin')->check()): ?>
                        <th>Institution Name</th>
                        <th>Vendor Name</th>
                        <?php else: ?>
                        <th>User Name</th>
                        <th>Docket Number</th>
                        <?php endif; ?>
                        <th>Courier Service</th>
                        <th>Status</th>
                        <th>Shipped Date</th>
                        <th>Delivered Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr class="">
                        <td><?php echo e(++$key); ?></td>
                        <?php if(Auth::guard('admin')->check()): ?>
                        <td><?php echo e($order->order_number); ?></td>
                        <td><?php echo e($order->institution->institution_name); ?></td>
                        <td><?php echo e($order->orderline[0]->vendor->vendor_name); ?></td>
                        <?php else: ?>
                        <td>
                          <a href="#" data-onum="<?php echo e($order->order_number); ?>" data-oid="<?php echo e($order->order_id); ?>" class="tabel_link" data-toggle="modal" data-target=".add-courier"><?php echo e($order->order_number); ?></a>
                        </td>
                        <td><?php echo e($order->useraddress->fullname); ?></td>
                        <td><?php echo e($order->ordercourier->docket_number); ?></td>
                        <?php endif; ?>
                        <td><?php echo e((isset($order->ordercourier->courier)) ? $order->ordercourier->courier->courier_name : ""); ?></td>
                        <td><?php if(isset($order->ordercourier->status_id) && $order->ordercourier->status_id == 1): ?>
                              <?php echo e('Processed'); ?>

                            <?php elseif(isset($order->ordercourier->status_id) && $order->ordercourier->status_id == 2): ?>
                              <?php echo e('Delivered'); ?>

                            <?php else: ?>
                              <?php echo e('Pending'); ?>

                            <?php endif; ?>
                        </td>
                        <?php if(!empty($order->ordercourier->send_at)): ?> 
                        <td><?php echo e(date('d-m-Y g:i A', strtotime($order->ordercourier->send_at))); ?></td>
                        <?php else: ?>
                        <td><?php echo e('-'); ?></td>
                        <?php endif; ?>
                        <?php if(!empty($order->ordercourier->deliver_at)): ?> 
                        <td><?php echo e(date('d-m-Y g:i A', strtotime($order->ordercourier->deliver_at))); ?></td>
                        <?php else: ?>
                        <td class="text-center"><?php echo e('-'); ?></td>
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

    <!-- Add Courier modal -->
    <div class="modal fade add-courier" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="courier">Add Courier</h4>
          </div>
          <?php echo Form::open(['route'=>'courier_update', 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'courier-form', 'method'=>'post']); ?>

          <div class="modal-body">
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="order_number">Order Number</label>
                <?php echo Form::text('order_number', '', ['class'=>'form-control col-md-7 col-xs-12', 'required'=>'required', 'id'=>'order_number', 'disabled'=>'disabled']); ?>

                <?php echo Form::hidden('order_id', '', ['class'=>'form-control col-md-7 col-xs-12', 'required'=>'required', 'id'=>'order_id']); ?>

                <span class="text-danger" id="order_number-error"></span>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="courier_id">Courier<span class="required">*</span></label>
                <?php echo Form::select('courier_id', $couriers, null, ['class'=>'form-control col-md-7 col-xs-12', 'required'=>'required', 'id'=>'courier_id']); ?>

                <span class="text-danger" id="courier-error"></span>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="docket_number">Docket Number <span class="required">*</span></label>
                <?php echo Form::text('docket_number', old('docket_number'), ['id' => 'docket_number', 'class'=>'form-control', 'placeholder'=>'Enter docket number', 'required'=>'required']); ?>

                <span class="text-danger" id="docket_number-error"></span>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="status_id ">Status<span class="required">*</span></label>
                <?php echo Form::select('status_id', $status, null, ['class'=>'form-control col-md-7 col-xs-12', 'required'=>'required', 'id'=>'status_id']); ?>

                <span class="text-danger" id="status_id-error"></span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="attributeForm_ajax_close" data-dismiss="modal">Close</button>
            <button type="submit" id="courierForm_ajax_submit" class="btn btn-primary">Update</button>
          </div>
          <?php echo Form::close(); ?>

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
    /**** Select2 Js for courier with autoselect Dropdown ****/
    // $('#courier_id').select2({
    //   placeholder: 'Select Courier',
    //   allowClear: true,
    // });

    /**** Select2 Js for courier with autoselect Dropdown ****/
    $(function () {
      $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('.add-courier').on('show.bs.modal', function (event) {
        // Set black on click event
        $('#order_number').val('');
        $('#order_id').val('');
        $('#courier_id').val('');
        $('#docket_number').val('');
        $('#status_id').val('');

        var button = $(event.relatedTarget); // Button that triggered the modal
        var onum = button.data('onum'); // Extract info from data-* attributes
        var oid = button.data('oid'); // Extract info from data-* attributes
        var modal = $(this);

        // in case of we need to update shipping info get courier info by order id
        $.ajax({
          url:"<?php echo e(route('courier_ajaxget')); ?>",
          type:'POST',
          data:{
            'order_id' : oid
          },
          success:function(data) {
            if(data.error) {
              if(data.message.order_id){
                  $( '#order_number-error' ).html( data.message.order_id[0] );
              }
            }

            if(data.success) {
              // $.each($('#status_id option'),function(a,b){
              //   if($(this).val() == data.data.status_id){
              //     $(this).attr('selected',true)
              //   }
              // });

              modal.find('#courier_id').val(data.data.courier_id);
              modal.find('#docket_number').val(data.data.docket_number);
              modal.find('#status_id').val(data.data.status_id);
            }
          },
        });

        modal.find('#order_number').val(onum);
        modal.find('#order_id').val(oid);
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>