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


	/**
	*	Fillable columns of the course table
	*
	*	@var array
	*/
	protected $fillable = array('course_name','course_number','instructor_id','description','start_date','deleted','end_date','course_contents');

	/**
	*	Contains all the errors if validation fails
	*
	*	@var array
	*/
	public static $errors;
	
	public static $no = "no";
	public static $yes = "yes";

	/**
	*	Set of rules used to validate a course
	*
	*	@var array
	*/

	public static $rules  = [

			'course_name'		=>	'required|min:4|max:50',
			'course_number'		=>	'required|min:3|max:10',
			'course_description'=>	'required|min:10|max:300',
			'course_contents'	=>	'required|min:10|max:300',
			'start_date'		=>	'required',
			'end_date'			=>	'required'
	];


	/**
	*	@author Abhijeet Dubey
	*
	*	Checks if the entered course information follow standard rules.
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
	*	Stores the course information in course table.
	*
	*	@param $data Array that contains user input for the course.
	*
	*	@return boolean Returns true if course information saved successfully and false otherwise.
	*/

	public static function store_new_course($data)
	{
		$course = new Course;

		$course->course_name 			=	$data['course_name'];
		$course->course_number			=	$data['course_number'];
		$course->instructor_id 			=	Auth::user()->id;
		$course->description 			=	$data['course_description'];
		$course->start_date 			=	$data['start_date'];
		$course->end_date 				=	$data['end_date'];
		$course->course_contents		=	$data['course_contents'];
		$course->deleted 				=	static::$no;

		if($course->save())
		{
			return true;
		}

		return false;
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Retrieve all valid courses for the instructor.
	*
	*	@param $id ID of an instructor.
	*
	*	@return array Returns an array containing all the valid courses offered by the instructor
	*/

	public static function get_all_courses($id)
	{
		$courses = Course::where('instructor_id','=',$id)->where('deleted','=',static::$no)->get();

		return $courses;
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Retrieve all the courses from course table.
	*
	*	@param none.
	*
	*	@return array Returns an array containing all the data in course table.
	*/

	public static function get_total_courses()
	{
		$courses 	=	Course::all();
		return $courses;
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Makes a course invalid by setting deleted attributed to yes.
	*
	*	@param $id ID of course.
	*
	*	@return boolean Returns true if operation is successful and false otherwise.
	*/
	public static function delete_course($id)
	{
		/* set deleted = "yes" in courses table */
		$course = Course::find($id);

		$course->deleted = "yes";
		$course->save();
		
		/* set deleted = "yes" in mcqbank table */
		$mcq 	=	MCQBank::where('course_id','=',$id)->get();
		foreach ($mcq as $temp) 
		{
			$temp->deleted 	=	"yes";
			$temp->save();
		}

		/* set deleted = "yes" in onewordbank table */
		$oneword 	=	OneWordBank::where('course_id','=',$id)->get();
		foreach ($oneword as $temp) 
		{
			$temp->deleted 	=	"yes";
			$temp->save();
		}

		/* set deleted = "yes" in truefalsebank table */
		$truefalse 	=	TrueFalseBank::where('course_id','=',$id)->get();
		foreach ($truefalse as $temp) 
		{
			$temp->deleted 	=	"yes";
			$temp->save();
		}

		return true;

	}


	/**
	*	@author Abhijeet Dubey 
	*
	*	Retrives information of a perticular course.
	*
	*	@param $course_id ID of course
	*
	*	@return array Returns an array containing all the information about a perticular course.
	*/

	public static function get_course_info($course_id)
	{
		return Course::find($course_id);
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

}
