<?php 


class InstructorController extends BaseController{

	public function dashboard()
	{
		$entity 	=	Auth::user();
		return View::make('instructor.dashboard')->with('entity',$entity);
	}

	public function add_course()
	{
		$entity		=	Auth::user();
		return View::make('instructor.add_new_course')->with('entity',$entity);
	}

	public function remove_course()
	{
		$entity		=	Auth::user();

		$courses    =   Course::get_all_courses(Auth::user()->id);

		return View::make('instructor.remove_course')->with('entity',$entity)->with('courses',$courses);
	}

	public function manage_course()
	{
		$entity		=	Auth::user();

		$courses 	=	Course::get_all_courses(Auth::user()->id);

		return View::make('instructor.manage_courses')->with('entity',$entity)->with('courses',$courses);
	}

	public function store_new_course()
	{
		if(Course::isValid(Input::all()))
		{
			if(Course::store_new_course(Input::all()))
			{
				return Redirect::route('add_course')->with('flash_message',"A new course has been added successfully...");
			}
			else 
			{
				return Redirect::route('add_course')->with('flash_message',"A new course can not be saved at this moment... Please try again after sometime!");		
			}
		}
		
		return Redirect::back()->withInput()->withErrors(Course::$errors);
	}

	public function delete_course()
	{
		if(isset($_POST['delete']))
		{
			if(Course::delete_course($_POST['delete']))
			{
				return Redirect::route('remove_course')->with('flash_message',"Selected course has been deleted successfully...");
			}
			else
			{
				return Redirect::route('remove_course')->with('flash_message',"Selected course can not be deleted at this moment... Please try again after sometime!");
			}
		}
	}

	public function show()
	{

	}

}