<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-center items-center">
            <div class="space-x-4 text-center">
                <a href="{{ url('fashion') }}" class="text-gray-800 hover:text-blue-500">Fashion</a>
                <a href="{{ url('login2') }}" class="text-gray-800 hover:text-blue-500">Pengguna</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto my-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-3xl font-semibold">Users List</h2>
            <a href="{{ route('login2.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600">Create New User</a>
        </div>

        @if ($message = Session::get('success'))
            <div class="bg-green-200 text-green-700 py-2 px-4 mb-4 rounded-lg">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-6 text-left font-semibold text-gray-700">No</th>
                    <th class="py-3 px-6 text-left font-semibold text-gray-700">Nama</th>
                    <th class="py-3 px-6 text-left font-semibold text-gray-700">Nomor</th>
                    <th class="py-3 px-6 text-left font-semibold text-gray-700">Email</th>
                    <th class="py-3 px-6 text-left font-semibold text-gray-700" width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = ($login2s->currentPage() - 1) * $login2s->perPage();
                @endphp
                @foreach ($login2s as $login2)
                <tr class="border-b hover:bg-gray-100 transition">
                    <td class="py-4 px-6">{{ ++$i }}</td>
                    <td class="py-4 px-6">{{ $login2->nama }}</td>
                    <td class="py-4 px-6">{{ $login2->nomor }}</td>
                    <td class="py-4 px-6">{{ $login2->email }}</td>
                    <td class="py-4 px-6">
                        <form action="{{ route('login2.destroy', $login2->id) }}" method="POST" class="inline">
                            <a href="{{ route('login2.show', $login2->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Show</a>
                            <a href="{{ route('login2.edit', $login2->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-8">
            {!! $login2s->links() !!}
        </div>
    </div>
</body>
</html>
