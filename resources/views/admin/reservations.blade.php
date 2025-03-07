<x-layout.tourist>
    <x-admin.adminheader :user="$user"></x-admin.adminheader>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-row">
            {{-- sidebar --}}
            {{-- mian content --}}
            <div class="flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 flex-nowrap">
                    @foreach ($reservations as $reservation)
                        <div
                            class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="relative">
                                <img src="/api/placeholder/400/300" alt="Luxury Villa" class="w-full h-48 object-cover">
                                <button
                                    class="absolute top-3 right-3 p-1.5 bg-white rounded-full shadow-sm hover:bg-rose-50">
                                    <i class="fas fa-heart text-rose-500"></i>
                                </button>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                        {{ $reservation->announcement->title }}</h3>
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <span class="ml-1 text-gray-700">4.9</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-2">
                                    <i class="fas fa-map-marker-alt mr-1 text-gray-400"></i>
                                    {{ $reservation->announcement->city }}
                                </p>
                                <div class="text-sm text-gray-500 mb-3">{{ $reservation->announcement->disponibility }}
                                </div>

                                <!-- User Information -->
                                <div class="flex items-center mb-3">
                                    <img src="{{ $reservation->user->profile_picture ?? '/default-avatar.png' }}"
                                        alt="{{ $reservation->user->name }}"
                                        class="w-10 h-10 rounded-full object-cover mr-3">
                                    <div>
                                        <p class="text-gray-900 font-semibold">{{ $reservation->user->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $reservation->user->email }}</p>
                                    </div>
                                </div>

                                <!-- Reservation Dates -->
                                <div class="text-sm text-gray-700 mb-3">
                                    <i class="fas fa-calendar-alt mr-1 text-blue-500"></i>
                                    <span class="font-semibold">Start Date:</span>
                                    {{ \Carbon\Carbon::parse($reservation->startDate)->format('d M Y') }}
                                </div>
                                <div class="text-sm text-gray-700 mb-3">
                                    <i class="fas fa-calendar-alt mr-1 text-red-500"></i>
                                    <span class="font-semibold">End Date:</span>
                                    {{ \Carbon\Carbon::parse($reservation->endDate)->format('d M Y') }}
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="text-rose-600 font-semibold">
                                        ${{ $reservation->announcement->price }} <span class="text-gray-500 font-normal">/
                                            night</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layout.tourist>