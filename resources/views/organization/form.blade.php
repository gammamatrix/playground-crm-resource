@extends('playground::layouts.resource.form', [
    'withFormInfo' => 'playground-crm-resource::organization/form-info',
    'withFormStatus' => 'playground-crm-resource::organization/form-status',
])

@section('form-tertiary')
@include('playground-crm-resource::organization/form-publishing')
@endsection

@section('form-quaternary')
@includeWhen(
    !empty($_method) && 'patch' === $_method,
    'playground-crm-resource::organization/form-revisions'
)
@endsection
