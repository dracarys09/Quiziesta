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

Route::post('/login',array(

	'as'	=>	'login',
	'uses'	=>	'HomeController@login'

	));

Route::get('/student/dashboard',array(

	'as'	=>	'student_dashboard',
	'uses'	=>	'StudentController@dashboard'

	))->before('auth');

Route::get('/instructor/dashboard',array(

	'as'	=>	'instructor_dashboard',
	'uses'	=>	'InstructorController@dashboard'

	))->before('auth');

Route::get('/logout',array(

	'as'	=>	'logout',
	'uses'	=>	'HomeController@logout'

	))->before('auth');






