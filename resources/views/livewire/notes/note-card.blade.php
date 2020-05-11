<div x-data x-init="removeClass($el,'bg-green-300',2500)" class="
    @if($note->recentlyUpdated) bg-green-300 @endif
    flex flex-row px-4 py-1 text-gray-800 transition-all duration-300 ease-in rounded shadow hover:bg-yellow-300" >
    <div class="flex-1 py-1 leading-snug ">{!! nl2br(e($note->memo)) !!}</div>
    <div class="flex-none text-xs leading-snug text-right text-gray-600">{{$note->user->name ?? 'anon' }}<br>{{ $note->updated_at->format('H:i D d/m/y') }}</div>
</div> 