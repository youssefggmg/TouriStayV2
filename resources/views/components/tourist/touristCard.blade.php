@props(['announcment'])
{{-- {{dd($announcment)}} --}}
<div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
    <div class="relative">
        <img src="/api/placeholder/400/300" alt="Luxury Villa" class="w-full h-48 object-cover">
        <button class="absolute top-3 right-3 p-1.5 bg-white rounded-full shadow-sm hover:bg-rose-50">
            <i class="fas fa-heart text-rose-500"></i>
        </button>
    </div>
    <div class="p-4">
        <div class="flex justify-between items-start">
            <h3 class="text-lg font-semibold text-gray-900 mb-1">title</h3>
            <div class="flex items-center">
                <i class="fas fa-star text-yellow-400"></i>
                <span class="ml-1 text-gray-700">4.9</span>
            </div>
        </div>
        <p class="text-gray-600 mb-2">
            <i class="fas fa-map-marker-alt mr-1 text-gray-400">{{$announcment->city}}</i> 
        </p>
        <div class="text-sm text-gray-500 mb-3">{{$announcment->disponibility}}</div>
        <div class="flex justify-between items-center">
            <div class="text-rose-600 font-semibold">${{$announcment->price}} <span class="text-gray-500 font-normal">/ night</span></div>
        </div>
    </div>
</div>