@extends('playground::layouts.resource.form', [
    'withFormInfo' => 'playground-crm-resource::people/form-info',
    'withFormStatus' => 'playground-crm-resource::people/form-status',
])

@section('form-tertiary')
@include('playground-crm-resource::people/form-publishing')
@endsection
