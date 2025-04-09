<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-wide">

    {{-- Header --}}
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Admin Panel</h1>
            
            {{-- Dropdown Menu --}}
            <div class="relative">
                <button id="dropdownToggle" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                    Menu
                    <svg class="inline w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div id="dropdownMenu"
                     class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg border hidden z-10">
                    <a href="{{ route('admin.dashboard') }}"
                       class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                    <a href="{{ route('admin.articles.index') }}"
                       class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Artikel</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    {{-- Konten Utama --}}
    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white shadow mt-10">
        <div class="container mx-auto px-4 py-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Blog Admin Panel. All rights reserved.
        </div>
    </footer>

    {{-- Dropdown Script --}}
    <script>
        const toggle = document.getElementById('dropdownToggle');
        const menu = document.getElementById('dropdownMenu');

        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>

</body>
</html>

