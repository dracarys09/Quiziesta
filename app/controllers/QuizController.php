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

	public function insert_quiz_questions($quiz_id)
	{
		$entity 	=	Auth::user();

		$course_id 	=	Quiz::get_course_id($quiz_id);
		
		$mcq 		=	MCQBank::get_questions($course_id,Auth::user()->id);

		$oneword 	=	OneWordBank::get_questions($course_id,Auth::user()->id);

		$truefalse 	=	TrueFalseBank::get_questions($course_id,Auth::user()->id);

		return View::make('quiz.insert_quiz_questions')->with('entity',$entity)->with('quiz_id',$quiz_id)->with('mcq',$mcq)->with('oneword',$oneword)->with('truefalse',$truefalse);
	}

	public function store_quiz_questions()
	{
		$ctr1 = 0;
		$ctr2 = 0;
		if(isset($_POST['mcq_button']))
		{
			$quiz_id 	=	$_POST['mcq_button'];
			if(@$_POST['mcq'] != "")
			{
				foreach($_POST['mcq'] as $mcq)
				{
					$marks 	=	Input::get($mcq);
					
					$ctr1++;
					
					if(Quiz_Questions::store_question($quiz_id,$mcq,$marks,"mcq"))
					{
						$ctr2++;
					}
				}
			}
			else
			{
				return Redirect::back()->with('flash_message',"You didn't select any checkbox...Select some questions that you want to add this time");
			}
			
		}
		else if(isset($_POST['oneword_button']))
		{	
			$quiz_id 	=	$_POST['oneword_button'];
			if(@$_POST['oneword'] != "")
			{
				foreach($_POST['oneword'] as $oneword)
				{
					$marks 	=	Input::get($oneword);
					
					$ctr1++;

					if(Quiz_Questions::store_question($quiz_id,$oneword,$marks,"oneword"))
					{
						$ctr2++;
					}
				}
			}
			else
			{
				return Redirect::back()->with('flash_message',"You didn't select any checkbox...Select some questions that you want to add this time");
			}
		}
		else if(isset($_POST['truefalse_button']))
		{
			$quiz_id 	=	$_POST['truefalse_button'];
			if(@$_POST['truefalse'] != "")
			{
				foreach($_POST['truefalse'] as $truefalse)
				{
					$marks 	=	Input::get($truefalse);

					$ctr1++;

					if(Quiz_Questions::store_question($quiz_id,$truefalse,$marks,"truefalse"))
					{
						$ctr2++;
					}
				}
			}
			else
			{
				return Redirect::back()->with('flash_message',"You didn't select any checkbox...Select some questions that you want to add this time");
			}	
		}

		if($ctr1 == $ctr2)
		{
			return Redirect::back()->with('flash_message',"Selected questions have been saved successfully...");
		}
		else 
		{
			return Redirect::back()->with('flash_message',"There is some server problem and some of the selected questions can not be saved right now...Please try again later!");
		}
	}

	public function show_quiz($quiz_id)
	{
		$entity 	=	Auth::user();

		$quiz 		=	Quiz::get_quiz($quiz_id);

		$mcq_quiz_questions 		=	Quiz_Questions::get_quiz_questions($quiz_id,"mcq");

		$one_word_quiz_questions	=	Quiz_Questions::get_quiz_questions($quiz_id,"oneword");

		$true_false_quiz_questions	=	Quiz_Questions::get_quiz_questions($quiz_id,"truefalse");	

		$temp	=	Quiz::find($quiz_id);
		$temp 	=	$temp->course_id;
		$course =	Course::find($temp);

		return View::make('quiz.show_quiz')->with('course',$course)->with('entity',$entity)->with('quiz',$quiz)->with('mcq_quiz_questions',$mcq_quiz_questions)->with('one_word_quiz_questions',$one_word_quiz_questions)->with('true_false_quiz_questions',$true_false_quiz_questions);
	}

	public function submit_quiz()
	{
		$student_id = Auth::user()->id;
		if(isset($_POST['submit_quiz']))
		{
			$quiz_id 	= 	$_POST['submit_quiz'];
			
			//get mcq questions	
			$mcq 		=	Quiz_Questions::get_quiz_questions($quiz_id,"mcq");

			//get oneword questions
			$oneword 	=	Quiz_Questions::get_quiz_questions($quiz_id,"oneword");

			//get truefalse questions
			$truefalse 	=	Quiz_Questions::get_quiz_questions($quiz_id,"truefalse");

			//save all mcq answers
			foreach($mcq as $question)
			{
				$name = "mcq".$question->id;

				if(@$_POST[$name] != "")
				{
					foreach($_POST[$name] as $answer)
					{
						$marks = Quiz_Questions::get_marks(2,$question->id);
						Student_Answers::submit_answer($question->id,Auth::user()->id,$quiz_id,$question->course_id,2,$question->correct_answer,$answer,$marks);
					}
				}
			}

			//save all truefalse answers
			foreach($truefalse as $question)
			{
				$name = "truefalse".$question->id;

				if(@$_POST[$name] != "")
				{
					$answer = $_POST[$name];
					$marks = Quiz_Questions::get_marks(4,$question->id);
					Student_Answers::submit_answer($question->id,Auth::user()->id,$quiz_id,$question->course_id,4,$question->answer,$answer,$marks);
				}
			}

			//save all oneword answers
			foreach($oneword as $question)
			{
				$name = "oneword".$question->id;

				if(@$_POST[$name] != "")
				{
					$answer = $_POST[$name];
					$marks = Quiz_Questions::get_marks(3,$question->id);
					Student_Answers::submit_answer($question->id,Auth::user()->id,$quiz_id,$question->course_id,3,$question->answer,$answer,$marks);
				}
			}

			$course_id = Quiz::find($quiz_id)->course_id;
			
			Marks::store_marks($course_id,$quiz_id,$student_id);


			if(Attended_Quizzes::mark_present(Auth::user()->id,$quiz_id))
			{
				$entity = Auth::user();
				return Redirect::route('my_courses')->with('flash_message',"Your answers have been submitted successfully...You can view your marks now!");
			}
		}
	}

	public function student_view_performance($quiz_id)
	{
		$quiz = Quiz::get_quiz($quiz_id);
		
		$entity 	=	Auth::user();

		$marks = Marks::get_marks(Auth::user()->id,$quiz_id);

		return View::make('student.view_marks')->with('entity',$entity)->with('marks',$marks);
	}

}









