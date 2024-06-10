<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <h2 class="text-3xl font-semibold">Info Pengguna</h2>
            <a href="{{ route('login2.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600">Create New User</a>
        </div>

        @if ($message = Session::get('success'))
            <div class="bg-green-200 text-green-700 py-2 px-4 mb-4 rounded-lg">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div id="userTable">
            <!-- Tabel data pengguna akan dimuat di sini menggunakan AJAX -->
        </div>

        <div class="mt-8" id="pagination">
            <!-- Pagination links akan dimuat di sini menggunakan AJAX -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            fetchData();

            function fetchData(page = 1) {
                $.ajax({
                    url: '{{ url("login2") }}?page=' + page,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        let rows = '';
                        response.data.forEach((login2, index) => {
                            rows += `
                                <tr class="border-b hover:bg-gray-100 transition">
                                    <td class="py-4 px-6">${(response.current_page - 1) * response.per_page + index + 1}</td>
                                    <td class="py-4 px-6">${login2.nama}</td>
                                    <td class="py-4 px-6">${login2.nomor}</td>
                                    <td class="py-4 px-6">${login2.email}</td>
                                    <td class="py-4 px-6">
                                        <form action="{{ url('login2') }}/${login2.id}" method="POST" class="inline">
                                            <a href="{{ url('login2') }}/${login2.id}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Show</a>
                                            <a href="{{ url('login2') }}/${login2.id}/edit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600">Delete</button>
                                        </form>
                                    </td>
                                </tr>`;
                        });

                        $('#userTable').html(`
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
                                    ${rows}
                                </tbody>
                            </table>
                        `);

                        let paginationLinks = '';
                        if (response.links) {
                            paginationLinks = response.links.map(link => {
                                return `<a href="javascript:void(0)" class="px-3 py-1 mx-1 ${link.active ? 'bg-blue-500 text-white' : 'bg-white text-blue-500'} rounded-md shadow" data-page="${link.label}">${link.label}</a>`;
                            }).join('');
                        }

                        $('#pagination').html(paginationLinks);
                    }
                });
            }

            $(document).on('click', '#pagination a', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                fetchData(page);
            });
        });
    </script>
</body>
</html>
