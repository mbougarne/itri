@extends('dashboard.layouts.master')

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
                        action="{{ route('tags.delete', $tag->slug) }}"
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
                        action="{{ route('tags.update', $tag->slug) }}"
                        method="POST">
                        {{-- Tag Name --}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="name">
                                {{ __("Name") }}
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $tag->name) }}"
                                    class="form-control @error('name') is-invalid @enderror "
                                    placeholder="{{ __("Lesson") }}">
                                @error('name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Submit --}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                @csrf
                                <button class="btn btn-primary" type="submit">
                                    {{ __('Update Tag') }}
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
    <script src="{{ asset('default/stisla/sweetalert.min.js') }}"></script>
@endsection
