<div class="w-48 sticky shadow-inner pt-4 text-sm text-teal-700 font-bold">
    <ul>
        <a href="{{ route('home') }}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('home*')) ? 'bg-blue-100' : '' }}">Dashboard</li>
        </a>
        <li class="shadow-inner border-gray-400 border-t text-gray-600 font-bold my-2 pt-2 pb-2 pl-4 text-sm">Operational:</li>

        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('foodbanks*')) ? 'bg-blue-100' : '' }}">Orders</li>
        </a>
        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('foodbanks*')) ? 'bg-blue-100' : '' }}">Requests</li>
        </a>
        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('foodbanks*')) ? 'bg-blue-100' : '' }}">Receipts</li>
        </a>
        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('foodbanks*')) ? 'bg-blue-100' : '' }}">Allocations</li>
        </a>
        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('foodbanks*')) ? 'bg-blue-100' : '' }}">Shipments</li>
        </a>

        <li class="shadow-inner border-gray-400 border-t text-gray-600 font-bold my-2 pt-2 pb-2 pl-4 text-sm">Master Data:</li>

        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('foodbanks*')) ? 'bg-blue-100' : '' }}">Foodbanks</li>
        </a>

        
        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('foodbanks*')) ? 'bg-blue-100' : '' }}">Contacts</li>
        </a>

        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('foodbanks*')) ? 'bg-blue-100' : '' }}">Clubs</li>
        </a>

        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
                {{ (request()->is('foodbanks*')) ? 'bg-blue-100' : '' }}">Suppliers</li>
        </a>

        <a href="#">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('foodbanks*')) ? 'bg-blue-100' : '' }}">Shippers</li>
        </a>

        <li class="shadow-inner border-gray-400 border-t text-gray-600 font-bold my-2 pt-2 pb-2 pl-4 text-sm">Administration:</li>

        <a href="{{ route('admin.users.index') }}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('admin/users*')) ? 'bg-blue-100' : '' }}">Users</li>
        </a>
        <a href="{{ route('admin.roles.index') }}">
            <li class="mx-2 py-2 px-2 hover:bg-teal-100 hover:border border-2 hover:text-teal-900 border-transparent hover:border-teal-700 rounded
            {{ (request()->is('admin/roles*')) ? 'bg-blue-100' : '' }}">Roles</li>
        </a>
    </ul>
</div>