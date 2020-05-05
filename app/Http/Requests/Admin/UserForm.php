<?php

namespace App\Http\Requests\Admin;

use App\Role;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('Users.edit', User::class);
    }

    public function rules()
    {
        $user = $this->user->id ?? 0;

        return [
            'name' => 'required | min:4',
            'email' => "required | max:50 |unique:users,email,{$user},id",
            'password' => 'nullable | max:50 | min:8',
            'mobile' => 'nullable | max:11 | min:11',
            'roles.*' => Rule::in($this->getRoleIds()),
            'permissions.*' => Rule::in($this->getPermissionIds()),
        ];
    }

    public function persist(User $user)
    {

        $user->name = $this->name;
        $user->email = $this->email;
        $user->passwordless = $this->input('passwordless',0);
        $user->mobile = $this->mobile;

        if (isset($this->password)) {
            $user->password = Hash::make($this->password);
        }
        $user->save();
        
        $this->updateRoles($user, $this->roles);
        $this->updatePermissions($user, $this->permissions);

    }

    private function updateRoles($user, $roles)
    {
        $existingRoles = $user->roles->pluck('name');

        $user->syncRoles($roles);

        $newRoles = $user->roles->pluck('name');

        if($newRoles != $existingRoles) {

            // logging
            activity('user')
                ->performedOn($user)
                ->withProperties([
                    'old roles' => $existingRoles,
                    'new roles' => $newRoles
                    ])
                ->log('Varied user roles');
        }
    }

    private function updatePermissions($user, $permissions)
    {
        $existingPermissions = $user->permissions->pluck('name');

        $user->syncPermissions($permissions);

        $newPermissions = $user->permissions->pluck('name');

        if($newPermissions != $existingPermissions) {

            // logging
            activity('user')
            ->performedOn($user)
            ->withProperties([
                'new permissions' => $newPermissions,
                'old permissions' => $existingPermissions
                ])
                ->log('Varied user permissions');
        }
    }
    
    /**
     * return array of roles that this user can assign
     * Basically all their roles, unless they have permission to issue all roles
     *
     * @return array
     */
    public function getRoleIds()
    {
        if(auth()->user()->can('Users.roles.all')) {
            return Role::get()->modelKeys();
        }
        return auth()->user()->roles->modelKeys();
    }

    /**
     * return an array of permissions that this user has
     * 
     * @return array
     */
    public function getPermissionIds()
    {
        return auth()->user()->getAllPermissions()->modelKeys();
    }
}
