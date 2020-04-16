@extends('dashboard.layouts.master')

{{-- Custom Styles --}}
@section('styles')
<link rel="stylesheet" href="{{ asset('default/css/selectric.css') }}">
@endsection

@section('content')
    {{-- Navigation --}}
    <x-content-header :title="$title" :description="$description" />
    {{-- Create --}}
    <form
        action="{{ route('categories.create') }}"
        method="POST"
        enctype="multipart/form-data">
        {{-- Fields --}}
        <div class="row">
            <div class="col-12">
                {{-- Card --}}
                <div class="card">
                    {{-- Header --}}
                    <div class="card-header">
                    <h4> {{ __("Add new category") }} </h4>
                    </div>
                    {{-- Card Body  --}}
                    <div class="card-body">
                        {{-- Title --}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="name">
                                {{ __("Name") }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name'), '' }}"
                                    class="form-control"
                                    placeholder="{{ __("Lessons") }}">
                            </div>
                        </div>
                        {{-- Categories --}}
                        @if ($categories->count())
                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                for="parent_id">
                                {{ __("Has Parent Category?") }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                    <select
                                        class="form-control selectric"
                                        name="parent_id">
                                        <option selected disabled>
                                            {{ __("Select Parent Category") }}
                                        </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        {{-- Description --}}
                        <div class="form-group row mb-4">
                            {{-- Controller --}}
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="description">
                                {{ __("Description") }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    id="description"
                                    name="description"
                                    class="form-control"
                                    value="{{ old('description') }}"
                                    placeholder="{{ __("A category about the lessons") }}">
                            </div>
                        </div>
                        {{-- Thumbnail --}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                {{ __("Thumbnail") }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">
                                        {{ __("Choose File") }}
                                    </label>
                                    <input type="file" name="thumbnail" id="image-upload">
                                </div>
                            </div>
                        </div>
                        {{-- Submit --}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                @csrf
                                <button class="btn btn-primary" type="submit">
                                    {{ __('Add New Category') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
<script src="{{ asset('default/stisla/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('default/stisla/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ asset('default/stisla/page/features-post-create.js') }}"></script>
@endsection
