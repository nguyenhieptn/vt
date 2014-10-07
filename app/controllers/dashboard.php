<?php

class Dashboard extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /dashboard
	 *
	 * @return Response
	 */
	public function index()
	{
        $user = Sentry::getUser();

        //this is the units where user manage
        $userUnit = array();
        foreach($user->units as $u){
            $userUnit[] = $u->id;
        };

        //get data
        $numberdocuments = Document::docsTo($userUnit,null,'1970-01-01 00:00:00','1970-01-01 00:00:00')
            ->get();

        if(!empty($numberdocuments)){
            return View::make("dashboard.dashboard",compact("numberdocuments"));
        }else{
            return View::make("dashboard.dashboard");
        }

	}

}