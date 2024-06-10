<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-center items-center">
            <div class="space-x-4 text-center">
                <a href="#" class="text-gray-800 hover:text-blue-500">Fashion</a>
                <a href="{{ url('login2') }}" class="text-gray-800 hover:text-blue-500">Pengguna</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow">
            <h1 class="text-3xl font-bold text-gray-800">Fashion Design</h1>
            <a href="{{ url('fashion/create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Add New</a>
        </div>
        <div class="mt-8">
            @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4 shadow">
                {{ session('success') }}
            </div>
            @endif
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden" id="fashion-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-3 px-6 text-left font-semibold text-gray-700">Nama</th>
                            <th class="py-3 px-6 text-left font-semibold text-gray-700">Nomor Telepon</th>
                            <th class="py-3 px-6 text-left font-semibold text-gray-700">Alamat</th>
                            <th class="py-3 px-6 text-left font-semibold text-gray-700">Gambar</th>
                            <th class="py-3 px-6 text-left font-semibold text-gray-700">Text</th>
                            <th class="py-3 px-6 text-right font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="fashion-data">
                        <!-- Data akan dimuat di sini menggunakan AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            fetchData();

            function fetchData() {
                $.ajax({
                    url: '{{ url("http://127.0.0.1:8000/api/fashion") }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        let rows = '';
                        response.data.forEach(item => {
                            rows += `
                                <tr class="border-b hover:bg-gray-100 transition">
                                    <td class="py-4 px-6 text-gray-800">${item.nama}</td>
                                    <td class="py-4 px-6 text-gray-800">${item.nomortelp}</td>
                                    <td class="py-4 px-6 text-gray-800">${item.alamat}</td>
                                    <td class="py-4 px-6">
                                        ${item.gambar ? `<img src="{{ asset('storage/') }}/${item.gambar}" alt="Gambar" class="w-16 h-16 rounded-lg object-cover">` : '<p class="text-gray-500">No image available</p>'}
                                    </td>
                                    <td class="py-4 px-6 text-gray-800">${item.text}</td>
                                    <td class="py-4 px-6 text-right flex justify-end space-x-2">
                                        <a href="{{ url('fashion') }}/${item.id}/edit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600">Edit</a>
                                        <form action="{{ url('fashion') }}/${item.id}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600">Delete</button>
                                        </form>
                                    </td>
                                </tr>`;
                        });
                        $('#fashion-data').html(rows);
                    }
                });
            }
        });
    </script>
</body>

</html>
