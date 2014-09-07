<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Cartalyst\Sentry\Users\Eloquent\User {

	use UserTrait, RemindableTrait;

    public static $rules = [
        'username' => 'required',
        'email' => 'required'
    ];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    /**
     * relation ship to pivot and units tables
     */
    public function units()
    {
        return $this->belongsToMany('unit');
    }

    public function documents()
    {
        return $this->hasMany('document');
    }

}
