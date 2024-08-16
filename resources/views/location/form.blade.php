@extends('playground::layouts.resource.form', [
    'withFormInfo' => 'playground-crm-resource::location/form-info',
    'withFormStatus' => 'playground-crm-resource::location/form-status',
])

@section('form-tertiary')
@include('playground-crm-resource::location/form-publishing')
@endsection
