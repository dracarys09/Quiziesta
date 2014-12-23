<?php 


class InstructorController extends BaseController{

	public function dashboard()
	{
		$instructor 	=	Auth::user();
		return View::make('instructor.dashboard')->with('instructor',$instructor);
	}


}