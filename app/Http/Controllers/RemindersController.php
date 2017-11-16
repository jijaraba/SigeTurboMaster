<?php

use Parse\ParseClient;
use Parse\ParseUser;

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
        //Implementación Externa
        $response = Password::remind(Input::only('email'), function($message){
            $message->subject(Lang::get('sige.ResetPassword'));
        });

        switch ($response)
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::REMINDER_SENT:
				return Redirect::back()->with('status', Lang::get($response));
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);
			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:

                //Create User In Parse
                ParseClient::initialize(getenv("PARSE_APP_KEY"), getenv("PARSE_REST_KEY"), getenv("PARSE_MASTER_KEY"));
                $query = ParseUser::query();
                $query->equalTo("email", $credentials['email']);
                $users = $query->find();
                if (!$users) {
                    //Create User
                    $user = new ParseUser();
                    $user->set('username',$credentials['email']);
                    $user->set('password', $credentials['password']);
                    $user->set('email',$credentials['email']);
                    try {
                        $user->signUp();
                    } catch (ParseException $ex) {
                        echo "Error: " . $ex->getCode() . " " . $ex->getMessage();
                    }
                }

				return Redirect::to('/login')->with('success',Lang::get('sige.PasswordReset'));
		}
	}

}
