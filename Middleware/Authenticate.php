<?php namespace Xtwoend\Component\User\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Xtwoend\Component\User\Exceptions\ForbiddenException;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }

        if($this->auth->user()->isBan()){
            return $this->forbidden();
        }

        return $next($request);
    }

    /**
     * Show forbidden page.
     *
     * @return mixed
     */
    public function forbidden()
    {
        throw new ForbiddenException("Sorry, you account is banned.");
    }
}
