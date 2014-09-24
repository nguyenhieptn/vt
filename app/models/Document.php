<?php

class Document extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
    protected $fillable = ['title','description','user_id','from_user_id','from_unit_id','files'];

    public function user(){
        return $this->belongsTo('user');
    }

    public function fromUnit()
    {
        return $this->belongsTo('unit','from_unit_id','id','units');
    }

    public function units()
    {
        return $this->belongsToMany('unit');
    }

    public function scopeDocsFrom($query,$fromUnitID = array()){
        return !(empty($fromUnitID)) ? $query->whereIn('from_unit_id',$fromUnitID):$query;
    }

    public static function scopeDocsTo($query, $unitList)
    {
        $docs = DB::table('documents')
                    ->join('document_unit','documents.id','=','document_unit.document_id')
                    ->join('units','documents.from_unit_id','=','units.id')
                    ->whereIn('document_unit.unit_id',$unitList)
                    ->select('documents.*',
                            'units.name AS fromunit'
                    )->paginate(5);
        return $docs;
    }

}