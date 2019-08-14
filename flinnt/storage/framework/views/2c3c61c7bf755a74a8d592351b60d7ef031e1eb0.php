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
            <h2>Bookset list</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
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
            <!-- <div class="col-md-6 col-sm-6 col-xs-12"></div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <button class="btn btn-info float-right" onclick="window.location='<?php echo e(route("booksets")); ?>'">Create Bookset</button>
            </div> -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="no-sort width-10">Image</th>
                  <th class="width-20">Bookset Name</th>
                  <th class="width-20">Board Name</th>
                  <th class="width-10">Standard Name</th>
                  <th class="width-20">Vendor Name</th>
                  <th class="width-10">Bookset Price</th>
                  <th class="width-10">Statue</th>
                  <th class="no-sort width-10">View</th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $booksets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr class="">
                    <td><img class="width-70" src="<?php echo e(URL::asset('/'.Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH').$bookset->book_set_image_path)); ?>"></td>
                    <td><?php echo e($bookset->bookset->book_set_name); ?></td>
                    <td><?php echo e($bookset->ibsbookset->ibs->board->board_name); ?></td>
                    <td><?php echo e($bookset->ibsbookset->ibs->standard->standard_name); ?></td>
                    <td><?php echo e($bookset->vendor->vendor_name); ?></td>
                    <td><?php echo e($bookset->sale_price); ?></td>
                    <td> <?php if($bookset->is_preffered == Config::get('settings.PREFFERED_YES')): ?> <?php echo e('Preffered'); ?> <?php else: ?> <?php echo e('Not Preffered'); ?> <?php endif; ?> </td>
                    <!-- <td><?php echo e($bookset->available_sub .'/'. $bookset->total_sub); ?></td> -->
                    <td><a class="btn btn-info btn-xs booklist" bookset_id="<?php echo e($bookset->book_set_id); ?>" vendor_id="<?php echo e($bookset->vendor->vendor_id); ?>" href="#" data-toggle="modal" data-target=".view-books">View</a><a class="btn btn-warning btn-xs" href="<?php echo e(route('bookset_preffered', [$bookset->book_set_id, $bookset->vendor->vendor_id])); ?>">Preffered</a></td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- view bookset's list of books -->
  <div class="modal fade view-books" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="attribute">List of books</h4>
        </div>
        <div class="modal-body">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="no-sort">Image</th>
                <th class="width-10">Subject</th>
                <th class="width-15">Book</th>
                <th class="width-10">Vendor</th>
                <th class="width-10">Board</th>
                <th class="width-10">Standard</th>
                <th class="width-20">Publisher</th>
                <th class="width-10">Price</th>
              </tr>
            </thead>
            <tbody id="books">

            </tbody>
          </table>
          <div class="row form-group">
            <div class="col-md-10 col-sm-10 col-xs-12">
              <label class="float-right">Total</label>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 text-right">
              <span class="total"></span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="bookset_ajax_close" data-dismiss="modal">Close</button>
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
    $('.vendor-delete').on('click',function(e){
      var answer=confirm('Do you want to delete?');
      if(!answer){
        e.preventDefault();
      }
    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    /**** Ajax call to get book list of bookset ****/ 
    $('body').on('click', '.booklist', function(){
      var bookset_id = $(this).attr('bookset_id');
      var vendor_id = $(this).attr('vendor_id');
      $.ajax({
        url:"<?php echo e(route('booklist_ajaxget')); ?>",
        type:'POST',
        dataType:'json',
        data:{'bookset_id':bookset_id, 'vendor_id':vendor_id},
        success:function(data) {
          if(data.success) {
            $('#books').html('');
            var total = 0;
            var flint_charge = 0;
            var institution_id = 0;
            var bookset_price = 0;
            $.each(data.data, function(i, item) {
              var $tr = '<tr class="">\
                <td><img class="width-70" src="<?php echo e(URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH'))); ?>/'+item.book_image_path+'"></td>\
                <td>'+item.subject_name+'</td>\
                <td>'+item.book_name+'</td>\
                <td>'+item.vendor_name+'</td>\
                <td>'+item.board_name+'</td>\
                <td>'+item.standard_name+'</td>\
                <td>'+item.publisher_name+'</td>\
                <td class="text-right">'+item.sale_price+'</td>\
              </tr>';
              $('#books').append($tr);
              if (item.sale_price != 'Not Available') {
                total += +item.sale_price;
              }
              $('.total').html(total);

              if ($.isNumeric(item.flint_charge)) {
               flint_charge = item.flint_charge;
              }
              $('.flint_charge').html(flint_charge+'%');

              institution_id = item.institution_id;
              bookset_price = item.bookset_price;
            });
            $('#book_set_id').val(bookset_id);
            $('#institution_id').val(institution_id);
            $('#sale_price').val(bookset_price);
          }
        },
      });
    });

  </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>