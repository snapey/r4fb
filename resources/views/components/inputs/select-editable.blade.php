@props(['editing'=>false, 'label', 'name','half'=>false,'list','current'=>null])
<div class="flex flex-row items-center">
    <label class="w-3/12 text-sm font-bold" for="{{ $name }}">{!! $label !!}</label>
    @if($editing)
        <select wire:model.lazy={{ $name }} name="{{ $name }}" class="{{ $half ? 'w-4/12' : 'w-9/12' }} px-1 py-1 bg-gray-300 border border-teal-600 rounded">
            <option value="">Not Specified</option>
            @foreach($list as $key => $item)
                <option value="{{ $key }}">{{ $item }}</option>
            @endforeach
        </select>
    @else
    <input
        class="{{ $half ? 'w-4/12' : 'w-9/12' }} px-2 py-1 bg-gray-200 border rounded"
        name="{{ $name }}" type="text" value="{{ $current }}" disabled 
    />
    @endif
</div>

@error($name)
    <div class="flex flex-row">
        <div class="w-3/12"></div>
        <div class="w-9/12 text-xs text-red-800 full ">{{ $message }}</div>
    </div>
@enderror