@props(["user"])
<header class="bg-white shadow-md sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo and Brand -->
            <div class="flex items-center">
                <a href="#" class="text-rose-500 text-xl font-bold">
                    <i class="fas fa-home mr-2"></i>
                    StayFinder
                </a>
            </div>

            <!-- Search Bar -->

            <!-- Navigation -->
            <div class="flex items-center space-x-4">
                <a href="/owner/home" class="text-gray-800 hover:text-rose-500 px-3 py-2 rounded-md text-sm font-medium">
                    <i class="fas fa-home mr-1"></i> Home
                </a>
                <a href="/announcments/create" class="text-gray-800 hover:text-rose-500 px-3 py-2 rounded-md text-sm font-medium">
                    <i class="fas fa-heart mr-1"></i> add annoucments
                </a>

                <!-- Profile Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <!-- Profile Button -->
                    <button @click="open = !open" class="bg-gray-100 rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 p-1">
                        <img class="h-8 w-8 rounded-full" src="{{$user->image}}" alt="Profile">
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg py-2">
                        <a href="/tourist/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <a href="/logout" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Alpine.js (if not already included) -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
