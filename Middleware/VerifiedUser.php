<?php namespace Xtwoend\Component\User\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Xtwoend\Component\User\Exceptions\ForbiddenException;

class VerifiedUser
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
     * @param   $role
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if($this->auth->user()->isVerified())
        {
            return $next($request);
        }
        
        return $this->forbidden();
    }

    /**
     * Show forbidden page.
     *
     * @return mixed
     */
    public function forbidden()
    {
        throw new ForbiddenException("Sorry, you don't have permission to access this page. pleace verificated your acount");
    }
}
