@can('Users.permissions')
<p class="text-sm font-bold mt-6">Extra Permissions:</p>

<div class="flex w-full mt-2">

    <div class="w-1/3 bg-gray-200 rounded p-4">
        @foreach($groupedPermissions[0] as $permission)
        <div class="w-full py-1"><label>
                <input type="checkbox" class="mr-2" name="permissions[]" value="{{ $permission->id }}"
                    {{ $user->permissions->contains('id',$permission->id)? 'checked': ''}}>{{ $permission->name }}</label>
        </div>
        @endforeach
    </div>

    <div class="w-1/3 bg-gray-200 ml-4 rounded p-4">
        @if(isset($groupedPermissions[1]))
        @foreach($groupedPermissions[1] as $permission)
        <div class="w-full py-1"><label>
                <input type="checkbox" class="mr-2" name="permissions[]" value="{{ $permission->id }}"
                    {{ $user->permissions->contains('id',$permission->id)? 'checked': ''}}>{{ $permission->name }}</label>
        </div>
        @endforeach
        @endif
    </div>

    <div class="w-1/3 bg-gray-200 ml-4 rounded p-4">
        @if(isset($groupedPermissions[2]))
        @foreach($groupedPermissions[2] as $permission)
        <div class="w-full py-1"><label>
                <input type="checkbox" class="mr-2" name="permissions[]" value="{{ $permission->id }}"
                    {{ $user->permissions->contains('id',$permission->id)? 'checked': ''}}>{{ $permission->name }}</label>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endcan