@extends('playground::layouts.resource.layout')

@section('title', 'CRM')

@section('breadcrumbs')
<div class="container-fluid mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('playground.crm.resource') }}">CRM</a></li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card my-1">
                <div class="card-header">
                    <h1>CRM</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card m-1">
                                <div class="card-body">
                                    <h5 class="card-title">Clients</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Manage clients</h6>
                                    <p class="card-text"></p>
                                    <a class="card-link" href="{{ route('playground.crm.resource.clients') }}">View Clients</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card m-1">
                                <div class="card-body">
                                    <h5 class="card-title">Contacts</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Manage contacts</h6>
                                    <p class="card-text"></p>
                                    <a class="card-link" href="{{ route('playground.crm.resource.contacts') }}">View Contacts</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card m-1">
                                <div class="card-body">
                                    <h5 class="card-title">Locations</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Manage locations</h6>
                                    <p class="card-text"></p>
                                    <a class="card-link" href="{{ route('playground.crm.resource.locations') }}">View Locations</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card m-1">
                                <div class="card-body">
                                    <h5 class="card-title">Organizations</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Manage organizations</h6>
                                    <p class="card-text"></p>
                                    <a class="card-link" href="{{ route('playground.crm.resource.organizations') }}">View Organizations</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card m-1">
                                <div class="card-body">
                                    <h5 class="card-title">People</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Manage people</h6>
                                    <p class="card-text"></p>
                                    <a class="card-link" href="{{ route('playground.crm.resource.people') }}">View People</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
