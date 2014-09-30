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


    //query docsto
    public function scopeDocsTo($query, $unitList,$search,$from,$to)
    {
        $query = DB::table('documents')
                    ->join('document_unit','documents.id','=','document_unit.document_id')
                    ->join('units','documents.from_unit_id','=','units.id')
                    ->whereIn('document_unit.unit_id',$unitList)
                    ->select('documents.*',
                            'units.name AS fromunit'
                    );

        //query search
        if($search) {
            $query->where("documents.title","LIKE","%$search%");
        }

        //query from to
        $f = \Carbon\Carbon::parse($from);
        $t = \Carbon\Carbon::parse($to);
        if($f!="1970-01-01 00:00:00" && $t!="1970-01-01 00:00:00"){
            if ($f == $t){
                $t = $t->addDay();
            }
            $query->whereBetween("documents.created_at",[$f,$t]);
        }else if($f=="1970-01-01 00:00:00" && $t!="1970-01-01 00:00:00"){
            $query->whereRaw("DATE(documents.created_at) = '$t'");
        }else if($f!="1970-01-01 00:00:00" && $t=="1970-01-01 00:00:00"){
            //echo $f; exit;
            $query->whereRaw("DATE(documents.created_at) = '$f'");

        }

        return $query;
    }

    public function scopeSearch($query,$search){
        if($search) {
            return $query->where("documents.title","LIKE","%$search%");
        }else {
            return $query;
        }
    }


    public function scopeDateBetween($query,$from,$to){
        $f = \Carbon\Carbon::parse($from);
        $t = \Carbon\Carbon::parse($to);
        if($f!="1970-01-01 00:00:00" && $t!="1970-01-01 00:00:00"){
            if ($f == $t){
                $t = $t->addDay();
            }
            return $query->whereBetween("documents.created_at",[$f,$t]);
        }else if($f=="1970-01-01 00:00:00" && $t!="1970-01-01 00:00:00"){
            return $query->whereRaw("DATE(documents.created_at) = '$t'");
         }else if($f!="1970-01-01 00:00:00" && $t=="1970-01-01 00:00:00"){
            //echo $f; exit;
            return $query->whereRaw("DATE(documents.created_at) = '$f'");

        }else {
            return $query;
        }
    }

}