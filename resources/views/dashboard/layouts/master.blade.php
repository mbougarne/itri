@include('dashboard.layouts.header')
<!-- Main Content -->
<div class="main-content">
    <section class="section">

        <x-breadcrumb :title="$title" />

        <div class="section-body">
            @yield('content')
        </div>
    </section>
</div>

@include('dashboard.layouts.footer')
