<?php $__env->startSection('css'); ?>
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
                <h2>Update standards to borad</h2>
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
                <?php echo Form::open(['route'=> ["institution_boardstandard_update", $board_id, $standard_id], 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'institution-form']); ?>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="board_id">Board</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo Form::select('board_id',$board, $board_id, ['class'=>'form-control', 'id' => 'board_id',  'required'=>'required', 'disabled']); ?>

                        <span class="text-danger"><?php echo e($errors->first('board_id')); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="standard_id">Standard</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo Form::select('standard_id[]',$class, $standard_id, ['class'=>'form-control', 'id' => 'standard_id', 'required'=>'required', 'multiple', 'disabled']); ?>

                        <span class="text-danger"><?php echo e($errors->first('standard_id')); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id">Subject</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo Form::select('subject_id[]',$subject, $assign_subjects, ['class'=>'form-control', 'id' => 'subject_id', 'required'=>'required', 'multiple']); ?>

                        <span class="text-danger"><?php echo e($errors->first('subject_id')); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-primary" type="button" onclick="window.location='<?php echo e(URL::previous()); ?>'">Cancel</button>
                      <button type="submit" class="btn btn-success submit">Update</button>
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
    <!-- Select2 -->
    <script src="<?php echo e(asset('vendors/select2/dist/js/select2.full.min.js')); ?>"></script>
    <!-- Parsley -->
    <script src="<?php echo e(asset('vendors/parsleyjs/dist/parsley.min.js')); ?>"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      /**** Select2 Js for search with autoselect Dropdown ****/ 
      $('#board_id').select2({
        placeholder: 'Select Board',
        allowClear: true,
        closeOnSelect: true
      });

      $('#standard_id').select2({
        placeholder: 'Select Standard',
        allowClear: false,
        closeOnSelect: false
      });
    
      $('#subject_id').select2({
        placeholder: 'Select Subject',
        allowClear: true,
        closeOnSelect: false
      });
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>