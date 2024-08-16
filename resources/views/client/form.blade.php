@extends('playground::layouts.resource.form', [
    'withFormInfo' => 'playground-crm-resource::client/form-info',
    'withFormStatus' => 'playground-crm-resource::client/form-status',
])

@section('form-tertiary')
@include('playground-crm-resource::client/form-publishing')
@endsection

@section('form-quaternary')
@includeWhen(
    !empty($_method) && 'patch' === $_method,
    'playground-crm-resource::client/form-revisions'
)
@endsection
