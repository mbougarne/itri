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
    {{-- Create --}}
    <form
        action="{{ route('posts.create') }}"
        method="POST"
        enctype="multipart/form-data">
        {{-- Fields --}}
        <div class="row">
            <div class="col-12">
                {{-- Card --}}
                <div class="card">
                    {{-- Header --}}
                    <div class="card-header">
                    <h4> {{ __("Write Your Post") }} </h4>
                    </div>
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
                                    value="{{ old('title'), '' }}"
                                    class="form-control"
                                    placeholder="{{ __("What's new in Laravel 7") }}">
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
                                                class="selectgroup-input">
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
                                    value="{{ old('description') }}">
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
                                    class="summernote"
                                >{{ old('body') }}</textarea>
                            </div>
                        </div>
                        {{-- Thumbnail --}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                {{ __("Thumbnail") }}
                            </label>
                            <div class="col-sm-12 col-md-7">
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
                                    value="{{ old('tags'), '' }}"
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
                                <option value="1">{{ __('Publish') }}</option>
                                <option value="0">{{ __('Pending') }}</option>
                            </select>
                            </div>
                        </div>
                        {{-- Submit --}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                @csrf
                                <button class="btn btn-primary" type="submit">
                                    {{ __('Create Post') }}
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
<script src="{{ asset('default/stisla/summernote-bs4.js') }}"></script>
<script src="{{ asset('default/stisla/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('default/stisla/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ asset('default/stisla/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('default/stisla/page/features-post-create.js') }}"></script>

<script>

    $(document).ready( function($) {

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

    })
</script>
@endsection
