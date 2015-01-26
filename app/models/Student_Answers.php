<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Student_Answers extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'student_answers';

	/**
	*	Fillable columns of student_answers table.
	*
	*	@var array
	*/
	protected $fillable = array('question_id','student_id','quiz_id','course_id','category_id','correct_answer','submitted_answer','marks');


	/**
	*	@author Abhijeet Dubey 
	*
	*	Stores the student's response to a question in student_answers table.
	*
	*	@param $question_id ID of a question belonging to a perticular category, $student_id ID of student, $quiz_id ID of quiz, $course_id ID of course, $category_id ID of category to which a question belongs, $correct_answer Right answer, $submitted_answer Answer submitted by student, $marks Total marks for this question.
	*
	*	@return boolean Returns true if the information is saved successfully and false otherwise.
	*/

	public static function submit_answer($question_id,$student_id,$quiz_id,$course_id,$category_id,$correct_answer,$submitted_answer,$marks)
	{
		$student_answer 	=	new Student_Answers;

		$student_answer->question_id		=	$question_id;
		$student_answer->student_id			=	$student_id;
		$student_answer->quiz_id			=	$quiz_id;
		$student_answer->course_id			=	$course_id;
		$student_answer->category_id		=	$category_id;
		$student_answer->correct_answer		=	$correct_answer;
		$student_answer->submitted_answer	=	$submitted_answer;
		$student_answer->marks 				=	$marks;
		
		if($student_answer->save())
		{
			return true;
		}

		return false;
	}


	/**
	*	@author Abhijeet Dubey 
	*
	*	Retrieves all the submitted answers of a student in a perticular quiz of a perticular course.
	*
	*	@param $student_id ID of student, $quiz_id ID of quiz, $course_id ID of course.
	*
	*	@return array Returns an array that contains all the answers submitted by a student in a perticular quiz for a perticular course.
	*/

	public static function get_all_submitted_answers($student_id,$quiz_id,$course_id)
	{
		$qry 	=	Student_Answers::where('student_id','=',$student_id)->where('quiz_id','=',$quiz_id)->where('course_id','=',$course_id)->get();

		return $qry;
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
