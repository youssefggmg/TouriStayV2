{{-- {{dd($reservations[0]->announcement->title)}} --}}
<x-layout.tourist>
    <x-tourist.tourist-header :user="$user"></x-tourist.tourist-header>
    <div class="flex-1">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 flex-nowrap">
            @foreach ($reservations as $reservation )
            <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="relative">
                    <img src="/api/placeholder/400/300" alt="Luxury Villa" class="w-full h-48 object-cover">
                    <button class="absolute top-3 right-3 p-1.5 bg-white rounded-full shadow-sm hover:bg-rose-50">
                        <i class="fas fa-heart text-rose-500"></i>
                    </button>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">{{$reservation->announcement->title}}</h3>
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400"></i>
                            <span class="ml-1 text-gray-700">4.9</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-2">
                        <i class="fas fa-map-marker-alt mr-1 text-gray-400">{{$reservation->announcement->city}}</i>
                    </p>
                    <div class="text-sm text-gray-500 mb-3">{{$reservation->announcement->disponibility}}</div>
            
                    <!-- Reservation Dates -->
                    <div class="text-sm text-gray-700 mb-3">
                        <i class="fas fa-calendar-alt mr-1 text-blue-500"></i>
                        <span class="font-semibold">Start Date:</span> {{ \Carbon\Carbon::parse($reservation->startDate)->format('d M Y') }}
                    </div>
                    <div class="text-sm text-gray-700 mb-3">
                        <i class="fas fa-calendar-alt mr-1 text-red-500"></i>
                        <span class="font-semibold">End Date:</span> {{ \Carbon\Carbon::parse($reservation->endDate)->format('d M Y') }}
                    </div>
            
                    <div class="flex justify-between items-center">
                        <div class="text-rose-600 font-semibold">${{$reservation->announcement->price}} 
                            <span class="text-gray-500 font-normal">/ night</span>
                        </div>
                    </div>
                </div>
            </div>
            
            @endforeach
        </div>
    </div>
</x-layout.tourist>