<?php

namespace App\Http\Middleware;

use App\RolePermissions;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use View as FacadeView;

class RolePermissionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $permissions = Auth::user()->permissions()->first()->permissions_info;
        FacadeView::share('global_permissions', $permissions);
        FacadeView::share('current_permission', new RolePermissions());
        $section = $request->segment(1);

        if (in_array($section, RolePermissions::SECTIONS)) {
            switch ($request->method()) {
                case 'POST':

                    if ($request->segment(2) != 'lists' && !$permissions[$section][RolePermissions::ACTION_CREATE]) {
                        abort(Response::HTTP_FORBIDDEN);
                    }
                    break;
                case 'PUT':
                    if (!$permissions[$section][RolePermissions::ACTION_EDIT]) {
                        abort(Response::HTTP_FORBIDDEN);
                    }
                    break;
                case 'DELETE':
                    if (!$permissions[$section][RolePermissions::ACTION_DELETE]) {
                        abort(Response::HTTP_FORBIDDEN);
                    }
                    break;
                case 'GET':
                default:
                    $is_create = $request->segment(2) == RolePermissions::ACTION_CREATE;

                    if (
                        $is_create
                        && !$permissions[$section][RolePermissions::ACTION_CREATE]
                    ) {
                        abort(Response::HTTP_FORBIDDEN);
                    }

                    $is_edit = $request->segment(3) == RolePermissions::ACTION_EDIT;

                    if (
                        $is_edit
                        && !$permissions[$section][RolePermissions::ACTION_EDIT]
                    ) {
                        abort(Response::HTTP_FORBIDDEN);
                    }

                    if (!$permissions[$section][RolePermissions::ACTION_SHOW]) {
                        abort(Response::HTTP_FORBIDDEN);
                    }
                    break;
            }

            return $next($request);
        }

        return $next($request);
    }


}
