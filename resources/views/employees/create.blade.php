<!DOCTYPE html>
<html>
<head>
    <title>Tambah Employee</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="p-6 max-w-lg mx-auto">
    <h2 class="text-xl font-bold mb-4">Tambah Employee</h2>

    <form method="POST" action="/employees" class="space-y-4">
        @csrf

        <input name="id_number" placeholder="KTP" class="w-full p-2 border rounded">

        <select name="division_id" class="w-full p-2 border rounded">
            @foreach($divisions as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>

        <select name="work_status" class="w-full p-2 border rounded">
            <option>Full Time</option>
            <option>Part Time</option>
            <option>Magang</option>
            <option>Freelance</option>
        </select>

        <input type="date" name="start_work_date" class="w-full p-2 border rounded">

        <button class="bg-green-500 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</div>

</body>
</html>