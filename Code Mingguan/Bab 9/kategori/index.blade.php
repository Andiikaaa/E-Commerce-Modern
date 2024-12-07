<!DOCTYPE html>
<html lang="id">

<link rel="stylesheet" href="{{ asset('css/kategori.css') }}">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - DigiMart</title>
    <link rel="stylesheet" href="{{ asset('css/kategori.css') }}">
</head>

<body>
    <a href="{{ route('kategori.create') }}" class="button-add">Tambah Data</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <tr>
            <th>Photo</th>
            <th>Categories</th>
            <th>Description</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        @foreach($categories as $category)
            <tr>
                <td><img src="{{ asset('storage/' . $category->photo) }}" alt="{{ $category->categories }}" style="max-width: 100px; border-radius: 10px;"></td>
                <td>{{ $category->categories }}</td>
                <td>{{ $category->description }}</td>
                <td>{{ $category->price }}</td>
                <td>
                    <a href="{{ route('kategori.edit', $category->id) }}" class="action-btn edit-btn">Edit</a>
                    <form action="{{ route('kategori.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete-btn">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>