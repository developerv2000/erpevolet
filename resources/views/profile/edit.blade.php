@extends('layouts.app', [
    'pageTitle' => __('My profile'),
    'pageName' => 'profile-edit',
    'mainAutoOverflowed' => false,
])

@section('content')
    <div class="toolbar">
        {{-- blade-formatter-disable --}}
        @php
            $crumbs = [
                ['link' => null, 'text' => __('My profile')],
                ['link' => null, 'text' => __('Edit')],
            ];
        @endphp
        {{-- blade-formatter-enable --}}

        <x-layouts.breadcrumbs :crumbs="$crumbs" />
    </div>

    @include('profile.partials.personal-data-form')
    @include('profile.partials.password-form')
@endsection
