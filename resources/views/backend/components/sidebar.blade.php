<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">{{ @config('app.name') }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown  {{ Request::routeIs('blog.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown "><i class="fa-solid fa-blog"></i><span>Blogs</span></a>
                <ul class="dropdown-menu ">
                    <li class = "{{ Request::routeIs('blog.create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('blog.create') }}">Add Blog</a>
                    </li>
                    <li class="{{ Request::routeIs('blog.list') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('blog.list') }}">Blog List</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::routeIs('settings.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fa-solid fa-setting"></i> <span>Settings</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::routeIs('settings.basic') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('settings.basic') }}">Basic Settings</a>
                    </li>
                    <li class="{{ Request::routeIs('settings.banner') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('settings.banner') }}">Banner Settings</a>
                    </li>
                    <li class="{{ Request::routeIs('contact/message') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('settings.contacts') }}">Contact Message</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fa-solid fa-right-from-bracket"></i> Sign Out
            </a>
        </div>
    </aside>
</div>
