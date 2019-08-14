<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo e(asset('vendors/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo e(asset('vendors/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo e(asset('vendors/nprogress/nprogress.css')); ?>" rel="stylesheet">
    <!-- Animate.css -->
    <!-- <link href="<?php echo e(asset('vendors/animate.css/animate.min.css')); ?>" rel="stylesheet"> -->
    <!-- iCheck -->
    <!-- <link href="<?php echo e(asset('vendors/iCheck/skins/flat/green.css')); ?>" rel="stylesheet"> -->
    <!-- bootstrap-wysiwyg -->
    <!-- <link href="<?php echo e(asset('vendors/google-code-prettify/bin/prettify.min.css')); ?>" rel="stylesheet"> -->
    <!-- Select2 -->
    <!-- <link href="<?php echo e(asset('vendors/select2/dist/css/select2.min.css')); ?>" rel="stylesheet"> -->
    <!-- Switchery -->
    <!-- <link href="<?php echo e(asset('vendors/switchery/dist/switchery.min.css')); ?>" rel="stylesheet"> -->
    <!-- starrr -->
    <!-- <link href="<?php echo e(asset('vendors/starrr/dist/starrr.css')); ?>" rel="stylesheet"> -->
    <!-- bootstrap-progressbar -->
    <!-- <link href="<?php echo e(asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')); ?>" rel="stylesheet"> -->
    <!-- JQVMap -->
    <!-- <link href="<?php echo e(asset('vendors/jqvmap/dist/jqvmap.min.css')); ?>" rel="stylesheet"/> -->
    <!-- bootstrap-daterangepicker -->
    <!-- <link href="<?php echo e(asset('vendors/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet"> -->
    <!-- Datatables -->
    <!-- <link href="<?php echo e(asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>" rel="stylesheet"> -->
    <!-- Fine Uploader Gallery CSS file-->
    <!-- <link href="<?php echo e(asset('vendors/fine_upload/fine-uploader-gallery.min.css')); ?>" rel="stylesheet"> -->
    <!-- <script type="text/template" id="qq-template" src="<?php echo e(asset('vendors/fine_upload/templates/gallery.html')); ?>"></script> -->
    <!-- Fine Uploader Gallery template -->
    <?php echo $__env->yieldContent('css'); ?>
<!--     <script type="text/template" id="qq-template">

        <div class="qq-uploader-selector qq-uploader qq-gallery" qq-drop-area-text="Drop files here">
        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
        </div>
        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
            <span class="qq-upload-drop-area-text-selector"></span>
        </div>
        <div class="qq-upload-button-selector qq-upload-button">
            <div>Upload a file</div>
        </div>
        <span class="qq-drop-processing-selector qq-drop-processing">
            <span>Processing dropped files...</span>
            <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
        </span>
        <ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite" aria-relevant="additions removals">
            <li>
                <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                <div class="qq-progress-bar-container-selector qq-progress-bar-container">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                </div>
                <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                <div class="qq-thumbnail-wrapper">
                    <img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>
                </div>
                <button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>
                <button type="button" class="qq-upload-retry-selector qq-upload-retry">
                    <span class="qq-btn qq-retry-icon" aria-label="Retry"></span>
                    Retry
                </button>

                <div class="qq-file-info">
                    <div class="qq-file-name">
                        <span class="qq-upload-file-selector qq-upload-file"></span>
                        <span class="qq-edit-filename-icon-selector qq-btn qq-edit-filename-icon" aria-label="Edit filename"></span>
                    </div>
                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">
                        <span class="qq-btn qq-delete-icon" aria-label="Delete"></span>
                    </button>
                    <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">
                        <span class="qq-btn qq-pause-icon" aria-label="Pause"></span>
                    </button>
                    <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">
                        <span class="qq-btn qq-continue-icon" aria-label="Continue"></span>
                    </button>
                </div>
            </li>
        </ul>

        <dialog class="qq-alert-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Close</button>
            </div>
        </dialog>

        <dialog class="qq-confirm-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">No</button>
                <button type="button" class="qq-ok-button-selector">Yes</button>
            </div>
        </dialog>

        <dialog class="qq-prompt-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <input type="text">
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Cancel</button>
                <button type="button" class="qq-ok-button-selector">Ok</button>
            </div>
        </dialog>
    </div>
    </script> -->
    <!-- Custom Theme Style -->
    <link href="<?php echo e(asset('build/css/custom.min.css')); ?>" rel="stylesheet">
    <!-- Custom flinnt Style -->
    <link href="<?php echo e(asset('build/css/flinnt.css')); ?>" rel="stylesheet">


</head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title">
              <a href="<?php echo e(route('home')); ?>" class="site_title"><i class="fa fa-paw"></i> <span><?php echo e(config('app.name', 'Laravel')); ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo e(asset('images/img.jpg')); ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <?php if(Auth::guard('admin')->check()): ?>
                <h2><?php echo e(Auth::guard('admin')->user()->admin_name); ?></h2>
                <?php endif; ?>
                <?php if(Auth::guard('vendor')->check()): ?>
                <h2><?php echo e(Auth::guard('vendor')->user()->vendor_name); ?></h2>
                <?php endif; ?>
                <?php if(Auth::guard('institution')->check()): ?>
                <h2><?php echo e(Auth::guard('institution')->user()->institution_name); ?></h2>
                <?php endif; ?>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Dashboard <span class="fa fa-chevron"></span></a>
                  </li>
                  <?php if(Auth::guard('admin')->check()): ?>
                  <li><a><i class="fa fa-edit"></i> Categories <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('category_list')); ?>">Manage Category</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Vendors <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('vendor_list')); ?>">Manage Vendor</a></li>
                      <li><a href="<?php echo e(route('sell_order_list')); ?>">Sell Order List</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Institutions <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('institution_list')); ?>">Manage Institution</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Products <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('product_list')); ?>">Manage Product</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Reports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('report_product_list')); ?>">Product List</a></li>
                      <li><a href="<?php echo e(route('report_order_list')); ?>">Order List</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Shipment Info <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('success_order_list')); ?>">Shipping Order List</a></li>
                    </ul>
                  </li>
                  <?php endif; ?>
                  <?php if(Auth::guard('institution')->check()): ?>
                  <li><a><i class="fa fa-edit"></i>Vendors <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('approve_vendor_list')); ?>">Select Vendors</a></li>
                    </ul>
                  </li>
                  <li><a href="<?php echo e(route('product_list')); ?>"><i class="fa fa-edit"></i>Product List</a></li>
                  <li><a href="<?php echo e(route('institution_boardstandard_list')); ?>"><i class="fa fa-edit"></i>Assign Board/Standard List</a></li>
                  <!-- <li><a><i class="fa fa-edit"></i>Vendors <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('institution_boardstandard_list')); ?>">Assign Board/Standard List</a></li>
                    </ul>
                  </li> -->
                  <li><a><i class="fa fa-edit"></i>Booksets <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('bookset_list')); ?>">Manage Bookset</a></li></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Reports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('report_order_list')); ?>">Order List</a></li>
                    </ul>
                  </li>
                  <?php endif; ?>
                  <?php if(Auth::guard('vendor')->check()): ?>
                  <li><a><i class="fa fa-edit"></i> Products <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('product_list')); ?>">Manage Product</a></li>
                      <li><a href="<?php echo e(route('product_search')); ?>">Search Product</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Bookset <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('booksetlist_forvendor')); ?>">Manage Bookset</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Reports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('report_product_list')); ?>">Product List</a></li>
                      <li><a href="<?php echo e(route('report_order_list')); ?>">Order List</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Shipment Info <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('success_order_list')); ?>">Shipping Order List</a></li>
                    </ul>
                  </li>
                  <?php endif; ?>
                </ul>
                <?php if(Auth::guard('admin')->check() || Auth::guard('vendor')->check()): ?>
                <h3>Setup</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-edit"></i> Attributes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('attribute_list')); ?>">Product Attributes</a></li>
                      <li><a href="<?php echo e(route('atr_create_list')); ?>">Price Specification</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Authors <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('author_list')); ?>">Manage Author</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Publishers <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('publisher_list')); ?>">Manage Publisher</a></li>
                    </ul>
                  </li>
                  <?php if(Auth::guard('admin')->check()): ?>
                  <li><a><i class="fa fa-edit"></i> Subjects <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('subject_list')); ?>">Manage Subject</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Boards <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('board_list')); ?>">Manage Board</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Standards <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('standard_list')); ?>">Manage Standard</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Languages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(route('language_list')); ?>">Manage Language</a></li>
                    </ul>
                  </li>
                  <?php endif; ?>
                </ul>
                <?php endif; ?>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo e(asset('images/img.jpg')); ?>" alt="">
                    <?php if(Auth::guard('admin')->check()): ?>
                    <?php echo e(Auth::guard('admin')->user()->admin_name); ?>

                    <?php endif; ?>
                    <?php if(Auth::guard('vendor')->check()): ?>
                    <?php echo e(Auth::guard('vendor')->user()->vendor_name); ?>

                    <?php endif; ?>
                    <?php if(Auth::guard('institution')->check()): ?>
                    <?php echo e(Auth::guard('institution')->user()->institution_name); ?>

                    <?php endif; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <?php if(!Auth::guard('admin')->check()): ?>
                      <li>
                        <a href="<?php echo e(route('profile')); ?>" onclick="event.preventDefault(); document.getElementById('profile-form').submit();" >Profile</a>
                        <form id="profile-form" action="<?php echo e(route('profile')); ?>" method="GET" class="display-none">
                            <?php echo csrf_field(); ?>
                        </form>
                      </li>
                    <?php endif; ?>
                    <li>
                        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" ><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="GET" class="display-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <!-- <div class="pull-right">
            Admin Template by <a href="#">ADMS</a>
          </div> -->
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo e(asset('vendors/jquery/dist/jquery.min.js')); ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo e(asset('vendors/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo e(asset('vendors/fastclick/lib/fastclick.js')); ?>"></script>
    <!-- NProgress -->
    <script src="<?php echo e(asset('vendors/nprogress/nprogress.js')); ?>"></script>
    <!-- bootstrap-wysiwyg -->
    <!-- <script src="<?php echo e(asset('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/jquery.hotkeys/jquery.hotkeys.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/google-code-prettify/src/prettify.js')); ?>"></script> -->
    <!-- Chart.js -->
    <!-- <script src="<?php echo e(asset('vendors/Chart.js/dist/Chart.min.js')); ?>"></script> -->
    <!-- gauge.js -->
    <!-- <script src="<?php echo e(asset('vendors/gauge.js/dist/gauge.min.js')); ?>"></script> -->
    <!-- bootstrap-progressbar -->
    <!-- <script src="<?php echo e(asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')); ?>"></script> -->
    <!-- iCheck -->
    <!-- <script src="<?php echo e(asset('vendors/iCheck/icheck.min.js')); ?>"></script> -->
    <!-- Skycons -->
    <!-- <script src="<?php echo e(asset('vendors/skycons/skycons.js')); ?>"></script> -->
    <!-- Flot -->
    <!-- <script src="<?php echo e(asset('vendors/Flot/jquery.flot.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/Flot/jquery.flot.pie.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/Flot/jquery.flot.time.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/Flot/jquery.flot.stack.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/Flot/jquery.flot.resize.js')); ?>"></script> -->
    <!-- Flot plugins -->
    <!-- <script src="<?php echo e(asset('vendors/flot.orderbars/js/jquery.flot.orderBars.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/flot-spline/js/jquery.flot.spline.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/flot.curvedlines/curvedLines.js')); ?>"></script> -->
    <!-- DateJS -->
    <!-- <script src="<?php echo e(asset('vendors/DateJS/build/date.js')); ?>"></script> -->
    <!-- JQVMap -->
    <!-- <script src="<?php echo e(asset('vendors/jqvmap/dist/jquery.vmap.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')); ?>"></script> -->
    <!-- bootstrap-daterangepicker -->
    <!-- <script src="<?php echo e(asset('vendors/moment/min/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script> -->
    <!-- jQuery Tags Input -->
    <!-- <script src="<?php echo e(asset('vendors/jquery.tagsinput/src/jquery.tagsinput.js')); ?>"></script> -->
    <!-- Switchery -->
    <!-- <script src="<?php echo e(asset('vendors/switchery/dist/switchery.min.js')); ?>"></script> -->
    <!-- Select2 -->
    <!-- <script src="<?php echo e(asset('vendors/select2/dist/js/select2.full.min.js')); ?>"></script> -->
    <!-- Parsley -->
    <!-- <script src="<?php echo e(asset('vendors/parsleyjs/dist/parsley.min.js')); ?>"></script> -->
    <!-- Autosize -->
    <!-- <script src="<?php echo e(asset('vendors/autosize/dist/autosize.min.js')); ?>"></script> -->
    <!-- jQuery autocomplete -->
    <!-- <script src="<?php echo e(asset('vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js')); ?>"></script> -->
    <!-- starrr -->
    <!-- <script src="<?php echo e(asset('vendors/starrr/dist/starrr.js')); ?>"></script> -->
    <!-- Datatables -->
    <!-- <script src="<?php echo e(asset('vendors/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script> -->
    <!-- ckeditor -->
    <!-- <script src="<?php echo e(asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js')); ?>"></script> -->
    <!-- Fine Uploader jQuery JS file-->
    <!-- <script src="<?php echo e(asset('vendors/fine_upload/jquery.fine-uploader.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/jquery.ui/jquery-ui.js')); ?>"></script> -->
    <!-- Custom Theme Scripts -->
    <script src="<?php echo e(asset('build/js/custom.js')); ?>"></script>
    <!-- Custom flinnt Script -->
    <!-- <script src="<?php echo e(asset('build/js/flinnt.js')); ?>"></script> -->

<!-- 
    <script>
        $('textarea').ckeditor();
    </script>
    
    <script>
        $( ".row_position" ).sortable({
          // delay: 150,
          // stop: function() {
          //     var selectedData = new Array();
          //     $('.row_position>tr').each(function() {
          //         selectedData.push($(this).attr("id"));
          //     });
          //     updateOrder(selectedData);
          // }
        });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#vendor_state_id').select2();
      });
    </script> -->
    <?php echo $__env->yieldContent('script'); ?>
  </body>
</html>