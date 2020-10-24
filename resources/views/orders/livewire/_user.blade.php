<div class="flex flex-row justify-between py-1">
    <label for="recipient-{{ $user->id }}">{{ $user->name }}
            <span class="text-indigo-800">&lt;{{ $user->email }}&gt;</span>
    </label>
        
    <input wire:model="users.{{ $user->id }}" type="checkbox" name="users-{{ $user->id }}" id="users-{{ $user->id }}">
</div>