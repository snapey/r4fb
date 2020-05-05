<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleForm;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('Roles.manage.all')) {
            $roles = Role::with('permissions')->orderBy('name')->get();
        } elseif(Auth::user()->can('Roles.manage')) {
            $roles = auth()->user()->roles;
        } else {
            abort(401);
        }

        return view('admin.role.index')
            ->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role;
        return $this->edit($role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleForm $request)
    {
        $role = new Role;

        $response = $this->update($request, $role);
        toast('The role was created', 'success');
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        // user can only give permissions that they have themselves
        $groupedPermissions = Auth::user()->getAllPermissions()->split(3);

        return view('admin.role.edit')
            ->withRole($role)
            ->withGroupedPermissions($groupedPermissions);
    }

    /**
     * Update the resource
     *
     * @param RoleForm $request
     * @param Role $role
     * @return redirect
     */
    public function update(RoleForm $request, Role $role)
    {
        $role = $request->persist($role);

        toast('The role was updated', 'success');
        return redirect(route('admin.roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        toast('The role was deleted', 'success');
        return redirect(route('admin.roles.index'));
    }
}
