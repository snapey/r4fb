<div class="sticky w-48 pt-4 text-sm font-bold text-teal-700 shadow-inner">
    <ul>
        <a href="{{ route('home') }}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('home*')) ? 'bg-teal-100' : '' }}">
            <x-svg.dashboard class="h-5" /> Dashboard</li>
        </a>
        <li class="pt-2 pb-2 pl-4 my-2 text-sm font-bold text-gray-600 border-t border-gray-400 shadow-inner">Operational:</li>

        @can('Orders.view')
        <a href="{{ route('orders.index') }}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('orders*')) ? 'bg-teal-100' : '' }}">
            <x-svg.order class="h-5" /> Orders</li>
        </a>
        @else
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded cursor-not-allowed hover:border-gray-300"><x-svg.order class="h-5" /> Orders</li>
        @endcan
        
        @can('Requests.view')
        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">
            <x-svg.request class="h-5" /> Requests</li>
        </a>
        @else
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded cursor-not-allowed hover:border-gray-300">
            <x-svg.request class="h-5" /> Requests</li>
        @endcan
        
        @can('Allocations.view')
            <a href="{{ route('allocations.index')}}">
                <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                {{ (request()->is('allocations*')) ? 'bg-teal-100' : '' }}">
                <x-svg.allocation class="h-5" /> Allocations</li>
            </a>
        @else
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded cursor-not-allowed hover:border-gray-300">
                <x-svg.allocation class="h-5" /> Allocations</li>
        @endcan

        @can('Shipments.view')
            <a href="{{ route('shipment.index')}}">
                <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">
                <x-svg.shipment class="h-5" /> Shipments</li>
            </a>
        @else
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded cursor-not-allowed hover:border-gray-300">
                <x-svg.shipment class="h-5" /> Shipments</li>
        @endcan

        <li class="pt-2 pb-2 pl-4 my-2 text-sm font-bold text-gray-600 border-t border-gray-400 shadow-inner">Master Data:</li>

        @can('Foodbanks.view')
            <a href="{{ route('admin.foodbanks.index')}}">
                <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                {{ (request()->is('admin/foodbanks*')) ? 'bg-teal-100' : '' }}">
                <x-svg.foodbank class="h-5" /> Food Banks</li>
            </a>
        @else
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded cursor-not-allowed hover:border-gray-300">
                <x-svg.foodbank class="h-5" /> Food Banks</li>
        @endcan

        @can('Contacts.view')
            <a href="{{ route('admin.contacts.index')}}">
                <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                {{ (request()->is('admin/contacts*')) ? 'bg-teal-100' : '' }}">
                <x-svg.contact class="h-5" /> Contacts</li>
            </a>
        @else
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded cursor-not-allowed hover:border-gray-300">
                <x-svg.contact class="h-5" /> Contacts</li>
        @endcan
        
        @can('Clubs.view')
            <a href="{{ route('admin.clubs.index')}}">
                <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">
                <x-svg.club class="h-5" />Clubs</li>
            </a>
        @else
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded cursor-not-allowed hover:border-gray-300">
                <x-svg.club class="h-5" /> Clubs</li>
        @endcan

        @can('Suppliers.view')    
            <a href="{{ route('admin.suppliers.index')}}">
                <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                    {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">
                    <x-svg.supplier class="h-5" /> Suppliers</li>
            </a>
        @else
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded cursor-not-allowed hover:border-gray-300">
                <x-svg.supplier class="h-5" /> Suppliers</li>
        @endcan

        @can('Shippers.view')
            <a href="{{ route('admin.shippers.index')}}">
                <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">
                <x-svg.shipper class="h-5" /> Shippers</li>
            </a>
        @else
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded cursor-not-allowed hover:border-gray-300">
                <x-svg.shipper class="h-5" /> Shippers</li>
        @endcan

        @can('Items.view')
            <a href="{{ route('admin.items.index')}}">
                <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">
                <x-svg.item class="h-5" /> Items</li>
            </a>
        @else
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded cursor-not-allowed hover:border-gray-300">
                <x-svg.item class="h-5" /> Items</li>
        @endcan

        @can('Emails.templates.view')
            <a href="{{ route('admin.templates.index')}}">
                <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">
                <x-svg.mail-open class="h-5" /> Email Templates</li>
            </a>
        @else
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded cursor-not-allowed hover:border-gray-300">
                <x-svg.mail-open class="h-5" /> Email Templates</li>
        @endcan

        <li class="pt-2 pb-2 pl-4 my-2 text-sm font-bold text-gray-600 border-t border-gray-400 shadow-inner">Administration:</li>

        @can('Emails.list')
            <a href="{{ route('admin.emails') }}">
                <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                            {{ (request()->is('admin/users*')) ? 'bg-teal-100' : '' }}">
                    <svg class="inline-block h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                     Emails Sent</li>
            </a>
        @else
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded cursor-not-allowed hover:border-gray-300">
                <svg class="inline-block h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg> Emails Sent</li>
        @endcan


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
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded cursor-not-allowed hover:border-gray-300">
                <x-svg.users class="h-5" /> Users</li>
            <li class="px-2 py-2 mx-2 text-gray-600 border-2 border-transparent rounded cursor-not-allowed hover:border-gray-300">
                <x-svg.roles class="h-5" /> Roles</li>
        @endcan
    </ul>
</div>