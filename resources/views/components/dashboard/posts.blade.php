{{-- Posts Table --}}
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            {{-- Header --}}
            <div class="card-header">
                <h4>{{ __("All Posts") }}</h4>
            </div>
            {{-- Content --}}
            <div class="card-body">
                {{-- Search --}}
                <div class="float-right">
                    <form>
                        <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                        </div>
                    </form>
                </div>

                <div class="clearfix mb-3"></div>
                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>#</td>
                                <th>{{ __("Title") }}</th>
                                <th>{{ __("Category") }}</th>
                                <th>{{ __("tags") }}</th>
                                <th>{{ __("Created At") }}</th>
                                <th>{{ __("Status") }}</th>
                            </tr>
                            @forelse ($posts as $post)
                                <tr>
                                    {{-- Count --}}
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    {{-- title --}}
                                    <td>
                                        <img
                                            alt="image"
                                            class="mr-3"
                                            src="{{ asset($post->getThumbnail()) }}">
                                        {{ $post->title }}
                                        <div class="table-links">
                                            <a href="{{ route('post.show', $post->slug) }}">
                                                {{ __("View") }}
                                            </a>
                                            <div class="bullet"></div>
                                            <a href="{{ route('post.update', $post->slug) }}">
                                                {{ __("Edit") }}
                                            </a>
                                        </div>
                                    </td>
                                    {{-- Categories --}}
                                    <td>
                                        @forelse($post->categories as $category)
                                            <a href="{{ route('category.show', $category->slug) }}">
                                                {{ $category->name }}
                                            </a>
                                        @empty
                                            {{ __("The post doesn't have a category") }}
                                        @endforelse
                                    </td>
                                    {{-- Tags --}}
                                    <td>
                                        @forelse($post->tags as $tag)
                                            <a href="{{ route('tag.show', $tag->slug) }}">
                                                {{ $tag->name }}
                                            </a>
                                        @empty
                                            {{ __("The post doesn't have a tag") }}
                                        @endforelse
                                    </td>
                                    {{-- Created At --}}
                                    <td>
                                        {{ $post->created_at->toFormattedDateString() }}
                                    </td>
                                    {{-- Published At --}}
                                    <td>
                                        <div class="badge badge-{{($post->is_published === 'Published') ? 'primary' : 'warning'}}">
                                            {{ $post->is_published }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        {{ __("No post has created yet!") }}
                                        <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm btn-round">
                                            {{ __("Create New One") }}
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
