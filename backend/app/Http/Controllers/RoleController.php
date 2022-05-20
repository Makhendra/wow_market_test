<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrUpdateRoleRequest;
use App\Role;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Redirect;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|View
     */
    public function index()
    {
        $roles = Role::paginate(self::PER_PAGE);
        return view('roles.list', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('roles.form', [
            'action' => route('roles.store'),
            'title' => trans('texts.new_role'),
            'method' => method_field('POST'),
        ]);
    }

    /**
     * Role a newly created resource in storage.
     *
     * @param CreateOrUpdateRoleRequest $request
     * @return RedirectResponse
     */
    public function store(CreateOrUpdateRoleRequest $request): RedirectResponse
    {
        Role::create($request->validated());
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
            'role' => $role
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
        return Redirect::route('roles.index');
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
        Role::findOrFail($role->id)->delete();
        return Redirect::route('roles.index');
    }
}
