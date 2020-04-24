<div>
    {{-- Title and Description --}}
    <h2 class="section-title">
        {{ __($title) }}
    </h2>
    <p class="section-lead">
        {{ __($description) }}
    </p>
    @if(!blank($links))
    {{-- Navigation Menus --}}
    <div class="row">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body">
                    <ul class="nav nav-pills">
                        @forelse ($links as $route => $label)
                            @if($loop->first)
                                <li class="nav-item">
                                    <a
                                        class="nav-link {{ route_active_status($route) }}"
                                        href="{{ route($route) }}">
                                        {{ __($label) }}
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a
                                        class="nav-link {{ route_active_status($route) }}"
                                        href="{{ route($route) }}">
                                        {{ __($label) }}
                                    </a>
                                </li>
                            @endif
                        @empty
                            <li class="nav-item">
                                <a class="nav-link active" href="#">
                                    {{ __("All") }}
                                </a>
                            </li>
                        @endforelse
                        {{-- Create Button --}}
                        @if(!in_array(request()->segment(2), ['tags', 'comments']))
                        <li class="nav-item ml-auto">
                            <a class="btn btn-success" href="{{ route(request()->segment(2) . '.create') }}">
                                <i class="fas fa-edit"></i>
                                {{ __("Create New " . Str::singular(request()->segment(2))) }}
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
