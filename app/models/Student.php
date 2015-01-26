<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Student extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'student';

	/**
	*	Fillable columns of student table.
	*
	*	@var array
	*/
	protected $fillable = array('rollno','batch');


	/**
	*	Contains all the errors if validation fails.
	*
	*	@var array.
	*/
	public static $errors;

	/* These are the set of rules that user input must follow in order to pass the validation. */
	/**
	*	Set of rules used to validate a student.
	*
	*	@var array
	*/
	public static $rules  =  [

				'rollno'	=>	'required|max:10|unique:student',
				'batch'		=>	'required'

	];
	
	/* Method to validate a student */
	/**
	*	@author Abhijeet Dubey 
	*
	*	Checks if the entered student student information follows standard rules or not.
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
	*	Stores student information in student table.
	*
	*	@param $rollno Roll Number of student, $batch Batch of student.
	*
	*	@return boolean Returns true if the information is saved successfully and false otherwise.
	*/

	public static function store_student_info($rollno, $batch)
	{
		$student = new Student;
		$student->rollno 	=	$rollno;
		$student->batch 	=	$batch;
		
		if($student->save())
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
