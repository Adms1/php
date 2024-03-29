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

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('tutor_login');
});


/******* Front-end routes for user ********/
Route::group(['prefix' => 'admin', 'namespace' => 'V1\Backend'], function(){

	Route::get('login', 'LoginController@showAdminLoginForm')->name('admin_login');
	Route::post('login', 'LoginController@Adminlogin')->name('admin_login');
	Route::get('register', ['uses'=>'UserController@register'])->name('admin_register');
	Route::get('register', ['uses'=>'UserController@register'])->name('admin_profile');
	Route::resource('users', 'UserController');
	// Change Password Routes...
	Route::get('change_password', ['uses'=>'LoginController@showChangePasswordForm'])->name('change_password');
	Route::patch('change_password', ['uses'=>'LoginController@changePassword'])->name('change_password');

	Route::group(['middleware' => 'auth:admin,tutor'], function(){
		Route::post('logout', 'LoginController@logout')->name('logout');
		Route::get('home', 'HomeController@index')->name('home');

		/*************************
		********* User ***********
		**************************/
		//Route::resource('users', 'UserController');

		/*************************
		********* Tutor ***********
		**************************/
		Route::resource('tutors', 'TutorController');

		/*************************
		******* User Type ********
		**************************/
		Route::resource('userTypes', 'UserTypesController');

		/*************************
		****** Course Type *******
		**************************/
		Route::resource('courseTypes', 'CourseTypesController');

		/*************************
		******** Institute *******
		**************************/
		Route::resource('institutes', 'InstitutesController');

		/*************************
		********** Board *********
		**************************/
		Route::resource('boards', 'BoardsController');

		/*************************
		********* Course *********
		**************************/
		Route::resource('courses', 'CoursesController');

		/*************************
		********* Standard *******
		**************************/
		Route::resource('standards', 'StandardsController');
		Route::post('standard_ajaxget',['uses'=>'StandardsController@getStandardListByAjax'])
			->name('standard_ajaxget');

		/*************************
		********* Subject ********
		**************************/
		Route::resource('subjects', 'SubjectsController');
		Route::post('subject_ajaxget',['uses'=>'SubjectsController@getSubjectListByAjax'])
			->name('subject_ajaxget');

		/*************************
		******* Test Type ********
		**************************/
		Route::resource('testTypes', 'TestTypesController');
		Route::post('testTypeData_ajaxget', ['uses'=>'TestTypesController@testTypeData_ajaxget'])->name('testTypeData_ajaxget');

		/*************************
		**** Course Subjects *****
		**************************/
		Route::resource('courseSubjects', 'CourseSubjectsController');

		/*************************
		* Board Standard Subject *
		**************************/
		Route::resource('boardStandardSubjects', 'BoardStandardSubjectsController');

		/*************************
		****** Test Package ******
		**************************/
		Route::resource('testPackages', 'TestPackagesController');
	});
});

Route::group(['prefix' => 'tutor', 'namespace' => 'V1\Backend'], function(){
	Route::get('login', 'LoginController@showTutorLoginForm')->name('tutor_login');
	Route::post('login', 'LoginController@Tutorlogin')->name('tutor_login');
	Route::get('register', ['uses'=>'TutorController@register'])->name('tutor_register');
	// Change Password Routes...
	Route::get('change_password', ['uses'=>'LoginController@showChangePasswordForm'])->name('change_password');
	Route::patch('change_password', ['uses'=>'LoginController@changePassword'])->name('change_password');
	
	Route::get('forgot_password', ['uses'=>'LoginController@showForgotPasswordForm'])->name('forgot_password');
	Route::post('check_mobile', ['uses'=>'LoginController@checkMobileRegister'])->name('check_mobile');
	Route::get('set_password', ['uses'=>'LoginController@showSetPasswordForm'])->name('set_password');
	Route::post('set_password', ['uses'=>'LoginController@setPassword'])->name('set_password');


	Route::post('institute_ajaxget',['uses'=>'InstitutesController@getInstituteListByAjax'])
			->name('institute_ajaxget');

	Route::get('purchasePackages/detail/{invoicenum?}', 'purchasePackagesController@getPurchasePackageDetailByInvoiceNumber')->name('invoice_detail');

	/*************************
	********* Tutor ***********
	**************************/
	Route::resource('tutors', 'TutorController');
	Route::get('tutor_profile', ['uses'=>'TutorController@showTutorProfile'])->name('tutor_profile');
	Route::put('tutor_profile', ['uses'=>'TutorController@updateTutorProfile'])->name('tutor_profile');

	Route::post('reSendOtp', ['uses'=>'TutorController@reSendOtp'])->name('resendotp');
	Route::get('activeTutor/{id}', ['uses'=>'TutorController@activeTutorByID'])->name('active_tutor');

	Route::group(['middleware' => 'auth:tutor'], function(){
		//Route::post('logout', 'LoginController@logout')->name('logout');
		Route::post('upload_image', 'HomeController@uploadImage')->name('upload');

		Route::post('subject_ajaxget',['uses'=>'SubjectsController@getSubjectListByAjax'])
			->name('subject_ajaxget');
		Route::post('standard_ajaxget',['uses'=>'StandardsController@getStandardListByAjax'])
			->name('standard_ajaxget');

		/*************************
		****** Test Package ******
		**************************/
		Route::resource('testPackages', 'TestPackagesController', ['parameters' => ['edit' => 'tab']]);
		Route::post('packageDetail_ajaxdelete',['uses'=>'TestPackagesController@packageDetail_ajaxdelete'])->name('packageDetail_ajaxdelete');

		Route::get('testCreate/{id}',['uses'=>'TestPackagesController@testCreate'])->name('test_create');
		Route::post('testStore',['uses'=>'TestPackagesController@testStore'])->name('test_store');
		Route::get('testEdit/{id}/{test_id}',['uses'=>'TestPackagesController@testEdit'])->name('test_edit');
		//Route::post('testEdit',['uses'=>'TestPackagesController@testEdit'])->name('test_edit');
		Route::put('testUpdate/{id}',['uses'=>'TestPackagesController@testUpdate'])->name('test_update');
		Route::post('test_ajaxView',['uses'=>'TestPackagesController@test_ajaxView'])->name('test_ajax_view');
		Route::post('test_ajaxdelete',['uses'=>'TestPackagesController@test_ajaxdelete'])->name('test_ajaxdelete');
		Route::get('testPublish/{id}/{test_id}',['uses'=>'TestPackagesController@testPublish'])->name('test_publish');

		Route::post('assignChapterTopic',['uses'=>'TestPackagesController@assignChapterTopic'])->name('assign_ct');
		Route::post('deleteAssignChapterTopic',['uses'=>'TestPackagesController@deleteAssignChapterTopic'])->name('delete_assign_ct');
		Route::get('assignChapterTopicList',['uses'=>'TestPackagesController@getAssignChapterTopicList'])->name('get_assign_list');
		
		Route::post('addSection',['uses'=>'TestPackagesController@addSection'])->name('add_section');
		Route::post('deleteSection',['uses'=>'TestPackagesController@deleteSection'])->name('delete_section');
		Route::get('getSectionList',['uses'=>'TestPackagesController@getSectionList'])->name('get_section_list');

		Route::post('assignSubjectTopic',['uses'=>'TestPackagesController@assignSubjectTopic'])->name('assign_st');
		Route::post('deleteAssignSubjectTopic',['uses'=>'TestPackagesController@deleteAssignSubjectTopic'])->name('delete_assign_st');

		/*************************
		******* Questions ********
		**************************/
		Route::resource('questions', 'QuestionsController');
		Route::post('question_ajaxget',['uses'=>'QuestionsController@getQuestionByAjax'])->name('question_ajaxget');
		Route::get('getQuestionFormate',['uses'=>'QuestionsController@getQuestionFormate'])->name('get_question_format');
		Route::post('getSectionQuestionList',['uses'=>'QuestionsController@getSectionQuestionList'])->name('get_sec_que_list');
		Route::post('selectQuestion',['uses'=>'QuestionsController@addSelectedQuestion'])->name('select_question');
		Route::post('deleteQuestion',['uses'=>'QuestionsController@deleteSelectedQuestion'])->name('delete_question');
		Route::POST('datatableQuestion',['uses'=>'QuestionsController@getDatatablesData'])->name('datatable_question_data');
		Route::post('difficulty_ajaxget',['uses'=>'QuestionsController@getDifficultyByAjax'])->name('difficulty_ajaxget');

		/*************************
		********* Units **********
		**************************/
		Route::resource('units', 'UnitsController');
		Route::post('unit_ajaxget',['uses'=>'UnitsController@getUnitListByAjax'])->name('unit_ajaxget');

		/*************************
		*** Purchase Packages ****
		**************************/
		Route::resource('purchasePackages', 'purchasePackagesController');
		Route::get('/transaction_ajaxget',['uses'=>'purchasePackagesController@getTransactionByAjax'])->name('transaction_ajaxget');

		/*************************
		******** Chapters ********
		**************************/
		Route::resource('chapters', 'ChaptersController');
		Route::post('chapter_ajaxget',['uses'=>'ChaptersController@chapter_ajaxget'])->name('chapter_ajaxget');

		/*************************
		********* Topics *********
		**************************/
		Route::resource('topics', 'TopicsController');
		Route::post('topic_ajaxget',['uses'=>'TopicsController@topic_ajaxget'])->name('topic_ajaxget');
		Route::post('courseTopic_ajaxget',['uses'=>'TopicsController@topicByCourse_ajaxget'])->name('courseTopic_ajaxget');
	});
});