@extends('dashboard.layouts.master')

@section('content')
    {{-- Navigation --}}
    <x-content-header
        :title="$title"
        :description="$description"
        :links="$links"
    />
    {{-- tags --}}
    <x-tags :tags="$tags" />
@endsection
