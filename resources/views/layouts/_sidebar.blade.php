<div class="sticky w-48 pt-4 text-sm font-bold text-teal-700 shadow-inner">
    <ul>
        <a href="{{ route('home') }}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('home*')) ? 'bg-teal-100' : '' }}">
            <x-svg.dashboard class="h-5" /> Dashboard</li>
        </a>
        <li class="pt-2 pb-2 pl-4 my-2 text-sm font-bold text-gray-600 border-t border-gray-400 shadow-inner">Operational:</li>

        <a href="{{ route('orders.index') }}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('orders*')) ? 'bg-teal-100' : '' }}">
            <x-svg.order class="h-5" /> Orders</li>
        </a>
        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">
            <x-svg.request class="h-5" /> Requests</li>
        </a>
        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">
            <x-svg.receipt class="h-5" /> Receipts</li>
        </a>
        <a href="{{ route('allocations.index')}}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('allocations*')) ? 'bg-teal-100' : '' }}">
            <x-svg.allocation class="h-5" /> Allocations</li>
        </a>
        <a href="{{ route('shipment.index')}}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">
            <x-svg.shipment class="h-5" /> Shipments</li>
        </a>

        <li class="pt-2 pb-2 pl-4 my-2 text-sm font-bold text-gray-600 border-t border-gray-400 shadow-inner">Master Data:</li>

        <a href="{{ route('admin.foodbanks.index')}}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('admin/foodbanks*')) ? 'bg-teal-100' : '' }}">
            <x-svg.foodbank class="h-5" /> Food Banks</li>
        </a>

        
    <a href="{{ route('admin.contacts.index')}}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('admin/contacts*')) ? 'bg-teal-100' : '' }}">
            <x-svg.contact class="h-5" /> Contacts</li>
        </a>

        <a href="{{ route('admin.clubs.index')}}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">
            <x-svg.club class="h-5" />Clubs</li>
        </a>

        <a href="{{ route('admin.suppliers.index')}}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">
                <x-svg.supplier class="h-5" /> Suppliers</li>
        </a>

        <a href="{{ route('admin.shippers.index')}}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">
            <x-svg.shipper class="h-5" /> Shippers</li>
        </a>

        <a href="{{ route('admin.items.index')}}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">
            <x-svg.item class="h-5" /> Items</li>
        </a>

        <li class="pt-2 pb-2 pl-4 my-2 text-sm font-bold text-gray-600 border-t border-gray-400 shadow-inner">Administration:</li>

        @can('Users.edit')
            <a href="{{ route('admin.users.index') }}">
                <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                {{ (request()->is('admin/users*')) ? 'bg-teal-100' : '' }}">
                <x-svg.users class="h-5" /> Users</li>
            </a>
            <a href="{{ route('admin.roles.index') }}">
                <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                {{ (request()->is('admin/roles*')) ? 'bg-teal-100' : '' }}">
                <x-svg.roles class="h-5" /> Roles</li>
            </a>
        @else
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded">
                <x-svg.users class="h-5" /> Users</li>
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded">
                            <x-svg.roles class="h-5" /> Roles</li>
        @endcan
    </ul>
</div>