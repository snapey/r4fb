<table class="w-full p-2 mt-4 text-sm leading-normal border border-white">
    <thead>
        <tr>
            <th class="w-1/2 p-2 text-left border-white">Ship From:</th>
            <th class="w-4 text-left border-white"></th>
            <th class="w-1/2 p-2 text-left border-white">Ship To:</th>
        </tr>
    </thead>
    <tbody>
        <tr class="text-base">
            <td class="p-2 align-top border border-gray-400 ">
                {{ $shipment->fromAddress->addressable->name }}<br />
                {{ $shipment->fromAddress->address1 }}<br />
                {{ $shipment->fromAddress->address2 }}<br />
                {{ $shipment->fromAddress->address3 }}<br />
                {{ $shipment->fromAddress->address4 }}<br />
                {{ $shipment->fromAddress->postcode }}<br />
                Phone:</span>{{ $shipment->fromAddress->phone }}<br />
                email:</span>{{ $shipment->fromAddress->email }}<br />
            </td>
            <td class="border-white">&nbsp;</td>
            <td class="p-2 align-top border border-gray-400">
                {{ $shipment->toAddress->addressable->name }}<br />
                {{ $shipment->toAddress->address1 }}<br />
                {{ $shipment->toAddress->address2 }}<br />
                {{ $shipment->toAddress->address3 }}<br />
                {{ $shipment->toAddress->address4 }}<br />
                {{ $shipment->toAddress->postcode }}<br /><br />
                Phone: {{ $shipment->toAddress->phone_number }}<br />
                @foreach($shipment->toAddress->addressable->contacts as $contact)
                    <strong>{{ $contact->forenames }} {{ $contact->surname }}</strong> - {{ $contact->phone1 }}
                    <em class="text-xs">{{ $contact->pivot->relationship ?? '' }}</em><br />
                @endforeach
            </td>
        </tr>
    </tbody>
</table>