<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrUpdateRoleRequest;
use App\Role;
use App\RolePermissions;
use App\Services\PermissionsRoleService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Redirect;

class RoleController extends Controller
{

    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $roles = Role::paginate(self::PER_PAGE);
        return view('roles.list', ['roles' => $roles]);
    }

    /**
     * @param CreateOrUpdateRoleRequest $request
     * @return RedirectResponse
     */
    public function store(CreateOrUpdateRoleRequest $request): RedirectResponse
    {
        $role = Role::create($request->validated());
        app(PermissionsRoleService::class)->updateOrCreate($role, $request->permissions_data);
        return $this->redirectRolesPage();
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('roles.form', [
            'action' => route('roles.store'),
            'title' => trans('texts.new_role'),
            'method' => method_field('POST'),
            'permissions' => app(PermissionsRoleService::class)->generate()
        ]);
    }

    /**
     * @return RedirectResponse
     */
    private function redirectRolesPage(): RedirectResponse
    {
        return Redirect::route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Application|Factory|View
     */
    public function edit(Role $role)
    {
        return view('roles.form', [
            'action' => route('roles.update', $role->id),
            'title' => trans('texts.edit_role'),
            'method' => method_field('PUT'),
            'role' => $role,
            'permissions' => app(PermissionsRoleService::class)->generate($role)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateOrUpdateRoleRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(CreateOrUpdateRoleRequest $request, Role $role): RedirectResponse
    {
        Role::findOrFail($role->id)->update($request->validated());
        app(PermissionsRoleService::class)->updateOrCreate($role, $request->permissions_data);
        return $this->redirectRolesPage();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Role $role): RedirectResponse
    {
        RolePermissions::whereRoleId($role->id)->delete();
        Role::findOrFail($role->id)->delete();
        return $this->redirectRolesPage();
    }
}
