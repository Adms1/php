<?php $__env->startSection('title'); ?>
    <title><?php echo e(config('app.name', 'Flinnt')); ?></title>
<?php $__env->stopSection(); ?>

<!--===============================================================================================-->

<?php $__env->startSection('content'); ?>
    <!-- Title Page -->
    <section>
        <div class="container width-95">

            <div class="row">
                <div class="col-lg-2">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 search-product pos-relative of-hidden m-b-20 m-t-20" >
                    <div class="input-group">
                        <input class="form-control s-text7 size6 h-40" type="text" name="product_name" placeholder="What is on your mind today?" id="product_name">
                        <button class="input-group-addon trans-0-4 flinnt-bg-color" id="search"><i class="fs-12 fa fa-search white-color" aria-hidden="true"></i></button>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4 w-size18 m-b-20 m-t-20">
                    <div class="flex-w flex-sb width-100">
                        <span class="width-15 m-text14 p-t-10">
                            Sort by
                        </span>
                        <div class="width-45 p-l-10 header-filter">
                            <div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21">
                                <select class="selection-2" name="sorting" id="sorting">
                                    <option value="">Default Sorting</option>
                                    <option value="">Popularity</option>
                                    <option value="ASC">Price: low to high</option>
                                    <option value="DESC">Price: high to low</option>
                                </select>
                            </div>
                        </div>
                        <div class="width-32 p-l-10 header-filter">
                            <div class="btn-group">
                                <a href="#" id="list" class="btn btn-default fh-border"><span class="fa fa-align-justify"></span></a> <a href="#" id="grid" class="btn btn-default fh-border"><span class="fa fa-th"></span></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Content page -->
    <section class="bgwhite p-b-65">
        <div class="container width-95">
            <div class="row">
                <div class="col-md-2 col-lg-2 p-b-50" id="mobile-filter-men">
                    <div class="leftbar p-r-0-sm">
                        <!--  -->
                        <h5 class="m-text14 p-b-7 p-t-7 bo3">
                            Show results for
                        </h5>
                        <!-- <h5 class="m-text14 p-b-7 p-t-7">
                            Any Category
                        </h5>

                        <ul class="p-b-20">
                            <li class="p-t-4">
                                <a href="<?php echo e(route('front_home')); ?>" class="s-text13">
                                    All
                                </a>
                            </li>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <li class="p-t-4">
                                    <a href="<?php echo e(route('front_home', $category['category_tree_id'])); ?>" class="s-text13">
                                        <?php echo e($category['category_name']); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul> -->

                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Bookset</b>
                        </h4>

                        <ul class="p-b-20">
                            <li class="p-t-4 s-text13">
                                <a href="<?php echo e(route('bookset_home')); ?>" class="s-text13"><?php echo e('All'); ?>

                                </a>
                            </li>
                            <?php $__currentLoopData = $standards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $standard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <li class="p-t-4">
                                    <a href="<?php echo e(route('bookset_home', $key)); ?>" class="s-text13">
                                        <?php echo e($standard); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Avg. Customer Review</b>
                        </h4>

                        <ul class="p-b-20">
                            <li class="p-t-4 s-text13">
                                <p class="ratings">
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    & Up
                                </p>
                            </li>

                            <li class="p-t-4 s-text13">
                                <p class="ratings">
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    & Up
                                </p>
                            </li>

                            <li class="p-t-4 s-text13">
                                <p class="ratings">
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    & Up
                                </p>
                            </li>

                            <li class="p-t-4 s-text13">
                                <p class="ratings">
                                    <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    & Up
                                </p>
                            </li>
                        </ul>

                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Item Condition</b>
                        </h4>

                        <ul class="p-b-20">
                            <li class="p-t-4 s-text13">
                                New
                            </li>

                            <li class="p-t-4 s-text13">
                                Certified Refurbished
                            </li>

                            <li class="p-t-4 s-text13">
                                Used
                            </li>
                        </ul>

                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Price</b>
                        </h4>

                        <ul class="p-b-20">
                            <li class="p-t-4 s-text13">
                                Under <i class="fa fa-rupee"></i> 100 
                            </li>

                            <li class="p-t-4 s-text13">
                                <i class="fa fa-rupee"></i> 100 - <i class="fa fa-rupee"></i> 200 
                            </li>

                            <li class="p-t-4 s-text13">
                                <i class="fa fa-rupee"></i> 200 - <i class="fa fa-rupee"></i> 500 
                            </li>

                            <li class="p-t-4 s-text13">
                                <i class="fa fa-rupee"></i> 500 - <i class="fa fa-rupee"></i> 1000 
                            </li>

                            <li class="p-t-4 s-text13">
                                Over <i class="fa fa-rupee"></i> 1000
                            </li>
                        </ul>
                        <p class="p-b-7">
                            <!-- HTML for rupes sign &#8377 --->
                            <input type="text" class="price_box" name="" placeholder='Min'>
                            <input type="text" class="price_box" name="" placeholder='Max'>
                            <button class="price_box btn-secondary width-27"> GO </button>

                        </p>

                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Discount</b>
                        </h4>

                        <ul class="p-b-20 border-discount">
                            <li class="p-t-4 s-text13">
                                10% Off or more
                            </li>

                            <li class="p-t-4 s-text13">
                                25% Off or more
                            </li>

                            <li class="p-t-4 s-text13">
                                35% Off or more
                            </li>

                            <li class="p-t-4 s-text13">
                                50% Off or more
                            </li>
                        </ul>

                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-10 p-b-50">

                    <!-- Bookset -->
                    <?php if(!empty($booksets) && count($booksets) > 0): ?>
                    <div class="row pos-relative">
                        <?php
                            $main_standard = $booksets[0]->standard_id;
                            $count = 1 ;
                        ?>
                        <p class="width-100 white-color border-std-name m-b-20">
                            <span class="span-std-name"><?php echo e($booksets[0]->standard_name); ?></span>
                            <a href="<?php echo e(route('bookset_grade_list', $main_standard)); ?>"><span class="see-more"><?php echo e('see more'); ?></span></a></p>
                        <?php $__currentLoopData = $booksets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($main_standard == $bookset->standard_id): ?>
                        <?php if($count <= 6): ?> 
                        <div class="col-sm-12 col-md-2 col-lg-2 p-b-30">
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block-center">
                                    <a href="<?php echo e(route('bookset_detail', [$bookset->institution_book_set_vendor_id, $bookset->standard_id])); ?>"><img src="<?php echo e(URL::asset('/'.Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH').$bookset->book_set_image_path)); ?>" alt="IMG-PRODUCT" class="product-thumbnail"></a>

                                    <div class="block2-overlay trans-0-4">
                                        <!-- <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a> -->

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <?php if(Auth::guard('user')->check()): ?>
                                                <?php if(Auth::guard('user')->user()->institution_id != ''): ?>
                                                <form action="<?php echo e(url('/cart/store')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>

                                                <input type="hidden" name="id" value="<?php echo e($bookset->institution_book_set_vendor_id); ?>">
                                                <input type="hidden" name="name" value="<?php echo e($bookset->book_set_name); ?>">
                                                <input type="hidden" name="book_id" value="<?php echo e($bookset->book_set_id); ?>">
                                                <input type="hidden" name="price" value="<?php echo e($bookset->sale_price); ?>">
                                                <input type="hidden" name="type" value="<?php echo e('bookset'); ?>">
                                                <input type="submit" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" value="Add to Cart">
                                                </form>
                                                <?php else: ?>
                                                <a href="#" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" data-toggle="modal" data-target=".show-notification">Add to Cart</a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <a href="<?php echo e(route('user_profile')); ?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Add to Cart</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="<?php echo e(route('bookset_detail', [$bookset->institution_book_set_vendor_id, $bookset->standard_id])); ?>" class="block2-name dis-block s-text3 p-b-5 pr-title flinnt-color">
                                        <?php echo e($bookset->book_set_name); ?>

                                    </a>

                                    <span class="block2-newprice m-text8 p-r-5">
                                        <i class="fa fa-rupee flinnt-price-clr"></i> 
                                        <b><?php echo e($bookset->sale_price); ?></b>
                                    </span>
                                    <?php if($bookset->sale_price != $bookset->list_price): ?>
                                    <span class="block2-oldprice m-text7 p-r-5">
                                        <i class="fa fa-rupee"></i> <?php echo e($bookset->list_price); ?>

                                    </span>
                                    <?php endif; ?>

                                    <span>
                                        <i class="a-icon a-icon-star a-star-4"></i>
                                        <p class="ratings">
                                            <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                            <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                            <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                            <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                            <i class="fa fa-angle-down"></i><span class="flinnt-color"> 88 </span>
                                        </p>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php 
                            $count++;
                        ?>
                        <?php endif; ?>
                        <?php else: ?>
                        <?php
                            $main_standard = $bookset->standard_id;
                            $count = 1 ;
                        ?>
                        </div>
                        <div class="row pos-relative">
                            <p class="width-100 white-color border-std-name m-b-20">
                            <span class="span-std-name"><?php echo e($bookset->standard_name); ?></span><a href="<?php echo e(route('bookset_grade_list', $main_standard)); ?>"><span class="see-more"><?php echo e('see more'); ?></span></a></p>
                            <div class="col-sm-12 col-md-2 col-lg-2 p-b-30">
                                <div class="block2">
                                    <div class="block2-img wrap-pic-w of-hidden pos-relative block-center">
                                        <a href="<?php echo e(route('bookset_detail', [$bookset->institution_book_set_vendor_id, $bookset->standard_id])); ?>"><img src="<?php echo e(URL::asset('/'.Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH').$bookset->book_set_image_path)); ?>" alt="IMG-PRODUCT" class="product-thumbnail"></a>

                                        <div class="block2-overlay trans-0-4">
                                            <!-- <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                                <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                                <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                            </a> -->

                                            <div class="block2-btn-addcart w-size1 trans-0-4">
                                                <?php if(Auth::guard('user')->check()): ?>
                                                    <?php if(Auth::guard('user')->user()->institution_id != ''): ?>
                                                    <form action="<?php echo e(url('/cart/store')); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>

                                                    <input type="hidden" name="id" value="<?php echo e($bookset->institution_book_set_vendor_id); ?>">
                                                    <input type="hidden" name="name" value="<?php echo e($bookset->book_set_name); ?>">
                                                    <input type="hidden" name="book_id" value="<?php echo e($bookset->book_set_id); ?>">
                                                    <input type="hidden" name="price" value="<?php echo e($bookset->sale_price); ?>">
                                                    <input type="hidden" name="type" value="<?php echo e('bookset'); ?>">
                                                    <input type="submit" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" value="Add to Cart">
                                                    </form>
                                                    <?php else: ?>
                                                    <a href="#" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" data-toggle="modal" data-target=".show-notification">Add to Cart</a>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('user_profile')); ?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Add to Cart</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="block2-txt p-t-20">
                                        <a href="<?php echo e(route('bookset_detail', [$bookset->institution_book_set_vendor_id, $bookset->standard_id])); ?>" class="block2-name dis-block s-text3 p-b-5 pr-title flinnt-color">
                                            <?php echo e($bookset->book_set_name); ?>

                                        </a>

                                        <span class="block2-newprice m-text8 p-r-5">
                                            <i class="fa fa-rupee flinnt-price-clr"></i> <b><?php echo e($bookset->sale_price); ?></b>
                                        </span>
                                        <?php if($bookset->sale_price != $bookset->list_price): ?>
                                        <span class="block2-oldprice m-text7 p-r-5">
                                            <i class="fa fa-rupee"></i> <?php echo e($bookset->list_price); ?>

                                        </span>
                                        <?php endif; ?>

                                        <span>
                                            <i class="a-icon a-icon-star a-star-4"></i>
                                            <p class="ratings">
                                                <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                                <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                                <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                                <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star-o"></span></a>
                                                <i class="fa fa-angle-down"></i><span class="flinnt-color"> 88 </span>
                                            </p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            $count++;
                            ?>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>