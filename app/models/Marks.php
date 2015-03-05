<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Marks extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	public static $EDIT_COST = 1;
	public static $SENTINEL = -1;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'marks';

	/**
	*	Fillable columns of marks table.
	*
	*	@var array
	*/
	protected $fillable = array('course_id','quiz_id','student_id','marks_obtained','total_marks');

	/**
	*	@author Abhijeet Dubey 
	*
	*	Store total marks obtained by a student in a quiz.
	*
	*	@param $course_id ID of course, $quiz_id ID of quiz, $student_id ID of student.
	*
	*	@return boolean Returns true if information is saved successfully and false otherwise.
	*/

	public static function store_marks($course_id,$quiz_id,$student_id)
	{
		$qry	=	Student_Answers::get_all_submitted_answers($student_id,$quiz_id,$course_id);

		$total_marks = 0;
		$awarded_marks = 0;

		foreach($qry as $question)
		{
			$total_marks	+=	$question->marks;

			$awarded_marks 	+=	Marks::calculate_marks($question->correct_answer,$question->submitted_answer,$question->category_id,$question->marks);
		}


		$marks 	=	new Marks;

		$marks->course_id		=	$course_id;
		$marks->quiz_id			=	$quiz_id;
		$marks->student_id		=	$student_id;
		$marks->marks_obtained	=	$awarded_marks;
		$marks->total_marks		=	$total_marks;

		if($marks->save())
		{
			return true;
		}	

		return false;
	}

	public static function edit_distance($x,$y)
	{
		//cost of alignment
		$cost = 0;
		$leftcell = 0;
		$topcell = 0;
		$cornercell = 0;

		$m = strlen($x) + 1;
		$n = strlen($y) + 1;
		
		$t = array(array());

		//Initialize the table
		for($i = 0;$i<$m;$i++)
		{
			for($j = 0;$j<$n;$j++)
			{
				$t[$i][$j] = static::$SENTINEL;
			}
		}

		//Set up base cases
		//t[i][0] = i
		for($i = 0;$i<$m;++$i)
		{
			$t[$i][0] = $i;
		}

		//t[0][j] = j
		for($j = 0;$j<$n;++$j)
		{
			$t[0][$j] = $j;
		}

		//Build t in top-down fashion
		for($i = 1;$i<$m;$i++)
		{
			for($j = 1;$j<$n;$j++)
			{
				//t[i][j-1]
				$leftcell = $t[$i][$j-1];
				$leftcell += static::$EDIT_COST;	//deletion

				//t[i-1][j]
				$topcell = $t[$i-1][$j];
				$topcell += static::$EDIT_COST;		//insertion

				//t[i-1][j-1]
				$cornercell = $t[$i-1][$j-1];
				if($x[$i-1] != $y[$j-1])
					$cornercell += static::$EDIT_COST;	//replacement

				//Minimum cost of the current cell
				$t[$i][$j] = min($leftcell,$topcell,$cornercell);
			}
		}
		//cost is the cell t[m][n]
		$cost = $t[$m-1][$n-1];
		return $cost;
	}

	/**
	*	@author Abhijeet Dubey 
	*
	*	Calculate marks to be awarded for a perticular question.
	*
	*	@param $correct_answer string containing correct answers, $submitted_answer string containing answer submitted by student, $category_id integer representing category of question, $total_marks float representing the marks for a question.
	*
	*	@todo This function needs modification
	*	
	*	@return float Returns the marks awarded for the submitted answer.
	*/

	public static function calculate_marks($correct_answer,$submitted_answer,$category_id,$total_marks)
	{
		$marks = 0;
		if($category_id == 2)
		{
			$ctr = 0;

			$len = strlen($correct_answer);
			for($i = 0;$i<$len;$i++)
			{
				if($correct_answer[$i] == ',')
					$ctr++;
			}

			$val 	=	$ctr + 1; 

			$token 	=	$total_marks/$val;
			
			$pos 	=	strpos($correct_answer,$submitted_answer);

			if($pos === false)
			{
				$marks = 0;
			}
			else
			{
				$marks = $token;
			}
		}
		else if($category_id == 3)
		{
			//Calculating the edit distance
			$x = $correct_answer;
			$y = "";
			$len = strlen($submitted_answer);
			for($i = 0;$i<$len;++$i)
			{
				if($submitted_answer[$i] == " ")
					continue;
				$y += $submitted_answer[$i];
			}
			$distance = Marks::edit_distance($x,$y);	//Dynamic Programming to improve runtime
			if($distance < 3)
				$marks = $total_marks;
			else
				$marks = 0;
		}
		else if($category_id == 4)
		{
			if($submitted_answer == $correct_answer)
			{
				$marks = $total_marks;
			}
			else
			{
				$marks = 0;
			}
		}

		return $marks;
	}


	/**
	*	@author Abhijeet Dubey
	*
	*	Retrieves marks obtained by a perticular student in a perticular quiz.
	*
	*	@param $student_id ID of student, $quiz_id ID of quiz.
	*
	*	@return array Returns an array containing the details of marks obtained by a perticular student in a perticular quiz.
	*/

	public static function get_marks($student_id, $quiz_id)
	{
		$qry = Marks::where('student_id','=',$student_id)->where('quiz_id','=',$quiz_id)->first();
		return $qry;
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
