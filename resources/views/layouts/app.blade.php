<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Inventory System') }} - @yield('title', 'Dashboard')</title>
    <link rel="preconnect"
          href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700"
          rel="stylesheet" />
    <link rel="stylesheet"
          href="{{ asset('css/global.css') }}">
    <style>
        html,
        body {
            height: 100%;
            background-color: #f3f4f6;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .app-layout {
            min-height: 100vh;
        }

        /* Mobile sidebar */
        .mobile-sidebar-overlay {
            position: relative;
            z-index: 50;
            display: none;
        }

        @media (max-width: 1024px) {
            .mobile-sidebar-overlay {
                display: block;
            }
        }

        .mobile-sidebar-overlay.hidden {
            display: none;
        }

        .mobile-sidebar-overlay.visible {
            display: block;
        }

        .sidebar-backdrop {
            position: fixed;
            inset: 0;
            background-color: rgba(17, 24, 39, 0.5);
        }

        .sidebar-container {
            position: fixed;
            inset: 0;
            display: flex;
        }

        .sidebar-content {
            position: relative;
            margin-right: 4rem;
            display: flex;
            width: 100%;
            max-width: 20rem;
            flex: 1;
        }

        .sidebar-close-button {
            position: absolute;
            left: 100%;
            top: 0;
            display: flex;
            justify-content: center;
            padding-top: 1.25rem;
            width: 4rem;
        }

        .sidebar-close-button button {
            margin: -0.625rem;
            padding: 0.625rem;
            border: none;
            background: none;
            cursor: pointer;
        }

        .sidebar-close-button svg {
            width: 1.5rem;
            height: 1.5rem;
            color: white;
        }

        /* Static sidebar for desktop */
        .desktop-sidebar {
            display: none;
        }

        @media (min-width: 1024px) {
            .desktop-sidebar {
                display: block;
                position: fixed;
                inset-y: 0;
                z-index: 50;
                display: flex;
                width: 18rem;
                flex-direction: column;
            }
        }

        /* Main content */
        .main-content {
            padding: 0;
        }

        @media (min-width: 1024px) {
            .main-content {
                padding-left: 18rem;
            }
        }

        /* Top navbar */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 40;
            display: flex;
            height: 4rem;
            align-items: center;
            gap: 1rem;
            border-bottom: 1px solid #e5e7eb;
            background-color: white;
            padding: 1rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        @media (min-width: 640px) {
            .navbar {
                gap: 1.5rem;
                padding: 1rem 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .navbar {
                padding: 1rem 2rem;
            }

            .mobile-menu-button {
                display: none;
            }
        }

        .mobile-menu-button {
            margin: -0.625rem;
            padding: 0.625rem;
            color: #374151;
            border: none;
            background: none;
            cursor: pointer;
        }

        .mobile-menu-button svg {
            width: 1.5rem;
            height: 1.5rem;
        }

        .navbar-divider {
            height: 1.5rem;
            width: 1px;
            background-color: #e5e7eb;
        }

        @media (min-width: 1024px) {
            .navbar-divider {
                display: none;
            }
        }

        .navbar-content {
            display: flex;
            flex: 1;
            gap: 1rem;
        }

        @media (min-width: 1024px) {
            .navbar-content {
                gap: 1.5rem;
            }
        }

        .navbar-spacer {
            flex: 1;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        @media (min-width: 1024px) {
            .navbar-actions {
                gap: 1.5rem;
            }
        }

        /* User dropdown */
        .user-dropdown {
            position: relative;
        }

        .user-menu-button {
            margin: -0.375rem;
            padding: 0.375rem;
            display: flex;
            align-items: center;
            border: none;
            background: none;
            cursor: pointer;
        }

        .user-avatar {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            background-color: #f3f4f6;
        }

        .user-info {
            display: none;
            margin-left: 1rem;
            align-items: center;
        }

        @media (min-width: 1024px) {
            .user-info {
                display: flex;
            }
        }

        .user-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: #111827;
        }

        .user-dropdown-icon {
            margin-left: 0.5rem;
            width: 1.25rem;
            height: 1.25rem;
            color: #9ca3af;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            z-index: 10;
            margin-top: 0.625rem;
            width: 8rem;
            border-radius: 0.375rem;
            background-color: white;
            padding: 0.5rem 0;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(17, 24, 39, 0.05);
        }

        .dropdown-menu.hidden {
            display: none;
        }

        .dropdown-menu.visible {
            display: block;
        }

        .dropdown-item {
            display: block;
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
            color: #111827;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .dropdown-item:hover {
            background-color: #f9fafb;
        }

        .dropdown-item-button {
            width: 100%;
            text-align: left;
            border: none;
            background: none;
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
            color: #111827;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .dropdown-item-button:hover {
            background-color: #f9fafb;
        }

        /* Page content */
        .page-content {
            padding: 1.5rem;
        }

        @media (min-width: 640px) {
            .page-content {
                padding: 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .page-content {
                padding: 2rem;
            }
        }

        /* Alerts */
        .alert {
            margin-bottom: 1rem;
            border-radius: 0.375rem;
            padding: 1rem;
        }

        .alert-success {
            background-color: #f0fdf4;
        }

        .alert-error {
            background-color: #fef2f2;
        }

        .alert-content {
            display: flex;
        }

        .alert-icon {
            flex-shrink: 0;
            width: 1.25rem;
            height: 1.25rem;
        }

        .alert-success .alert-icon {
            color: #4ade80;
        }

        .alert-error .alert-icon {
            color: #f87171;
        }

        .alert-message {
            margin-left: 0.75rem;
        }

        .alert-success .alert-message {
            font-size: 0.875rem;
            font-weight: 500;
            color: #166534;
        }

        .alert-error .alert-message {
            font-size: 0.875rem;
            color: #7f1d1d;
        }

        .alert-error ul {
            list-style: disc;
            padding-left: 1.5rem;
            margin: 0;
        }

        .alert-error li {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="app-layout"
         x-data="{ sidebarOpen: false }">
        <!-- Mobile sidebar -->
        <div class="mobile-sidebar-overlay"
             :class="{ 'visible': sidebarOpen, 'hidden': !sidebarOpen }">
            <div class="sidebar-backdrop"
                 @click="sidebarOpen = false"></div>
            <div class="sidebar-container">
                <div class="sidebar-content">
                    <div class="sidebar-close-button">
                        <button type="button"
                                @click="sidebarOpen = false">
                            <span class="sr-only">Close sidebar</span>
                            <svg fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    @include('layouts.sidebar')
                </div>
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="desktop-sidebar">
            @include('layouts.sidebar')
        </div>

        <!-- Main content -->
        <div class="main-content">
            <!-- Top navbar -->
            <div class="navbar">
                <button type="button"
                        class="mobile-menu-button"
                        @click="sidebarOpen = true">
                    <span class="sr-only">Open sidebar</span>
                    <svg fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <div class="navbar-divider"></div>

                <div class="navbar-content">
                    <div class="navbar-spacer"></div>
                    <div class="navbar-actions">
                        <!-- User dropdown -->
                        <div class="user-dropdown"
                             x-data="{ open: false }">
                            <button type="button"
                                    @click="open = !open"
                                    class="user-menu-button">
                                <img class="user-avatar"
                                     src="{{ auth()->user()->avatar_url }}"
                                     alt="">
                                <span class="user-info">
                                    <span class="user-name">{{ auth()->user()->name }}</span>
                                    <svg class="user-dropdown-icon"
                                         viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                              clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>
                            <div class="dropdown-menu"
                                 :class="{ 'visible': open, 'hidden': !open }"
                                 @click.outside="open = false">
                                <a href="{{ route('profile') }}"
                                   class="dropdown-item">Profile</a>
                                <form method="POST"
                                      action="{{ route('logout') }}"
                                      class="w-full">
                                    @csrf
                                    <button type="submit"
                                            class="dropdown-item-button">Sign out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page content -->
            <main class="page-content">
                @if(session('success'))
                <div class="alert alert-success"
                     x-data="{ show: true }"
                     x-show="show"
                     x-init="setTimeout(() => show = false, 5000)">
                    <div class="alert-content">
                        <div class="alert-icon">
                            <svg viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                      clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="alert-message">
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-error">
                    <div class="alert-content">
                        <div class="alert-icon">
                            <svg viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                      clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="alert-message">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
            defer></script>
</body>

</html>
