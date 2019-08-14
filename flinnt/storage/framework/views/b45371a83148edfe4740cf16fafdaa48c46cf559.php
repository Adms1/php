<?php $__env->startSection('content'); ?>
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Edit Institution</h2>
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

                <?php echo Form::open(['route'=> ["institution_update", $institution->institution_id], 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'institution-form', 'enctype'=>'multipart/form-data']); ?>

                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="name">Institution Name <span class="required">*</span></label>
                        <?php echo Form::text('institution_name', $institution->institution_name, ['class'=>'form-control', 'placeholder'=>'Enter Name', 'required'=>'required']); ?>

                        <span class="text-danger"><?php echo e($errors->first('institution_name')); ?></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="contact_name">Contact Person Name <span class="required">*</span></label>
                        <?php echo Form::text('contact_name', $institution->contact_name, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter contact name', 'required'=>'required']); ?>

                        <span class="text-danger"><?php echo e($errors->first('contact_name')); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="address1">Address1 <span class="required">*</span></label>
                        <?php echo Form::text('address1', $institution->address1, ['class'=>'form-control', 'placeholder'=>'Enter Address1', 'required'=>'required']); ?>

                        <span class="text-danger"><?php echo e($errors->first('address1')); ?></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="address2">Address2 <span class="required">*</span></label>
                        <?php echo Form::text('address2', $institution->address2, ['class'=>'form-control', 'placeholder'=>'Enter Address2']); ?>

                        <span class="text-danger"><?php echo e($errors->first('address2')); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="city">City <span class="required">*</span></label>
                        <?php echo Form::text('city', $institution->city, ['class'=>'form-control', 'placeholder'=>'Enter City', 'required'=>'required']); ?>

                        <span class="text-danger"><?php echo e($errors->first('city')); ?></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <label for="state_id">State <span class="required">*</span></label>
                      <?php echo Form::select('state_id',$states, $institution->state_id, ['class'=>'form-control', 'placeholder'=>'Select State', 'id'=>'state_id', 'required'=>'required']); ?>

                      <span class="text-danger"><?php echo e($errors->first('state_id')); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="pin">Pin Code <span class="required">*</span></label>
                        <?php echo Form::text('pin', $institution->pin, ['class'=>'form-control', 'placeholder'=>'Enter Pin', 'required'=>'required']); ?>

                        <span class="text-danger"><?php echo e($errors->first('pin')); ?></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="country_id">Country <span class="required">*</span></label>
                        <?php echo Form::select('country_id',$countries, $institution->country_id, ['class'=>'form-control', 'placeholder'=>'Select Country', 'required'=>'required']); ?>

                        <span class="text-danger"><?php echo e($errors->first('country_id')); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="email">Email <span class="required">*</span></label>
                        <?php echo Form::email('email', $institution->email, ['class'=>'form-control', 'placeholder'=>'Enter Email', 'required'=>'required']); ?>

                        <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                    </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="phone">Phone Number<span class="required">*</span></label>
                        <?php echo Form::text('phone', $institution->phone, ['class'=>'form-control', 'placeholder'=>'Enter Phone', 'required'=>'required', 'data-parsley-pattern' => '^[\d\+\-\.\(\)\/\s]*$']); ?>

                        <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="institution_image">Photo <span class="required">*</span></label>
                        <?php echo Form::file('institution_image', ['id'=>'photo', 'onchange' => 'handleFileSelect()']); ?>

                        <span class="text-danger"><?php echo e($errors->first('institution_image')); ?></span>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                          <output id="result">
                            <img class="col-md-4 col-sm-4 col-xs-12" src="<?php echo e(URL::asset('/'.Config::get('settings.THUMBNAIL_INSTITUTION_IMG_PATH').$institution->institution_id.'/'.$institution->institution_image)); ?>">
                          <output/>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="status_id">Status <span class="required">*</span></label>
                        <?php echo Form::select('status_id',$status, $institution->status_id, ['class'=>'form-control', 'placeholder'=>'Select status', 'required'=>'required']); ?>

                        <span class="text-danger"><?php echo e($errors->first('status_id')); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-primary" type="button" onclick="window.location='<?php echo e(route("institution_list")); ?>'">Cancel</button>
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
    <!-- Switchery -->
    <script src="<?php echo e(asset('vendors/switchery/dist/switchery.min.js')); ?>"></script>
    <!-- Parsley -->
    <script src="<?php echo e(asset('vendors/parsleyjs/dist/parsley.min.js')); ?>"></script>

    <script type="text/javascript">
        function handleFileSelect() {
            //Check File API support
            if (window.File && window.FileList && window.FileReader) {

                var files = event.target.files; //FileList object
                var output = document.getElementById("result");
                output.innerHTML = "";
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    //Only pics
                    if (!file.type.match('image')) continue;

                    var picReader = new FileReader();
                    picReader.addEventListener("load", function (event) {
                        var picFile = event.target;
                        var div = document.createElement("div");
                        div.innerHTML = "<img class='col-md-4 col-sm-4 col-xs-12' src='" + picFile.result + "'" + "title='" + picFile.name + "'/>";
                        output.insertBefore(div, null);
                    });
                    //Read the image
                    picReader.readAsDataURL(file);
                }
            } else {
                console.log("Your browser does not support File API");
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>