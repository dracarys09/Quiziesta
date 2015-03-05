<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Attended_Quizzes extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'attended_quizzes';


	/**
	*	Fillable columns of the table.
	*
	*	@var array
	*/
	protected $fillable = array('student_id','quiz_id');


	/**
	*	@author Abhijeet Dubey
	*
	*	Saves the information in attended_quizzes table to mark present.
	*
	*	@param 	$student_id ID of student, $quiz_id ID of quiz. 
	*
	*	@return boolean  Returns true if attendance saved successfully and false otherwise.
	*/
	public static function mark_present($student_id,$quiz_id)
	{
		$qry	=	new Attended_Quizzes;

		$qry->student_id	=	$student_id;
		$qry->quiz_id		=	$quiz_id;

		if($qry->save())
		{
			return true;
		}
		
		return false;
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Checks if a student has already attempted the quiz or not.
	*
	*	@param $student_id ID of student, $quiz_id ID of quiz.
	*
	*
	*	@return array Returns an array containing the attendence information.
	*/

	public static function check($student_id,$quiz_id)
	{
		$qry	=	Attended_Quizzes::where('student_id','=',$student_id)->where('quiz_id','=',$quiz_id)->get();
		return $qry;
	}

	public static function find_attended_quizzes($student_id)
	{
		return Attended_Quizzes::where('student_id','=',$student_id)->get();
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
