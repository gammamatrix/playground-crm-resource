@extends('playground::layouts.resource.form', [
    'withFormInfo' => 'playground-crm-resource::contact/form-info',
    'withFormStatus' => 'playground-crm-resource::contact/form-status',
])

@section('form-tertiary')
@include('playground-crm-resource::contact/form-publishing')
@endsection

@section('form-quaternary')
@includeWhen(
    !empty($_method) && 'patch' === $_method,
    'playground-crm-resource::contact/form-revisions'
)
@endsection
