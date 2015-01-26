<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Quiz extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'quiz';

	/**
	*	Fillable columns of quiz table.
	*
	*	@var array
	*/
	protected $fillable = array('course_id','instructor_id','quiz_title','quiz_date','start_time','end_time','set_visible');

	/**
	*	Contains all the errors if validation fails.
	*
	*	@var array
	*/
	public static $errors;


	/* Validation will be performed here */
	/**
	*	@author Abhijeet Dubey 
	*
	*	Checks if the entered Quiz information follows standard rules. 
	*	
	*	@todo This function will be implemented later.
	*
	*	@param $data Array that contains data to be checked for validity.
	*
	*	@return boolean Returns true if the input is valid and false otherwise.
	*/
	public static function isValid($data)
	{

	}

	/* Save info in quiz table */
	/**
	*	@author Abhijeet Dubey 
	*
	*	Stores the Quiz information in quiz table.
	*
	*	@param $course_id ID of course, $data Array that contains all the details of the Quiz.
	*
	*	@return boolean Returns true if the information is saved successfully and false otherwise.
	*/

	public static function store_new_quiz($course_id,$data)
	{
		$quiz = new Quiz;
		$quiz->course_id 		=	$course_id;
		$quiz->instructor_id	=	Auth::user()->id;
		$quiz->quiz_title		=	$data['quiz_title'];
		$quiz->quiz_date		=	$data['quiz_date'];
		$quiz->start_time		=	$data['start_time'];
		$quiz->end_time 		=	$data['end_time'];
		$quiz->set_visible		=	"false";

		if($quiz->save())
		{
			return true;
		}

		return false;
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Retrieves all the quizzes for an instructor.
	*
	*	@param $entity_id ID of instructor.
	*
	*	@return array Returns an array that contains all the quizzes created by an instructor.
	*/

	public static function get_all_quizzes($entity_id)
	{
		return Quiz::where('instructor_id','=',$entity_id)->get();
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Retrieves all the quizzes for a course offered by an instructor.
	*
	*	@param $course_id ID of course, $entity_id ID of an instructor.
	*
	*	@return array Returns an array that contains all the quizzes for a course offered by an instructor.
	*/

	public static function get_course_quizzes($course_id,$entity_id)
	{
		return Quiz::where('instructor_id','=',$entity_id)->where('course_id','=',$course_id)->get();
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Finds a quiz by it's ID.
	*
	*	@param $quiz_id ID of quiz.
	*
	*	@return array Returns an array that contains all the details about a perticular quiz.
	*/

	public static function get_quiz($quiz_id)
	{
		return Quiz::find($quiz_id);
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Finds the ID of a course to which a Quiz belongs.
	*
	*	@param $quiz_id ID of quiz.
	*
	*	@return int Returns the ID of a course (if found) to which a quiz belongs and 0 otherwise.
	*/

	public static function get_course_id($quiz_id)
	{
		$qry = Quiz::find($quiz_id);

		if(count($qry) > 0)
		{
			return $qry->course_id;
		}
		return 0;
	}

	


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
