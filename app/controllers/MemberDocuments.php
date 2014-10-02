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
        return View::make('memberdocuments.docfrom', compact('documents'));
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

        return View::make('memberdocuments.docto', compact('documents'));
	}

    public function show($id){
        $document = Document::find($id);
        $uid = Sentry::getUser()->id;
        //mark read
        $readList = json_decode($document->read,true);
        if(!in_array($uid,$readList)) {
            $readList[] = $uid;
            $document->read = json_encode($readList);
            $document->save();
        }



        //update readed
        return View::make('memberdocuments.show', compact('document'));
    }


}
