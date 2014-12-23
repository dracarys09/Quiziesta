<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class OneWordBank extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'onewordbank';
	protected $fillable = array('course_id','instructor_id','category_id','problem_statement','image','answer');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
