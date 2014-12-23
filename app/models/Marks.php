<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Marks extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'marks';
	protected $fillable = array('course_id','quiz_id','student_id','instructor_id','marks_obtained','total_marks','present');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
