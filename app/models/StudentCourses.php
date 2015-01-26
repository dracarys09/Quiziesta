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

	/**
	*	Fillable columns of student_courses table.
	*
	*	@var array
	*/
	protected $fillable = array('user_id','courses_id');

	/**
	*	Contains all the errors if validation fails.
	*
	*	@var array
	*/
	public static $errors;
	
	public static $no = "no";
	public static $yes = "yes";


	/**
	*	@author Abhijeet Dubey 
	*
	*	Retrieves all the courses for a perticular user.
	*
	*	@param $id ID of student/instructor
	*
	*	@return array Returns an array that contains all the courses for a perticular user.
	*/

	public static function get_all_courses($id)
	{
		$courses = StudentCourses::where('user_id','=',$id)->where('deleted','=',static::$no)->get();
		return $courses;
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Enrol a student in a course.	
	*
	*	@todo This function needs modification.
	*
	*	@param $course_id ID of course.
	*
	*	@return
	*/

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

	/**
	*	@author Abhijeet Dubey 
	*
	*	Drop a course.
	*
	*	@param $course_id ID of course.
	*
	*	@return boolean Returns true if a course is dropped successfully and false otherwise.
	*/

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
