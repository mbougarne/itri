@include('dashboard.layouts.header')
<!-- Main Content -->
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Transprent Sidebar</div>
            </div>
        </div>

        <div class="section-body">
            @yield('content')
        </div>
    </section>
</div>

@include('dashboard.layouts.footer')
