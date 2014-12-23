<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Course extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'course';
	protected $fillable = array('course_name','course_number','instructor_id','description','start_date','end_date','course_contents');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
