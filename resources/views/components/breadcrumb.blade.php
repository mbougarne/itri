{{--
    We get the breadcrumbs directly from the current request URL as array.
    Then we loop through each item in the array and use it as name of the route,
    since we have the route names same as uri path, each segment with indexes 1 - 2 is a route name,
    But if we want to get the route for the segment of the index, we must concatinate
    Segment with index 2 and iteration 3
--}}
<div class="section-header">
    <h1>{{$title}}</h1>
    <div class="section-header-breadcrumb">

        @foreach ($items(request()->segments()) as $item)

            @if($loop->last)
                <div class="breadcrumb-item">{{ __(ucwords($item)) }}</div>
            @else
                <div class="breadcrumb-item {{ ($loop->first) ? 'active' : ''}}">
                    <a href="{{ breadcrumb_route_name($item, $loop->iteration) }}" >
                        {{ __(ucwords($item)) }} <br>
                    </a>
                </div>
            @endif

        @endforeach

    </div>
</div>
