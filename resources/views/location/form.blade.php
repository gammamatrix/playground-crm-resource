@extends('playground::layouts.resource.form', [
    'withFormInfo' => 'playground-crm-resource::location/form-info',
    'withFormStatus' => 'playground-crm-resource::location/form-status',
])

@section('form-tertiary')
@include('playground-crm-resource::location/form-publishing')
@endsection

@section('form-quaternary')
@includeWhen(
    !empty($_method) && 'patch' === $_method,
    'playground-crm-resource::location/form-revisions'
)
@endsection
