<?php $__env->startSection('title'); ?>
    <title><?php echo e(config('app.name', 'Flinnt')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <!-- Auto Complete with ajax -->
    <link href="<?php echo e(asset('vendors/jquery-ui/css/jquery-ui-autocomplete.css')); ?>" rel="stylesheet">
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

                <!-- <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="">
                            Sort by
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21">
                                <select class="selection-2" name="sorting" id="sorting">
                                    <option value="">Default Sorting</option>
                                    <option value="">Popularity</option>
                                    <option value="ASC">Price: low to high</option>
                                    <option value="DESC">Price: high to low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <div class="btn-group">
                                <a href="#" id="list" class="btn btn-default fh-border"><span class="fa fa-align-justify"></span></a> <a href="#" id="grid" class="btn btn-default fh-border"><span class="fa fa-th"></span></a>
                            </div>
                        </div>
                    </div>
                </div> -->

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
                        <h5 class="m-text14 p-b-7 p-t-7">
                            <b>Any Category</b>
                        </h5>

                        <ul class="p-b-20">
                            <!-- <li class="p-t-4">
                                <a href="<?php echo e(route('front_home')); ?>" class="s-text13">
                                    All
                                </a>
                            </li> -->
                            <?php if(!empty($category_id)): ?>
                            <li class="p-t-4 s-text13">
                                <a href="#" class="s-text13" onclick="checkbox_clear('category')">
                                    <i class="fa fa-angle-left"> Clear</i>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <li class="p-t-4">
                                <a href="#" onclick="set_category('<?php echo e($category["category_tree_id"]); ?>')" class="s-text13">
                                    <?php echo e($category['category_name']); ?>

                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

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
                                <!-- <?php echo e(route('bookset_home', $key)); ?> -->
                                <!-- <a href="<?php echo e(route('bookset_home', $key)); ?>" class="s-text13" onclick="set_checked(<?php echo e($standard); ?>)">
                                    <input type="checkbox" id="checkbox<?php echo e($standard); ?>" name="checkbox<?php echo e($standard); ?>" value="<?php echo e($standard); ?>">
                                    <?php echo e($standard); ?>

                                </a> -->
                                <a href="<?php echo e(route('bookset_home', $key)); ?>" class="s-text13">
                                    <?php echo e($standard); ?>

                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <?php if(!Auth::guard('user')->check()): ?>
                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Institution</b>
                        </h4>

                        <ul class="p-b-20">
                            <?php if(!empty($institution_id)): ?>
                            <li class="p-t-4 s-text13">
                                <a href="#" class="s-text13" onclick="checkbox_clear('institution')">
                                    <i class="fa fa-angle-left"> Clear</i>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php $__currentLoopData = $institutions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $institution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="p-t-4">
                                <a href="#" onclick="set_institution('<?php echo e($key); ?>')" class="s-text13">
                                    <?php echo e($institution); ?>

                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>

                        <?php if(count($languages) > 0): ?>
                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Refine by</b>
                        </h4>
                        <h5 class="m-text14">English & Indian Languages</h5>

                        <ul class="p-b-20">
                            <?php if(!empty($selected_lng)): ?>
                            <li class="p-t-4 s-text13">
                                <a href="#" class="s-text13" onclick="checkbox_clear('language')">
                                    <i class="fa fa-angle-left"> Clear</i>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="p-t-4 s-text13">
                                <input type="checkbox" id="language_<?php echo e($key); ?>" name="languages[]" value="<?php echo e($key); ?>" <?php echo e((in_array($key,$selected_lng)) ? "checked" : ""); ?> onclick="filter_checked('language_<?php echo e($key); ?>')"> 
                                <a href="#" class="s-text13" onclick="set_checked('language_<?php echo e($key); ?>')">
                                    <?php echo e($language); ?>

                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>

                        <?php if(count($formats) > 0): ?>
                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Format</b>
                        </h4>

                        <ul class="p-b-20">
                            <?php if(!empty($selected_frmt)): ?>
                            <li class="p-t-4 s-text13">
                                <a href="#" class="s-text13" onclick="checkbox_clear('format')">
                                    <i class="fa fa-angle-left"> Clear</i>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php $__currentLoopData = $formats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $format): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="p-t-4 s-text13">                                
                                <input type="checkbox" id="format_<?php echo e($key); ?>" name="formats[]" value="<?php echo e($key); ?>" <?php echo e((in_array($key,$selected_frmt)) ? "checked" : ""); ?> onclick="filter_checked('format_<?php echo e($key); ?>')">
                                <a href="#" class="s-text13" onclick="set_checked('format_<?php echo e($key); ?>')">
                                    <?php echo e($format); ?>

                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>

                        <?php if(count($authors) > 0): ?>
                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Author</b>
                        </h4>

                        <ul class="p-b-20">
                            <?php if(!empty($selected_athr)): ?>
                            <li class="p-t-4 s-text13">
                                <a href="#" class="s-text13" onclick="checkbox_clear('author')">
                                    <i class="fa fa-angle-left"> Clear</i>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="p-t-4 s-text13">
                                <input type="checkbox" id="author_<?php echo e($key); ?>" name="authors[]" value="<?php echo e($key); ?>" <?php echo e((in_array($key,$selected_athr)) ? "checked" : ""); ?> onclick="filter_checked('author_<?php echo e($key); ?>')">
                                <a href="#" class="s-text13" onclick="set_checked('author_<?php echo e($key); ?>')">
                                    <?php echo e($author); ?>

                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>

                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Avg. Customer Review </b>
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

                        <!--  -->
                <!--        <h4 class="m-text14 p-b-32">
                            Filters
                        </h4> -->

                        <!-- <div class="filter-price p-t-7 p-b-7 bo3">
                            <div class="m-text15 p-b-17">
                                Price
                            </div>

                            <div class="wra-filter-bar">
                                <div id="filter-bar"></div>
                            </div>

                            <div class="flex-sb-m flex-w p-t-16">
                                <div class="w-size11">
                                    <button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">
                                        Filter
                                    </button>
                                </div>

                                <div class="s-text3 p-t-10 p-b-10">
                                    Range: <span id="value-lower"><i class="fa fa-rupee"></i> 610</span> - <span id="value-upper"><i class="fa fa-rupee"></i> 980</span>
                                </div>
                            </div>
                        </div> -->
                        <?php if(count($prices) > 0): ?>
                        <h4 class="m-text14 p-b-7 p-t-7 bo3">
                            <b>Price</b>
                        </h4>

                        <ul class="p-b-20">
                            <?php if(!empty($selected_min || $selected_max)): ?>
                            <li class="p-t-4 s-text13">
                                <a href="#" class="s-text13" onclick="checkbox_clear('price')">
                                    <i class="fa fa-angle-left"> Any Price</i>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php $__currentLoopData = $prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($price['min'] == 0): ?>
                                    <li class="p-t-4 s-text13" onclick="compile_filter('<?php echo e($price["min"]); ?>', '<?php echo e($price["max"]); ?>')">
                                        <a href="#">
                                            Under <i class="fa fa-rupee"></i> 100 
                                        </a>
                                    </li>
                                <?php elseif($price['max'] == 'all'): ?>
                                    <li class="p-t-4 s-text13" onclick="compile_filter('<?php echo e($price["min"]); ?>', '')">
                                        <a href="#">
                                            Over <i class="fa fa-rupee"></i> 1000
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li class="p-t-4 s-text13" onclick="compile_filter('<?php echo e($price["min"]); ?>', '<?php echo e($price["max"]); ?>')">
                                        <a href="#">
                                            <i class="fa fa-rupee"></i> <?php echo e($price['min']); ?> - <i class="fa fa-rupee"></i> <?php echo e($price['max']); ?> 
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>
                        <p class="p-b-7">
                            <!-- HTML for rupes sign &#8377 --->
                            <input type="text" class="price_box" name="min" value="<?php echo e(!empty($selected_min) ? $selected_min : ''); ?>" id="min" placeholder='Min'>
                            <input type="text" class="price_box" name="max" value="<?php echo e(!empty($selected_max) ? $selected_max : ''); ?>" id="max" placeholder='Max'>
                            <button class="price_box btn-secondary width-27" onclick="set_checked('price_box')"> GO </button>
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
                        <!-- <div class="filter-color p-t-22 p-b-50 bo3">
                            <div class="m-text15 p-b-12">
                                Color
                            </div>

                            <ul class="flex-w">
                                <li class="m-r-10">
                                    <input class="checkbox-color-filter" id="color-filter1" type="checkbox" name="color-filter1">
                                    <label class="color-filter color-filter1" for="color-filter1"></label>
                                </li>

                                <li class="m-r-10">
                                    <input class="checkbox-color-filter" id="color-filter2" type="checkbox" name="color-filter2">
                                    <label class="color-filter color-filter2" for="color-filter2"></label>
                                </li>

                                <li class="m-r-10">
                                    <input class="checkbox-color-filter" id="color-filter3" type="checkbox" name="color-filter3">
                                    <label class="color-filter color-filter3" for="color-filter3"></label>
                                </li>

                                <li class="m-r-10">
                                    <input class="checkbox-color-filter" id="color-filter4" type="checkbox" name="color-filter4">
                                    <label class="color-filter color-filter4" for="color-filter4"></label>
                                </li>

                                <li class="m-r-10">
                                    <input class="checkbox-color-filter" id="color-filter5" type="checkbox" name="color-filter5">
                                    <label class="color-filter color-filter5" for="color-filter5"></label>
                                </li>

                                <li class="m-r-10">
                                    <input class="checkbox-color-filter" id="color-filter6" type="checkbox" name="color-filter6">
                                    <label class="color-filter color-filter6" for="color-filter6"></label>
                                </li>

                                <li class="m-r-10">
                                    <input class="checkbox-color-filter" id="color-filter7" type="checkbox" name="color-filter7">
                                    <label class="color-filter color-filter7" for="color-filter7"></label>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-10 p-b-50">
                    <div id="filter_header">
                        <?php if($count > 0): ?> 
                        <div class="flex-sb-m flex-w filter-header">
                            <span class="s-text8 p-t-10 p-b-10 p-l-15">
                                Showing 1–<?php echo e($count); ?> of <?php echo e($count); ?> results
                            </span>
                            <input type="hidden" id="filter_header_data" name="filter_header_data" value="<?php echo e(!empty($filter_encode) ? $filter_encode : ''); ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Product -->
                    <div id="filter_product">
                        <?php if(!empty($products) && count($products) > 0): ?>
                        <div class="row pos-relative">
                            <?php
                                $main_standard = $products[0]->standard_id;
                                $count = 1 ;
                            ?>
                            <p class="width-100 white-color border-std-name m-b-20">
                                <span class="span-std-name"><?php echo e($products[0]->standard_name); ?></span>
                                <a href="<?php echo e(route('grade_list', $main_standard)); ?>"><span class="see-more"><?php echo e('see more'); ?></span></a></p>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($main_standard == $product->standard_id): ?>
                            <?php if($count <= 6): ?> 
                            <div class="col-sm-12 col-md-2 col-lg-2 p-b-30">
                                <div class="block2">
                                    <div class="block2-img wrap-pic-w of-hidden pos-relative block-center">
                                        <a href="<?php echo e(route('product_detail', [$product->institution_book_vendor_id, $product->standard_id])); ?>"><img src="<?php echo e(URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').$product->book_image_path)); ?>" alt="IMG-PRODUCT" class="product-thumbnail"></a>

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

                                                    <input type="hidden" name="id" value="<?php echo e($product->institution_book_vendor_id); ?>">
                                                    <input type="hidden" name="name" value="<?php echo e($product->book_name); ?>">
                                                    <input type="hidden" name="book_id" value="<?php echo e($product->book_id); ?>">
                                                    <input type="hidden" name="price" value="<?php echo e($product->sale_price); ?>">
                                                    <input type="hidden" name="type" value="<?php echo e('book'); ?>">
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
                                        <a href="<?php echo e(route('product_detail', [$product->institution_book_vendor_id, $product->standard_id])); ?>" class="block2-name dis-block s-text3 p-b-5 pr-title flinnt-color">
                                            <?php echo e($product->book_name); ?>

                                        </a>

                                        <span class="block2-newprice m-text8 p-r-5">
                                            <i class="fa fa-rupee flinnt-price-clr"></i> 
                                            <b><?php echo e($product->sale_price); ?></b>
                                        </span>
                                        <?php if($product->sale_price != $product->list_price): ?>
                                        <span class="block2-oldprice m-text7 p-r-5">
                                            <i class="fa fa-rupee"></i> <?php echo e($product->list_price); ?>

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
                                $main_standard = $product->standard_id;
                                $count = 1 ;
                            ?>
                            </div>
                            <div class="row pos-relative">
                                <p class="width-100 white-color border-std-name m-b-20">
                                <span class="span-std-name"><?php echo e($product->standard_name); ?></span><a href="<?php echo e(route('grade_list', $main_standard)); ?>"><span class="see-more"><?php echo e('see more'); ?></span></a></p>
                                <div class="col-sm-12 col-md-2 col-lg-2 p-b-30">
                                    <div class="block2">
                                        <div class="block2-img wrap-pic-w of-hidden pos-relative block-center">
                                            <a href="<?php echo e(route('product_detail', [$product->institution_book_vendor_id, $product->standard_id])); ?>"><img src="<?php echo e(URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').$product->book_image_path)); ?>" alt="IMG-PRODUCT" class="product-thumbnail"></a>

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

                                                        <input type="hidden" name="id" value="<?php echo e($product->institution_book_vendor_id); ?>">
                                                        <input type="hidden" name="name" value="<?php echo e($product->book_name); ?>">
                                                        <input type="hidden" name="book_id" value="<?php echo e($product->book_id); ?>">
                                                        <input type="hidden" name="price" value="<?php echo e($product->sale_price); ?>">
                                                        <input type="hidden" name="type" value="<?php echo e('book'); ?>">
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
                                            <a href="<?php echo e(route('product_detail', [$product->institution_book_vendor_id, $product->standard_id])); ?>" class="block2-name dis-block s-text3 p-b-5 pr-title flinnt-color">
                                                <?php echo e($product->book_name); ?>

                                            </a>

                                            <span class="block2-newprice m-text8 p-r-5">
                                                <i class="fa fa-rupee flinnt-price-clr"></i> <b><?php echo e($product->sale_price); ?></b>
                                            </span>
                                            <?php if($product->sale_price != $product->list_price): ?>
                                            <span class="block2-oldprice m-text7 p-r-5">
                                                <i class="fa fa-rupee"></i> <?php echo e($product->list_price); ?>

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

                    <!-- Pagination -->
                    <!-- <div class="pagination flex-m flex-w p-t-26">
                        <a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
                        <a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
                    </div> -->
                </div>
            </div>
            <form action="<?php echo e(url('/')); ?>" method="GET" name="formFilter" id="formFilter">
                <?php echo csrf_field(); ?>

                <input type="hidden" id="category_id" name="category_id" value="<?php echo e(!empty($category_id) ? $category_id : ''); ?>">
                <input type="hidden" id="institution_id" name="institution_id" value="<?php echo e(!empty($institution_id) ? $institution_id : ''); ?>">
                <input type="submit" value="">
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    
    <!-- Auto Complete with ajax -->
    <script src="<?php echo e(asset('vendors/jquery-ui/js/jquery-ui.min.js')); ?>"></script>

    <script type="text/javascript">
        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*** To get products name for autocomplete in product search box ***/
            var src = "<?php echo e(route('product_searchAjax')); ?>";
            $("#product_name").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: src,
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            product_name: request.term
                        },
                        success: function(data) {
                            var array = $.map(data, function(item) {
                                return {
                                    label: item,
                                    value: item,
                                    product: item
                                }
                            });
                            response(array)
                        }
                    });
                },
                minLength: 1,
                select: function(event, ui) {
                    var data = ui.item.product;
                    $('#product_name').val(data);
                }
            });
        });

        /*** On check box click submit filter form ***/
        function filter_checked(id) {
            var min = "";
            var max = "";

            min = set_min_price(min);
            max = set_max_price(max);

            compile_filter(min[0], max[0]);
        }

        /*** On check box click submit filter form ***/
        function set_checked(id) {
            var min = "";
            var max = "";

            if ($('input[id='+id+']').is(':checked')) {
                $('input[id='+id+']').attr('checked', false);
            } else {
                $('input[id='+id+']').attr('checked', true);
            }

            min = set_min_price(min);
            max = set_max_price(max);

            compile_filter(min[0], max[0]);
        }

        /*** On category click submit filter form ***/
        function set_category(category_id) {
            var min = "";
            var max = "";

            $('#category_id').val(category_id);

            min = set_min_price(min);
            max = set_max_price(max);

            compile_filter(min[0], max[0]);
        }

        /*** On institution click submit filter form ***/
        function set_institution(institution_id) {
            var min = "";
            var max = "";

            $('#institution_id').val(institution_id);

            min = set_min_price(min);
            max = set_max_price(max);

            compile_filter(min[0], max[0]);
        }

        /*** Get Checked languages ***/
        function language_filter(languages) {
            languages = $('input[name="languages[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            return languages = $.unique(languages.sort()).sort();
        }

        /*** Get Checked formates ***/
        function format_filter(formats) {
            formats = $('input[name="formats[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            return formats = $.unique(formats.sort()).sort();
        }

        /*** Get Checked authors ***/
        function author_filter(authors) {
            authors = $('input[name="authors[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            return authors = $.unique(authors.sort()).sort();
        }

        /*** Get min price from price form ***/
        function set_min_price(min) {
            min = $('input[name="min"]').map(function() {
                if ($(this).val() !== "") {
                    return $(this).val();
                }
            }).get();

            return min = $.unique(min.sort()).sort();
        }

        /*** Get max price from price form ***/
        function set_max_price(max) {
            max = $('input[name="max"]').map(function() {
                if ($(this).val() !== "") {
                    return $(this).val();
                }
            }).get();
            
            return max = $.unique(max.sort()).sort();
        }

        /*** Compile filter from with all filters ***/
        function compile_filter(min, max) {
            var filter = [];
            var languages = [];
            var formats = [];
            var authors = [];
            var product_name = $("#product_name").val();
            var category_id = $('#category_id').val();
            var institution_id = $('#institution_id').val();
            var filter_header_data = $('#filter_header_data').val();
            var sorting = $('#sorting').val();

            var filter_product = $('#filter_product');
            var filter_option = $('#mobile-filter-men');
            var filter_header = $('#filter_header');

            languages = language_filter(languages);
            formats = format_filter(formats);
            authors = author_filter(authors);

            filter.push({languages:languages,formats:formats,authors:authors,min_price:min,max_price:max});

            // $('#filter').val(JSON.stringify(filter));
            // $("#formFilter").submit();
            $("#ajax_loader").css("display", "block");
            $.ajax({
                type: "POST",
                url: '<?php echo e(route("product_filterAjax")); ?>',
                dataType: 'json',
                data: {
                    'product_name' : product_name,
                    'category_id' : category_id,
                    'institution_id' : institution_id,
                    'filter' : JSON.stringify(filter),
                    'filter_encode' : filter_header_data,
                    'sorting' : sorting
                },
                success: function(data) {
                    $("#ajax_loader").css("display", "none");
                    filter_product.html(data.filter_product);
                    filter_option.html(data.filter_option);
                    filter_header.html(data.filter_header);
                }
            });
        }

        /*** Remove key related filter then Compile filter from with available filters ***/
        function checkbox_clear(key) {
            var min = "";
            var max = "";

            if (key == 'language') {
                $('input[name="languages[]"]').attr('checked', false);
            }

            if (key == 'format') {
                $('input[name="formats[]"]').attr('checked', false);
            }

            if (key == 'author') {
                $('input[name="authors[]"]').attr('checked', false);
            }

            if (key == 'price') {
                $('input[name="max"]').val('');
                $('input[name="min"]').val('');
            }

            if (key == 'category') {
                $('#category_id').val('');
            }

            if (key == 'institution') {
                $('#institution_id').val('');
            }

            min = set_min_price(min);
            max = set_max_price(max);

            compile_filter(min[0], max[0]);
        }

        /*** To get products list based on search name and filtered values ***/
        $('#search').on('click', function(){
            var min = "";
            var max = "";

            min = set_min_price(min);
            max = set_max_price(max);

            compile_filter(min[0], max[0]);
        });

        /*** To sort product list based on price min/max ***/
        $('#sorting').on('change', function(){
            var min = "";
            var max = "";

            min = set_min_price(min);
            max = set_max_price(max);

            compile_filter(min[0], max[0]);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>