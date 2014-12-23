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

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
