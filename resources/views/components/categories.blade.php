{{-- Categories Table --}}
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            {{-- Header --}}
            <div class="card-header">
                <h4>{{ __("All Categories") }}</h4>
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
                                <th>{{ __("Status") }}</th>
                                <th>{{ __("Created At") }}</th>
                            </tr>
                            @forelse ($categories as $category)
                                <tr>
                                    {{-- Count --}}
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    {{-- title --}}
                                    <td>
                                        <div>
                                            <div class="float-left">
                                                <img
                                                    alt="image"
                                                    class="mr-3"
                                                    width="65"
                                                    src="{{ asset($category->thumbnail) }}">
                                            </div>
                                            <span>
                                                {{ $category->name }}
                                                <br>
                                                <small>
                                                    {{ $category->description }}
                                                </small>
                                            </span>
                                        </div>
                                        <div class="table-links">
                                            <div class="bullet"></div>
                                            <a href="{{ route('categories.update', $category->slug) }}">
                                                {{ __("Edit") }}
                                            </a>
                                        </div>
                                    </td>
                                    {{-- Status --}}
                                    <td>
                                        <div class="badge badge-{{($category->is_sub == 'Sub Category') ? 'info' : 'primary'}}">
                                            {{ $category->is_sub }}
                                        </div>
                                    </td>
                                    {{-- Created At --}}
                                    <td>
                                        {{ $category->created_at->diffForHumans() }}
                                        <br>
                                        <small class="text-muted">
                                            {{ $category->created_at->toFormattedDateString() }}
                                        </small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        {{ __("No category has created yet!") }}
                                        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm btn-round">
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
