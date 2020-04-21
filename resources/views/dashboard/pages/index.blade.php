@extends('dashboard.layouts.master')

@section('content')
    {{-- Navigation --}}
    <x-content-header
        :title="$title"
        :description="$description"
        :links="$links"
    />
    {{-- Pages --}}
    <x-pages :pages="$pages" />
@endsection
