<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="{{ $description ??  ''}}">
    <title>{{ $title ?? env('APP_NAME') }}</title>
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    {{-- bootstrap and fontawesome --}}
    <link rel="stylesheet" href="{{ asset('default/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('default/css/fontawesome.min.css') }}">
    {{-- Libs --}}
    @yield('styles')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('default/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('default/css/components.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('default/css/rtl.css') }}"> --}}
    <style>
        {!! $settings->styles ?? '' !!}
    </style>
    {!! $settings->header_scripts ?? '' !!}
</head>

{{-- Main template Body --}}
<body class="layout-2">
    {{-- App Container --}}
    <div id="app">
        {{-- Global Wrapper --}}
        <div class="main-wrapper">
            {{-- Navigation --}}
            @include('dashboard.partials.navbar')
            {{-- Sidebar --}}
            @include('dashboard.partials.sidebar')
