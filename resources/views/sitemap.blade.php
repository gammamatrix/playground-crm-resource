<?php
$user = \Illuminate\Support\Facades\Auth::user();

$viewClients = \Playground\Auth\Facades\Can::access($user, [
    'allow' => false,
    'any' => true,
    'privilege' => 'playground-crm-resource:client:viewAny',
    'roles' => ['admin', 'manager', 'publisher'],
])->allowed();

$viewContacts = \Playground\Auth\Facades\Can::access($user, [
    'allow' => false,
    'any' => true,
    'privilege' => 'playground-crm-resource:contact:viewAny',
    'roles' => ['admin', 'manager', 'publisher'],
])->allowed();

$viewLocations = \Playground\Auth\Facades\Can::access($user, [
    'allow' => false,
    'any' => true,
    'privilege' => 'playground-crm-resource:location:viewAny',
    'roles' => ['admin', 'manager', 'publisher'],
])->allowed();

$viewOrganizations = \Playground\Auth\Facades\Can::access($user, [
    'allow' => false,
    'any' => true,
    'privilege' => 'playground-crm-resource:organization:viewAny',
    'roles' => ['admin', 'manager', 'publisher'],
])->allowed();

$viewPeople = \Playground\Auth\Facades\Can::access($user, [
    'allow' => false,
    'any' => true,
    'privilege' => 'playground-crm-resource:people:viewAny',
    'roles' => ['admin', 'manager', 'publisher'],
])->allowed();


if (!$viewClients && !$viewContacts && !$viewLocations && !$viewOrganizations && !$viewPeople) {
    return;
}
?>
<div class="card my-1">
    <div class="card-body">

        <h2>CRM</h2>

        <div class="row">

            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">
                    Client Relationship Management System
                    <small class="text-muted">clients, contacts, locations, organizations and people</small>
                    </div>
                    <ul class="list-group list-group-flush">

                        @if ($viewClients)
                        <a href="{{ route('playground.crm.resource.clients') }}" class="list-group-item list-group-item-action">
                            Clients
                        </a>
                        @endif

                        @if ($viewContacts)
                        <a href="{{ route('playground.crm.resource.contacts') }}" class="list-group-item list-group-item-action">
                            Contacts
                        </a>
                        @endif

                        @if ($viewLocations)
                        <a href="{{ route('playground.crm.resource.locations') }}" class="list-group-item list-group-item-action">
                            Locations
                        </a>
                        @endif

                        @if ($viewOrganizations)
                        <a href="{{ route('playground.crm.resource.organizations') }}" class="list-group-item list-group-item-action">
                            Organizations
                        </a>
                        @endif

                        @if ($viewPeople)
                        <a href="{{ route('playground.crm.resource.people') }}" class="list-group-item list-group-item-action">
                            People
                        </a>
                        @endif

                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>
