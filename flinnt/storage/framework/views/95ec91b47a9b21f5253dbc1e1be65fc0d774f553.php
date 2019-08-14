<?php $__env->startSection('content'); ?>
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add Publisher</h2>
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

                <?php echo Form::open(['route'=>'publisher_store', 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'publisher-form']); ?>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attribute_type">Publisher Name<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo Form::text('publisher_name', old('publisher_name'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter publisher name', 'required'=>'required']); ?>

                        <span class="text-danger"><?php echo e($errors->first('publisher_name')); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo Form::textarea('description', old('description'), ['class'=>'form-control', 'placeholder'=>'Enter Description']); ?>

                      <span class="text-danger"><?php echo e($errors->first('description')); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-primary" type="button" onclick="window.location='<?php echo e(route("publisher_list")); ?>'">Cancel</button>
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <button type="submit" class="btn btn-success submit">Submit</button>
                    </div>
                  </div>
                <?php echo Form::close(); ?>

              </div>
            </div>
          </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <!-- Parsley -->
    <script src="<?php echo e(asset('vendors/parsleyjs/dist/parsley.min.js')); ?>"></script>

    <script type="text/javascript">
      /**** On reset button click clear values ****/
      $("button[type='reset']").on("click", function(event){
          $(this).closest('form').find("input").attr('value', '');
          $('#publisher-form').parsley().reset();
          $('.text-danger').hide();
      });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>