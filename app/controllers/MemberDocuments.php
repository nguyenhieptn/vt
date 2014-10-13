<?php

class MemberDocuments extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function documentFrom()
	{
        //init var
        $user = Sentry::getUser();
        $search = Input::get("search");
        $from = date("Y-m-d H:i:s",strtotime(Input::get("from")) );
        $to = date("Y-m-d H:i:s",strtotime(Input::get("to")) );

        //this is the units where user manage
        $userUnit = array();
        foreach($user->units as $u){
            $userUnit[] = $u->id;
        };

        //get data
        $documents = Document::orderBy('created_at','desc')
            ->docsFrom($userUnit)
            ->search($search)
            ->dateBetween($from,$to)
            ->paginate(5);
        $numberdocuments = Document::docsTo($userUnit,null,'1970-01-01 00:00:00','1970-01-01 00:00:00')
            ->get();
        return View::make('memberdocuments.docfrom', compact('documents','numberdocuments'));
	}

    public function documentTo()
	{
        //init var
        $user = Sentry::getUser();
        $search = Input::get("search");
        $from = date("Y-m-d H:i:s",strtotime(Input::get("from")) );
        $to = date("Y-m-d H:i:s",strtotime(Input::get("to")) );

        //current units manage by this user
        $userUnit = array();
        foreach($user->units as $u){
            $userUnit[] = $u->id;
        };
        //get data
        $documents = Document::docsTo($userUnit,$search,$from,$to)
                            ->paginate(5);

        $numberdocuments = Document::docsTo($userUnit,null,'1970-01-01 00:00:00','1970-01-01 00:00:00')
                    ->get();
        return View::make('memberdocuments.docto',compact('documents','numberdocuments'));
	}
    public function create()
    {
        $user = Sentry::getUser();
        //current units manage by this user
        $userUnit = array();
        foreach($user->units as $u){
            $userUnit[] = $u->id;
        };

        $unitObjs = DB::table('units')->whereIn('id', $userUnit)->get();
        $unitMembers=array();
        foreach($unitObjs as $unit){
            $unitMembers[$unit->id] = $unit->name;
        };
        $units = Unit::orderBy('unit_type')->lists('name','id');
        return View::make('memberdocuments.create',compact('units','unitMembers'));
    }
    public function show($id){
        $document = Document::find($id);
        $uid = Sentry::getUser()->id;

        //mark read
        $readList = (array)json_decode($document->read,true);
        if(!in_array($uid,$readList)) {
            $readList[] = $uid;
            $document->read = json_encode($readList);
            $document->save();
        }
        //init var
        $user = Sentry::getUser();

        //current units manage by this user
        $userUnit = array();
        foreach($user->units as $u){
            $userUnit[] = $u->id;
        };
        $numberdocuments = Document::docsTo($userUnit,null,'1970-01-01 00:00:00','1970-01-01 00:00:00')
            ->get();
        //update readed
        return View::make('memberdocuments.show', compact('document','numberdocuments'));
    }
    public function store()
    {
        $data = Input::except('_token','to_units_id');
        $validator = Validator::make($data, Document::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        //files upload
        $files = Input::file('files');
        //var_dump($files);exit;
        $filesName = array();
        foreach($files as $file) {
            if(isset($file)){
                // public/uploads
                $file->name = uniqid()."_".$file->getClientOriginalName();
                $filesName[] = $file->name;
                $file->move('uploads/',$file->name);
            }
        }

        $data['files'] = json_encode($filesName);

        $doc = Document::create($data);

        //dump pivot table units to
        $units = Input::get('to_units_id');
        if (count($units)){
            $doc->units()->attach($units);
        }

        return Redirect::to('docto');
    }

}
