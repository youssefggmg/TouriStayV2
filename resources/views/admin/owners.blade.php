<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owners Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto mt-10">
        <h2 class="text-3xl font-semibold text-center text-gray-700 mb-6">Owners Management</h2>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="py-2 px-4 border-b">Owner Name</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Number of Properties</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($owners as $owner)
                        <tr class="text-left">
                            <td class="py-2 px-4 border-b">{{ $owner->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $owner->email }}</td>
                            <td class="py-2 px-4 border-b">{{ $owner->announcements_count }}</td>
                            <td class="py-2 px-4 border-b">
                                @if(!$owner->is_banned)
                                    <form action="" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                            Ban Account
                                        </button>
                                    </form>
                                @else
                                    <span class="text-red-500 font-semibold">Banned</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
