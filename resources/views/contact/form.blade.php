@extends('playground::layouts.resource.form', [
    'withFormInfo' => 'playground-crm-resource::contact/form-info',
    'withFormStatus' => 'playground-crm-resource::contact/form-status',
])

@section('form-tertiary')
@include('playground-crm-resource::contact/form-publishing')
@endsection
