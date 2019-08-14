<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/******* Redirect user to live login screen ********/	
Route::get('live_login', function () {
    return Redirect::to(Config::get('settings.APP_URL'));
})->name('live_login');


/******* Front-end routes for user ********/
Route::group(['namespace' => 'V1\Frontend'], function(){
	Route::get('/{category_id?}/{filter?}', 'HomeController@index')->name('front_home');
	Route::post('/search/product', 'HomeController@getAjaxSearchProduct')->name('product_filterAjax');
	Route::get('/view/{id}/{standard_id}', 'HomeController@show')->name('product_detail');
	Route::get('/home/grade/{standard_id?}', 'HomeController@listByGrade')->name('grade_list');
	Route::get('/bookset/{standard_id?}', 'HomeController@getBooksetList')->name('bookset_home');
	Route::get('/bookset/view/{id}/{standard_id}', 'HomeController@getBooksetView')->name('bookset_detail');
	Route::get('/bookset/grade/{standard_id?}', 'HomeController@booksetListByGrade')->name('bookset_grade_list');

	/******* Middleware Protected ********/
	Route::group(['middleware' => ['auth:user']], function(){
		Route::get('/{id}', 'HomeController@doUserLogin')->name('user_login');
		Route::get('/my/cart', 'HomeController@cart')->name('cart');
		Route::get('/user/profile', 'HomeController@getUserProfile')->name('user_profile');
		Route::post('/user/profileUpdate', 'HomeController@userProfileUpdate')->name('profile_update');
		Route::get('/user/orderList', 'HomeController@getUserOrderList')->name('user_order');
		Route::get('/user/logout', 'HomeController@doUserLogout')->name('user_logout');

		Route::get('/cart', 'CartsController@index');
		Route::post('/cart/store', 'CartsController@store');
		Route::post('/cart/update', 'CartsController@update');
		Route::post('/cart/destroy', 'CartsController@destroy');
		Route::delete('/emptyCart', 'CartsController@emptyCart');
		Route::post('/switchToWishlist/{id}', 'CartsController@switchToWishlist');

		Route::get('/address/select', 'OrdersController@selectAddress')->name('select_address');
		Route::post('/address/store', 'OrdersController@storeAddress')->name('address_store');
		Route::get('/address/edit/{id}', 'OrdersController@editAddress')->name('address_edit');
		Route::post('/address/update/{id}', 'OrdersController@updateAddress')->name('address_update');
		Route::get('/address/delete/{id}', 'OrdersController@destroyAddress')->name('address_destroy');

		Route::get('/order/review/{id?}', 'OrdersController@processReviewPay')->name('review_pay');
		Route::get('/order/checkout/process', 'OrdersController@processCheckout')->name('checkout');
		Route::get('/order/tryAgain/{order_id}', 'OrdersController@doTryAgainPayment')->name('try_again_order');
		Route::post('/order/checkout/response', 'OrdersController@response');
	});
});

Route::group(['namespace' => 'V1\Backend'], function(){
	Route::get('/order/generatepdf/{ordernum?}','BaseController@generatePDF')->name('invoice_pdf');
});


// Route::group(['prefix' => 'admin', 'namespace' => 'V1\Backend'], function(){
// 	Route::get('login', 'HomeController@showLoginForm')->name('login');
// 	Route::post('login', 'HomeController@authenticate');
// });

/******* Back-end routes for admin, vendor, institution ********/
Route::group(['prefix' => 'admin', 'namespace' => 'V1\Backend'], function(){
	Route::get('/', function () {
	    return redirect()->route('login');
	});
	Route::get('/login', 'HomeController@showLoginForm')->name('login');
	Route::post('/login', 'HomeController@authenticate');
	Route::get('/order/detail/{ordernum?}', 'OrdersController@getOrderDetailsByOrderNumber')->name('order_detail');
	Route::get('/product/searchajax',['uses'=>'ProductsController@productSearchAjax'])->name('product_searchAjax');

	Route::group(['middleware' => ['auth:admin,vendor,institution']], function(){
		Route::get('/logout', 'HomeController@logout')->name('logout');
		Route::get('/profile', 'HomeController@showProfileForm')->name('profile');
		Route::post('/updateprofile', 'HomeController@updateProfile')->name('updateprofile');
		Route::get('/home', 'HomeController@index')->name('home');

		/************************
		******* Category ********
		************************/
		Route::get('/category/create',['uses'=>'CategoriesController@create'])->name('categories');
		Route::get('/category/list',['uses'=>'CategoriesController@index'])->name('category_list');
		Route::post('/category/store',['uses'=>'CategoriesController@store'])->name('category_store');
		Route::get('/category/edit/{id}',['uses'=>'CategoriesController@edit'])->name('category_edit');
		Route::post('/category/update/{id}',['uses'=>'CategoriesController@update'])->name('category_update');
		Route::get('/category/delete/{id}',['uses'=>'CategoriesController@destroy'])->name('category_destroy');
		Route::get('/category/changestatus/{id}/{status}',['uses'=>'CategoriesController@changestatus'])->name('category_changestatus');

		/************************
		******* Author **********
		************************/
		Route::get('/author/create',['uses'=>'AuthorsController@create'])->name('authors');
		Route::get('/author/list',['uses'=>'AuthorsController@index'])->name('author_list');
		Route::post('/author/store',['uses'=>'AuthorsController@store'])->name('author_store');
		Route::get('/author/edit/{id}',['uses'=>'AuthorsController@edit'])->name('author_edit');
		Route::post('/author/update/{id}',['uses'=>'AuthorsController@update'])->name('author_update');
		Route::get('/author/delete/{id}',['uses'=>'AuthorsController@destroy'])->name('author_destroy');
		Route::post('/author_ajaxstore',['uses'=>'AuthorsController@authorAjaxStore'])->name('author_ajaxstore');

		/************************
		******* Publisher *******
		************************/
		Route::get('/publisher/create',['uses'=>'publishersController@create'])->name('publishers');
		Route::get('/publisher/list',['uses'=>'publishersController@index'])->name('publisher_list');
		Route::post('/publisher/store',['uses'=>'publishersController@store'])->name('publisher_store');
		Route::get('/publisher/edit/{id}',['uses'=>'publishersController@edit'])->name('publisher_edit');
		Route::post('/publisher/update/{id}',['uses'=>'publishersController@update'])->name('publisher_update');
		Route::get('/publisher/delete/{id}',['uses'=>'publishersController@destroy'])->name('publisher_destroy');
		Route::post('/publisher_ajaxstore',['uses'=>'publishersController@publisherAjaxStore'])->name('publisher_ajaxstore');

		/************************
		******* Product *********
		************************/
		Route::get('/product/create',['uses'=>'ProductsController@create'])->name('products');
		Route::get('/product/list',['uses'=>'ProductsController@index'])->name('product_list');
		Route::post('/product/store',['uses'=>'ProductsController@store'])->name('product_store');
		Route::get('/product/edit/{id}',['uses'=>'ProductsController@edit'])->name('product_edit');
		Route::get('/product/view/{id}',['uses'=>'ProductsController@show'])->name('product_view');
		Route::post('/product/update/{id}',['uses'=>'ProductsController@update'])->name('product_update');
		Route::get('/product/delete/{id}',['uses'=>'ProductsController@destroy'])->name('product_destroy');
		Route::delete('/product/deleteImage/{id}/{uuid?}',['uses'=>'ProductsController@deleteImage'])->name('product_deleteImage');
		Route::get('/product/getImage/{id}/{uuid?}',['uses'=>'ProductsController@getImage'])->name('product_getImage');
		Route::get('/product/search/list/{product_name?}',['uses'=>'ProductsController@productSearch'])->name('product_search');
		Route::get('/product/createoffer/{id}',['uses'=>'ProductsController@productAddOffer'])->name('product_offer');
		Route::get('/product/storeoffer/{id}',['uses'=>'ProductsController@productStoreOffer'])->name('product_storeOffer');
		// Route::get('/product/searchajax',['uses'=>'ProductsController@productSearchAjax'])->name('product_searchAjax');


		Route::get('/attribute/product/list',['uses'=>'AttributeController@index'])->name('atr_create_list');
		Route::get('/attribute/product/create',['uses'=>'AttributeController@Create'])->name('atr_create');
		Route::post('/attribute/product/store',['uses'=>'AttributeController@Store'])->name('atr_store');
		Route::get('/attribute/specification/create',['uses'=>'AttributesController@specificationCreate'])->name('spe_create');
		Route::post('/attribute/specification/store',['uses'=>'AttributesController@specificationStore'])->name('spe_store');
		Route::get('/product_attribute_map/create',['uses'=>'AttributesController@productsAttributeCreate'])->name('pr_atr_create');
		Route::post('/product_attribute_map/store',['uses'=>'AttributesController@productsAttributeStore'])->name('pr_atr_store');

		/************************
		******* Vendor **********
		************************/
		Route::get('/vendor/create',['uses'=>'VendorsController@create'])->name('vendors');
		Route::get('/vendor/list',['uses'=>'VendorsController@index'])->name('vendor_list');
		Route::post('/vendor/store',['uses'=>'VendorsController@store'])->name('vendor_store');
		Route::get('/vendor/edit/{id}',['uses'=>'VendorsController@edit'])->name('vendor_edit');
		Route::get('/vendor/view/{id}',['uses'=>'VendorsController@show'])->name('vendor_view');
		Route::post('/vendor/update/{id}',['uses'=>'VendorsController@update'])->name('vendor_update');
		Route::get('/vendor/delete/{id}',['uses'=>'VendorsController@destroy'])->name('vendor_destroy');
		Route::get('/approved/vendor/list',['uses'=>'VendorsController@getApprovedVendorForm'])->name('approve_vendor_list');
		Route::post('/approved/vendor/list',['uses'=>'VendorsController@selectApprovedVendor'])->name('select_vendor_list');

		/************************
		******* Subject *********
		************************/
		Route::get('/subject/create',['uses'=>'SubjectsController@create'])->name('subjects');
		Route::get('/subject/list',['uses'=>'SubjectsController@index'])->name('subject_list');
		Route::post('/subject/store',['uses'=>'SubjectsController@store'])->name('subject_store');
		Route::get('/subject/edit/{id}',['uses'=>'SubjectsController@edit'])->name('subject_edit');
		Route::post('/subject/update/{id}',['uses'=>'SubjectsController@update'])->name('subject_update');
		Route::get('/subject/delete/{id}',['uses'=>'SubjectsController@destroy'])->name('subject_destroy');

		/************************
		******* Board **********
		************************/
		Route::get('/board/create',['uses'=>'BoardsController@create'])->name('boards');
		Route::get('/board/list',['uses'=>'BoardsController@index'])->name('board_list');
		Route::post('/board/store',['uses'=>'BoardsController@store'])->name('board_store');
		Route::get('/board/edit/{id}',['uses'=>'BoardsController@edit'])->name('board_edit');
		Route::post('/board/update/{id}',['uses'=>'BoardsController@update'])->name('board_update');
		Route::get('/board/delete/{id}',['uses'=>'BoardsController@destroy'])->name('board_destroy');

		/************************
		******* Standard ********
		************************/
		Route::get('/standard/create',['uses'=>'StandardsController@create'])->name('standards');
		Route::get('/standard/list',['uses'=>'StandardsController@index'])->name('standard_list');
		Route::post('/standard/store',['uses'=>'StandardsController@store'])->name('standard_store');
		Route::get('/standard/edit/{id}',['uses'=>'StandardsController@edit'])->name('standard_edit');
		Route::post('/standard/update/{id}',['uses'=>'StandardsController@update'])->name('standard_update');
		Route::get('/standard/delete/{id}',['uses'=>'StandardsController@destroy'])->name('standard_destroy');

		/************************
		******* Institution *****
		************************/
		Route::get('/institution/create',['uses'=>'InstitutionsController@create'])->name('institutions');
		Route::get('/institution/list',['uses'=>'InstitutionsController@index'])->name('institution_list');
		Route::post('/institution/store',['uses'=>'InstitutionsController@store'])->name('institution_store');
		Route::get('/institution/edit/{id}',['uses'=>'InstitutionsController@edit'])->name('institution_edit');
		Route::post('/institution/update/{id}',['uses'=>'InstitutionsController@update'])->name('institution_update');
		Route::get('/institution/delete/{id}',['uses'=>'InstitutionsController@destroy'])->name('institution_destroy');
		Route::get('/institution/boardstandard',['uses'=>'InstitutionsController@getBoardStandardForm'])->name('institution_board_standard');
		Route::post('/institution/assignboardstandard}',['uses'=>'InstitutionsController@assignBoardStandard'])->name('institution_assignboardstandard');
		Route::get('/institution/boardstandard/list',['uses'=>'InstitutionsController@getBoardStandardList'])->name('institution_boardstandard_list');
		Route::get('/institution/boardstandard/edit/{board_id}/{standard_id}',['uses'=>'InstitutionsController@getBoardStandardEditForm'])->name('institution_boardstandard_edit');
		Route::post('/institution/boardstandard/update/{board_id}/{standard_id}',['uses'=>'InstitutionsController@updateBoardStandard'])->name('institution_boardstandard_update');
		Route::get('/institution/boardstandard/changestatus/{id}/{status}',['uses'=>'InstitutionsController@changestatus'])->name('institution_boardstandard_changestatus');


		/************************
		******* Language ********
		************************/
		Route::get('/language/create',['uses'=>'LanguagesController@create'])->name('languages');
		Route::get('/language/list',['uses'=>'LanguagesController@index'])->name('language_list');
		Route::post('/language/store',['uses'=>'LanguagesController@store'])->name('language_store');
		Route::get('/language/edit/{id}',['uses'=>'LanguagesController@edit'])->name('language_edit');
		Route::post('/language/update/{id}',['uses'=>'LanguagesController@update'])->name('language_update');
		Route::get('/language/delete/{id}',['uses'=>'LanguagesController@destroy'])->name('language_destroy');
		
		/************************
		****** Attribute ********
		************************/
		Route::get('/attribute/create',['uses'=>'AttributesController@create'])->name('attributes');
		Route::get('/attribute/list',['uses'=>'AttributesController@index'])->name('attribute_list');
		Route::post('/attribute/store',['uses'=>'AttributesController@store'])->name('attribute_store');
		Route::get('/attribute/edit/{id}',['uses'=>'AttributesController@edit'])->name('attribute_edit');
		Route::post('/attribute/update/{id}',['uses'=>'AttributesController@update'])->name('attribute_update');
		Route::get('/attribute/delete/{id}',['uses'=>'AttributesController@destroy'])->name('attribute_destroy');
		Route::post('/attribute_ajaxstore/{product_id}',['uses'=>'AttributesController@attributeAjaxStore'])->name('attribute_ajaxstore');
		Route::post('/attribute_ajaxupdate',['uses'=>'AttributesController@attributeAjaxUpdate'])->name('attribute_ajaxupdate');
		Route::post('/attribute_ajaxdelete',['uses'=>'AttributesController@attributeAjaxDelete'])->name('attribute_ajaxdelete');

		/************************
		******** Bookset ********
		************************/
		Route::get('/bookset/create',['uses'=>'BooksetsController@create'])->name('booksets');
		Route::get('/bookset/list',['uses'=>'BooksetsController@index'])->name('bookset_list');
		Route::post('/bookset/store',['uses'=>'BooksetsController@store'])->name('bookset_store');
		Route::get('/bookset/edit/{id}',['uses'=>'BooksetsController@edit'])->name('bookset_edit');
		Route::post('/bookset/update/{id}',['uses'=>'BooksetsController@update'])->name('bookset_update');
		Route::get('/bookset/delete/{id}',['uses'=>'BooksetsController@destroy'])->name('bookset_destroy');
		Route::post('/standard_ajaxget',['uses'=>'BooksetsController@getStandardListByAjax'])->name('standard_ajaxget');
		Route::post('/subject_ajaxget',['uses'=>'BooksetsController@getSubjectListByAjax'])->name('subject_ajaxget');
		Route::delete('/bookset/deleteImage/{id}/{uuid?}',['uses'=>'BooksetsController@deleteImage'])->name('bookset_deleteImage');
		Route::get('/bookset/getImage/{id}/{uuid?}',['uses'=>'BooksetsController@getImage'])->name('bookset_getImage');
		Route::post('/booklist_ajaxget',['uses'=>'BooksetsController@getBookListByAjax'])->name('booklist_ajaxget');
		Route::get('/booksetlist/forvendor',['uses'=>'BooksetsController@getBooksetListForVendor'])->name('booksetlist_forvendor');
		Route::post('/booksetlist/vendorprice',['uses'=>'BooksetsController@addBooksetPrice'])->name('bookset_vendorprice');
		Route::get('/booksetlist/forinstitution/{id}',['uses'=>'BooksetsController@getBooksetInfoForInstitution'])->name('booksetlist_forinstitution');
		Route::get('/bookset/preffered/{id}/{vendor_id}',['uses'=>'BooksetsController@setBooksetPreffered'])->name('bookset_preffered');
		//});

		/************************
		******* Report **********
		************************/
		Route::get('/report/product_list/{vendor_id?}',['uses'=>'ReportsController@index'])->name('report_product_list');
		Route::get('/report/order_list/{vendor_id?}',['uses'=>'ReportsController@getOrderList'])->name('report_order_list');
		//Route::get('order/detail/{ordernum?}', 'OrdersController@getOrderDetailsByOrderNumber')->name('order_detail');
		Route::get('/report/product_export/{vendor_id?}',['uses'=>'ReportsController@productListExport'])->name('report_product_export');

		/************************
		******* Courier *********
		************************/
		Route::get('/courier/order_list',['uses'=>'CouriersController@index'])->name('success_order_list');
		Route::post('/courier/update',['uses'=>'CouriersController@update'])->name('courier_update');
		Route::post('/courier_ajaxget',['uses'=>'CouriersController@getCourierInfoByAjax'])->name('courier_ajaxget');

		/************************
		******* Order **********
		************************/
		Route::match(['GET','POST'], '/order/sell_list', ['uses'=>'OrdersController@getSellOrderList'])->name('sell_order_list');
		Route::get('/transaction_ajaxget',['uses'=>'HomeController@getTransactionByAjax'])->name('transaction_ajaxget');
	});
});
