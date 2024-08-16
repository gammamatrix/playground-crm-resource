@extends('playground::layouts.resource.form', [
    'withFormInfo' => 'playground-crm-resource::people/form-info',
    'withFormStatus' => 'playground-crm-resource::people/form-status',
])

@section('form-tertiary')
@include('playground-crm-resource::people/form-publishing')
@endsection

@section('form-quaternary')
@includeWhen(
    !empty($_method) && 'patch' === $_method,
    'playground-crm-resource::people/form-revisions'
)
@endsection
