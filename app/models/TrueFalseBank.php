<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class TrueFalseBank extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'truefalsebank';

	/**
	*	Fillable columns of truefalsebank table.
	*
	*	@var array
	*/
	protected $fillable = array('category_id','deleted','instructor_id','course_id','problem_statement','image','answer');
	
	public static $no = "no";
	public static $yes = "yes";

	/**
	*	@author Abhijeet Dubey 
	*
	*	Retrieves all the True/False Questions for a course offered by an instructor.
	*
	*	@param $course_id ID of course, $instructor_id ID of instructor.
	*
	*	@return array Returns an array containing all the True/False Questions for a course offered by an instructor.
	*/

	public static function get_questions($course_id,$instructor_id)
	{
		$qry 	=	TrueFalseBank::where('course_id','=',$course_id)->where('instructor_id','=',$instructor_id)->where('deleted','=',static::$no)->get();
		
		return $qry;
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Stores a new True/False Question in truefalsebank table.
	*
	*	@param $course_id ID of course, $data Array that contains all the details of a True/False Question.
	*
	*	@return boolean Returns true if the information is saved successfully and false otherwise.
	*/

	public static function store_question($course_id,$data)
	{
		$question 	=	new TrueFalseBank;

		$question->course_id		=	$course_id;
		$question->instructor_id	=	Auth::user()->id;
		$question->category_id		=	4;
		$question->problem_statement=	$data['problem_statement'];
		$question->answer			=	$data['correct_answer'];
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
	*	@return boolean Returns true if the modification is successful and false otherwise.
	*/

	public static function remove_question($question_id)
	{
		$question = TrueFalseBank::find($question_id);
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
	*	Finds a True/False Question by it's ID.
	*
	*	@param $id ID of True/False Question.
	*
	*	@return array Returns an array that contains all the details about a perticular True/False Question.
	*/

	public static function find_by_id($id)
	{
		return TrueFalseBank::find($id);
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
