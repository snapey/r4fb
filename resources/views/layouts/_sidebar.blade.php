<div class="sticky w-48 pt-4 text-sm font-bold text-teal-700 shadow-inner">
    <ul>
        <a href="{{ route('home') }}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('home*')) ? 'bg-teal-100' : '' }}">Dashboard</li>
        </a>
        <li class="pt-2 pb-2 pl-4 my-2 text-sm font-bold text-gray-600 border-t border-gray-400 shadow-inner">Operational:</li>

        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">Orders</li>
        </a>
        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">Requests</li>
        </a>
        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">Receipts</li>
        </a>
        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">Allocations</li>
        </a>
        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">Shipments</li>
        </a>

        <li class="pt-2 pb-2 pl-4 my-2 text-sm font-bold text-gray-600 border-t border-gray-400 shadow-inner">Master Data:</li>

        <a href="{{ route('admin.foodbanks.index')}}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('admin/foodbanks*')) ? 'bg-teal-100' : '' }}">Foodbanks</li>
        </a>

        
    <a href="{{ route('admin.contacts.index')}}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('admin/contacts*')) ? 'bg-teal-100' : '' }}">Contacts</li>
        </a>

        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">Clubs</li>
        </a>

        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">Suppliers</li>
        </a>

        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('link')) ? 'bg-teal-100' : '' }}">Shippers</li>
        </a>

        <li class="pt-2 pb-2 pl-4 my-2 text-sm font-bold text-gray-600 border-t border-gray-400 shadow-inner">Administration:</li>

        <a href="{{ route('admin.users.index') }}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('admin/users*')) ? 'bg-teal-100' : '' }}">Users</li>
        </a>
        <a href="{{ route('admin.roles.index') }}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('admin/roles*')) ? 'bg-teal-100' : '' }}">Roles</li>
        </a>
    </ul>
</div>