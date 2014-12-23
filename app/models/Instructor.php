<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Instructor extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'instructor';
	protected $fillable = array('email');

	/* This variable contains all the error messages if validation fails. */
	public static $errors;

	/* These are the set of rules that user input must follow in order to pass the validation. */
	public static $rules  =  [

				'email'	=>	'required|unique:instructor'

	];
	
	/* Method to validate a student */
	public static function isValid($data)
	{
		$validation = Validator::make($data,static::$rules);

		if($validation->passes())
		{
			return true;
		}

		static::$errors 	=	$validation->messages();

		return false;
	}

	public static function store_instructor_info($email)
	{
		$instructor = new Instructor;
		$instructor->email = $email;
		
		if($instructor->save())
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
