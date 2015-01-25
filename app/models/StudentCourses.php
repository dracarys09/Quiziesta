<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class StudentCourses extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'student_courses';
	protected $fillable = array('user_id','courses_id');

	public static $errors;
	public static $no = "no";
	public static $yes = "yes";



	public static function get_all_courses($id)
	{
		$courses = StudentCourses::where('user_id','=',$id)->where('deleted','=',static::$no)->get();
		return $courses;
	}

	public static function enrol($course_id)
	{
		$check = StudentCourses::where('course_id','=',$course_id)->where('deleted','=',static::$no)->get();
		$status = 0;
		if(count($check) > 0)
		{
			$status = 2;
		}
		else
		{
			$check = StudentCourses::where('course_id','=',$course_id)->where('deleted','=',static::$yes)->get();
			
			if(count($check) > 0)
			{
				foreach ($check as $temp)
				{
					$temp->delete();
				}
			}

			$course = new StudentCourses;

			$course->user_id 		= 	Auth::user()->id;
			$course->course_id 		=	$course_id;
			$course->deleted 		=	static::$no;

			if($course->save())
			{
				$status = 1;
			}
		}

		return $status;
	}

	public static function drop_course($course_id)
	{
		$course = StudentCourses::where('course_id','=',$course_id)->first();
		$course->deleted = static::$yes;
		if($course->save())
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
