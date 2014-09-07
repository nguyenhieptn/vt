<?php

class Document extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
    protected $fillable = ['title','description','user_id','from_user_id'];

    public function user(){
        return $this->belongsTo('user');
    }

    public function fromUnit()
    {
        return $this->belongsTo('unit','from_unit_id','id','units');
    }

}