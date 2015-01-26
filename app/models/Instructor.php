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

	/**
	*	Fillable columns of instructor table.
	*
	*	@var array
	*/
	protected $fillable = array('email');

	/**
	*	Contains all the error messages if validation fails.
	*
	* 	@var array
	*/
	public static $errors;

	/* These are the set of rules that user input must follow in order to pass the validation. */
	public static $rules  =  [

				'email'	=>	'required|unique:instructor'

	];
	
	/**
	*	@author Abhijeet Dubey 
	*
	*	Checks if entered instructor information follows standard rules.
	*
	*	@param $data Array that contains user input. 
	*
	*	@return boolean Returns true if validation passes and false otherwise.
	*/

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

	/**
	*	@author Abhijeet Dubey 
	*
	*	Store instructor details in instructor table.
	*
	*	@param $email Email address of an instructor.
	*
	*	@return boolean Returns true if information is saved successfully and false otherwise.
	*/

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
