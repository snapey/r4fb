@props(['editing'=>false, 'label', 'name','half'=>false, 'placeholder'=>null])
<div class="flex flex-row items-center">
    <label class="w-3/12 text-sm font-bold" for="{{ $name }}">{{ $label }}</label>
    <input
        class="{{ $half ? 'w-4/12' : 'w-9/12' }} px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
wire:model.lazy="{{ $name }}" name="{{ $name }}" type="text" @if(!$editing) disabled @else placeholder="{{ $placeholder}}" @endif />
</div>
@error($name)
    <div class="flex flex-row">
        <div class="w-3/12"></div>
        <div class="w-9/12 text-xs text-red-800 full ">{{ $message }}</div>
    </div>
@enderror