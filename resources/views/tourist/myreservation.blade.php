<x-layout.tourist>
    {{-- {{dd($user)}} --}}
    <x-tourist.tourist-header :user="$user"></x-tourist.tourist-header>
    <div class="flex-1">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 flex-nowrap">
            @foreach ($announcments as $announcment )
            <x-tourist.touristCard :announcment="$announcment"></x-tourist.tourist-card>
            @endforeach
        </div>
        {!! $announcments->links() !!}
    </div>
</x-layout.tourist>