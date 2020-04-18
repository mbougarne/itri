@extends('dashboard.layouts.master')

{{-- Custom Styles --}}
@section('styles')
<link rel="stylesheet" href="{{ asset('default/css/selectric.css') }}">
@endsection

@section('content')
    {{-- Navigation --}}
    <x-content-header :title="$title" :description="$description" />
    {{-- Content --}}
    <div class="row">
        <div class="col-12">
            {{-- Card --}}
            <div class="card">
                {{-- Header --}}
                <div class="card-header">
                    <h4> {{ __("Update category") }} </h4>
                    {{-- Delete form --}}
                    <form
                        action="{{ route('categories.delete', $category->slug) }}"
                        method="POST"
                        class="ml-auto deleteItem">
                        {{-- Delete --}}
                        @csrf
                        <button type="submit" class="btn btn-icon icon-left btn-danger" disabled>
                            <i class="fas fa-times"></i>
                            DELETE
                        </button>
                    </form>
                </div>
                {{-- Card Body  --}}
                <div class="card-body">
                    {{-- Update form --}}
                    <form
                        action="{{ route('categories.update', $category->slug) }}"
                        method="POST"
                        enctype="multipart/form-data">
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
                                    value="{{ old('name', $category->name) }}"
                                    class="form-control @error('name') is-invalid @enderror "
                                    placeholder="{{ __("Lessons") }}">
                                @error('name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Categories --}}
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
                                @foreach ($categories as $cat)
                                    <option
                                        value="{{ $cat->id }}"
                                        {{ ($cat->id == $category->parent_id) ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
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
                                    class="form-control @error('description') is-invalid @enderror"
                                    value="{{ old('description', $category->description) }}"
                                    placeholder="{{ __("A category about the lessons") }}">
                                @error('description')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Thumbnail --}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                {{ __("Thumbnail") }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <div class="mb-2">
                                    <p><strong>Current Thumbnail:</strong></p>
                                    <img
                                        src="{{ asset($category->thumbnail) }}"
                                        class="img-fluid"
                                        width="245">
                                </div>
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
                                    {{ __('Update Category') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('default/stisla/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('default/stisla/jquery.uploadPreview.min.js') }}"></script>
{{-- Delete Post --}}
<script src="{{ asset('default/stisla/sweetalert.min.js') }}"></script>
<script>
    $(document).ready( function($) {

        $(".select").selectric();
        $.uploadPreview({
            input_field: "#image-upload",
            preview_box: "#image-preview",
            label_field: "#image-label",
            label_default: "Choose File",
            label_selected: "Change File",
            no_label: false,
            success_callback: null
        });

    })
</script>
@endsection
