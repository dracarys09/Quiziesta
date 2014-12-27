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
	protected $fillable = array('quiz_id','category_id','question_id','marks');


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
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
