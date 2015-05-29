<?php namespace Xtwoend\Component\User\Http;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Validator;
use Xtwoend\Component\User\Auth\AuthenticatesAndRegistersUsers;
use Xtwoend\Component\User\Repositories\UserRepository;

class AuthController extends Controller
{
	use DispatchesJobs, ValidatesRequests, AuthenticatesAndRegistersUsers;

	protected $users;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    	
    	$this->users = $users;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {   
        return $this->users->register([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}