<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
</head>

<body class="">

    <div class="w-full text-center">
        <img src="{{ asset('images/R4FBLogo.png') }}" class="w-64" />
    </div>
    
    <h1 class="mt-4 font-sans text-2xl text-teal-700">Rotary4Foodbanks <span class="float-right text-xl">Purchase Order</span></h1>
    <p class="text-sm">Yew Tree Cottage, Tatenhill Common, Rangemore, Burton-on Trent, DR13 9RT</p>
    <p class="text-sm">RF4B Co-ordinator, Rotarian John Cavey</p>
    <p class="text-sm">Tel: 07855 299443</p>

    <h2 class="my-4 text-xl font-bold text-teal-800 ">Order {{ $order->id }}<span class="float-right text-base font-normal">{{ $order->created_at->format('d/m/Y')}}</span></h2>

    <table class="w-full leading-snug table-fixed">
        <thead>
            <tr>
                <th class="p-2 text-left border-0">Supplier:</th>
                <th class="w-4 p-2 text-left border-0"></th>
                <th class="p-2 text-left border-0">Ship To:</th>
            </tr>
        </thead>
        <tbody class="border-0">
            <tr class="border-0">
                <td class="p-4 align-top border">
                    {{ $order->supplier->name }}<br />
                    {{ $order->supplier->addresses->first()->address1 }}<br />
                    {{ $order->supplier->addresses->first()->address3 }}<br />
                    {{ $order->supplier->addresses->first()->address4 }}<br />
                    {{ $order->supplier->addresses->first()->address2 }}<br />
                    {{ $order->supplier->addresses->first()->postcode }}<br /><br />
                    Phone:</span>{{ $order->supplier->phone }}<br />
                    email:</span>{{ $order->supplier->email }}<br />
                </td>
                <td class="border-0">&nbsp;</td>
                <td class="p-4 align-top border">
                    {{ $order->shipto->addressable->name }}<br />
                    {{ $order->shipto->address1 }}<br />
                    {{ $order->shipto->address2 }}<br />
                    {{ $order->shipto->address3 }}<br />
                    {{ $order->shipto->address4 }}<br />
                    {{ $order->shipto->postcode }}<br /><br />
                    Phone: {{ $order->shipto->phone_number }}<br />
                </td>
            </tr>
        </tbody>
    </table>

    <section id="orderLines" class="max-w-screen-xl mt-2">

        <div class="p-1 bg-white">

            <table class="w-full text-xs border-0">
                <thead>
                    <tr class="">
                        <th class="py-1 text-sm text-left">Code</th>
                        <th class="py-1 text-sm text-left">Description</th>
                        <th class="py-1 text-sm text-left">UOM</th>
                        <th class="py-1 text-sm text-right">Each</th>
                        <th class="py-1 text-sm text-center">Qty</th>
                        <th class="py-1 text-sm text-right">Line Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderlines as $line)
                        <tr class="">
                            <td class="py-1 bg-gray-300 border-2 border-white ">{{ $line->code }}</td>
                            <td class="py-1 bg-gray-300 border-2 border-white ">{{ $line->description }}</td>
                            <td class="py-1 bg-gray-300 border-2 border-white ">{{ $line->uom }}</td>
                            <td class="py-1 text-right bg-gray-300 border-2 border-white"><x-pp v="{{ $line->each }}" /></td>
                            <td class="px-2 text-center bg-gray-300 border-2 border-white">{{ $line->qty }}</td>
                            <td class="py-1 text-right bg-gray-300 border-2 border-white"><x-pp v="{{ $line->total }}" /></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="py-1 font-bold text-right" colspan="5">Total:</td>
                        <td class="py-1 text-right border-2 border-b-0 border-l-0 border-r-0 border-gray-700"><x-pp v="{{$order->orderlines->sum('total')}}" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <div>
        @foreach($order->notes->where('external') as $note)
            <p>{{ $note->memo }}</p>
        @endforeach
    </div>

    <div class="mt-8">
        <p>PDF Generated {{ now()->format('d-m-Y H:i')  }}</p>
    </div>
</body>
</html>