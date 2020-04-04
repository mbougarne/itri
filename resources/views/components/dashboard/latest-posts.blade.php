{{-- Latest Posts --}}
<div class="col-md-8 col-sm-12">
    {{-- Card --}}
    <div class="card">
        {{-- Card Header --}}
        <div class="card-header">
            <h4>{{ __("Latest Posts")}}</h4>
            <div class="card-header-action">
                <a href="{{ route('posts') }}" class="btn btn-primary">{{ __("View All") }}</a>
            </div>
        </div>
        {{-- Card Body --}}
        <div class="card-body p-0">
            {{-- Table Container --}}
            <div class="table-responsive">
                {{-- Table --}}
                <table class="table table-striped mb-0">
                    {{-- Table Header --}}
                    <thead>
                        <tr>
                            <th>{{ __("Title") }}</th>
                            <th>{{ __("Create At") }}</th>
                            <th>{{ __("Action") }}</th>
                        </tr>
                    </thead>
                    {{-- Table Body --}}
                    <tbody>
                        {{-- Post Item --}}
                        @forelse ($posts as $post)
                        <tr>
                            {{-- Title --}}
                            <td>
                                <p>
                                    <img
                                        alt="image"
                                        class="mr-3"
                                        src="{{ asset($post->getThumbnail()) }}">
                                    {{ $post->title }}
                                </p>
                            </td>
                            {{-- Created At --}}
                            <td>
                                <small class="text-muted">
                                    {{ $post->created_at->diffForHumans() }}
                                </small>
                            </td>
                            {{-- Manage --}}
                            <td>
                                <a
                                    class="btn btn-primary btn-action mr-1"
                                    data-toggle="tooltip"
                                    title="{{ __("Edit") }}"
                                    data-original-title="{{ __("Edit") }}"
                                    href="{{ route("post.update", $post->slug) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="2">
                                    <p class="text-muted">
                                        {{ __("No post has created yet!") }}
                                        <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm btn-round">
                                            {{ __("Create New One") }}
                                        </a>
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
