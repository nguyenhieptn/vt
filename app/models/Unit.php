<?php

class Unit extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'name' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name','unit_type'];
    
    //relationship to users table pivot user
    public function users()
    {
        $this->belongsToMany('user');
    }
}