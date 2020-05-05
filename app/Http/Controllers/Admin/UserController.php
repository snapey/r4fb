<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserForm;
use App\User;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->permissionTo('Users.edit');

        return view('admin.user.index')
            ->withUsers(User::with('roles', 'permissions')->orderBy('name')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->permissionTo('Users.add');

        $user = new User;
        return $this->edit($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserForm $request)
    {
        $user = new User;

        $response = $this->update($request, $user);
        toast('The user was created','success');
        return $response;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->permissionTo('Users.edit');

        // user can only offer roles they have themselves, unless they have permission 'Users.roles.all'
        if (Auth::user()->can('Users.roles.all')) {
            $groupedRoles = Role::with('permissions')->orderBy('name')->get()->split(3);
        } elseif (Auth::user()->can('Users.roles')) {
            $groupedRoles = auth()->user()->roles()->get()->split(3);
        }

        // user can only offer permissions they have themselves
        if (Auth::user()->can('Users.permissions')) {
            $groupedPermissions = auth()->user()->getAllPermissions()->sortBy('id')->split(3);
        } else {
            $groupedPermissions = [];
        }

        return view('admin.user.edit')
            ->withUser($user)
            ->withGroupedRoles($groupedRoles)
            ->withGroupedPermissions($groupedPermissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserForm $request, User $user)
    {
        $request->persist($user);

        toast('The user was updated','success');
        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->permissionTo('Users.delete');

        $user->delete();

        toast('The user was deleted','success');
        return redirect(route('admin.users.index'));
    }

    public function permissionTo(string $permission)
    {
        abort_unless(Auth::user()->can($permission, User::class), 401);
    }
}
