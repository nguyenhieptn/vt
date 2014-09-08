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
        return $this->belongsToMany('user');
    }

    public function documents()
    {
        return  $this->hasMany('document','from_unit_id','id');
    }
}