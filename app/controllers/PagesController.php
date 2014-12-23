<?php 


class PagesController extends BaseController{


	public function home()
	{
		if(Auth::check())
		{
			$type	=	Auth::user()->type;
			if($type == "student")
			{
				return Redirect::route('student_dashboard');
			}
			else if($type == "instructor")
			{
				return Redirect::route('instructor_dashboard');
			}
		}
		else
		{
			return View::make('home');
		}
	}

	public function signup()
	{	
		if(Auth::check())
		{
			$type	=	Auth::user()->type;
			if($type == "student")
			{
				return Redirect::route('student_dashboard');
			}
			else if($type == "instructor")
			{
				return Redirect::route('instructor_dashboard');
			}
		}
		else
		{
			return View::make('register');	
		}
	}
}