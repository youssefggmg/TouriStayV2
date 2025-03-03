<x-layout.tourist>
    <x-owner.ownerheader :user="$user"></x-owner.ownerheader>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-row">
                {{-- sidebar --}}
                {{-- mian content --}}
                <div class="flex-1">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 flex-nowrap">
                        @foreach ($ownerAnnouncmets as $announcment )
                        <x-owner.ownercard :announcment="$announcment"></x-owner.ownercard>
                        {{-- <x-tourist.touristCard :announcment="$announcment"></x-tourist.tourist-card> --}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</x-layout.tourist>