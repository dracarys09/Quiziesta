<?php

Route::get('/temp',function() {

	return View::make('temp');

});

Route::get('/', 'PagesController@home');

Route::get('/signup',array(

	'as'	=>	'signup',
	'uses'	=>	'PagesController@signup'

	));

Route::post('/signup',array(

	'as'	=>	'signup',
	'uses'	=>	'HomeController@store'

	));

Route::get('/login',array(

	'as'	=>	'login',
	'uses'	=>	'PagesController@home'

	));

Route::post('/login',array(

	'as'	=>	'login',
	'uses'	=>	'HomeController@login'

	));

Route::get('/student/dashboard',array(

	'as'	=>	'student_dashboard',
	'uses'	=>	'StudentController@dashboard'

	))->before('auth');

Route::get('/entity/dashboard',array(

	'as'	=>	'dashboard',
	'uses'	=>	'PagesController@dashboard'

	))->before('auth');

Route::get('/instructor/dashboard',array(

	'as'	=>	'instructor_dashboard',
	'uses'	=>	'InstructorController@dashboard'

	))->before('auth');

Route::get('/logout',array(

	'as'	=>	'logout',
	'uses'	=>	'HomeController@logout'

	))->before('auth');

Route::get('instructor/dashboard/add_course',array(

	'as'	=>	'add_course',
	'uses'	=>	'InstructorController@add_course'

	))->before('auth');


Route::get('instructor/dashboard/remove_course',array(

	'as'	=>	'remove_course',
	'uses'	=>	'InstructorController@remove_course'

	))->before('auth');


Route::get('instructor/dashboard/manage_course',array(

	'as'	=>	'manage_course',
	'uses'	=>	'InstructorController@manage_course'

	))->before('auth');

Route::post('/entity/dashboard',array(

	'as'	=>	'send_email',
	'uses'	=>	'HomeController@email'

	))->before('auth');

Route::post('/instructor/dashboard/add_course',array(

	'as'	=>	'add_course',
	'uses'	=>	'InstructorController@store_new_course'

	))->before('auth');

Route::post('/instructor/dashboard/remove_course',array(

	'as'	=>	'remove_course',
	'uses'	=>	'InstructorController@delete_course'

	))->before('auth');

Route::get('/instructor/dashboard/show_course/{course_id}',array(

	'as'	=>	'show_course',
	'uses'	=>	'InstructorController@show'

	))->before('auth');


Route::post('/instructor/dashboard/create_quiz',array(

	'as'	=>	'create_quiz',
	'uses'	=>	'QuizController@store_new_quiz'

	))->before('auth');

Route::get('/instructor/dashboard/view_performance/{course_id}',array(

	'as'	=>	'view_performance',
	'uses'	=>	'QuizController@show_performance'

	))->before('auth');

Route::get('/instructor/dashboard/manage_question_bank/{course_id}',array(

	'as'	=>	'manage_question_bank',
	'uses'	=>	'QuizController@manage_question_bank'

	))->before('auth');

Route::get('/instructor/dashboard/insert_questions/{quiz_id}',array(

	'as'	=>	'insert_quiz_questions',
	'uses'	=>	'QuizController@insert_quiz_questions'

	))->before('auth');

Route::post('/instructor/dashboard/insert_questions',array(

	'as'	=>	'insert_quiz_questions',
	'uses'	=>	'QuizController@store_quiz_questions'

	))->before('auth');

Route::post('/instructor/dashboard/manage_question_bank',array(

	'as'	=>	'manage_question_bank',
	'uses'	=>	'QuizController@add_question'

	))->before('auth');

Route::post('/instructor/dashboard/manage_question_bank/remove_question',array(

	'as'	=>	'remove_question',
	'uses'	=>	'QuizController@remove_question'

	))->before('auth');

Route::get('/instructor/dashboard/show_quiz/{quiz_id}',array(

	'as'	=>	'show_quiz',
	'uses'	=>	'QuizController@show_quiz'

	))->before('auth');

Route::get('/student/dashboard/add_course',array(

	'as'	=>	'student_add_course',
	'uses'	=>	'StudentController@add_course'

	))->before('auth');

Route::get('/student/dashboard/remove_course',array(

	'as'	=>	'student_remove_course',
	'uses'	=>	'StudentController@remove_course'

	))->before('auth');

Route::post('/student/dashboard/add_course',array(

	'as'	=>	'student_add_course',
	'uses'	=>	'StudentController@store_courses'

	))->before('auth');

Route::post('/student/dashboard/remove_course',array(

	'as'	=>	'student_remove_course',
	'uses'	=>	'StudentController@delete_course'

	))->before('auth');

Route::get('/student/dashboard/my_courses',array(

	'as'	=>	'my_courses',
	'uses'	=>	'StudentController@show_courses'

	))->before('auth');

