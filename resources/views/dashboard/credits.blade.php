@extends('dashboard.layouts.master')

@section('content')

<div class="section-body">
    <h2 class="section-title">Thanks To ...</h2>
    <p class="section-lead">
        I would like to thank the people who help in make this app
    </p>

    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Credits</h4>
            </div>
            <div class="card-body">
                <div class="list-unstyled list-unstyled-border mt-4">
                    <div class="media">
                        <div class="media-icon"><i class="far fa-circle"></i></div>
                        <div class="media-body">
                            <h6>Laravel</h6>
                            <p>by <a href="https://laravel.com/">Taylor Otwell & Community</a></p>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-icon"><i class="far fa-circle"></i></div>
                        <div class="media-body">
                            <h6>Stisla</h6>
                            <p>by <a href="https://nauval.in/">Muhamad Nauval Azhar</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

@endsection
