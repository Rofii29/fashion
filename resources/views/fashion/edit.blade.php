<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fashion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow">
            <h1 class="text-3xl font-bold text-gray-800">Edit Fashion</h1>
            <a href="{{ url('fashion') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Back</a>
        </div>
        <nav class="bg-white shadow">
            <div class="container mx-auto px-4 py-4 flex justify-center items-center">
                <div class="space-x-4 text-center">
                    <a href="{{ url('fashion') }}" class="text-gray-800 hover:text-blue-500">Fashion</a>
                    <a href="{{ url('login2') }}" class="text-gray-800 hover:text-blue-500">Pengguna</a>
                </div>
            </div>
        </nav>
        <div class="mt-8 bg-white p-8 rounded-lg shadow-md">
            <form id="edit-fashion-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="fashion-id" value="{{ $id }}">
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 font-bold mb-2">Nama:</label>
                    <input type="text" id="nama" name="nama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="nomortelp" class="block text-gray-700 font-bold mb-2">Nomor Telepon:</label>
                    <input type="text" id="nomortelp" name="nomortelp" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block text-gray-700 font-bold mb-2">Alamat:</label>
                    <input type="text" id="alamat" name="alamat" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="text" class="block text-gray-700 font-bold mb-2">Text:</label>
                    <input type="text" id="text" name="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="gambar" class="block text-gray-700 font-bold mb-2">Gambar:</label>
                    <input type="file" id="gambar" name="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <img id="current-gambar" class="w-16 h-16 rounded-lg object-cover mt-2">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let id = $('#fashion-id').val();

            // Fetch existing data
            $.ajax({
                url: `{{ url('http://127.0.0.1:8000/api/fashion') }}/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        $('#nama').val(response.data.nama);
                        $('#nomortelp').val(response.data.nomortelp);
                        $('#alamat').val(response.data.alamat);
                        $('#text').val(response.data.text);
                        let imageUrl = response.data.gambar ? `{{ asset('storage') }}/${response.data.gambar}` : null;
                        if (imageUrl) {
                            $('#current-gambar').attr('src', imageUrl);
                        }
                    } else {
                        alert(response.massage);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            // Handle form submission
            $('#edit-fashion-form').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: `{{ url('http://127.0.0.1:8000/api/fashion') }}/${id}`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            alert(response.massage);
                            window.location.href = '{{ url("fashion") }}';
                        } else {
                            alert('Failed to update data.');
                            console.log(response.data);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Failed to update data.');
                    }
                });
            });
        });
    </script>
</body>
</html>
