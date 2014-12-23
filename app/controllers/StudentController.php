<?php 


class StudentController extends BaseController{


	public function dashboard()
	{
		return Auth::user();
	}


}