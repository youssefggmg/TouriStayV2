<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Announcement</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <x-owner.ownerheader :user="$user"></x-owner.ownerheader>
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">

        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Create Announcement</h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="/announcments/store" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="title" class="block text-gray-600 font-medium">Title</label>
                    <input type="text" name="title" id="title"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Enter title" required>
                </div>

                <div>
                    <label for="city" class="block text-gray-600 font-medium">City</label>
                    <input type="text" name="city" id="city"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Enter city" required>
                </div>

                <div>
                    <label for="price" class="block text-gray-600 font-medium">Price ($)</label>
                    <input type="number" step="0.01" name="price" id="price"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Enter price" required>
                </div>

                <div>
                    <label for="disponibility" class="block text-gray-600 font-medium">Disponibility Date</label>
                    <input type="date" name="disponibility" id="disponibility"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                </div>

                <div>
                    <label class="block text-gray-600 font-medium mb-2">Select Equipment</label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($equipments as $equipment)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="equipments[]" value="{{ $equipment->id }}"
                                    class="w-4 h-4 text-blue-500 border-gray-300 rounded focus:ring-blue-500">
                                <span class="text-gray-700">{{ $equipment->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label for="user_id" class="text-gray-600 font-medium hidden">User ID</label>
                    <input type="number" name="user_id" id="user_id" hidden value="{{ $user->id }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Enter your user ID" required>
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition duration-200">Create
                    Announcement</button>
            </form>
        </div>

    </div>
</body>

</html>