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
	protected $fillable = array('rollno','batch');


	/* This variable contains all the error messages if validation fails. */
	public static $errors;

	/* These are the set of rules that user input must follow in order to pass the validation. */
	public static $rules  =  [

				'rollno'	=>	'required|max:10|unique:student',
				'batch'		=>	'required'

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
