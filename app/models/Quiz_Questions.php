<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Quiz_Questions extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'quiz_questions';
	protected $fillable = array('quiz_id','category_id','question_id','marks');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
