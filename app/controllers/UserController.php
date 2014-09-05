<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /user
	 *
	 * @return Response
	 */
	public function login()
	{
        if ( Sentry::check()) {
            return Redirect::route('dashboard');
        }else {
            return View::make("users.login");
        }
	}

    public function doLogin()
    {
// validate the info, create rules for the inputs
        $rules = array(
            'username'    => 'required|alphaNum', // username
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            try{
                // create our user data for the authentication
                $userdata = array(
                    'username' 	=> Input::get('username'),
                    'password' 	=> Input::get('password')
                );

                // attempt to do the login
                $user = Sentry::authenticate($userdata, false);
                // validation successful!
            }
            catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
            {
                return Redirect::to('login')->withInput(Input::except('password'))->withErrors("Login required");
            }
            catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
            {
                return Redirect::to('login')->withInput(Input::except('password'))->withErrors("Password required");
            }
            catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
            {
                return Redirect::to('login')->withInput(Input::except('password'))->withErrors("Wrong Password");
            }
            catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
            {
                return Redirect::to('login')->withInput(Input::except('password'))->withErrors("User not found");
            }
            catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
            {
                return Redirect::to('login')->withInput(Input::except('password'))->withErrors("not activated");
            }

            return Redirect::intended('dashboard');
        }
    }

    public function index()
    {
        $users = Sentry::findAllUsers();

        return View::make('users.index')->with(compact('users'));
    }

	public function logout()
	{
        Sentry::logout();
        return Redirect::to('login')->withErrors("Success logout");
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /user
	 *
	 * @return Response
	 */
	public function store()
	{
        try
        {
            $user = Input::except('_token','units','group');
            //var_dump($user);exit;
            // Create the user
            $user = Sentry::createUser($user);

            // Find the group using the group id
            $userGroup = Sentry::findGroupByName(Input::get('group'));

            // Assign the group to the user
            $user->addGroup($userGroup);

            // assign units user pivot, since the syntry uloquent doesn't support, we need to use extenders one
            $units = Input::get("units");
            if(count($units)) {
                foreach($units as $u){
                    User::find($user->id)->units()->attach($u);
                }
            }
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            return Redirect::to("users/create")->withErrors('gen.Login field is required.')->withInput(Input::except('_token','password'));
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            return Redirect::to("users/create")->withErrors('gen.Password field is required.')->withInput(Input::except('_token','password'));
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            return Redirect::to("users/create")->withErrors('gen.User with this login already exists.');
        }
        catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            return Redirect::to("users/create")->withErrors('gen.Group was not found.');
        }

        return Redirect::to("users")->withErrors("gen.Success create user");
	}

	public function create()
	{
        $units = Unit::orderBy('unit_type')->get(['id','name']);
		return View::make('users.create',compact('units'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /user/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        try
        {
            // Find the user using the user id
            $user = Sentry::findUserById($id);

            // Delete the user
            $user->delete();
            return Redirect::to("users")->withErrors("gen.Success delete");
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Redirect::to("users")->withErrors("gen.User was not found.");
        }
	}

}