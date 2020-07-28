<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
</head>

<body class="">

    <div class="w-full text-center">
        <img src="{{ asset('images/R4FBLogo.png') }}" class="w-64" />
    </div>
    
    <h1 class="mt-4 font-sans text-2xl text-teal-700">Rotary4Foodbanks <span class="float-right text-2xl">Delivery Note</span></h1>

<h2 class="my-4 text-xl font-bold text-teal-800 ">Shipment {{ $shipment->id }}-{{ $sub->sub }}<span class="float-right text-base font-normal">{{ $shipment->created_at->format('d/m/Y')}}</span></h2>

    <table class="w-full m-0 text-sm">
        <thead>
            <tr>
                <th class="text-left">Ship From:</th>
                <th class="w-4 text-left"></th>
                <th class="text-left">Ship To:</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-sm">
                <td class="align-top border">
                    {{ $shipment->fromAddress->addressable->name }}<br />
                    {{ $shipment->fromAddress->address1 }}<br />
                    {{ $shipment->fromAddress->address2 }}<br />
                    {{ $shipment->fromAddress->address3 }}<br />
                    {{ $shipment->fromAddress->address4 }}<br />
                    {{ $shipment->fromAddress->postcode }}<br />
                    Phone:</span>{{ $shipment->fromAddress->phone }}<br />
                    email:</span>{{ $shipment->fromAddress->email }}<br />
                </td>
                <td class="">&nbsp;</td>
                <td class="align-top border">
                    {{ $shipment->toAddress->addressable->name }}<br />
                    {{ $shipment->toAddress->address1 }}<br />
                    {{ $shipment->toAddress->address2 }}<br />
                    {{ $shipment->toAddress->address3 }}<br />
                    {{ $shipment->toAddress->address4 }}<br />
                    {{ $shipment->toAddress->postcode }}<br /><br />
                    Phone: {{ $shipment->toAddress->phone_number }}<br />
                </td>
            </tr>
        </tbody>
    </table>

    <table class="w-full text-xs">
        <thead>
            <tr class="">
                <th class="py-1 text-sm text-left">Code</th>
                <th class="py-1 text-sm text-left">Description</th>
                <th class="py-1 text-sm text-left">UOM</th>
                <th class="py-1 text-sm text-center">Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allocation->stocks as $line)
                <tr class="">
                    <td class="py-1 bg-gray-300 border-2 border-white ">{{ $line->item->code }}</td>
                    <td class="py-1 bg-gray-300 border-2 border-white ">{{ $line->item->description }}</td>
                    <td class="py-1 bg-gray-300 border-2 border-white ">{{ $line->item->uom }}</td>
                    <td class="px-2 text-center bg-gray-300 border-2 border-white">{{ $line->qty }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($shipment->notes->count() >0)
        <h1 class="text-2xl">Notes</h1>
        <div class="mb-8 border">
            @foreach($shipment->notes->where('external') as $note)
            <p class="text-sm">{{ $note->memo }}</p>
            @endforeach
        </div>
    @endif

    <div style="page-break-before:always"></div>
    <h1 class="text-2xl">Receipt Confirmation for Shipment {{ $shipment->id }}-{{ $sub->sub }}</h1>
        
    <table class="w-full mx-auto">
        <thead>
            <tr>
                <th class="" width="30%">&nbsp;</th>
                <th class="" width="30%">&nbsp;</th>
                <th class="" width="30%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>&nbsp;</td>
                <td>
                    Recieved By (print):
                </td>
                <td class="border border-t-0 border-b-2 border-l-0 border-r-0 border-gray-800">&nbsp;
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    On Behalf of (print):
                </td>
                <td class="border border-t-0 border-b-2 border-l-0 border-r-0 border-gray-800">&nbsp;
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    Date:
                </td>
                <td class="border border-t-0 border-b-2 border-l-0 border-r-0 border-gray-800">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    Sign:
                </td>
                <td class="border border-t-0 border-b-2 border-l-0 border-r-0 border-gray-800"><br /><br /><br /><br />
                </td>
            </tr>
        </tbody>
    </table>
    
    <p class="m-0 text-xl font-bold">Please Scan or photograph signed copy and return to <a
            href="mailto:rotaryfoundation1220@gmail.com">rotaryfoundation1220@gmail.com</a></p>
    
    <p class="mt-8">Alternatively by post: c/o RF4B Co-ordinator, Rotarian John Cavey, Yew Tree Cottage, Tatenhill Common,
        Rangemore, Burton-on
        Trent, DR13 9RT. Tel: 07855 299443</p>

</body>
</html>