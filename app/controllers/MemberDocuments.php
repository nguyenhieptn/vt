<?php

class MemberDocuments extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function documentFrom()
	{
        $user = Sentry::getUser();
        $userUnit = array();
        foreach($user->units as $u){
            $userUnit[] = $u->id;
        };
        $documents = Document::orderBy('created_at','desc')->docsFrom($userUnit)->paginate(5);
        return View::make('memberdocuments.docfrom', compact('documents'));
	}

    public function documentTo()
	{
		//
	}


}
