<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Redirect;
use Exception;

class UserController extends Controller
{
    /**
     * @return RedirectResponse
     */
    private function redirectUsersPage(): RedirectResponse
    {
        return Redirect::route('users.index');
    }

    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $users = User::with('role')->paginate(self::PER_PAGE);
        return view('users.list', ['users' => $users]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.form', [
            'action' => route('users.store'),
            'title' => trans('texts.new_user'),
            'method' => method_field('POST'),
            'roles' => $roles,
        ]);
    }

    /**
     * @param CreateUserRequest $request
     * @return RedirectResponse
     */
    public function store(CreateUserRequest $request): RedirectResponse
    {
        User::create($request->validated());
        return $this->redirectUsersPage();
    }

    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.form', [
            'action' => route('users.update', $user->id),
            'title' => trans('texts.edit_user'),
            'method' => method_field('PUT'),
            'roles' => $roles,
            'user' => $user
        ]);
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        if ($request->validated()) {
            $user->update($request->except('password'));

            $newPassword = $request->get('password');
            if($newPassword) {
                $user->password = Hash::make($newPassword);
                $user->save();
            }
        }

        return $this->redirectUsersPage();
    }

    /**
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user): RedirectResponse
    {
        User::findOrFail($user->id)->delete();
        return $this->redirectUsersPage();
    }
}
