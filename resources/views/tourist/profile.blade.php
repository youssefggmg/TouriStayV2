<x-layout.tourist>
    {{-- {{dd($user)}} --}}
    <x-tourist.tourist-header :user="$user"></x-tourist.tourist-header>
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 min-h-screen flex items-center justify-center">

        <div class="bg-white p-6 rounded-lg shadow-lg w-80 text-center">
            <img class="w-24 h-24 rounded-full mx-auto border-4 border-blue-500" src="{{$user->image}}"
            alt="User Avatar">
            <h2 class="text-xl font-semibold mt-3 text-gray-800">{{$user->name}}</h2>
            <p class="text-gray-500 text-sm">{{$user->role}}</p>
            <div class="mt-4">
                <button class="!bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition">
                    <a href="/tourist/edit">
                        edit info 
                    </a>
                </button>
            </div>
            <div class="mt-4 text-gray-600 text-sm">
                <p><strong>Location:</strong> New York, USA</p>
                <p><strong>Email:</strong> {{$user->email}}</p>
            </div>
        </div>
    </div>
</x-layout.tourist>