@props(['editing'=>false, 'label', 'name','checked'])
<div class="flex flex-row items-center">
    <label class="w-3/12 text-sm font-bold" for="{{ $name }}">{{ $label }}</label>
    @if($editing)
        <input 
            type="checkbox" 
            wire:model.lazy="{{ $name }}" 
            name="{{ $name }}"
            class="@if($editing) border-teal-600 @endif rounded my-2"
        />
    @else
        @if($checked)
            <span class="inline">&check;</span>
        @else
            <span class="inline text-gray-500">&mdash;</span>
        @endif
    @endif
</div>
