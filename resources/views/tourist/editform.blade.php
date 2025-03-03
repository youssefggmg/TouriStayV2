<x-layout.tourist>
    <x-tourist.tourist-header :user="$user"></x-tourist.tourist-header>
    <div class="bg-gradient-to-r from-blue-400 to-purple-500 min-h-screen flex items-center justify-center">

        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Update Profile</h2>

            <form action="/tourist/edit" method="post" class="space-y-4">
                @method("PATCH")
                @csrf
                <!-- Name -->
                <div>
                    <label class="block text-gray-700 font-semibold">Full Name</label>
                    <input type="text" name="name" placeholder="Enter your name" value="{{$user->name}}"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 font-semibold">Email</label>
                    <input type="email" name="email" placeholder="Enter your email" value="{{$user->email}}"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Password Update -->
                <h3 class="text-lg font-semibold text-gray-800 mt-4">Update Password</h3>

                <div>
                    <label class="block text-gray-700 font-semibold">Current Password</label>
                    <input type="password" name="current_password" placeholder="Enter current password"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">New Password</label>
                    <input type="password" name="new_password" placeholder="Enter new password"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Confirm New Password</label>
                    <input type="password" name="confirm_password" placeholder="Confirm new password"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <button type="submit"
                    class="w-full !bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition">Update
                    Info</button>
            </form>
        </div>
    </div>
</x-layout.tourist>