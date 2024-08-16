@extends('playground::layouts.resource.form', [
    'withFormInfo' => 'playground-crm-resource::organization/form-info',
    'withFormStatus' => 'playground-crm-resource::organization/form-status',
])

@section('form-tertiary')
@include('playground-crm-resource::organization/form-publishing')
@endsection
