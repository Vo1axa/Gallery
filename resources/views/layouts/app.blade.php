<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap');

        body {
            transition: background-color 0.3s, color 0.3s;
        }

        #admin-sidebar {
    transition: transform 0.3s ease-in-out;
}

#admin-sidebar.admin-sidebar-hidden {
    transform: translateX(-100%);
}

#main-content.admin-sidebar-shifted {
    margin-left: 250px !important;
}
        #main-content {
            transition: margin-left 0.3s ease-in-out; !important
        }
            </style>
        
    <link rel="stylesheet" href="/css/fonts.css">

    @vite('resources/css/app.css')

    <!-- Navbar -->
    <nav class="text-[#1e1e1e] bg-gray-200 dark:bg-gray-700  sticky top-0 z-[9999] flex items-center justify-center mx-auto  px-10 transition-colors duration-300">
        <div class="container flex items-center justify-between mx-auto ">
            
            <!-- Left Section: Logo -->
            <div class="flex-shrink-0 text-[#6eb7ff] dark:text-[#3e6eff]">
                <a class="navbar-brand font-barlow font-regular tracking-wider text-3xl" href="/"><strong>GALLEY</strong></a>
            </div>
            @auth
            @if(Auth::user()->is_admin)
            <button id="sidebar-toggle" class=" inline-flex space-x-8 font-semibold text-gray-500 dark:text-slate-200 hover:text-blue-600 duration-300">Admin Panel</button>
            @endif
            @endauth
            <!-- Center Section: Navigation Links (Centered) -->
            <div class="flex-1 text-center">
                <ul class="inline-flex space-x-8 font-semibold text-gray-500 dark:text-slate-200">
                    <li class="hover:text-blue-600 duration-300"><a href="/galleries">Gallery</a></li>
                    <li class="hover:text-blue-600 duration-300"><a href="/albums">Album</a></li>
                    @auth
                    <li class="hover:text-blue-600 duration-300"><a href="{{route('galleries.create')}}">New Post</a></li>
                    <li class="hover:text-blue-600 duration-300"><a href="{{route('albums.create') }}"> New Album</a></li>
                    @endauth
                </ul>
                </ul>
            </div>

        
    
            <!-- Right Section: Search Form and User Profile -->
            <div class="flex items-center space-x-4">
                <!-- Search Form -->
            <div class="relative flex mt-3 items-center">
                <form action="{{ request()->is('galleries*') ? route('galleries.index') : route('albums.index') }}" method="GET" class="flex items-center mr-4 text-gray-900 dark:text-slate-50">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Search for an image.." class="rounded-full dark:bg-black backdrop-blur-md pl-4 p-2 w-64" value="{{ request()->input('search') }}">
                        <button type="submit" class="absolute right-0 text-white px-4 py-2 rounded-full ml-2 size-5">
                            <svg class="size-4 -ml-2 xl:mt-1 fill-black dark:fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
    
               <!-- Theme Toggle Button -->
            <button id="theme-toggle" class="w-16 h-8 rounded-full focus:outline-none bg-slate-100 dark:bg-gray-500 flex items-center">
                <svg id="theme-icon" class="size-4 -ml-2 xl:mt-1 text-gray-800 dark:text-white" width="40" height="40" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                    <!-- Initial icon will be set by JavaScript -->
                </svg>
            </button>
    
                @auth
        <!-- User Dropdown -->
        <div class="relative inline-block text-left">
            <button type="button" class="flex items-center text-black dark:text-white focus:outline-none" id="dropdownButton">
                @if(Auth::user()->profile_image)
                    <img class="rounded-full w-8 h-8 object-cover" 
                         src="{{ asset('images/profile/' . Auth::user()->profile_image) }}" 
                         alt="User Profile Image">
                @else
                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 text-gray-500">
                            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                        </svg>
                    </div>
                @endif
                <svg class="w-5 h-5 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.292 7.707a1 1 0 011.414 0L10 11.414l3.293-3.707a1 1 111.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        
            <!-- Dropdown menu -->
            <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-gray-200 dark:bg-gray-700 rounded-md shadow-lg dark:shadow-white z-20">
                <div class="px-4 py-2 text-gray-700 dark:text-white">
                    <p class="text-sm">Logged in as:<br>{{ Auth::user()->username }}</p>
                    <p class="text-xs">{{ Auth::user()->email }}</p>
                </div>
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="dropdownButton">
                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="block text-gray-700 dark:text-white px-4 py-2 hover:bg-gray-300/40 transition ease-in-out rounded-sm" role="menuitem">
                        Profile
                    </a>
                    <a href="{{ route('profile.edit', ['id' => Auth::user()->id]) }}" class="block text-gray-700 dark:text-white px-4 py-2 hover:bg-gray-300/40 transition ease-in-out rounded-sm" role="menuitem">
                        Settings
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block text-gray-700 dark:text-white px-4 py-2 hover:bg-gray-300/40 transition ease-in-out rounded-sm" role="menuitem">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

                </div>
                @else
                <!-- Login/Register Links -->
                <ul class="flex font-semibold space-x-4">
                    <li><a class="nav-link text-gray-100 bg-sky-500 hover:text-sky-900 rounded transition ease-in-out delay-100 hover:font-medium py-2 px-4 " href="{{ route('login') }}">Login</a></li>
                    <li><a class="nav-link text-gray-800 dark:text-slate-400 hover:bg-gray-500 dark:hover:bg-gray-100 hover:text-white rounded transition ease-in-out delay-100 hover:font-medium py-2 px-4" href="{{ route('register') }}">Register</a></li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>

</head>


<body class="bg-slate-100 dark:bg-gray-900 transition-colors duration-300">

    <!--Admin sidebar-->
    @auth
    @if(Auth::user()->is_admin)
    
    <!-- Sidebar content -->
    <div id="admin-sidebar" class="fixed mt-16 top-0 left-0 w-64 bg-gray-200 dark:bg-gray-700 h-screen p-4 shadow-md admin-sidebar-hidden">
        <h2 class="text-lg font-bold mb-4 dark:text-white">Welcome to the Admin Dashboard</h2>
        <ul>
            <li class="mb-4">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-600 dark:text-gray-200 hover:text-blue-600">Dashboard</a>
            </li>
            <li class="mb-4">
                <a href="{{ route('admin.users') }}" class="text-gray-600 dark:text-gray-200 hover:text-blue-600">Manage Users</a>
            </li>
            <li class="mb-4">
                <a href="{{ route('admin.albums.index') }}" class="text-gray-600 dark:text-gray-200 hover:text-blue-600">Manage Albums</a>
            </li>
            <li class="mb-4">
                <a href="{{ route('admin.galleries.index') }}" class="text-gray-600 dark:text-gray-200 hover:text-blue-600">Manage Galleries</a>
            </li>
        </ul>
    </div>
    @endif
    @endauth
    
    <!-- Content -->
    <div id="main-content">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Script for Admin Sidebar-->
    <script>
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const adminSidebar = document.getElementById('admin-sidebar');
        const mainContent = document.getElementById('main-content');

        sidebarToggle.addEventListener('click', () => {
            adminSidebar.classList.toggle('admin-sidebar-hidden');
            mainContent.classList.toggle('admin-sidebar-shifted');
        });
    </script>

    <!-- Script Dropdown -->
    <script>
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });
    </script>

<script>
    // Theme toggle functionality
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const currentTheme = localStorage.getItem('theme');

    // Check saved theme and apply
    if (currentTheme) {
        document.documentElement.classList.add(currentTheme);
        themeIcon.innerHTML = currentTheme === 'dark'
            ? '<path fill-rule="evenodd" d="M12 3a9 9 0 100 18 9 9 0 000-18zm0 2a7 7 0 110 14 7 7 0 010-14z" clip-rule="evenodd"/>'
            : '<path d="M12 4.6a7.4 7.4 0 100 14.8A7.4 7.4 0 0012 4.6zm0 1.2A6.2 6.2 0 0118 12a6.2 6.2 0 01-6 6.2A6.2 6.2 0 016 12a6.2 6.2 0 016-6.2z"/>';
    } else {
        themeIcon.innerHTML = '<path fill-rule="evenodd" d="M12 4.6a7.4 7.4 0 100 14.8A7.4 7.4 0 0012 4.6zm0 1.2A6.2 6.2 0 0118 12a6.2 6.2 0 01-6 6.2A6.2 6.2 0 016 12a6.2 6.2 0 016-6.2z" clip-rule="evenodd"/>';
    }

    themeToggleBtn.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');
        const isDarkMode = document.documentElement.classList.contains('dark');
        localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
        themeIcon.innerHTML = isDarkMode
            ? '<path fill-rule="evenodd" d="M12 3a9 9 0 100 18 9 9 0 000-18zm0 2a7 7 0 110 14 7 7 0 010-14z" clip-rule="evenodd"/>'
            : '<path d="M12 4.6a7.4 7.4 0 100 14.8A7.4 7.4 0 0012 4.6zm0 1.2A6.2 6.2 0 0118 12a6.2 6.2 0 01-6 6.2A6.2 6.2 0 016 12a6.2 6.2 0 016-6.2z"/>';
    });
</script>
</body>
</html>