<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Sige\Services\Validation\UserValidator as Validator;

class SessionsController extends BaseController
{

    protected $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('sessions.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $input = Input::all();
        if (!$this->validator->validate($input)) {
            return Redirect::back()->withErrors($this->validator->errors())->withInput();
        }

        $attempt = Auth::attempt([
            'email' => $input['email'],
            'password' => $input['password']
        ], (isset($input["remember-password"])) ? true : false);

        if ($attempt) {

            //Update User
            $user = User::find(getUser()->iduser);
            $user->last_session = Carbon::now();
            $user->sigeturbo_token = str_random(30);
            $user->save();

            $role = explode(",",$user->role);
            if(count($role) > 1){
                return Redirect::intended('/roles')->withInput()
                    ->with('success', Lang::get('sige.LoggedIn'));
            } else {
                //Define Role Session
                Session::set('role',$user->role);
                //Redirect by Role
                if ($user->role === 'Parents') {
                    return Redirect::intended('/parents')->withInput()->with('success', Lang::get('sige.LoggedIn'));
                }
                return Redirect::intended('/formation')->withInput()->with('success', Lang::get('sige.LoggedIn'));

            }

        }
        return Redirect::back()->with('error', Lang::get('sige.InvalidCredentials'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
        //Delete Rol
        Session::forget('role');
        Auth::logout();
        return Redirect::home()->with('success', Lang::get('sige.LoggedOut'));
    }

}
