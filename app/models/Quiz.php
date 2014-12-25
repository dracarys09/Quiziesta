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
	protected $fillable = array('course_id','instructor_id','quiz_title','quiz_date','start_time','end_time','set_visible');

	public static $errors;

	/* Validation will be performed here */


	/* Save info in quiz table */
	public static store_new_quiz($course_id,$data)
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
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
