<header class="bg-blue-900 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-lg font-bold">Admin Panel</div>
            <div class="relative">
                <button class="text-white focus:outline-none" id="menu-button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white text-black rounded-lg shadow-lg hidden" id="menu">
                    <a href="/" class="block px-4 py-2 hover:bg-gray-200">Home Site</a>
                    <a href="/admin" class="block px-4 py-2 hover:bg-gray-200">Dashboard</a>
                    <a href="../admin/general.php" class="block px-4 py-2 hover:bg-gray-200">General</a>
                    <a href="../page/logout.php" class="block px-4 py-2 hover:bg-gray-200">Logout</a>
                </div>
            </div>
        </div>
    </header>