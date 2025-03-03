<x-layout.tourist>
    <x-admin.adminheader :user="$user"></x-admin.adminheader>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-row">
            {{-- sidebar --}}
            {{-- mian content --}}
            <div class="flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 flex-nowrap">
                    @foreach ($announcments as $announcment)
                        <x-admin.admincards :announcment="$announcment"></x-admin.admincards>
                    @endforeach
                </div>
                {!! $announcments->links() !!}
            </div>
        </div>
    </div>
</x-layout.tourist>