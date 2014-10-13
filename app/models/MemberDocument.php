<?php

class MemberDocument extends \Eloquent {
    // Add your validation rules here
    public static $rules = [
        'title' =>'required',
        'user_id' =>'required',
        //'files' => 'mimes:jpeg,bmp,png,pdf,doc,docx,xls,xlsx,txt'
    ];
    protected $fillable = ['title','description','user_id','from_user_id','from_unit_id','files','read','state'];
}