@extends('layouts.app', [
    'pageTitle' => __('Comments') . ' — ' . $record->title,
    'pageName' => 'comments-index',
    'mainAutoOverflowed' => false,
])

@section('content')
    <div class="main-box">
        {{-- Toolbar --}}
        <div class="toolbar">
            <x-layouts.breadcrumbs :crumbs="$breadcrumbs" />
        </div>

        @can('edit-comments')
            @include('comments.partials.create-form')
        @endcan

        @include('comments.partials.list')

        {{-- Modals --}}
        <x-modals.target-delete :forceDelete="false" />
    </div>
@endsection
