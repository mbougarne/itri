@php
    $catsIds = $post->categories()->allRelatedIds()->toArray();
    $tagsNames = $post->tags()->pluck('name')->toArray();
    $tagsNames = trim(implode(', ', $tagsNames));
@endphp
@extends('dashboard.layouts.master')
{{-- Custom Styles --}}
@section('styles')
<link rel="stylesheet" href="{{ asset('default/css/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('default/css/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('default/css/bootstrap-tagsinput.css') }}">
@endsection

@section('content')
    {{-- Navigation --}}
    <x-content-header :title="$title" :description="$description" />
    {{-- Update --}}
        <div class="row">
            <div class="col-12">
                {{-- Card --}}
                <div class="card">
                    {{-- Header --}}
                    <div class="card-header">
                        {{-- Title --}}
                        <h4> {{ __("Write Your Post") }} </h4>
                        {{-- Delete form --}}
                        <form
                            action="{{ route('posts.delete', $post->slug) }}"
                            method="POST"
                            class="ml-auto deleteItem">
                            {{-- Delete --}}
                            @csrf
                            <button type="submit" class="btn btn-icon icon-left btn-danger">
                                <i class="fas fa-times"></i>
                                DELETE
                            </button>
                        </form>
                    </div>
                    {{-- Form --}}
                    <form
                        action="{{ route('posts.update', $post->slug) }}"
                        method="POST"
                        enctype="multipart/form-data">
                        {{-- Card Body  --}}
                        <div class="card-body">
                            {{-- Title --}}
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="title">
                                    {{ __("Title") }}
                                </label>
                                <div class="col-sm-12 col-md-7">
                                    <input
                                        type="text"
                                        id="title"
                                        name="title"
                                        value="{{ old('title', $post->title) }}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="{{ __("What's new in Laravel 7") }}"
                                        required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ print_r($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Categories --}}
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                    for="categories">
                                    {{ __("Categories") }}
                                </label>
                                <div class="col-sm-12 col-md-7">

                                    <div class="selectgroup w-100">
                                        @forelse ($categories as $category)

                                            <label class="selectgroup-item">
                                                <input
                                                    type="checkbox"
                                                    name="categories[]"
                                                    value="{{ old('categories', $category->id) }}"
                                                    class="selectgroup-input"
                                                    {{ (in_array($category->id, $catsIds)) ? 'checked' : '' }}>
                                                <span class="selectgroup-button">
                                                    {{ $category->name }}
                                                </span>
                                            </label>
                                        @empty
                                            <p>
                                                {{ __("The system doesn't have any category yet!") }}
                                                <a href="{{ route('category.create') }}">
                                                    {{ __("Create New One") }}
                                                </a>
                                            </p>
                                        @endforelse
                                    </div>
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
                                        class="form-control"
                                        value="{{ old('description', $post->description) }}">
                                    {{-- Alert --}}
                                    <div class="alert alert-dark alert-has-icon p-2">
                                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                        <div class="alert-body">
                                            {{ __("A brief description about the article for SEO") }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Post Body --}}
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="body">
                                    {{ __("Content") }}
                                </label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea
                                        id="body"
                                        name="body"
                                        class="summernote @error('body') is-invalid @enderror"
                                        required
                                    >{{ old('body', $post->body) }}</textarea>
                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}@error('body') is-invalid @enderror
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
                                    {{-- Old one --}}
                                    <div class="mb-1">
                                        <p>
                                            <strong>{{ __("The current thumbnail:") }}</strong>
                                        </p>
                                        <img
                                            src="{{ asset($post->thumbnail) }}"
                                            class="img-fluid"
                                            width="245">
                                    </div>
                                    {{-- Upload New One --}}
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Choose File</label>
                                        <input type="file" name="thumbnail" id="image-upload">
                                    </div>
                                </div>
                            </div>
                            {{-- Tags --}}
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="tags">
                                    {{ __('Tags') }}
                                </label>
                                <div class="col-sm-12 col-md-7">
                                    <input
                                        type="text"
                                        id="tags"
                                        name="tags"
                                        value="{{ old('tags', $tagsNames) }}"
                                        class="form-control inputtags">
                                    <div class="alert alert-dark alert-has-icon p-2">
                                        <div class="alert-icon"><i class="fas fa-ban"></i></div>
                                        <div class="alert-body">
                                            {{ __("Click enter or separate them with comma") }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Status --}}
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="isPublished">
                                    {{ __('Status') }}
                                </label>
                                <div class="col-sm-12 col-md-7">
                                <select class="form-control selectric" name="is_published" is="isPublished">
                                    <option value="1" {{ ($post->is_published == 'Published') ? 'selected' : ''}}>
                                        {{ __('Publish') }}
                                    </option>
                                    {{-- Draft --}}
                                    <option value="0" {{ ($post->is_published == 'Draft') ? 'selected' : ''}}>
                                        {{ __('Draft') }}
                                    </option>
                                </select>
                                </div>
                            </div>
                            {{-- Submit --}}
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    @csrf
                                    <button class="btn btn-primary" type="submit">
                                        {{ __('Update Post') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
<script src="{{ asset('default/stisla/summernote-bs4.js') }}"></script>
<script src="{{ asset('default/stisla/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('default/stisla/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ asset('default/stisla/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('default/stisla/page/features-post-create.js') }}"></script>
{{-- Delete Post --}}
<script src="{{ asset('default/stisla/sweetalert.min.js') }}"></script>

<script>

    $(document).ready( function($) {
        // Send image file
        function sendFile(file) {

            let form_data = new FormData();
                form_data.append('upload_image', file);
                form_data.append('_token', "{{ csrf_token() }}");

            $.ajax({
                data: form_data,
                type: "POST",
                url: "{{ route('upload.image') }}",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('.summernote').summernote('editor.insertImage', response.path);
                }
            });
        }
        // Summer Note
        $(".summernote").summernote({
            dialogsInBody: true,
            height: 300,
            minHeight: null,
            maxHeight: null,
            toolbar: [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'strikethrough']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['genixcms', ['elfinder']],
                ['view', ['codeview']]
            ],
            callbacks:{
                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0])
                }
            }
        });
        // Confirmation Alert
        $(".deleteItem").submit(function(e) {
            e.preventDefault();
            swal({
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('Once deleted, you will not be able to recover this post!') }}",
                icon: 'error',
                buttons: true,
                dangerMode: true,
            })
            .then( willDelete => {
                if (willDelete) {

                    swal( "{{ __('Your post has been deleted!') }}",
                        {
                            icon: 'success',
                        });
                    e.target.submit();

                } else {
                    swal('Your imaginary file is safe!');
                }
            });
        });
    })
</script>
@endsection
