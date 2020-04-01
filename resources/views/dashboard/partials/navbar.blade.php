{{-- Navigation Background --}}
<div class="navbar-bg"></div>
{{-- Navigation --}}
<nav class="navbar navbar-expand-lg main-navbar">
    {{-- App/Name --}}
    <a href="/" class="navbar-brand sidebar-gone-hide">
        {{env('APP_NAME')}}
    </a>
    {{-- Sidebar Toggle Button --}}
    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    {{-- Messages / Notifications / Profile --}}
    <ul class="navbar-nav navbar-right ml-auto">
        {{-- Messages --}}
        <li class="dropdown dropdown-list-toggle">
            {{-- Icon --}}
            <a
                href="#"
                data-toggle="dropdown"
                class="nav-link nav-link-lg message-toggle beep">
                <i class="far fa-envelope"></i>
            </a>
            {{-- Content --}}
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">
                    Messages
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-message">
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-desc">
                            Template update is available now!
                            <div class="time text-primary">2 Min Ago</div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">
                        View All
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </li>
        {{-- Notifications --}}
        <li class="dropdown dropdown-list-toggle">
            {{-- Icon --}}
            <a
                href="#"
                data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg beep">
                <i class="far fa-bell"></i>
            </a>
            {{-- Comment --}}
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">
                    Notifications
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>

                <div class="dropdown-list-content dropdown-list-icons">
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-icon bg-primary text-white">
                        <i class="fas fa-code"></i>
                        </div>
                        <div class="dropdown-item-desc">
                        Template update is available now!
                        <div class="time text-primary">2 Min Ago</div>
                        </div>
                    </a>

                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </li>
        {{-- Profile --}}
        <li class="dropdown">
            <a
                href="#"
                data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img
                    alt="{{auth()->user()->username ?? 'John Doe'}}"
                    src="../assets/img/avatar/avatar-1.png"
                    class="rounded-circle mr-1">

                <div class="d-sm-none d-lg-inline-block">
                    {{auth()->user()->username ?? 'John Doe'}}
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                {{-- Profile --}}
                <a href="features-profile.html" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                {{-- Settings --}}
                <a href="features-settings.html" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                {{-- Logout --}}
                <a href="#" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
