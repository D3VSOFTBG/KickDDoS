<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{setting('TITLE')}} {{setting('TITLE_SEPERATOR')}} @yield('page_name')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">
    <!-- Admin Style -->
    <link rel="stylesheet" href="{{asset('/assets/css/d3vsoft.css')}}">

    @if (session('ok'))
    <script>
        alert('OK');
    </script>
    @endif

    @if ($errors->any())
    <script>
        alert('{{ implode(' ', $errors->all(':message')) }}');
    </script>
    @endif

    @include('inc.js')
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('home')}}" class="brand-link text-center">
                <span class="brand-text"> <strong>{{setting('TITLE')}}</strong> </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{route('home')}}" class="nav-link @if (Route::currentRouteName() == 'home') active @endif">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Account
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::check())
                                    <li class="nav-item">
                                        <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Logout</p>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{route('login')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Login</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('register')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Register</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @if (Auth::check())
                            <li class="nav-item @if (str_contains(Request::url(), '/user/')) menu-open @endif">
                                <a href="#" class="nav-link @if (str_contains(Request::url(), '/user/')) active @endif">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        User
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('user.profile')}}"
                                            class="nav-link @if (Route::currentRouteName() == 'user.profile') active @endif">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Profile</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('user.test')}}"
                                            class="nav-link @if (Route::currentRouteName() == 'user.test') active @endif">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Test</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @if (Auth::user()->is_admin == 1)
                                <li class="nav-item @if (str_contains(Request::url(), '/admin/')) menu-open @endif">
                                    <a href="#"
                                        class="nav-link @if (str_contains(Request::url(), '/admin/')) active @endif">
                                        <i class="nav-icon fas fa-user-cog"></i>
                                        <p>
                                            Admin
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('admin.settings')}}"
                                                class="nav-link @if (Route::currentRouteName() == 'admin.settings') active @endif">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Settings</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('admin.users')}}"
                                                class="nav-link @if (Route::currentRouteName() == 'admin.users') active @endif">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Users</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('admin.methods')}}"
                                                class="nav-link @if (Route::currentRouteName() == 'admin.methods') active @endif">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Methods</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('admin.servers')}}"
                                                class="nav-link @if (Route::currentRouteName() == 'admin.servers') active @endif">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Servers</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('admin.cache')}}"
                                                class="nav-link @if (Route::currentRouteName() == 'admin.cache') active @endif">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Cache</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
