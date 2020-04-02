@extends('dashboard.layouts.master')

@section('content')
    <h1>Hello Content</h1>
    <div class="row">
        <x-dashboard.stats
            icon="far fa-user"
            background="success"
            title="users"
            count="10"
        />
    </div>
    {{-- Latest Posts --}}
    <div class="row">
        <x-dashboard.latest-posts :posts="$posts"/>
    </div>
@endsection
