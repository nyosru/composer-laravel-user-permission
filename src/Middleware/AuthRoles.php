<?php

namespace Phpcatcom\Permission\Middleware;

use Phpcatcom\Permission\Exceptions\UnauthenticatedException;
use Phpcatcom\Permission\Exceptions\UnauthorizedException;
use Phpcatcom\Permission\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Phpcatcom\Permission\Models\Role;
use Phpcatcom\Permission\Models\User;

class AuthRoles
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws \Throwable
     */
    public function handle($request, Closure $next)
    {

        $guards = collect(config('auth.guards'));

        $authGuard = $guards->keys()->filter(function ($key) {
            return auth($key)->check();
        })->first();
        throw_if(!auth($authGuard)->check(), UnauthenticatedException::notLoggedIn());

        $super_access_count = User::whereAccessFull(true)->count();
        if ($super_access_count > 0) {
//            echo 'sdfsdf<div style="padding:10px; background-color: yellow; margin: 10px;">Для работы плагина управления правами доступа, дайте полные права в разделе пользвателя (своему пользователю) </div>';

            if( auth($authGuard)->user()->access_full ){
//                echo __LINE__.' есть полный доступ';
            }else{
//                echo __LINE__.' нет полный доступ';

            $action = $request->route()->getActionname();
            $name = $request->route()->getActionname();
            $role_id = auth($authGuard)->user()->role_id;

            $permission = Permission::where(function ($query) use ($action, $name) {
                $query->where('name', $name);
                $query->orWhere('action', $action);
            })->whereHas('roles', function ($query) use ($role_id) {
                $query->where('id', $role_id);
            })->first();

            throw_if(is_null($permission), UnauthorizedException::noPermission());

        }
        }
        return $next($request);
    }
}
