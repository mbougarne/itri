@extends('dashboard.layouts.master')

@section('content')
    {{-- Navigation --}}
    <x-content-header
        :title="$title"
        :description="$description"
        :links="$links"
    />
    {{-- comments --}}
    <x-comments :comments="$comments" />
@endsection
