<?php

return [
	'ca_name' => 'Name',
	'ca_action' => 'Action',
	'ca_status' => 'Status',
	'ca_print' => 'Print',
	'ca_add_test' => 'Add Test',
	'ca_delete_test' => 'Delete Test',
	'ca_create_test' => 'Create Test',
	'ca_ct' => 'Chapter/Topic',
	'ca_st' => 'Subject/Topic',
	'ca_section' => 'Section',
	'ca_add_cp' => 'Add Chapter/Topic',
	'ca_add_st' => 'Add Subject/Topic',
	'ca_add_section' => 'Add Section',
	'ca_delete_section' => 'Delete Section',
	'ca_heading' => 'Heading Name',
	'ca_question_type' => 'Question Type',
	'ca_section_description' => 'Section Description',
	'ca_question_per_mark' => 'Marks Per Question',
	'ca_total_mark' => 'Total Mark',
	'ca_total_question' => 'Total Question',
	'ca_add_question' => 'Add Question',
	'ca_delete_question' => 'Delete Question',
	'ca_assign_ct' => 'Assign Chapter/Topic',
	'ca_delete_assign_ct' => 'Delete Assigned Chapter/Topic',
	'ca_que_from' => 'Questions From',
	'ca_que_selection' => 'Question Selection',
	'ca_tc_bank' => 'TC Question Bank',
	'ca_your_bank' => 'Your Question Bank',
	'ca_academic' => 'State Boards',
	'ca_competitive' => 'Competitive',
	'ca_auto' => 'Auto',
	'ca_manual' => 'Manual',
	'ca_admin_login' => 'Admin Login',
	'ca_admin_login' => 'Admin Login',
	'ca_tutor_login' => 'Tutor Sign In',
	'ca_tutor_signup' => 'Tutor Sign Up',
	'ca_admin_registration' => 'Admin Registration',
	'ca_tutor_registration' => 'Tutor Registration',
	'ca_tutor' => 'Tutor',
	'ca_profile' => 'Profile',
	'ca_institute' => 'Institute',
	'ca_login' => 'Login',
	'ca_registration' => 'Registration',
	'ca_whoops' => 'Whoops!',
	'ca_there_were_problems_with_input' => 'There were problems with input',
	'ca_email' => 'Email',
	'ca_password' => 'Password',
	'ca_forgot_password' => 'Forgot Password?',
	'ca_forgot_pass' => 'Forgot Password',
	'ca_reset_password' => 'Reset Password',
	'ca_remember_me' => 'Remember me',
	'ca_title' => 'Admin',
	'ca_dashboard' => 'Dashboard',
	'ca_dashboard_text' => 'You are logged in!',
	'ca_logout' => 'Logout',
	'ca_change_password' => 'Change password',
	'ca_add_new' => 'Add new',
	'ca_register' => 'Register',
	'ca_signup' => 'Sign Up',
	'ca_signin' => 'Sign In',
	'ca_add' => 'Add',
	'ca_list' => 'List',
	'ca_view' => 'View',
	'ca_create' => 'Create',
	'ca_edit' => 'Edit',
	'ca_delete' => 'Delete',
	'ca_update' => 'Update',
	'ca_save' => 'Save',
	'ca_submit' => 'Submit',
	'ca_cancel' => 'Cancel',
	'ca_serial_number' => 'Sr.No.',
	'ca_are_you_sure' => 'Are you sure?',
	'ca_no_entries_in_table' => 'No entries in table',
	'ca_delete_selected' => 'Delete selected',
	'ca_create_successfully' => 'Created successfully!',
	'ca_create_failed' => 'Create failed!',
	'ca_update_successfully' => 'Updated successfully!',
	'ca_update_failed' => 'Update failed!',
	'ca_profile_update_success' => 'Profile Updated successfully',
	'ca_profile_update_failed' => 'Profile Updated failed!',
	'ca_delete_confirmation' => 'Are you sure you want to delete this record?',
	'ca_test_publish_successfully' => 'Test Published successfully',
	'ca_test_publish_failed' => 'Test Published failed!',
	'ca_testpackage_publish_failed' => 'Test Package is not Published Please check all tests are published!',
	'user-management' => 'User Management',
	'ca_change_password' => 'Change password',
	'ca_current_password' => 'Current password',
	'ca_new_password' => 'New password',
	'ca_password_confirm' => 'New password confirmation',
	'ca_hint' => 'Hint',
	'ca_explaination' => 'Explaination',
	'ca_true' => 'True',
	'ca_false' => 'False',
	'ca_transaction_history' => 'Last 5 Transactions',
	'ca_see_more' => 'View More',
	'ca_verify_code' => 'Verify the Code',
	'ca_resend_code' => 'Resend verification code',
	'ca_signup_text' => 'Do Not Have An Account?',
	'ca_signin_text' => 'Already Have An Account?',	

	'users' => [
		'title' => 'Users',
		'fields' => [
				'id' => 'User Id',
				'name' => 'User Name',
				'email' => 'Email',
				'password' => 'Password',
				'type' => 'User Type',
				'is-active' => 'Is Active',
				'level' => 'User Level',
				'photo' => 'Image',
				'select' => 'Please Select User',
		]
	],

	'institutes' => [
		'title' => 'Institutes',
		'fields' => [
				'id' => 'Institute Id',
				'name' => 'Institute Name',
				'is-active' => 'Is Active',
				'photo' => 'Image',
				'select' => 'Please Select Institute',
		]
	],

	'tutors' => [
		'title' => 'Tutors',
		'fields' => [
				'id' => 'Tutor Id',
				'name' => 'Tutor Name',
				'email' => 'Email',
				'password' => 'Password',
				'phone' => 'Mobile Number',
				'status' => 'Status',
				'is-active' => 'Is Active',
				'account' => 'Account Type',
				'photo' => 'Image',
				'select' => 'Please Select Tutor',
		]
	],

	'user_types' => [
		'title' => 'User Types',
		'fields' => [
				'id' => 'User Type Id',
				'name' => 'User Type Name',
				'is-active' => 'Is Active',
				'level' => 'User Level',
				'photo' => 'Image',
				'select' => 'Please Select User Type',
		]
	],

	'course_types' => [
		'title' => 'Course Types',
		'fields' => [
				'id' => 'Course Type Id',
				'name' => 'Course Type Name',
				'is-active' => 'Is Active',
				'photo' => 'Image',
				'select' => 'Please Select Course Type',
		]
	],

	'boards' => [
		'title' => 'Boards',
		'fields' => [
				'id' => 'Board Id',
				'name' => 'Board Name',
				'is-active' => 'Is Active',
				'photo' => 'Image',
				'select' => 'Please Select Board',
		]
	],

	'subjects' => [
		'title' => 'Subjects',
		'fields' => [
				'id' => 'Subject Id',
				'name' => 'Subject Name',
				'is-active' => 'Is Active',
				'photo' => 'Image',
				'select' => 'Please Select Subject',
		]
	],

	'standards' => [
		'title' => 'Standards',
		'fields' => [
				'id' => 'Standard Id',
				'name' => 'Standard Name',
				'is-active' => 'Is Active',
				'photo' => 'Image',
				'select' => 'Please Select Standard',
		]
	],

	'courses' => [
		'title' => 'Courses',
		'fields' => [
				'id' => 'Course Id',
				'name' => 'Course Name',
				'type' => 'Course Type',
				'is-active' => 'Is Active',
				'photo' => 'Image',
				'select' => 'Please Select Course',
		]
	],

	'test_types' => [
		'title' => 'Test Types',
		'fields' => [
				'id' => 'Test Type Id',
				'name' => 'Test Type Name',
				'is-active' => 'Is Active',
				'select' => 'Please Select Test Type',
		]
	],

	'chapters' => [
		'title' => 'Chapters',
		'fields' => [
				'id' => 'Chapter Id',
				'name' => 'Chapter Name',
				'is-active' => 'Is Active',
				'select' => 'Please Select Chapter',
		]
	],

	'units' => [
		'title' => 'Units',
		'fields' => [
				'id' => 'Unit Id',
				'name' => 'Unit Name',
				'is-active' => 'Is Active',
				'select' => 'Please Select Unit',
		]
	],

	'topics' => [
		'title' => 'Topics',
		'fields' => [
				'id' => 'Topic Id',
				'name' => 'Topic Name',
				'is-active' => 'Is Active',
				'select' => 'Please Select Topic',
		]
	],

	'course_subjects' => [
		'title' => 'Course Subject',
		'fields' => [
				'id' => 'Course Subject Id',
				'course-name' => 'Course Name',
				'subject-name' => 'Subject Name',
		]
	],

	'board_standard_subjects' => [
		'title' => 'Board Standard Subject',
		'fields' => [
				'id' => 'Board Standard Subject Id',
				'board-name' => 'Board Name',
				'standard-name' => 'Standard Name',
				'subject-name' => 'Subject Name',
		]
	],

	'test_packages' => [
		'title' => 'Test Package',
		'fields' => [
				'id' => 'Test Package Id',
				'name' => 'Test Package Name',
				'sale-price' => 'Sale Price',
				'list-price' => 'List Price',
				'sale-price-tcd' => 'Sale Price TCD',
				'list-price-tcd' => 'List Price TCD',
				'type' => 'Course type',
				'is-active' => 'Is Publish',
				'description' => 'Package Description',
				'number' => 'Number of Test',
				'board-name' => 'Board Name',
				'standard-name' => 'Standard Name',
				'subject-name' => 'Subject Name',
				'course-name' => 'Course Name',
				'photo' => 'Image',
				'status' => 'Status',
		]
	],

	'tests' => [
		'title' => 'Tests',
		'fields' => [
				'id' => 'Test Id',
				'name' => 'Test Name',
				'difficulty-level' => 'Difficulty Level',
				'duration' => 'Duration (In Min.)',
				'question' => 'Total Question',
				'marks' => 'Total Marks',
				'is-active' => 'Is Active',
				'select' => 'Please Select Test',
				'status' => 'Status',
		]
	],

	'questions' => [
		'title' => 'Questions',
		'fields' => [
				'id' => 'Question Id',
				'title' => 'Title',
				'name' => 'Question Text',
				'mark' => 'Marks',
				'difficulty-level' => 'Difficulty Level',
				'is-active' => 'Is Active',
				'type' => 'Question type',
				'option' => 'Options',
				'min' => 'Min Value',
				'max' => 'Max Value',
		]
	],

	'test_chapter_topic' => [
		'title' => 'Test Chapter Topic',
		'fields' => [
				'id' => 'Test Chapter Topic Id',
				'weightage' => 'Weightage(%)',
		]
	],

	'test_subject_topic' => [
		'title' => 'Test Subject Topic',
		'fields' => [
				'id' => 'Test Subject Topic Id',
				'weightage' => 'Weightage(%)',
		]
	],

	'purchase_packages' => [
		'title' => 'Purchase Packages',
		'fields' => [
				'id' => 'Purchase Packages Id',
				'invoice-number' => 'Invoice Number',
				'payment-number' => 'Payment Order',
				'transaction-number' => 'Transaction Number',
				'student-name' => 'Student Name',
				'amount' => 'Amount',
				'qty' => 'Quantity',
				'sale-price' => 'TestPackageSalePrice',
				'payment-date' => 'PaymentDate',
				'status' => 'Status',
		]
	],
];