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

		$quizzes = Quiz::all();

		$attended_quizzes = Attended_Quizzes::find_attended_quizzes(Auth::user()->id);
		$attempted_quizzes = array();
		$i = 0;
		foreach($attended_quizzes as $quiz)
		{
			$attempted_quizzes[$i++] = Quiz::get_quiz($quiz->quiz_id);
		}
		
		$counter = 0;

		return View::make('student.my_courses')->with('entity',$entity)->with('attempted_quizzes',$attempted_quizzes)->with('courses',$courses)->with('quizzes',$quizzes)->with('counter',$counter);
	}

	public function take_quiz($quiz_id)
	{

		$qry 		=	Attended_Quizzes::check(Auth::user()->id,$quiz_id);
		if(count($qry) > 0)
		{
			return Redirect::route('my_courses')->with('flash_message',"You have already attempted this quiz...");
		}

		$mcq		=	Quiz_Questions::get_quiz_questions($quiz_id,"mcq");
		shuffle($mcq);

		$oneword 	=	Quiz_Questions::get_quiz_questions($quiz_id,"oneword");
		shuffle($oneword);

		$truefalse	=	Quiz_Questions::get_quiz_questions($quiz_id,"truefalse");
		shuffle($truefalse);

		$entity 	=	Auth::user();

		$quiz 		=	Quiz::get_quiz($quiz_id);

		$temp		=	Quiz::find($quiz_id);
		$temp 		=	$temp->course_id;
		$course 	=	Course::find($temp);

		return View::make('quiz.student_take_quiz')->with('entity',$entity)->with('quiz',$quiz)->with('course',$course)->with('mcq',$mcq)->with('oneword',$oneword)->with('truefalse',$truefalse);
	}

}






