<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Kits\Models\Auth\Acl\Middleware;


use Illuminate\Contracts\Auth\Guard;

class UserHasAllRoles
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new UserHasPermission instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Run the request filter.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $closure
     * @param string                   $role
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $roles      = call_user_func_array('array_merge', $roles);
        $authorized = call_user_func_array([$this->auth->user(), 'hasAllRoles'], $roles);

        if (! $authorized) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            }

            return abort(401);
        }

        return $next($request);
    }
}
