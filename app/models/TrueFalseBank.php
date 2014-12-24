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
	protected $fillable = array('category_id','deleted','instructor_id','course_id','problem_statement','image','answer');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
