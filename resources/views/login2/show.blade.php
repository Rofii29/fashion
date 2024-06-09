<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto my-8">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-semibold">Lihat user</h2>
        <a href="{{ route('login2.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Back</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-3 md:col-span-1 bg-white p-6 rounded-lg shadow">
            <div class="mb-4">
                <strong class="block mb-1">Nama:</strong>
                <p>{{ $login2->nama }}</p>
            </div>
        </div>
        <div class="col-span-3 md:col-span-1 bg-white p-6 rounded-lg shadow">
            <div class="mb-4">
                <strong class="block mb-1">Nomor:</strong>
                <p>{{ $login2->nomor }}</p>
            </div>
        </div>
        <div class="col-span-3 md:col-span-1 bg-white p-6 rounded-lg shadow">
            <div class="mb-4">
                <strong class="block mb-1">Email:</strong>
                <p>{{ $login2->email }}</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
