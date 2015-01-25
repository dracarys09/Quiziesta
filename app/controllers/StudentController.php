<?php 


class StudentController extends BaseController{


	public function dashboard()
	{
		$entity = Auth::user();
		return View::make('student.dashboard')->with('entity',$entity);
	}

	public function add_course()
	{
		$entity = Auth::user();

		$courses 	=	Course::get_total_courses();

		return View::make('student.add_new_course')->with('entity',$entity)->with('courses',$courses);
	}

	public function remove_course()
	{
		$entity 	=	Auth::user();

		$qry 	=	StudentCourses::get_all_courses(Auth::user()->id);

		$courses = array();
		$i = 0;
		foreach($qry as $course)
		{
			$courses[$i++] = Course::find($course->course_id);
		}

		return View::make('student.remove_course')->with('entity',$entity)->with('courses',$courses);
	}

	public function store_courses()
	{
		if(isset($_POST['enrol']))
		{
			$status = StudentCourses::enrol($_POST['enrol']);

			if($status == 1)
			{
				return Redirect::route('student_add_course')->with('flash_message',"You have registered succesfully in the selected course...");
			}
			else if($status == 2)
			{
				return Redirect::back()->with('flash_message',"You are already registered for this course...");
			}
			else
			{
				return Redirect::route('student_add_course')->with('flash_message',"Enrolment can not be done at the moment...Please try again after sometime!");
			}
		}
	}

	public function delete_course()
	{
		if(isset($_POST['remove']))
		{
			if(StudentCourses::drop_course($_POST['remove']))
			{
				return Redirect::route('student_remove_course')->with('flash_message',"Selected course has been dropped succesfully...");
			}
			else
			{
				return Redirect::route('student_remove_course')->with('flash_message',"You can not remove this course at this moment...Please try again after sometime!");
			}
		}
	}

	public function show_courses()
	{
		$entity 	=	Auth::user();

		$qry 	=	StudentCourses::get_all_courses(Auth::user()->id);

		$courses = array();
		$i = 0;
		foreach($qry as $course)
		{
			$courses[$i++] = Course::find($course->course_id);
		}

		return View::make('student.my_courses')->with('entity',$entity)->with('courses',$courses);
	}

}