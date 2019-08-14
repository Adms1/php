<?php $__env->startSection('title'); ?>
    <title><?php echo e('Flinnt | Product Detail'); ?></title>
<?php $__env->stopSection(); ?>

<!--===============================================================================================-->
    
<?php $__env->startSection('content'); ?>

    <!-- breadcrumb -->
    <div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-l-15-sm m-t-10 m-b-10">
        <a href="<?php echo e(route('front_home')); ?>" class="s-text16">
            Home
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="<?php echo e(route('front_home')); ?>" class="s-text16">
            Book
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="#" class="s-text16">
            Education
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
            CBSE Computer Science Chapterwise Solved Papers Class 12th
        </span>
    </div>

    <!-- Product Detail -->
    <div class="container bgwhite p-t-10 p-b-10" >
        <div class="flex-w flex-sb">
            <div class="col-sm-12 col-md-12 col-lg-6 m-t-10 m-b-10 pl-0">
                <div class="wrap-slick3 flex-sb flex-w">
                    <div class="slick3">
                        <?php if(count($product->images) > 0): ?>
                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item-slick3" data-thumb="<?php echo e(URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').$image->book_image_path)); ?>">
                            <div class="wrap-pic-w margin-0">
                                <img src="<?php echo e(URL::asset('/'.Config::get('settings.ORIGINAL_PRODUCT_IMG_PATH').$image->book_image_path)); ?>" alt="IMG-PRODUCT" class="product-original margin-0">
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <div class="item-slick3" data-thumb="<?php echo e(URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').Config::get('settings.PRODUCT_DEFAULT_IMAGE'))); ?>">
                            <div class="wrap-pic-w margin-0">
                                <img src="<?php echo e(URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').Config::get('settings.PRODUCT_DEFAULT_IMAGE'))); ?>" alt="IMG-PRODUCT" class="product-original margin-0">
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="wrap-slick3-dots"></div>

                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-6 m-t-10 m-b-10">
                <h4 class="product-detail-name m-text16 p-b-13 flinnt-color">
                    <?php echo e($product->book_name); ?>

                </h4>

                <span>
                    <p class="ratings">
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#"><span class="fa fa-star-o"></span></a>
                        <i class="fa fa-angle-down"></i> 88
                    </p>
                </span>

                <p class="s-text8 p-t-10">
                    <?php echo e($product->description[0]->description); ?>

                </p>

                <div class="p-t-10">
                    <div class="flex-m flex-w p-b-10">
                        <div class="s-text15 w-size11">
                            Sold By
                        </div>

                        <div class="of-hidden w-size16">
                            <?php echo e($product->bookvendor[0]->vendor_name); ?>

                        </div>
                    </div>
                    <?php if(isset($product->sale_price)): ?>
                    <div class="flex-r-m flex-w p-t-10">
                        <div class="w-full flex-m flex-w" id="shopping-cart-table">
                            
                            <div class="s-text8 size9 trans-0-4 m-t-10 m-b-10 float-left pd-10">
                                Price: <span class="flinnt-price-clr"><i class="fa fa-rupee"></i><?php echo e($product->sale_price); ?> </span>
                                <span class="block2-oldprice m-text7 p-r-5"><i class="fa fa-rupee"></i> <?php echo e($product->list_price); ?></span>
                            </div>

                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if(isset($product->book_vendors) && count($product->book_vendors) > 0): ?>
                    <div class="flex-r-m flex-w p-t-20">
                        <div class="w-full flex-m flex-w">
                            <table class="table-shopping-cart m-width-0">
                                <tr class="table-head m-text8 boall">
                                    <th class="text-center" colspan="3"><?php echo e('Other Sellers on Flinnt'); ?></th>
                                </tr>

                                <?php $__currentLoopData = $product->book_vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book_vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="table-row text-center boall">
                                    <td class="column-2 m-text14 p-t-10 p-b-10 p-r-0"><span>Sold By:</span> <?php echo e($book_vendor->vendor_name); ?></td>
                                    <td class="column-3 m-text14 p-t-10 p-b-10 p-r-0">
                                        <span class="flinnt-price-clr"><i class="fa fa-rupee"></i> <?php echo e($book_vendor->sale_price); ?></span>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>


    <!-- Relate Product -->
    <section class="relateproduct bgwhite p-b-138 p-t-20">
        <div class="container">

            <div class="bo6 p-t-15 p-b-14">
                <h5 class="flex-sb-m m-text19 trans-0-4">
                    Product description
                </h5>

                <div class="m-text15 p-t-15">
                    <p class="s-text8">
                        <?php echo $product->description[1]->description; ?>

                    </p>
                </div>
            </div>

            <div class="bo6 p-t-15 p-b-14">
                <h5 class="flex-sb-m m-text19 trans-0-4">
                    About the Author
                </h5>
                <?php $__currentLoopData = $product->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-t-15">
                        <p class="s-text8">
                            <b><?php echo e($author->author_name); ?></b>
                        </p>
                        <p class="s-text8">
                            <?php echo e($author->about_author); ?>

                        </p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>


            <div class="bo6 p-t-15 p-b-14">
                <h5 class="flex-sb-m m-text19 trans-0-4">
                    Product details
                </h5>

                <div class="p-t-15">
                    
                    <?php if($product->publisher->publisher_name): ?>
                        <p class="s-text8">
                            <b>Publisher Name:</b> <span><?php echo e($product->publisher->publisher_name); ?></span> 
                        </p>
                    <?php endif; ?>

                    <?php if($product->language->language_name): ?>
                        <p class="s-text8">
                            <b>Language:</b> <span><?php echo e($product->language->language_name); ?></span> 
                        </p>
                    <?php endif; ?>

                    <?php if(count($product->attribute) > 0): ?>
                        <?php $__currentLoopData = $product->attribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <p class="s-text8">
                                <b><?php echo e($attribute->attribute_name); ?>:</b> <span><?php echo e($attribute->attribute_value); ?></span> 
                            </p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    
                    <?php if($product->isbn): ?>
                        <p class="s-text8">
                            <b>ISBN:</b> <span><?php echo e($product->isbn); ?></span> 
                        </p>
                    <?php endif; ?>

                    <?php if($product->series): ?>
                        <p class="s-text8">
                            <b>Edition:</b> <span><?php echo e($product->series); ?></span> 
                        </p>
                    <?php endif; ?>

                    <?php if($product->hs_code): ?>
                        <p class="s-text8">
                            <b>HS Code:</b> <span><?php echo e($product->hs_code); ?></span> 
                        </p>
                    <?php endif; ?>

                    <p class="s-text8">
                        <b>Average Customer Rating:</b> <span class="ratings">
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                        <a href="#"><span class="fa fa-star-o"></span></a>
                        <i class="fa fa-angle-down"></i><span class="flinnt-color"> 88 customer reviews</span> 
                    </p>
                </div>
            </div>
            <div class="bo6 p-t-15 p-b-14">
                <h5 class="flex-sb-m m-text19 trans-0-4">
                    Customer reviews
                </h5>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-3 m-text15 p-t-15 p-b-23">
                        <p class="s-text8">
                            <span class="ratings">
                            <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                            <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                            <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                            <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                            <a href="#"><span class="fa fa-star-o"></span></a>
                            <span class="flinnt-color">88</span> 
                        </p>
                        <p class="s-text8">
                            <span class="flinnt-color">4 out of 5 stars <i class="fa fa-angle-down"></i></span> 
                        </p>
                        <br>
                        <div class="widget_summary width-100 review-star">
                            <div class="w_left w_25 float-left text-left width-25">
                                <a href="#" class="s-text8 flinnt-color"><span>5 star</span></a>
                            </div>
                            <div class="w_center w_55 width-55 float-left">
                                <div class="progress review-progress">
                                    <div class="progress-bar bg-green width-66 bg-star-progress-color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20 float-left text-right width-20">
                                <a href="#" class="s-text8 flinnt-color"><span>66%</span></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget_summary width-100 review-star">
                            <div class="w_left w_25 float-left text-left width-25">
                                <a href="#" class="s-text8 flinnt-color"><span>4 star</span></a>
                            </div>
                            <div class="w_center w_55 width-55 float-left">
                                <div class="progress review-progress">
                                    <div class="progress-bar bg-green width-45 bg-star-progress-color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20 float-left text-right width-20">
                                <a href="#" class="s-text8 flinnt-color"><span>45%</span></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary width-100 review-star">
                            <div class="w_left w_25 float-left text-left width-25">
                                <a href="#" class="s-text8 flinnt-color"><span>3 star</span></a>
                            </div>
                            <div class="w_center w_55 width-55 float-left">
                                <div class="progress review-progress">
                                    <div class="progress-bar bg-green width-25 bg-star-progress-color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20 float-left text-right width-20">
                                <a href="#" class="s-text8 flinnt-color"><span>25%</span></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary width-100 review-star">
                            <div class="w_left w_25 float-left text-left width-25">
                                <a href="#" class="s-text8 flinnt-color"><span>2 star</span></a>
                            </div>
                            <div class="w_center w_55 width-55 float-left">
                                <div class="progress review-progress">
                                    <div class="progress-bar bg-green width-5 bg-star-progress-color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20 float-left text-right width-20">
                                <a href="#" class="s-text8 flinnt-color"><span>5%</span></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary width-100 review-star">
                            <div class="w_left w_25 float-left text-left width-25">
                                <a href="#" class="s-text8 flinnt-color"><span>1 star</span></a>
                            </div>
                            <div class="w_center w_55 width-55 float-left">
                                <div class="progress review-progress">
                                    <div class="progress-bar bg-green width-2 bg-star-progress-color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20 float-left text-right width-20">
                                <a href="#" class="s-text8 flinnt-color"><span>2%</span></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <p>
                            <a href="#" class="s-text8"><span class="flinnt-color">Sell all 88 customer reviews <i class="fa fa-angle-down"></i></span></a>
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 s-text8">
                        <p>Share your thoughts with other customers</p>
                        <br>
                        <button class="btn btn-info m-text15 write-review">Write a product review</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.front_app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>