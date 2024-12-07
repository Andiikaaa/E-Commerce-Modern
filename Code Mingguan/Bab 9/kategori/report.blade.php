<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Kategori - DigiMart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h2>Report Kategori - DigiMart</h2>
    <p>Berikut adalah daftar kategori yang tersedia:</p>

    <table>
        <thead>
            <tr>
                <th>Photo</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $category->photo) }}" alt="{{ $category->categories }}" style="max-width: 100px; border-radius: 10px;">
                    </td>
                    <td>{{ $category->categories }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
