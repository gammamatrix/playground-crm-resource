@extends('playground::layouts.resource.form', [
    'withFormInfo' => 'playground-crm-resource::client/form-info',
    'withFormStatus' => 'playground-crm-resource::client/form-status',
])

@section('form-tertiary')
@include('playground-crm-resource::client/form-publishing')
@endsection
