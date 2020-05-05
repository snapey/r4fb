@can('Users.roles')
<p class="text-sm font-bold">Roles:</p>

<div class="flex w-full mt-2">

    <div class="w-1/3 bg-gray-200 rounded p-4">
        @foreach($groupedRoles[0] as $role)
        <div class="w-full py-1"><label>
                <input type="checkbox" class="mr-2" name="roles[]" value="{{ $role->id }}"
                    {{ $user->roles->contains('id',$role->id)? 'checked': ''}}>{{ $role->name }}</label>
        </div>
        @endforeach
    </div>

    <div class="w-1/3 bg-gray-200 ml-4 rounded p-4">
        @if(isset($groupedRoles[1]))
        @foreach($groupedRoles[1] as $role)
        <div class="w-full py-1"><label>
                <input type="checkbox" class="mr-2" name="roles[]" value="{{ $role->id }}"
                    {{ $user->roles->contains('id',$role->id)? 'checked': ''}}>{{ $role->name }}</label>
        </div>
        @endforeach
        @endif
    </div>

    <div class="w-1/3 bg-gray-200 ml-4 rounded p-4">
        @if(isset($groupedRoles[2]))
        @foreach($groupedRoles[2] as $role)
        <div class="w-full py-1"><label>
                <input type="checkbox" class="mr-2" name="roles[]" value="{{ $role->id }}"
                    {{ $user->roles->contains('id',$role->id)? 'checked': ''}}>{{ $role->name }}</label>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endcan