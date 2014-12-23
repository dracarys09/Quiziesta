<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $fillable = array('name','department','dob','email','password','userable','type');

	public static $errors;

	public static $rules	=	[

					'entity'			=>	'required',
					'email'				=>	'required|unique:users',
					'password'			=>	'required',
					'confirm-password'	=>	'required|same:password',
					'name'				=>	'required|min:3|max:30',
					'department'		=>	'required|min:3|max:50',
					'dob'				=>	'required'
	];


	/* Method to validate the user input. */
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

	public static function store_user_info($data,$flag)
	{
		$user = new User;
		$user->name 		=	$data['name'];
		$user->department 	=	$data['department'];
		$user->dob 			=	$data['dob'];
		$user->email 		=	$data['email'];
		$user->password 	=	Hash::make($data['password']);

		/* Storing information from student table or instructor table depending on whether the person is a valid student or a valid instructor */
		if($flag == 1)
		{
			$id = Student::where('rollno','=',$data['rollno'])->first()->id;
			
			$user->userable =	$id;
			$user->type 	=	"student";		
		}
		else if($flag == 2)
		{
			$id = Instructor::where('email','=',$data['email'])->first()->id;

			$user->userable = $id;
			$user->type     = "instructor";
		}

		/* Saving the user instance */
		if($user->save())
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
	protected $hidden = array('password', 'remember_token');

}
