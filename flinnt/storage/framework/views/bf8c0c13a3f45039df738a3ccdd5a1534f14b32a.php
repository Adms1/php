<?php $__env->startSection('title'); ?>
    <title><?php echo e('Flinnt | Product Detail'); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
	<style type="text/css">
		.block2 .wrap-pic-w img { width: 120px }
		.block2-overlay { width: 70%; left: 25px; }
		@media (max-width: 425px) {
		  	.block2 .wrap-pic-w img {
		  		width: 100%;
    			height: 100%;
			}
			.block2-overlay { width: 100%; left: 0px; }
	  	}
	</style>
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
            </div>
        </div>
    </section>

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

			<div class="col-sm-12 col-md-12 col-lg-6 m-t-10 m-b-20">
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
					<?php echo e($book_descriptions[0]->description); ?>

				</p>

				<div class="p-t-10">
					<div class="flex-m flex-w p-b-10">
						<div class="s-text15 w-size11">
							Sold By
						</div>

						<div class="w-size20">
							<?php echo e($book_institution_book_vendor->vendor_name); ?>

						</div>
					</div>

					<div class="flex-r-m flex-w p-t-10">
						<div class="w-full flex-m flex-w" id="shopping-cart-table">
							<form action="<?php echo e(url('/cart/store')); ?>" method="POST">
								<?php echo csrf_field(); ?>

							<div class="s-text8 width-100 trans-0-4 m-t-10 m-b-10 float-left p-t-10 p-r-10">
								Price: <span class="flinnt-price-clr"><i class="fa fa-rupee"></i><?php echo e($book_institution_book_vendor->sale_price); ?> </span>
								<?php if($book_institution_book_vendor->sale_price != $book_institution_book_vendor->list_price): ?>
								<span class="block2-oldprice m-text7 p-r-5"><i class="fa fa-rupee"></i> <?php echo e($book_institution_book_vendor->list_price); ?></span>
								<?php endif; ?>
							</div>

							<div class="flex-w bo5 of-hidden m-t-10 m-b-10 float-left">
								<button class="btn-num-product-down color1 flex-c-m qty-btn bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								<input class="qty-btn m-text18 t-center num-product" type="number" name="qty" value="1">

								<button class="btn-num-product-up color1 flex-c-m qty-btn bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>

							<div class="size17 trans-0-4 m-t-10 m-b-10 float-left">
								<?php if(Auth::guard('user')->check()): ?>
                                    <?php if(Auth::guard('user')->user()->institution_id != ''): ?>
					                <input type="hidden" name="id" value="<?php echo e($book_institution_book_vendor->institution_book_vendor_id); ?>">
					                <input type="hidden" name="name" value="<?php echo e($product->book_name); ?>">
					                <input type="hidden" name="book_id" value="<?php echo e($book_institution_book_vendor->book_id); ?>">
					                <input type="hidden" name="price" value="<?php echo e($book_institution_book_vendor->sale_price); ?>">
					                <input type="hidden" name="type" value="<?php echo e('book'); ?>">
					                <input type="submit" class="btn btn-info btn-addcart-product-detail flinnt-bg-color float-right" value="Add to Cart">
				                	<?php else: ?>
	                                <a href="#" class="btn btn-info btn-addcart-product-detail flinnt-bg-color float-right" data-toggle="modal" data-target=".show-notification">Add to Cart</a>
	                                <?php endif; ?>
	                            <?php else: ?>
	                                <a href="<?php echo e(route('user_profile')); ?>" class="btn btn-info btn-addcart-product-detail flinnt-bg-color float-right">Add to Cart</a>
	                            <?php endif; ?>
							</div>
							</form>
						</div>
					</div>
					<?php if(isset($book_vendors) && count($book_vendors) > 0): ?>
					<div class="flex-r-m flex-w p-t-20">
						<div class="w-full flex-m flex-w">
							<table class="table-shopping-cart m-width-0">
								<tr class="table-head m-text8 boall">
									<th class="text-center" colspan="3"><?php echo e('Other Sellers on Flinnt'); ?></th>
								</tr>

								<?php $__currentLoopData = $book_vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book_vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr class="table-row text-center boall">
									<td class="column-2 m-text14 bookset-info-tbl"><span>Sold By:</span> <?php echo e($book_vendor->vendor_name); ?></td>
									<td class="column-3 m-text14 bookset-info-tbl">
										<span class="flinnt-price-clr"><i class="fa fa-rupee"></i> <?php echo e($book_vendor->sale_price); ?></span>
									</td>
									<td class="column-4 bookset-info-tbl">
										<?php if(Auth::guard('user')->check()): ?>
                                            <?php if(Auth::guard('user')->user()->institution_id != ''): ?>
											<form action="<?php echo e(url('/cart/store')); ?>" method="POST">
	                                            <?php echo csrf_field(); ?>

	                                            <input type="hidden" name="id" value="<?php echo e($book_vendor->institution_book_vendor_id); ?>">
	                                            <input type="hidden" name="name" value="<?php echo e($book_vendor->book_name); ?>">
	                                            <input type="hidden" name="book_id" value="<?php echo e($book_vendor->book_id); ?>">
	                                            <input type="hidden" name="price" value="<?php echo e($book_vendor->sale_price); ?>">
	                                            <input type="hidden" name="type" value="<?php echo e('book'); ?>">
	                                            <input type="submit" class="btn-addcart-product-detail btn btn-info flinnt-bg-color" value="Add to Cart">
	                                        </form>
                                        	<?php else: ?>
                                    		<a href="#" class="btn-addcart-product-detail btn btn-info flinnt-bg-color" data-toggle="modal" data-target=".show-notification">Add to Cart</a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('user_profile')); ?>" class="btn-addcart-product-detail btn btn-info flinnt-bg-color">Add to Cart</a>
                                        <?php endif; ?>
									</td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</table>
						</div>
					</div>
					<?php endif; ?>
				</div>

				<!-- <div class="p-b-45">
					<span class="s-text8 m-r-35">SKU: MUG-01</span>
					<span class="s-text8">Categories: Mug, Design</span>
				</div> -->

				<!--  -->
				<!-- <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Description
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div> -->

				<!-- <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Additional information
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Reviews (0)
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div> -->
			</div>
		</div>
	</div>


	<!-- Relate Product -->
	<section class="relateproduct bgwhite p-b-138 p-t-20">
		<div class="container">
			<!-- <div class="sec-title p-b-60"> -->
				<!-- <h3 class="m-text5 t-center"> -->
					<!-- Related Products -->
				<!-- </h3> -->
			<!-- </div> -->

			<!-- Slide2 -->
			<?php if(isset($book_grades) && count($book_grades) > 0): ?>
			<div class="wrap-slick2 p-b-15 cls-related p-t-12 related-product">
				<div class="slick2">
					<?php $__currentLoopData = $book_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book_grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block-center">
								<img src="<?php echo e(URL::asset('/'.Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH').$book_grade->book_image_path)); ?>" class="product-thumbnail display-inline" alt="IMG-PRODUCT">

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

	                                            <input type="hidden" name="id" value="<?php echo e($book_grade->institution_book_vendor_id); ?>">
	                                            <input type="hidden" name="name" value="<?php echo e($book_grade->book_name); ?>">
	                                            <input type="hidden" name="book_id" value="<?php echo e($book_grade->book_id); ?>">
	                                            <input type="hidden" name="price" value="<?php echo e($book_grade->sale_price); ?>">
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
								<a href="<?php echo e(route('product_detail', [$book_grade->institution_book_vendor_id, $book_grade->standard_id])); ?>" class="block2-name dis-block s-text3 p-b-5 pr-title flinnt-color">
									<?php echo e($book_grade->book_name); ?>

								</a>

                                <span class="block2-newprice m-text8 p-r-5">
                                    <i class="fa fa-rupee flinnt-price-clr"></i> <b><?php echo e($book_grade->sale_price); ?></b>
                                </span>
                                <?php if($book_grade->sale_price != $book_grade->list_price): ?>
                                <span class="block2-oldprice m-text7 p-r-5">
                                    <i class="fa fa-rupee"></i> <?php echo e($book_grade->list_price); ?>

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
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
			<?php endif; ?>

			<div class="bo6 p-t-15 p-b-14">
				<h5 class="flex-sb-m m-text19 trans-0-4">
					Product description
				</h5>

				<div class="m-text15 p-t-15">
					<p class="s-text8">
						<?php echo $book_descriptions[1]->description; ?>

					</p>
				</div>
			</div>

			<div class="bo6 p-t-15 p-b-14">
				<h5 class="flex-sb-m m-text19 trans-0-4">
					About the Author
				</h5>
				<?php $__currentLoopData = $book_authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book_author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="p-t-15">
						<p class="s-text8">
							<b><?php echo e($book_author->author_name); ?></b>
						</p>
						<p class="s-text8">
							<?php echo e($book_author->about_author); ?>

						</p>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>

			<div class="bo6 p-t-15 p-b-14">
				<h5 class="flex-sb-m m-text19 trans-0-4">
					Product details
				</h5>

				<div class="p-t-15">
					
					<?php if($product->publisher_name): ?>
						<p class="s-text8">
							<b>Publisher Name:</b> <span><?php echo e($product->publisher_name); ?></span> 
						</p>
					<?php endif; ?>

					<?php if($product->language_name): ?>
						<p class="s-text8">
							<b>Language:</b> <span><?php echo e($product->language_name); ?></span> 
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
<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>