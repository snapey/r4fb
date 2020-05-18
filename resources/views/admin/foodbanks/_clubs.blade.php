{{-- clubs ---------------------------------------------------- --}}

<div class="pl-4 mt-2 mr-4">
    <h2 class="py-2 text-xl font-bold border-t-2 border-gray-400">
        Clubs <span class="pl-4 text-xs font-normal text-gray-600">Create association from Club</span>
    </h2>
    <table class="text-sm bg-white ">

        @foreach($foodbank->clubs as $club)
        <tr>
            <td class="px-4 py-2">Rotary Club</td>
            <td class="px-4 py-2">
                <a class="text-indigo-700 underline"
                    href="{{ route('admin.clubs.show',$club->id)}}">{{ $club->name}}</a>
            </td>
            <td class="px-4 py-2">{{ $club->district }}</td>
        </tr>
        @endforeach

    </table>
</div>