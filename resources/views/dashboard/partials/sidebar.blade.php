{{-- Sidebar / Dashboard Navigation --}}
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        {{-- Logo --}}
        <div class="sidebar-brand sidebar-gone-show">
            <a href="{{ route('dashboard') }}">
                @if(isset($settings->logo) && !empty($settings->logo))
                    <img
                        src="{{ asset('uploads/settings/' . $settings->logo) }}"
                        alt="{{ $settings->title }}">
                @else
                    {{ env('APP_NAME') }}
                @endif
            </a>
        </div>
        {{-- Navigation Links --}}
        <ul class="sidebar-menu">
            {{-- Dashboard --}}
            <li class="menu-header">{{ __("Dashboard") }}</li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fire"></i>
                    <span>{{ __("Dashboard") }}</span>
                </a>
            </li>
            {{-- Content --}}
            <li class="menu-header">{{ __("Content") }}</li>
            <li class="nav-item dropdown">
                <a
                    href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown">
                    <i class="fas fa-newspaper"></i>
                    <span>{{ __("Posts") }}</span>
                </a>
                <ul class="dropdown-menu">
                    {{-- All posts --}}
                    <li>
                        <a
                            class="nav-link"
                            href="{{ route('posts') }}">
                            {{ __("Posts") }}
                        </a>
                    </li>
                    {{-- Create Post --}}
                    <li>
                        <a
                            class="nav-link"
                            href="{{ route('post.create') }}">
                            {{ __("Create Post") }}
                        </a>
                    </li>
                    {{-- Categories --}}
                    <li>
                        <a
                            class="nav-link"
                            href="{{ route('categories') }}">
                            {{ __("Categories") }}
                        </a>
                    </li>
                    {{-- Tags --}}
                    <li>
                        <a
                            class="nav-link"
                            href="{{ route('tags') }}">
                            {{ __("Tags") }}
                        </a>
                    </li>
                </ul>
            </li>
            {{-- Pages --}}
            <li class="nav-item">
                <a
                    href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown">
                    <i class="fas fa-poll-h"></i>
                    <span>{{ __("Pages") }}</span>
                </a>
                <ul class="dropdown-menu">
                    {{-- All pages --}}
                    <li>
                        <a
                            class="nav-link"
                            href="{{ route('pages') }}">
                            {{ __("Pages") }}
                        </a>
                    </li>
                    {{-- Create Page --}}
                    <li>
                        <a
                            class="nav-link"
                            href="{{ route('page.create') }}">
                            {{ __("Create Page") }}
                        </a>
                    </li>
                </ul>
            </li>
            {{-- Comments --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('comments') }}">
                    <i class="fas fa-fire"></i>
                    <span>{{ __("Comments") }}</span>
                </a>
            </li>
            {{-- Contacts --}}
            <li class="menu-header">{{ __("Contacts") }}</li>
            <li class="nav-item">
                <a
                    href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown">
                    <i class="fas fa-address-book"></i>
                    <span>{{ __("Contacts") }}</span>
                </a>
                <ul class="dropdown-menu">
                    {{-- All Contacts --}}
                    <li>
                        <a
                            class="nav-link"
                            href="{{ route('contacts') }}">
                            {{ __("Contacts") }}
                        </a>
                    </li>
                    {{-- Create Contact --}}
                    <li>
                        <a
                            class="nav-link"
                            href="{{ route('contact.create') }}">
                            {{ __("Create Contact") }}
                        </a>
                    </li>
                    {{-- Forms --}}
                    <li>
                        <a
                            class="nav-link"
                            href="{{ route('forms') }}">
                            {{ __("Forms") }}
                        </a>
                    </li>
                    {{-- Create Form --}}
                    <li>
                        <a
                            class="nav-link"
                            href="{{ route('form.create') }}">
                            {{ __("Create Form") }}
                        </a>
                    </li>
                </ul>
            </li>
            {{-- Settings --}}
            <li class="menu-header">{{ __("Settings") }}</li>
            <li class="nav-item">
                {{-- Settings --}}
                <a
                    class="nav-link"
                    href="{{ route('settings.update') }}">
                    <i class="fas fa-cogs"></i>
                    {{ __("Settings") }}
                </a>
            </li>
            <li class="nav-item">
                {{-- Menus --}}
                <a
                    class="nav-link"
                    href="{{ route('menus') }}">
                    <i class="fas fa-list"></i>
                    {{ __("Menus") }}
                </a>
            </li>
        </ul>

        {{-- Thanks --}}
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a
                href="https://getstisla.com/docs"
                class="btn btn-danger btn-lg btn-block btn-icon-split">
                Thanks ❤
            </a>
        </div>
    </aside>
</div>
