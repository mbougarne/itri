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
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
