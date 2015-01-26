<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Categories extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	/**
	*	Fillable columns of the categories table
	*
	*	@var array	
	*/
	protected $fillable = array('name','_lft','_rgt','parent_id');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
