<?php namespace Xtwoend\Component\User\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Xtwoend\Component\User\Events\UserRegisteredEvent; 

trait RegistersUsers {

	use RedirectsUsers;

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRegister()
	{
		return view('auth.register');
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{
		$validator = $this->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}

		$user = $this->create($request->all());

		if(config('auth.register_confrim'))
		{
			event(new UserRegisteredEvent($user));
		}

		Auth::login($user);

		return redirect($this->redirectPath());
	}

}
