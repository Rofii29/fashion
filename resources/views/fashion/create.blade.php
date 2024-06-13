<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Fashion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Create Fashion</h1>
            <form id="createForm" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nomortelp">Nomor Telepon</label>
                    <input type="text" name="nomortelp" id="nomortelp" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="gambar">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="text">Text</label>
                    <textarea name="text" id="text" rows="4" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out">Create</button>
                    <a href="{{ url('fashion') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-gray-600 transition duration-300 ease-in-out">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {
            $('#createForm').on('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                
                $.ajax({
                    url: "{{ url('/api/fashion') }}", // Ganti dengan URL yang benar
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Redirect to fashion page after successful creation
                        window.location.href = "{{ url('fashion') }}";
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error here, if needed
                    }
                });
            });
        });
    </script>
</body>
</html>
