@extends('dashboard.layouts.master')

@section('content')
    {{-- Navigation --}}
    <x-content-header
        :title="$title"
        :description="$description"
        :links="$links"
    />
    {{-- Posts --}}
    <x-dashboard.posts :posts="$posts" />
@endsection
