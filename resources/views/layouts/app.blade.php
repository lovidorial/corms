<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSOATS System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-slate-900 text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-20">
            <div class="p-6 border-b border-slate-700">
                <h1 class="text-xl font-bold text-white">CSOATS</h1>
                <p class="text-xs text-slate-400">GPOA Management</p>
            </div>
            <nav class="p-4">
                <ul class="space-y-2">
                    @if(!auth()->user()->isAdmin())
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-sky-600' : 'hover:bg-slate-800' }}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('profile.edit') ? 'bg-sky-600' : 'hover:bg-slate-800' }}">
                            Edit Profile
                        </a>
                    </li>
                    
                    @endif
                    
                    @if(!auth()->user()->isAdmin())
                    <li>
                        <a href="{{ route('gpoa.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('gpoa.create') ? 'bg-sky-600' : 'hover:bg-slate-800' }}">
                            GPOA Activity
                        </a>
                    </li>
               
                    <li>
                        <a href="{{ route('user.activities') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('user.activities') ? 'bg-sky-600' : 'hover:bg-slate-800' }}">
                            My Activities
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->isAdmin())
                    <li class="pt-4 mt-4 border-t border-slate-700">
                        <p class="px-4 text-xs text-slate-500 uppercase mb-2">Admin Menu</p>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.users.*') ? 'bg-sky-600' : 'hover:bg-slate-800' }}">
                            Manage Users
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-sky-600' : 'hover:bg-slate-800' }}">
                            Admin Dashboard
                        </a>
                        <a href="{{ route('admin.activities') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.activities') ? 'bg-sky-600' : 'hover:bg-slate-800' }}">
                            Admin Monitoring
                        </a>
                    </li>
                    @endif

                    <li class="pt-4 mt-4 border-t border-slate-700">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-4 py-3 rounded-lg transition hover:bg-red-600 w-full">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                    </li>
                </ul>
            </nav>
        </aside>
        <!-- overlay for mobile when sidebar open -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden md:hidden"></div>

        <!-- Main Content -->
        <div id="mainContent" class="flex-1 ml-0 md:ml-64 transition-all duration-300 overflow-auto">
            <!-- Top Navbar -->
            <header class="bg-white shadow-sm h-auto flex flex-col md:flex-row items-center justify-between px-4 md:px-8 fixed w-full md:w-[calc(100%-16rem)] z-10">
                <div class="w-full flex items-center justify-between">
                    <!-- hamburger on mobile -->
                    <button id="sidebarToggle" class="md:hidden p-2 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <!-- other header content here if needed -->
                </div>
                <!-- always-visible user info pinned to top-right -->
                <div class="absolute top-0 right-0 p-4 flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-800 truncate max-w-[120px]">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 uppercase truncate">{{ auth()->user()->role }}</p>
                    </div>
                    @if(auth()->user()->isAdmin())
                        <img src="{{ asset('images/osdw.logo.jpg') }}" alt="OSDW Logo" class="w-10 h-10 rounded-full object-cover" />
                    @elseif(auth()->user()->profile_photo_path)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="avatar" class="w-10 h-10 rounded-full object-cover" />
                    @else
                        <div class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center font-bold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <!-- mobile quick links row -->
                <nav class="md:hidden w-full mt-2">
                    <ul class="flex justify-center space-x-4">
                        <li>
                            <a href="{{ route('dashboard') }}" class="text-gray-800 hover:text-sky-600 text-sm">Dashboard</a>
                        </li>
                        @if(!auth()->user()->isAdmin())
                        <li>
                            <a href="{{ route('user.activities') }}" class="text-gray-800 hover:text-sky-600 text-sm">Activities</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </header>

            <!-- Page Content -->
            <main class="p-8 mt-16 max-w-7xl mx-auto w-full">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const toggle = document.getElementById('sidebarToggle');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }
            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }

            toggle && toggle.addEventListener('click', function() {
                if (sidebar.classList.contains('-translate-x-full')) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            });

            overlay && overlay.addEventListener('click', closeSidebar);
        });
    </script>
    @stack('scripts')
</body>
</html>