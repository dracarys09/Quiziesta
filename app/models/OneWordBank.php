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
	protected $fillable = array('course_id','deleted','instructor_id','category_id','problem_statement','image','answer');
	public static $no = "no";
	public static $yes = "yes";

	public static function get_questions($course_id,$instructor_id)
	{
		$qry 	=	OneWordBank::where('course_id','=',$course_id)->where('instructor_id','=',$instructor_id)->where('deleted','=',static::$no)->get();
		
		return $qry;
	}

	public static function store_question($course_id,$data)
	{
		$question  	=	new OneWordBank;

		$question->course_id			=	$course_id;
		$question->instructor_id		=	Auth::user()->id;
		$question->category_id			=	3;
		$question->problem_statement	=	$data['problem_statement'];
		$question->answer 				= 	$data['correct_answer'];
		$question->deleted 				=	static::$no;

		if($question->save())
		{
			return true;
		}
		
		return false;
	}

	public static function remove_question($question_id)
	{
		$question = OneWordBank::find($question_id);
		$question->deleted = static::$yes;

		if($question->save())
		{
			return true;
		}
		return false;
	}

	public static function find_by_id($id)
	{
		return OneWordBank::find($id);
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
