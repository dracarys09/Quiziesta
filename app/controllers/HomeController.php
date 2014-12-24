<?php

class HomeController extends BaseController {


	public function login()
	{
		$attempt = Auth::attempt(array(

			'email'		=>	Input::get('email'),
			'password'	=>	Input::get('password'),
			'type'		=>	Input::get('entity')

			));

		if($attempt)
		{
			$user 	=	Auth::user();
			$type 	=	$user->type;

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
			return Redirect::back()->withInput()->with('flash_message',"Invalid Credentials...Please try again!");
		}
	}

	public function store()
	{
		$entity = Input::get('entity');

		$flag = 0;

		if(User::isValid(Input::all()))
		{
			if($entity == "student")
			{
				if(Student::isValid(Input::all()))
				{
					/* Storing information in student table */
					if(Student::store_student_info(Input::get('rollno'), Input::get('batch')))
					{
						/* Setting a flag to indicate that the person is a valid student */
						$flag = 1;
					}
				}
				else
				{
					return Redirect::back()->withInput()->with('flash_message',Student::$errors." Please try again...");
				}
			}
			else if($entity == "instructor")
			{
				if(Instructor::isValid(Input::all()))
				{
					/* Storing information in instructor table */
					if(Instructor::store_instructor_info(Input::get('email')))
					{
						/*Setting a flag to indicate that the person is a valid instructor*/
						$flag = 2;
					}
				}
				else
				{
					return Redirect::back()->withInput()->with('flash_message',Instructor::$errors." Please try again...");
				}
			}

			/* Storing remaining information in the users table */
			if(User::store_user_info(Input::all(),$flag))
			{
				/* Redirecting to the login page if registration is successful */
				return Redirect::to('/')->with('flash_message',"Registration Successful...You can now login from below!");
			}
		}			
		else 
		{
			return Redirect::back()->withInput()->with('flash_message',User::$errors." Please try again...");
		}
			
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('/')->with('flash_message',"You have been successfully logged out...");
	}

	public function email()
	{
		
	}

}
