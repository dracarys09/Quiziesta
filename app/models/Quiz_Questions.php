<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Quiz_Questions extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'quiz_questions';

	/**
	*	Fillable columns of quiz_questions table.
	*
	*	@var array
	*/
	protected $fillable = array('quiz_id','category_id','question_id','marks');

	/**
	*	@author Abhijeet Dubey 
	*
	*	Stores information about a quiz question in quiz_questions table.
	*
	*	@param $quiz_id ID of quiz, $question_id ID of a question belonging to a perticular category, $marks total marks for this question, $type Type(category) of question.
	*
	*	@return boolean Returns true if information is saved successfully and false otherwise.
	*/

	public static function store_question($quiz_id,$question_id,$marks,$type)
	{
		if($type == "mcq")
		{
			$question 		=	MCQBank::find($question_id);
		}
		else if($type == "oneword")
		{
			$question 		=	OneWordBank::find($question_id);
		}
		else
		{
			$question 		=	TrueFalseBank::find($question_id);
		}

		$quiz_question 	=	new Quiz_Questions;

		$quiz_question->quiz_id 	=	$quiz_id;
		$quiz_question->category_id	=	$question->category_id;
		$quiz_question->question_id	=	$question_id;
		$quiz_question->marks 		=	$marks;

		if($quiz_question->save())
		{
			return true;
		}

		return false;
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Retrieves questions of a perticular category for a quiz.
	*
	*	@param $quiz_id ID of quiz, $type Type(category) of questions to be retrieved.
	*
	*	@return array Returns an array that contains all the questions of a perticular category belonging to a perticular quiz.
	*/

	public static function get_quiz_questions($quiz_id,$type)
	{
		$ans = array();
		$i = 0;
		if($type == "mcq")
		{
			$questions 	=	Quiz_Questions::where('quiz_id','=',$quiz_id)->where('category_id','=',2)->get();
			foreach($questions as $temp)
			{
				$qry 	=	MCQBank::find_by_id($temp->question_id);
				$ans[$i++]	=	$qry;
			}
		}
		else if($type == "oneword")
		{
			$questions 	=	Quiz_Questions::where('quiz_id','=',$quiz_id)->where('category_id','=',3)->get();
			foreach($questions as $temp)
			{
				$qry 	=	OneWordBank::find_by_id($temp->question_id);
				$ans[$i++]	=	$qry;
			}
		}
		else if($type == "truefalse")
		{
			$questions 	=	Quiz_Questions::where('quiz_id','=',$quiz_id)->where('category_id','=',4)->get();
			foreach($questions as $temp)
			{
				$qry 	=	TrueFalseBank::find_by_id($temp->question_id);
				$ans[$i++]	=	$qry;
			}
		}

		return $ans;
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Retrieves the total marks decided by an instructor for a question of a perticular category.
	*
	*	@param $category_id ID of category of a question, $question_id ID of question.
	*
	*	@return int Returns total marks for a perticular question belonging to a perticular category.
	*/

	public static function get_marks($category_id,$question_id)
	{
		$qry 	=	Quiz_Questions::where('category_id','=',$category_id)->where('question_id','=',$question_id)->first();
		
		$marks 	= $qry->marks;
		
		return $marks;
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
