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

Route::get('/instructor/dashboard/show_course',array(

	'as'	=>	'show_course',
	'uses'	=>	'InstructorController@show'

	))->before('auth');






