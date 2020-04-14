{{-- Latest Comments --}}
<div class="col-md-4 col-sm-12">
    {{-- Card --}}
    <div class="card">
        <div class="card-header">
            <h4>{{ __("Comments") }}</h4>
        </div>
        {{-- Card Body --}}
        <div class="card-body">
            {{-- Comments Lists --}}
            <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                @forelse ($comments as $comment)
                    <li class="media">
                        <img
                            class="mr-3 rounded-circle"
                            width="70"
                            src="{{ asset('img/avatar-2.png') }}">
                        <div class="media-body">
                            {{-- Pending --}}
                            <div class="media-right">
                                <div class="text-warning">
                                    {{ __("Pending") }}
                                </div>
                            </div>
                            {{-- Name --}}
                            <div class="media-title mb-1">
                                {{ $comment->first_name . ' ' . $comment->last_name }}
                            </div>
                            {{-- Date --}}
                            <div class="text-time">
                                {{ $comment->created_at->diffForHumans() }}
                            </div>
                            {{-- Content --}}
                            <div class="media-description text-muted">
                                {{ Str::limit($comment->body, 150) }}
                            </div>
                            <div class="media-links">
                                <div class="bullet"></div>
                                <a href="{{ route('comments.update', $comment->id) }}">
                                    {{ __("Edit") }}
                                </a>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="media">
                        <div class="media-title mb-1">
                            {{ __("There is no comment yet!") }}
                        </div>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
  </div>
