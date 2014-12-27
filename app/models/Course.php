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
	protected $fillable = array('course_name','course_number','instructor_id','description','start_date','deleted','end_date','course_contents');

	public static $errors;
	public static $no = "no";
	public static $yes = "yes";

	public static $rules  = [

			'course_name'		=>	'required|min:4|max:50',
			'course_number'		=>	'required|min:3|max:10',
			'course_description'=>	'required|min:10|max:300',
			'course_contents'	=>	'required|min:10|max:300',
			'start_date'		=>	'required',
			'end_date'			=>	'required'
	];



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

	public static function get_all_courses($id)
	{
		$courses = Course::where('instructor_id','=',$id)->where('deleted','=',static::$no)->get();

		return $courses;
	}

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
