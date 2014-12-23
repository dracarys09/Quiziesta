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
	protected $fillable = array('course_id','instructor_id','problem_statement','option1','option2','opiton3','option4','image','category_id','correct_answer');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
