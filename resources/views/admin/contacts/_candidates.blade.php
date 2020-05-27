                    @if( count($candidates ?? []) > 0)
                        <div class="relative p-2 border border-teal-600 rounded shadow">
                            <a href="#" wire:click.prevent="closeCandidates" 
                                class="absolute top-0 right-0 p-1 text-xs rounded-full hover:bg-gray-400 hover:text-indigo-700">
                                <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </a>
                            <p class="pb-1 text-sm font-bold">One of these existing contacts ?</p>
                            <table class="w-full text-xs">
                            @foreach($candidates as $contact)
                                <tr wire:click="selectContact({{ $contact->id }})" 
                                    class="hover:bg-yellow-300
                                    @if($contact->id == $exists) bg-yellow-200 @endif " >
                                    <td>@if($contact->id == $exists)&check;@endif</td>
                                    <td class="px-2 py-1">{{$contact->surname}}</td>
                                    <td class="px-2 py-1">{{ $contact->forenames }}</td>
                                    <td class="px-2 py-1">{{ $contact->phone1 }}</td>
                                    <td class="px-2 py-1">{{ $contact->email1 }}</td>

                                <tr>
                            @endforeach
                            </table>
                        </div>
                    @endif
