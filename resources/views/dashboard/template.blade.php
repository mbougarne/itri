@extends('dashboard.layouts.master')

@section('content')
    <div class="row">
        <x-dashboard.stats
            icon="fas fa-newspaper"
            background="primary"
            title="posts"
            count="10"
        />
        <x-dashboard.stats
            icon="fas fa-comments"
            background="success"
            title="comments"
            count="100"
        />
        <x-dashboard.stats
            icon="fas fa-mail-bulk"
            background="warning"
            title="messages"
            count="20"
        />
        <x-dashboard.stats
            icon="fas fa-heart"
            background="danger"
            title="contacts"
            count="20"
        />
    </div>
    {{-- Latest Posts --}}
    <div class="row">
        <x-dashboard.latest-posts />
        <x-dashboard.latest-comments />
    </div>
@endsection
