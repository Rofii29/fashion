<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fashion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-3xl font-bold mb-8 text-gray-800">Edit Fashion</h1>
            <form id="fashionForm" data-id="{{ $id }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                    <input type="text" id="nama" name="nama" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nomor Telpon</label>
                    <input type="text" id="nomortelp" name="nomortelp" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Gambar</label>
                    <input type="file" id="gambar" name="gambar" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <img id="currentImage" class="w-16 h-16 rounded-lg mt-4 object-cover">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Text</label>
                    <textarea id="text" name="text" rows="4" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                </div>
                <div class="flex place-content-end gap-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out">Simpan</button>
                    <a href="{{ url('fashion') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-gray-600 transition duration-300 ease-in-out">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let id = $('#fashionForm').data('id');

            $.ajax({
                url: `http://127.0.0.1:8000/api/fashion/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.data) {
                        $('#nama').val(response.data.nama);
                        $('#nomortelp').val(response.data.nomortelp);
                        $('#text').val(response.data.text);
                        if (response.data.gambar) {
                            $('#currentImage').attr('src', `{{ asset('storage') }}/${response.data.gambar}`);
                        } else {
                            $('#currentImage').attr('src', '');
                        }
                    } else {
                        alert('Data tidak ditemukan.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', status, error);
                    alert('Gagal memuat data.');
                }
            });

            $('#fashionForm').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                formData.append('_method', 'PUT');  // Append the _method field with 'PUT'

                $.ajax({
                    url: `http://127.0.0.1:8000/api/fashion/${id}`,
                    type: 'POST',  // Use POST method to send formData
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert('Data berhasil disimpan!');
                        window.location.href = '/fashion';
                    },
                    error: function(xhr) {
                        alert('Gagal menyimpan data.');
                    }
                });
            });
        });
    </script>
</body>

</html>
