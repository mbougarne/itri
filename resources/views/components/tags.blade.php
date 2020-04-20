{{-- Tags Table --}}
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            {{-- Header --}}
            <div class="card-header">
                <h4>{{ __("All Tags") }}</h4>
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
                                <th>{{ __("Name") }}</th>
                                <th>{{ __("slug") }}</th>
                                <th>{{ __("Created At") }}</th>
                            </tr>
                            @forelse ($tags as $tag)
                                <tr>
                                    {{-- Count --}}
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    {{-- title --}}
                                    <td>
                                        <div>
                                            {{ $tag->name }}
                                        </div>
                                        <div class="table-links">
                                            <div class="bullet"></div>
                                            <a href="{{ route('tags.update', $tag->slug) }}">
                                                {{ __("Edit") }}
                                            </a>
                                        </div>
                                    </td>
                                    {{-- Status --}}
                                    <td>
                                        {{ $tag->slug }}
                                    </td>
                                    {{-- Created At --}}
                                    <td>
                                        {{ $tag->created_at->diffForHumans() }}
                                        <br>
                                        <small class="text-muted">
                                            {{ $tag->created_at->toFormattedDateString() }}
                                        </small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        {{ __("No tag has created yet!") }}
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
