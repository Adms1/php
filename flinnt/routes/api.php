<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'V1\API'], function(){
	Route::post('/getBookList', 'ApiController@getBookList');
	Route::post('/getBookDetail', 'ApiController@getBookDetail');
	Route::post('/getBookListRelatedToBook', 'ApiController@getBookListRelatedToBook');
	Route::post('/getOtherVendorListRelatedToBook', 'ApiController@getOtherVendorListRelatedToBook');

	Route::post('/getCartList', 'ApiController@getCartList');
	Route::post('/cartStore', 'ApiController@cartStore');
	Route::post('/cartUpdate', 'ApiController@cartUpdate');
	Route::post('/cartDestroy', 'ApiController@cartDestroy');

	Route::post('/getBooksetList', 'ApiController@getBooksetList');
	Route::post('/getBooksetDetail', 'ApiController@getBooksetDetail');

	Route::get('/getLanguageList', 'ApiController@getLanguageList');
	Route::get('/getStateList', 'ApiController@getStateList');
	Route::get('/getAuthorList', 'ApiController@getAuthorList');
	Route::get('/getBoardList', 'ApiController@getBoardList');
	Route::get('/getPublisherList', 'ApiController@getPublisherList');
	Route::get('/getFilterList', 'ApiController@getFilterList');

	Route::post('/addUserAddress', 'ApiController@addUserAddress');
	Route::post('/getUserAddressList', 'ApiController@getUserAddressList');
	Route::post('/updateUserAddress', 'ApiController@updateUserAddress');
	Route::post('/addressDestroy', 'ApiController@addressDestroy');

	Route::post('/getFilteredBookList', 'ApiController@getFilteredBookList');

});