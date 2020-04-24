{{-- Comments Table --}}
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            {{-- Header --}}
            <div class="card-header">
                <h4>{{ __("All Comments") }}</h4>
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
                                <th>{{ __("User Details") }}</th>
                                <th>{{ __("Comment Body") }}</th>
                                <th>{{ __("Status") }}</th>
                                <th>{{ __("Created At") }}</th>
                            </tr>
                            @forelse ($comments as $comment)
                                <tr>
                                    {{-- Count --}}
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    {{-- title --}}
                                    <td>
                                        <div>
                                           <p>
                                               <strong>{{ $comment->fullName() }}</strong>
                                               <br>
                                               <small class="text-muted">
                                                   {{ $comment->email }}
                                               </small>
                                               {{-- Is Reply --}}
                                               <div class="badge badge-{{($comment->is_reply == 'Reply') ? 'info' : 'primary'}}">
                                                    {{ $comment->is_reply }}
                                                </div>
                                               {{-- Is Subscribed --}}
                                               <div class="badge badge-{{($comment->is_subscribed == 'Subscribed') ? 'success' : 'secondary'}}">
                                                    {{ $comment->is_subscribed }}
                                                </div>
                                           </p>
                                        </div>
                                        <div class="table-links">
                                            <div class="bullet"></div>
                                            <a href="{{ route('comments.update', $comment->id) }}">
                                                {{ __("Edit") }}
                                            </a>
                                        </div>
                                    </td>
                                    {{-- Status --}}
                                    <td>
                                        <div class="badge badge-{{($comment->is_approved == 'Approved') ? 'success' : 'warning'}}">
                                            {{ $comment->is_approved }}
                                        </div>
                                    </td>
                                    {{-- Created At --}}
                                    <td>
                                        <p>
                                            {{ $comment->created_at->diffForHumans() }}
                                            <br>
                                            <small class="text-muted">
                                                {{ $comment->created_at->toFormattedDateString() }}
                                            </small>
                                        </p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        {{ __("There is no comment yet!") }}
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
