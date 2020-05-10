                    @if( count($candidates ?? []) > 0)
                        <div class="p-2 border border-teal-600 rounded shadow">
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
