{{-- {{dd($user)}} --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted Announcements</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-admin.adminheader :user="$user"></x-admin.adminheader>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-gray-700">Deleted Announcements</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">City</th>
                    <th class="py-2 px-4 border-b">Owner</th>
                    <th class="py-2 px-4 border-b">Disponibility</th>
                    <th class="py-2 px-4 border-b">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deletedAnnouncements as $announcement)
                    <tr class="text-center">
                        <td class="py-2 px-4 border-b">{{ $announcement->title }}</td>
                        <td class="py-2 px-4 border-b">{{ $announcement->city }}</td>
                        <td class="py-2 px-4 border-b">
                            {{ $announcement->owner ? $announcement->owner->name : 'Unknown' }}
                        </td>
                        <td class="py-2 px-4 border-b">{{ $announcement->disponibility }}</td>
                        <td class="py-2 px-4 border-b">
                            ${{ number_format($announcement->price, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
