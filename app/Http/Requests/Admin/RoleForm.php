<?php

namespace App\Http\Requests\Admin;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class RoleForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::any(['Roles.manage','Roles.manage.all'], Role::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' =>'required|min:4',
            'permissions.*' => Rule::in($this->user()->getAllPermissions()->modelKeys()),
        ];
    }

    public function persist($role)
    {
        $role->name = $this->name;
        $role->save();

        $this->updatePermissions($role, $this->permissions);

        //give user the role they just created
        auth()->user()->assignRole($role);
        
        return $role;
        
    }

    private function updatePermissions($role, $permissions)
    {
        $old = $role->permissions->pluck('name');

        $role->syncPermissions($permissions);

        $new = $role->permissions->pluck('name');

        if($new != $old) {

            // logging
            activity('user')
                ->performedOn($role)
                ->withProperties([
                    'new permissions' => $new,
                    'old permissions' => $old,
                ])
                ->log('Varied role ":subject.name" permissions');
        }
    }
}
