@props(['editing'=>false, 'label', 'name','checked'])
<div class="flex flex-row items-center">
    <label class="w-3/12 my-2 text-sm font-bold" for="{{ $name }}">{{ $label }}</label>
    @if($editing)
        <input 
            type="checkbox" 
            wire:model.lazy="{{ $name }}" 
            name="{{ $name }}"
            class="my-2 @if($editing) border-teal-600 @endif rounded"
        />
    @else
        @if($checked)
            <span class="inline">&check;</span>
        @else
            <span class="inline text-gray-500">&mdash;</span>
        @endif
    @endif
</div>
