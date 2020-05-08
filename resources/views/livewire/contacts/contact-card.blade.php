<div class="m-4 p-4 bg-white shadow rounded overflow-hidden">
    <ul class="space-y-2">
        <li>{{ $contact->forenames }} {{ $contact->surname }}</li>
        <li>{{ $contact->phone1}}</li>
        <li><a href="mailto:{{ $contact->email1}}" target="_blank" class="text-indigo-700 underline">{{ $contact->email1}}</a></li>
    </ul>
</div>
