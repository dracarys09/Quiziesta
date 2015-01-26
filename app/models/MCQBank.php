<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class MCQBank extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mcqbank';

	/**
	*	Fillable columns of mcqbank table.
	*
	*	@var array
	*/
	protected $fillable = array('course_id','instructor_id','deleted','problem_statement','option1','option2','opiton3','option4','image','category_id','correct_answer');
	
	public static $no = "no";
	public static $yes = "yes";

	/**
	*	@author Abhijeet Dubey 
	*
	*	Retrieves all the MCQs for a course offered by an instructor.
	*
	*	@param $course_id ID of course, $instructor_id ID of instructor.
	*
	*	@return array Returns an array that contains all MCQs for a course offered by an instructor.
	*/

	public static function get_questions($course_id,$instructor_id)
	{
		$qry 	=	MCQBank::where('course_id','=',$course_id)->where('instructor_id','=',$instructor_id)->where('deleted','=',static::$no)->get();
		return $qry;
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Store a new MCQ for a course in mcqbank table.
	*
	*	@param $course_id ID of course, $data Array that contains details of MCQ.
	*
	*	@return boolean Returns true if the information is saved successfully and false otherwise.
	*/

	public static function store_question($course_id,$data)
	{
		$question 	=	new MCQBank;

		$question->course_id 		=	$course_id;
		$question->instructor_id	=	Auth::user()->id;
		$question->problem_statement=	$data['problem_statement'];
		$question->option1			=	$data['option1'];
		$question->option2			=	$data['option2'];
		$question->option3			=	$data['option3'];
		$question->option4			=	$data['option4'];
		$question->correct_answer	=	$data['correct_option'];
		$question->category_id		=	2;
		$question->deleted 			=	static::$no;

		if($question->save())
		{
			return true;
		}

		return false;
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Make a valid question invalid.
	*
	*	@param $question_id ID of question.
	*
	*	@return boolean Returns true if modification is successful and false otherwise.
	*/

	public static function remove_question($question_id)
	{
		$question = MCQBank::find($question_id);
		$question->deleted = static::$yes;

		if($question->save())
		{
			return true;
		}
		return false;
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Finds a question by its ID value.
	*
	*	@param $id ID of MCQ.
	*
	*	@return array Returns an array containing details of the question.
	*/

	public static function find_by_id($id)
	{
		return MCQBank::find($id);
	}


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
