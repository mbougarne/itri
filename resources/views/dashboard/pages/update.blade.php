@extends('dashboard.layouts.master')
{{-- Custom Styles --}}
@section('styles')
<link rel="stylesheet" href="{{ asset('default/css/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('default/css/selectric.css') }}">
@endsection
{{-- Content --}}
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
                        <h4> {{ __("Update Page") }} </h4>
                        {{-- Delete form --}}
                        <form
                            action="{{ route('pages.delete', $page->slug) }}"
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
                    {{-- Form --}}
                    <form
                        action="{{ route('pages.update', $page->slug) }}"
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
                                        value="{{ old('title', $page->title) }}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ print_r($message) }}</strong>
                                        </span>
                                    @enderror
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
                                        value="{{ old('description', $page->description) }}">
                                    {{-- Alert --}}
                                    <div class="alert alert-dark alert-has-icon p-2">
                                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                        <div class="alert-body">
                                            {{ __("A brief description about the page for SEO") }}
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
                                    >{{ old('body', $page->body) }}</textarea>
                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
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
                                    {{-- Old one --}}
                                    <div class="mb-1">
                                        <p>
                                            <strong>{{ __("The current thumbnail:") }}</strong>
                                        </p>
                                        <img
                                            src="{{ asset($page->thumbnail) }}"
                                            class="img-fluid"
                                            width="245">
                                    </div>
                                    {{-- Upload New One --}}
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">
                                            {{ __("Choose File") }}
                                        </label>
                                        <input type="file" name="thumbnail" id="image-upload">
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
                                    <option
                                        value="1"
                                        {{ ($page->is_published == 'Published') ? 'selected' : ''}}>
                                        {{ __('Publish') }}
                                    </option>
                                    {{-- Draft --}}
                                    <option
                                        value="0"
                                        {{ ($page->is_published == 'Draft') ? 'selected' : ''}}>
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
                                        {{ __('Update Page') }}
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
