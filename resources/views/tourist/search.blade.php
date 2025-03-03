<x-layout.tourist>
    <x-tourist.tourist-header></x-tourist.tourist-header>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-row">
            {{-- mian content --}}
            <div class="flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 flex-nowrap">
                    @foreach ($announcments as $announcment )
                    <x-tourist.touristCard :announcment="$announcment"></x-tourist.tourist-card>
                    @endforeach
                </div>
                {{-- <x-tourist.touristBagination :paginator="$announcments"></x-tourist.touristBagination> --}}
            </div>
        </div>
    </div>
</x-layout.tourist>