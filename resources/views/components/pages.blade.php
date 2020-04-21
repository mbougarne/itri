{{-- Pages Table --}}
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            {{-- Header --}}
            <div class="card-header">
                <h4>{{ __("All Pages") }}</h4>
            </div>
            {{-- Content --}}
            <div class="card-body">
                <div class="clearfix mb-3"></div>
                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>#</td>
                                <th>{{ __("Title") }}</th>
                                <th>{{ __("Created At") }}</th>
                                <th>{{ __("Status") }}</th>
                            </tr>
                            @forelse ($pages as $page)
                                <tr>
                                    {{-- Count --}}
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    {{-- title --}}
                                    <td>
                                        <div>
                                            {{-- Thumbnail --}}
                                            <div class="float-left">
                                                <img
                                                    alt="image"
                                                    class="mr-3"
                                                    width="55"
                                                    src="{{ asset($page->thumbnail) }}">
                                            </div>
                                            {{-- Content --}}
                                            <div>
                                                {{ $page->title }}
                                                <div class="table-links">
                                                    <a href="{{ route('pages.show', $page->slug) }}">
                                                        {{ __("View") }}
                                                    </a>
                                                    <div class="bullet"></div>
                                                    <a href="{{ route('pages.update', $page->slug) }}">
                                                        {{ __("Edit") }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    {{-- Created At --}}
                                    <td>
                                        {{ $page->created_at->toFormattedDateString() }}
                                    </td>
                                    {{-- Published At --}}
                                    <td>
                                        <div class="badge badge-{{($page->is_published === 'Published') ? 'primary' : 'warning'}}">
                                            {{ $page->is_published }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        {{ __("No page has created yet!") }}
                                        <a href="{{ route('pages.create') }}" class="btn btn-primary btn-sm btn-round">
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
