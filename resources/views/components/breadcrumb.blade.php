<div class="section-header">
    <h1>{{$title}}</h1>
    <div class="section-header-breadcrumb">

        @foreach ($items(request()->segments()) as $item)

            @if($loop->last)
                <div class="breadcrumb-item">{{ __(ucwords($item)) }}</div>
            @else

                <div class="breadcrumb-item {{ ($loop->first) ? 'active' : ''}}">
                    <a href="{{ route($item) }}">
                        {{ __(ucwords($item)) }} <br>
                    </a>
                </div>

            @endif

        @endforeach

    </div>
</div>
