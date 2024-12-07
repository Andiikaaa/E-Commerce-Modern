<!DOCTYPE html>
<html lang="id">

<link rel="stylesheet" href="{{ asset('css/kategori.css') }}">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
</head>

<body>
    <h2>Tambah Kategori</h2>
    <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="photo">Gambar</label>
        <input type="file" name="photo" required>

        <label for="categories">Kategori</label>
        <input type="text" name="categories" required>

        <label for="description">Deskripsi</label>
        <textarea name="description" required></textarea>

        <label for="price">Harga</label>
        <input type="number" name="price" required>

        <button type="submit">Tambah Kategori</button>
    </form>
</body>

</html>
