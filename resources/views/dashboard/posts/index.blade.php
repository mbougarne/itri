@extends('dashboard.layouts.master')

@section('content')
    {{-- Navigation --}}
    <x-content-header
        :title="$title"
        :description="$description"
        :links="$links"
    />
    {{-- Posts --}}
    <x-posts :posts="$posts" />
@endsection
