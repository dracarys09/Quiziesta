<?php 


class QuizController extends BaseController{

	public function store_new_quiz()
	{
		if(isset($_POST['create']))
		{
			$course_id = $_POST['create'];

			if(Quiz::store_new_quiz($course_id,Input::all()))
			{
				return Redirect::route('manage_course')->with('flash_message',"Quiz has been saved successfully...Now you can add questions to the quiz!");
			}
			else
			{
				return Redirect::back()->with('flash_message',"Quiz can not be created at this moment...Please try again later");
			}
		}
	}

	public function show_performance()
	{
		return "Under Construction";
	}

	public function manage_question_bank($course_id)
	{
		$entity 	=	Auth::user();

		$mcq 		=	MCQBank::get_questions($course_id,$entity->id);
		$oneword	=	OneWordBank::get_questions($course_id,$entity->id);
		$truefalse  =	TrueFalseBank::get_questions($course_id,$entity->id);

		return View::make('quiz.manage_question_bank')->with('entity',$entity)->with('course_id',$course_id)->with('mcq',$mcq)->with('oneword',$oneword)->with('truefalse',$truefalse); 	
	}

	public function store_question_bank()
	{
		return "Under Construction";
	}

	public function update_question_bank()
	{
		return "Under Construction";
	}

	public function add_question()
	{
		if(isset($_POST['add_mcq']))
		{
			$course_id	=	$_POST['add_mcq']; 
		
			if(MCQBank::store_question($course_id,Input::all()))
			{
				return Redirect::back()->with('flash_message',"A new MCQ has been added successfully...");
			}
			else
			{
				return Redirect::back()->with('flash_message',"A new question can not be added at this moment...Please try again later!");
			}
		}
		else if(isset($_POST['add_oneword']))
		{
			$course_id	=	$_POST['add_oneword'];	
		
			if(OneWordBank::store_question($course_id,Input::all()))
			{
				return Redirect::back()->with('flash_message',"A new One Word Question has been added successfully...");
			}
			else
			{
				return Redirect::back()->with('flash_message',"A new question can not be added at this moment...Please try again later!");
			}
		}
		else if(isset($_POST['add_truefalse']))
		{
			$course_id	=	$_POST['add_truefalse'];
			
			if(TrueFalseBank::store_question($course_id,Input::all()))
			{
				return Redirect::back()->with('flash_message',"A new True/False Question has been added successfully...");
			}
			else
			{
				return Redirect::back()->with('flash_message',"A new question can not be added at this moment...Please try again later!");
			}
		}
	}

	public function remove_question()
	{
		if(isset($_POST['deletemcq']))
		{
			$question_id 	=	$_POST['deletemcq'];
			if(MCQBank::remove_question($question_id))
			{
				return Redirect::back()->with('flash_message',"The selected MCQ has been successfully deleted...");
			}
			else 
			{
				return Redirect::back()->with('flash_message',"This question can not be deleted at this moment...Please try again later!");
			}
		}
		else if(isset($_POST['deleteoneword']))
		{
			$question_id 	=	$_POST['deleteoneword'];
			if(OneWordBank::remove_question($question_id))
			{
				return Redirect::back()->with('flash_message',"The selected One Word Question has been successfully deleted...");
			}
			else 
			{
				return Redirect::back()->with('flash_message',"This question can not be deleted at this moment...Please try again later!");
			}
		}
		else if(isset($_POST['deletetruefalse']))
		{
			$question_id 	=	$_POST['deletetruefalse'];
			if(TrueFalseBank::remove_question($question_id))
			{
				return Redirect::back()->with('flash_message',"The selected True/False Question has been successfully deleted...");
			}
			else 
			{
				return Redirect::back()->with('flash_message',"This question can not be deleted at this moment...Please try again later!");
			}
		}
	}

	public function insert_quiz_questions($course_id)
	{
		$entity 	=	Auth::user();
		$quizes 	=	Quiz::where('course_id','=',$course_id)->where('instructor_id','=',$entity->id)->get();

		return View::make('quiz.insert_quiz_questions')->with('entity',$entity)->where('quizzes',$quizzes);
	}

}